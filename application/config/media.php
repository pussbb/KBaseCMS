<?php defined('SYSPATH') or die('No direct script access.');

return array(
    'base' => array(
        'js' => array(
            'jquery/jquery.min',
        ),
    ),
    'default' => array(
        'depends' => array('base'),
        'css' => array(
            'bootstrap/bootstrap' => '',
            'main' => '',
            'ui' => ''
        ),
        'js' => array(

            'bootstrap/bootstrap',
            'bootstrap/datepicker',
            'ui_lib' => array(
                'files' => array(
                    'lib/init',
                    'lib/is',
                    'lib/tWidget',
                    'lib/tDialog',
                    'lib/tConfirm',
                    'lib/pseudo_ajax_load_progress',
                    'lib/inline_alert',
                    'lib/formControl'
                )

            ),
        ),
        'coffee' => array(
            'dsdfsdf'
        ),

        'less' => array(
            'sdfsdf'
        ),
    ),
);
