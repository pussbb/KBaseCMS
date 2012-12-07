<?php defined('SYSPATH') or die('No direct script access.');

    echo View::factory('template/header', get_defined_vars())->render();

        echo '<div id="header">';
            echo '<h1>';
            echo HTML::anchor('amdin', tr('Admin area'));
            echo '</h1>';
        echo '</div>';
        echo '<div class="app-mode">';
        $mode = '<i class="icon-ok-sign"></i> '.tr('Mode:').' ';
        switch ( Kohana::$environment) {
            case Kohana::PRODUCTION : echo '<span class="badge badge-success">'.$mode.tr('Production').'</span>'; break;
            case Kohana::STAGING: echo '<span class="badge badge-warning">'.$mode.tr('Staging').'</span>'; break;
            case Kohana::TESTING: echo '<span class="badge badge-info">'.$mode.tr('Testing').'</span>'; break;;
            default: echo '<span class="badge badge-important">'.$mode.tr('Development').'</span>'; break;
        }
        echo '</div>';
        ?>

        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav btn-group">
            <li>
                <li class="btn btn-inverse" ><a title="" href="#"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li>
                <li class="btn btn-inverse dropdown" id="menu-messages">
                    <a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><span class="text"><?php echo tr('Tools');?></span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a title="" href="<?php echo URL::site('admin/translations/').'?current_translation_language='.Cookie::get('current_translation_language', 'en');?>"><i class="icon-flag"></i><?php echo tr('Languages');?></a></li>
                        <li><a title="" href="<?php echo URL::site('admin/welcome/clean_cache');?>" data-toggle="confirm"><i class="icon-trash"></i><?php echo tr('Clean cache');?></a></li>
                        <li><a title="" href="<?php echo URL::site('admin/welcome/logs');?>"><i class="icon-list-alt"></i><?php echo tr('Logs');?></a></li>
                        <li><a title="" href="#"><i class="icon-magic"></i><?php echo tr('Backup');?></a></li>
                    </ul>
                </li>
                <li class="btn btn-inverse">
                  <a title="" href="#"><i class="icon icon-cog"></i> <span class="text"><?php echo tr('Settings');?></span></a>
                </li>
                <li class="btn btn-inverse">
                    <?php
                        echo HTML::anchor(URL::site('users/logout'),
                            '<i class="icon icon-share-alt"></i> <span class="text">'.tr('Logout').'</span>',
                            array('data-click' => "skip" )
                        );
                    ?>
                </li>
            </ul>
         </div>

        <div id="sidebar">
            <ul>
                <li class="active"><a href="#"><i class="icon icon-home"></i> <span>Dashboard</span></a></li>
              <?php
                foreach(Admin_Modules::instance()->modules() as $module) {
                    $submenu = Arr::get($module, 'menu');
                    echo '<li '.($submenu?'class="submenu"':'').'>';
                    $title = Arr::path($module, 'info.icon').'<span>'.Arr::path($module, 'info.name').'</span>';
                    $link = '#';
                    if ($submenu) {
                        array_unshift($submenu, array('uri' => Arr::path($module, 'info.uri'), 'title' => tr('Dashboard')));
                        $title .= '<span class="label">'.count($submenu).'</span>';
                    }
                    else {
                        $link = URL::site('admin/'.Arr::path($module, 'info.uri'));
                    }

                    echo HTML::anchor($link, $title);

                        if ($submenu) {
                        ;
                          echo '<ul>';
                          foreach($submenu as $menu_item) {
                              echo '<li>';
                              echo HTML::anchor('admin/'.Arr::get($menu_item, 'uri'),
                                        '<span>'.Arr::path($menu_item, 'title').'</span>');
                              echo '</li>';
                          }

                          echo '</ul>';
                        }
                    echo '</li>';
                }

              ?>
            </ul>

        </div>
        <?php
    echo '<div class="container" id="content">';
            echo '<div class="container-fluid">';
                echo '<div class="request-info"></div>';
                echo '<div class="form-container"></div>';
                echo '<div class="fluid-content">';
                echo $content;
                echo '</div>';
                echo '<div class="details-container"></div>';
            echo '</div>';
    echo '</div>';

    echo View::factory('template/footer', get_defined_vars())->render();

