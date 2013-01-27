<?php defined('SYSPATH') or die('No direct script access.');

return array(
    'admin' => array(
        'css' => array(
            'codemirror/codemirror' => '',
            'codemirror/theme/monokai' => '',
        ),
        'js' => array(
            'codemirror/codemirror-min.full',
            'ckeditor/ckeditor',
            'admin/content' => array(
                'admin/common',
                'admin/page_edit',
                'admin/post_edit'
            )
        ),
    ),
    'blog' => array(
        'css' => array(),
        'js' => array(
            'blog/main' => array(
                'blog/archive.block'
            )
        )
    ),
    'backbone' => array(
        'css' => array(),
        'js' => array(
            'backbone/underscore-min',
            'backbone/backbone-min'
        ),
    ),
    'blog_archives' => array(
        'css' => array(
            'blog/archives' => '',
        ),
        'js' => array(
            'blog/archives' => array(
                'blog/archives/models/articles',
                'blog/archives/models/months',
                'blog/archives/models/years',
                'blog/archives/views/articles',
                'blog/archives/views/months',
                'blog/archives/views/years',
                'blog/archives/app',
            )
        ),
    ),
);
