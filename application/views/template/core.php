<?php
    echo View::factory('template/header', get_defined_vars())->render();

    if ( ! Auth::instance()->logged_in())
        echo View::factory('template/menu/public', get_defined_vars())->render();
    else
        echo View::factory('template/menu/user', get_defined_vars())->render();

?>

    <div class="container">
        <?php echo $content; ?>
    </div> <!-- /container -->

<?php
    echo View::factory('template/footer', get_defined_vars())->render();
?>
