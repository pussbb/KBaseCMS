<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Pages extends Controller_Template_Admin {

    public function before()
    {
        parent::before();
        $this->type = Arr::get($_REQUEST, 'type', 'file');
        $this->page = Arr::get($_REQUEST, 'page');
        $this->errors = array();
    }

    public function action_index()
    {
        if ($this->request->is_ajax())
            $this->render_partial();
    }

    public function action_new()
    {
        $this->set_filename('admin/pages/form');
        if ($this->request->is_ajax())
            $this->render_partial();
    }

    public function action_edit()
    {
        $this->set_filename('admin/pages/form');
        $this->page = $this->find_page($this->page, $this->type);
        if ($this->request->is_ajax())
            $this->render_partial();
    }

    private function save_page($name = NULL)
    {
        if ( ! $this->page && ! $name){
            $this->errors['filename'] = tr('Page name must be not empty');
            return;
        }
        $pages_path = APPPATH.'views'.DIRECTORY_SEPARATOR.'pages'.DIRECTORY_SEPARATOR;
        switch($this->type) {
            case 'file':
                $file = $this->find_page($this->page);
                if ( ! $file ) {
                    $file = $pages_path.$name.'.php';
                }
                try {
                    file_put_contents($file, Arr::get($_REQUEST, 'content'));
                }
                catch(Exception $e) {
                    $this->errors['general'] = $e->getMessage();
                }
                break;
            case 'folder':
                $file = $this->find_page($this->page);
                if ( ! $file ) {
                    $file = $pages_path.$name;
                }
                $file .= DIRECTORY_SEPARATOR;
                try {
                    Dir::create_if_need($file);
                }
                catch(Exception $e) {
                    $this->errors['general'] = $e->getMessage();
                }
                foreach(Arr::get($_REQUEST, 'content') as $lang => $content)
                {
                    try {
                        file_put_contents($file.$lang.'.php', $content);
                    }
                    catch(Exception $e) {
                        $this->errors['general'] = $e->getMessage();
                    }
                }
                break;
            default:
                throw new Kohana_Exception('Unknown page type');
                break;
        }
    }

    public function action_update()
    {
        $name = Arr::get($_REQUEST, 'filename');
        $this->set_filename('admin/pages/form');
        $this->save_page($name);
        if ($this->errors) {
            if ($this->request->is_ajax())
                return $this->render_partial();
            return;
        }

        if ($this->request->is_ajax())
            return $this->render_nothing();
    }

    public function action_destroy()
    {
        if ( ! $this->is_delete())
            throw new HTTP_Exception_403(tr('Access deny'));

        switch($this->type) {
            case 'file':
                unlink($this->find_page($this->page));
                break;
            case 'folder':
                Dir::rmdir($this->find_page($this->page, 'folder'));
                break;
            default:
                throw new Kohana_Exception('Unknown page type');
                break;
        }
        $this->render_nothing();
    }

    private function find_page($page_name, $type = 'file')
    {
        if ($type === 'file')
            return Kohana::find_file('views', 'pages/'.$page_name);

        $modules = array_merge(array('application' => APPPATH), Kohana::modules());

        foreach($modules as $module)
        {
            $view_path = $module.'views'.DIRECTORY_SEPARATOR.'pages'.DIRECTORY_SEPARATOR;
            foreach(Dir::listing($view_path) as $dir_item)
            {
                $item = pathinfo($dir_item, PATHINFO_FILENAME);
                if (is_dir($dir_item) && $item === $page_name)
                    return $dir_item;
            }
        }
        return NULL;
    }
}
