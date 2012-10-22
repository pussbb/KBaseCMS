<?php defined('SYSPATH') or die('No direct script access.');

    echo View::factory('template/header', get_defined_vars())->render();

        echo '<div id="header">';
            echo '<h1>';
            echo HTML::anchor('amdin', tr('Admin area'));
            echo '</h1>';
        echo '</div>';
        ?>
<script>
$(document).ready(function(){
    $('.submenu > a').click(function(e)
    {
        e.preventDefault();
        var submenu = $(this).siblings('ul');
        var li = $(this).parents('li');
        var submenus = $('#sidebar li.submenu ul');
        var submenus_parents = $('#sidebar li.submenu');
        if(li.hasClass('open'))
        {
            if(($(window).width() > 768) || ($(window).width() < 479)) {
                submenu.slideUp();
            } else {
                submenu.fadeOut(250);
            }
            li.removeClass('open');
        } else
        {
            if(($(window).width() > 768) || ($(window).width() < 479)) {
                submenus.slideUp();
                submenu.slideDown();
            } else {
                submenus.fadeOut(250);
                submenu.fadeIn(250);
            }
            submenus_parents.removeClass('open');
            li.addClass('open');
        }
    });

    var ul = $('#sidebar > ul');

    $('#sidebar > a').click(function(e)
    {
        e.preventDefault();
        var sidebar = $('#sidebar');
        if(sidebar.hasClass('open'))
        {
            sidebar.removeClass('open');
            ul.slideUp(250);
        } else
        {
            sidebar.addClass('open');
            ul.slideDown(250);
        }
    });
});
</script>
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav btn-group">
                <li class="btn btn-inverse" ><a title="" href="#"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li>
                <li class="btn btn-inverse dropdown" id="menu-messages">
                    <a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><span class="text"><?php echo tr('Tools');?></span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a title="" href="#"><?php echo tr('Languages');?></a></li>
                        <li><a title="" href="#"><?php echo tr('Clean cache');?></a></li>
                        <li><a title="" href="#"><?php echo tr('Logs');?></a></li>
                        <li><a title="" href="#"><?php echo tr('Backup');?></a></li>
                    </ul>
                </li>
                <li class="btn btn-inverse">
                  <a title="" href="#"><i class="icon icon-cog"></i> <span class="text"><?php echo tr('Settings');?></span></a>
                </li>
                <li class="btn btn-inverse">
                    <?php
                        echo HTML::anchor('users/logout',
                            '<i class="icon icon-share-alt"></i> <span class="text">'.tr('Logout').'</span>'
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
                    echo HTML::anchor('admin/'.Arr::path($module, 'info.uri'),
                                        '<span>'.Arr::path($module, 'info.name').'</span>');
                        
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
    echo '<div class="container" id="content">';?>
            <div id="content-header">

            </div>

            <div class="container-fluid">
    <?php
      echo $content;
    echo '</div></div>';

    echo View::factory('template/footer', get_defined_vars())->render();

