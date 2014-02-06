<div class="navbar navbar-top site-bar">
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
                        '' => tr('Home'),
                        'blog' => tr('Blog'),
                        'news' => tr('News'),
                        'about-us' => tr('About us'),
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
                    if (Auth::instance()->logged_in()) {
                        $links = array(
                            'users/logout' => tr('Logout'),
                        );
                    }
                    else {
                        $links = array(
                            'users/register' => tr('Register'),
                            'users/login' => tr('Login')
                        );
                    }
                    $request_uri = preg_replace(Language::uri_check_codes(), '', Request::current()->uri());
                    $langs = array();
                    foreach(Language::available() as $lang) {
                        $label = HTML::image('images/langs/'.$lang->code.'.png', array(
                            'alt' => $lang->name,
                            'width' => 32,
                            'height' => 32,
                        ));
                        $uri = Text::reduce_slashes($lang->code.'/'.$request_uri.URL::query());
                        echo '<li class="icons">';
                            echo Html::anchor(
                                URL::site($uri, TRUE, TRUE, FALSE),
                                $label
                            );
                        echo '</li>';
                    }

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
