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
                'lib/init',
                'lib/is',
                'lib/tWidget',
                'lib/tDialog',
                'lib/tConfirm',
                'lib/pseudo_ajax_load_progress',
                'lib/inline_alert',
                'lib/formControl'
            ),
        ),
    ),
);
