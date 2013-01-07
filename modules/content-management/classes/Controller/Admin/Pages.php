<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Pages extends Controller_Template_Admin {

    private $config_file = NULL;

    public function before()
    {
        parent::before();
        $this->config_file = APPPATH.'config'.DIRECTORY_SEPARATOR.'pages'.EXT;
        $this->type = Arr::get($_REQUEST, 'type', 'file');
        $this->page = trim(Arr::get($_REQUEST, 'filename', Arr::get($_REQUEST, 'page')), '-');
        $this->errors = array();
        if ( ! file_exists($this->config_file))
            $this->save_config(array());
        $this->pages_config = Kohana::$config->load('pages');
        $this->absoluteFilePath = NULL;
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
        $this->absoluteFilePath = $this->find_page($this->page, $this->type);
        if ($this->request->is_ajax())
            $this->render_partial();
    }

    private function save_page()
    {
        if ( ! $this->page){
            $this->errors['filename'] = tr('Page name must be not empty');
            return;
        }
        if ( count(explode('-', $this->page)) < 2) {
            $this->errors['filename'] = tr('Page name must in format "here-page-of-something"');
            return;
        }

        $pages_path = APPPATH.'views'.DIRECTORY_SEPARATOR.'pages'.DIRECTORY_SEPARATOR;

        switch($this->type) {
            case 'file':
                $this->absoluteFilePath = $this->find_page($this->page);
                if ( ! $this->absoluteFilePath ) {
                    $this->absoluteFilePath = $pages_path.$this->page.'.php';
                }
                try {
                    file_put_contents($this->absoluteFilePath, Arr::get($_REQUEST, 'content'));
                }
                catch(Exception $e) {
                    $this->errors['general'] = $e->getMessage();
                }
                $this->pages_config[$this->page] = array(
                    'title' => Arr::get($_REQUEST, 'title'),
                    'keywords' => Arr::get($_REQUEST, 'keywords'),
                    'description' => Arr::get($_REQUEST, 'description')
                );
                $this->save_config((array)$this->pages_config);
                break;
            case 'folder':
                $this->absoluteFilePath = $this->find_page($this->page);
                if ( ! $this->absoluteFilePath ) {
                    $this->absoluteFilePath = $pages_path.$this->page;
                }
                $this->absoluteFilePath .= DIRECTORY_SEPARATOR;
                try {
                    Dir::create_if_need($this->absoluteFilePath);
                }
                catch(Exception $e) {
                    $this->errors['general'] = $e->getMessage();
                }
                $attr = array();
                foreach(Arr::get($_REQUEST, 'content') as $lang => $content)
                {
                    $attr[$lang] = array(
                        'title' => Arr::path($_REQUEST, 'title.'.$lang),
                        'keywords' => Arr::path($_REQUEST, 'keywords.'.$lang),
                        'description' => Arr::path($_REQUEST, 'description.'.$lang)
                    );
                    try {
                        file_put_contents($this->absoluteFilePath.$lang.'.php', $content);
                    }
                    catch(Exception $e) {
                        $this->errors['general'] = $e->getMessage();
                    }
                }
                $this->pages_config[$this->page] = $attr;
                $this->save_config((array)$this->pages_config);
                break;
            default:
                throw new Kohana_Exception('Unknown page type');
                break;
        }
    }

    private function save_config(array $config)
    {
        try {
            $the_header = "<?php defined('SYSPATH') or die('No direct script access.'); \n\nreturn ";
            $content = $the_header.var_export($config , true ).';';
            file_put_contents($this->config_file, $content);
        }
        catch(Exception $e) {
            $this->errors['general'] = $e->getMessage();
        }
    }

    public function action_update()
    {
        $name = Arr::get($_REQUEST, 'filename');
        $this->set_filename('admin/pages/form');
        $this->save_page();
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
        if (isset($this->pages_config[$this->page])) {
            unset($this->pages_config[$this->page]);
            $this->save_config((array)$this->pages_config);
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
