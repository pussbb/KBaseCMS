<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Page extends Controller_Core {

    protected  $check_access = FALSE;

    public function action_index()
    {
        $page = 'pages'.DIRECTORY_SEPARATOR.$this->request->param('id');
        $dir = APPPATH.'views'.DIRECTORY_SEPARATOR.$page;
        $file_exists = Kohana::find_file('views', $page);
        if ( ! $file_exists && ! is_dir($dir))
            throw new HTTP_Exception_404();

        if ($file_exists)
            return $this->set_filename($page);

        $file = $page.DIRECTORY_SEPARATOR.Language::get()->code;
        $file_exists = Kohana::find_file('views', $file);
        if ($file_exists)
            return $this->set_filename($file);

        $file = $page.DIRECTORY_SEPARATOR.Kohana::$config->load('site.default_language');
        $file_exists = Kohana::find_file('views', $file);
        if ($file_exists)
            return $this->set_filename($file);

        $file = Arr::get(Dir::files($dir), 0);
        if ($file)
            return $this->set_filename(str_replace(array(APPPATH.'views'.DIRECTORY_SEPARATOR,'.php'),'', $file));

        throw new HTTP_Exception_404();

    }

}
