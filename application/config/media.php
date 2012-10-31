<?php defined('SYSPATH') or die('No direct script access.');

return array(
    'default' => array(
        'css' => array(
            'bootstrap/bootstrap' => '',
            'main' => '',
            'ui' => ''
        ),
        'js' => array(
            'jquery/jquery.min',
            'bootstrap/bootstrap',
            'bootstrap/datepicker',
            'ui_lib' => array(
                'lib/is',
                'lib/pseudo_ajax_load_progress',
                'lib/inline_alert',
            ),
        ),
    ),
);