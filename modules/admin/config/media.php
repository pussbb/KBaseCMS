<?php defined('SYSPATH') or die('No direct script access.');

return array(
    'admin' => array(
        'css' => array(
            'admin/main' => '',
            'admin/grey' => '',
        ),
        'js' => array(
            'admin/main' => array(
              'admin/init',
              'admin/sidebar',
              'admin/loader',
              'admin/table',
            ),
        ),
    ),
);
