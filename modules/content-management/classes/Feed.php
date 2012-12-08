<?php defined('SYSPATH') or die('No direct script access.');

abstract class Feed extends XMLWriter  {

    public function __construct()
    {
        $this->openMemory();
        $this->setIndent(true);
        $this->setIndentString(' ');
        $this->startDocument('1.0', 'UTF-8');

    }

    public static function factory($type)
    {
        $klass = "Feed_".str_replace(array('.','/'),array('','_'),strtoupper($type));
        return new $klass;
    }

    abstract protected function _close_document();
    abstract protected function start_document();
    abstract protected function append_item($item);
    abstract public function mime_type();

    private function get_items()
    {
        return Model_News::find_all(array('with'=> 'author'))->records;
    }

    public function render()
    {
        $this->start_document();
        foreach($this->get_items() as $item)
        {
            $this->append_item($item);
        }
        $this->_close_document();
        return $this->outputMemory(TRUE);
    }
}
