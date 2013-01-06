<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Page extends Controller_Core {

    protected $check_access = FALSE;
    protected $type = 'file';
    protected $lang = NULL;

    public function action_index()
    {
        $page = 'pages'.DIRECTORY_SEPARATOR.$this->request->param('id');
        $dir = APPPATH.'views'.DIRECTORY_SEPARATOR.$page;
        $file_exists = Kohana::find_file('views', $page);
        if ( ! $file_exists && ! is_dir($dir))
            throw new HTTP_Exception_404();

        if ($file_exists)
            return $this->set_filename($page);

        $this->type = 'folder';
        $this->lang = Language::get()->code;
        $file = $page.DIRECTORY_SEPARATOR.$this->lang ;
        $file_exists = Kohana::find_file('views', $file);
        if ($file_exists)
            return $this->set_filename($file);

        $this->lang = Kohana::$config->load('site.default_language');
        $file = $page.DIRECTORY_SEPARATOR.$this->lang;
        $file_exists = Kohana::find_file('views', $file);
        if ($file_exists)
            return $this->set_filename($file);

        $this->lang = Arr::get(Dir::files($dir), 0);
        if ($this->lang)
            return $this->set_filename(str_replace(array(APPPATH.'views'.DIRECTORY_SEPARATOR,'.php'),'', $this->lang));

        throw new HTTP_Exception_404();

    }

    public function after()
    {
        $pages_config = Kohana::$config->load('pages.'.$this->request->param('id'));
        if ( ! $pages_config) {
            parent::after();
            return;
        }
        if ($this->type === 'folder')
        {
            $pages_config = Arr::get($pages_config, $this->lang, array());
        }
        $this->set_title(Arr::get($pages_config, 'title'));
        $this->set_description(Arr::get($pages_config, 'description'));
        $this->set_keywords(Arr::get($pages_config, 'keywords'));
        parent::after();
    }

}
