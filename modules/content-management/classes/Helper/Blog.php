<?php defined('SYSPATH') or die('No direct script access.');

class Helper_Blog {

    public static function recent($limit = 15)
    {
        return Model_Blog_Post::find_all(array(
            'with' => array('author', 'contents'),
            'limit' => 15,
        ))->records;
    }

    public static function find_by($filter)
    {
        $limit = Arr::get($_REQUEST, 'articles_count');
        $offset = Arr::get($_REQUEST, 'articles_count');
        $filter = array_merge($filter, array(
            'with' => array('author', 'contents'),
            'limit' => $limit ? intval($limit) : 15,
            'offset' => $offset ? intval($offset) : NULL,
        ));
        return Model_Blog_Post::find_all($filter)->records;
    }

    public static function article($filter)
    {
        $filter = array_merge($filter, array('with' => array('author', 'contents')));
        $article = Model_Blog_Post::find($filter);
        $lang = Language::get();
        if ( ! $article->contents)
            throw new Exception("No content found");
        foreach($article->contents as $tr_content)
        {
            if ($lang->id !== $tr_content->language_id)
                continue;
            $article->update_params($tr_content->as_array());
            return $article;
        }
        
        $article->update_params(Arr::get($article->contents, 0)->as_array());
        return $article;
    }
 }
