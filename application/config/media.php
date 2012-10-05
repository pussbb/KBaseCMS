<?php defined('SYSPATH') or die('No direct script access.');

return array(
    'default' => array(
        'css' => array(
            'bootstrap/bootstrap' => '',
            'main' => '',
        ),
        'js' => array(
            'jquery/jquery.min',
            'bootstrap/bootstrap.min',
            array(
                'ui_lib',
                array(
                    'lib/pseudo_ajax_load_progress',
                    'lib/inline_alert',
                ),
            ),
        ),
    ),
);