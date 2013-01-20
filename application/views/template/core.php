<?php
    echo View::factory('template/header', get_defined_vars())->render();

    echo View::factory('template/menu/public', get_defined_vars())->render();
?>

    <div class="container">
        <?php echo $content; ?>
    </div> <!-- /container -->

<?php
    echo View::factory('template/footer', get_defined_vars())->render();
?>
