<div class="navbar navbar-top ">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse">
                <ul class="nav pull-left">
                <?php

                    $links = array(
                        'about-us' => tr('About us'),
                        'blog' => tr('Blog'),
                        'news' => tr('News'),
                    );
                    foreach($links as $uri => $label){
                        echo '<li>';
                        echo Html::anchor(
                            URL::site($uri),
                            $label
                        );
                        echo '</li>';
                    }
                ?>
                </ul>
                <ul class="nav pull-right">
                <?php
                    $links = array(
                        'users/logout' => tr('Logout'),
                    );
                    foreach($links as $uri => $label){
                        echo '<li>';
                        echo Html::anchor(
                            URL::site($uri),
                            $label
                        );
                        echo '</li>';
                    }
                ?>
                </ul>
            </div><!--/.nav-collapse -->

        </div>
    </div>
</div>
