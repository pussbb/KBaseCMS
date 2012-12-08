<?php defined('SYSPATH') or die('No direct script access.');

class Feed_RSS_20 extends Feed {

    public function mime_type()
    {
        return 'application/rss+xml';
    }

    protected function start_document()
    {
        $this->startElement('rss');
        $this->writeAttribute('version', '2.0');
        $site = Kohana::$config->load("site");
        $this->startElement("channel");
            $this->writeElement('title', Object::property($site, 'title'));
            $this->writeElement('description', Object::property($site, 'description'));
            $this->writeElement('link', URL::base(TRUE, TRUE));
            $this->writeElement('pubDate', date("D, d M Y H:i:s e"));
            $this->writeElement('lastBuildDate', date("D, d M Y H:i:s e"));
            $this->writeElement('generator', 'KBaseCMS generator v 1.0');
            $this->writeElement('copyright', 'Copyright '.date('Y').' '.Object::property($site, 'copyright'));
            $this->writeElement('managingEditor', Object::property($site, 'managingEditor'));
            $this->writeElement('webMaster',  Object::property($site, 'webMaster'));
    }

    protected function append_item($item)
    {
        $this->startElement('item');
            $this->writeElement('title', $item->title);
            $this->writeElement('link', $item->link?:Helper_Model::url($item,'view'));
            $this->startElement('description');
                $this->writeCData($item->content);
            $this->endElement();
            $this->startElement('guid');
                $this->writeAttribute('isPermaLink', 'true');
                $this->text(Helper_Model::url($item,'view'));
            $this->endElement();
            $this->writeElement('pubDate', Date::format($item->created_at, "D, d M Y H:i:s e"));
            $this->writeElement('author', $item->author->login.' ('.$item->author->email.')');
        $this->endElement();
    }

    protected function _close_document()
    {
         // End channel
        $this->endElement();
        // End rss
        $this->endElement();
        $this->endDocument();
    }

}
