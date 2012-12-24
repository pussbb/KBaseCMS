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
            'admin/page_edit',
            'admin/post_edit'
        ),
    ),
);
