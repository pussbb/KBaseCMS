<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Admin extends Controller_Core {

    private $user = NULL;
    protected $check_access = FALSE;
    public function before()
    {
        parent::before();
        $this->view->user = $this->user = Auth::instance()->current_user();

    }

    public function action_index()
    {

    }

    public function action_clear_cache()
    {
        $this->rmdir_files(Kohana::$cache_dir);
        $this->render_nothing();
    }

    private function rmdir_files($dir) {
        $dh = opendir($dir);
        if ($dh) {
            while($file = readdir($dh)) {
                if (!in_array($file, array('.', '..'))) {
                    if (is_file($dir.$file)) {
                        unlink($dir.$file);
                    }
                    else if (is_dir($dir.$file)) {
                    rmdir_files($dir.$file);
                    }
                }
            }
            if ( $dir !== Kohana::$cache_dir)
            {
                @chmod($dir, 0777);
                rmdir($dir);
            }
        }
    }
}