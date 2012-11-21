<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Translations extends Controller_Template_Admin {

    public $languages = NULL;

    private $translations = NULL;
    private $current_language = NULL;
    private $default_language = NULL;

    public function before()
    {
        parent::before();
        $this->languages = Model_Language::find_all()->records;
        $languages_collection = Collection::hash($this->languages, 'code');
        $this->default_language = Arr::get(
            $languages_collection,
            'en'
        );
        $current_language_code = Arr::get($_REQUEST, 'current_translation_language', 'en');
        $this->current_language = Arr::get(
            $languages_collection,
            $current_language_code,
            $this->default_language
        );
        Cookie::set('current_translation_language', $this->current_language->code);
    }

    public function action_index()
    {
        $this->translations = $this->get_translations();
        $this->view->translations = $this->translations;
        $this->view->languages = $this->languages;
        $this->view->current_language = $this->current_language;
        if ($this->request->is_ajax())
            $this->render_partial();
    }

    public function action_update()
    {
        $this->render_nothing();
        $language_id = Arr::get($_REQUEST, 'language_id');
        $languages = Collection::hash($this->languages, 'id');
        $language = Arr::get($languages, $language_id);
        if ( ! $language)
            throw new Exception('Wrong language_id');

        $translation = trim(Arr::get($_REQUEST, 'translation'));
        if ( ! $translation)
            return;
        $identifier = Arr::get($_REQUEST, 'identifier');
        $this->save_translation(
            $identifier,
            $translation,
            $language
        );
    }

    public function action_parse_sources()
    {
        Tools_Language::parse_source();
        $this->redirect('translations');
    }

    public function action_compile_translations()
    {
        Tools_Language::compile_translations();
        $this->redirect('translations');
    }

    private function parse_translations($filename)
    {
        $file = fopen($filename, 'rt');
        $parts = explode("\n\n", fread($file, filesize($filename)));

        //removing header part
        if (isset($parts[0]) && strpos($parts[0], 'Project-Id-Version') !== FALSE)
            unset($parts[0]);

        $result = array();
        foreach ($parts as $key => $part)
        {
            $lines = explode("\n", $part);
            $files = array();
            foreach ($lines as $line)
            {
                if (strpos($line, '#:') === 0)
                {
                    $line = substr($line, 3);
                    $source_file = explode(':', $line);
                    $files[] = array(
                        $source_file[1] => $source_file[0]
                    );
                }
                elseif(strpos($line, 'msgid') === 0)
                {
                    preg_match('/\"(?<id>[^>]*)\"/', $line, $substr);
                    $result[$key]['id'] = Arr::get($substr, 'id', '');
                }
                elseif(strpos($line, 'msgstr') === 0)
                {
                    preg_match('/\"(?<translation>[^>]*)\"/', $line, $substr);
                    $result[$key]['translation'] = Arr::get($substr, 'translation', '');
                }
                elseif(isset($result[$key]['id']) && empty($result[$key]['id']))
                {
                    preg_match('/\"(?<id>[^>]*)\"/', $line, $substr);
                    $result[$key]['id'] = Arr::get($substr, 'id', '');
                }
                $result[$key]['files'] = $files;
            }
        }
        return array_values($result);
    }

    private function get_translations()
    {
        $translations = array();

        $filename = Gettext::absolute_file_path($this->current_language->locale);
        if ( ! file_exists($filename))
            return array();

        $translations = $this->parse_translations($filename);
        $result = array();
        foreach ($translations as $translation)
        {
            $identifier = Arr::get($translation, 'id');
            if ( ! $identifier)
                continue;
            $files = Arr::get($translation, 'files');
            $translation = Arr::get($translation, 'translation');
            $result[$identifier]['translation'] = $translation;
            $result[$identifier]['files'] = $files;
        }
        return $result;
    }

    private function save_translation($identifier, $translation, $language)
    {
        $pattern = '/msgid "'.$identifier.'"\nmsgstr "(\s\S)*"/';
        $replacement = 'msgid "'.$identifier.'"'."\n".'msgstr "'.$translation.'"';
        File::sed(
            Gettext::absolute_file_path($language->locale),
            $pattern,
            $replacement
        );
    }

}
