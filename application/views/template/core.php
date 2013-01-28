<?php defined('SYSPATH') or die('No direct script access.');
    echo View::factory('template/header', get_defined_vars())->render();
    echo '<header id="page-header">';
        echo View::factory('template/menu/public', get_defined_vars())->render();
    echo '</header>';
?>

<div class="container">
    <?php echo $content; ?>
</div>

<?php
    echo '<footer id="page-footer">';
        echo View::factory('template/footer', get_defined_vars())->render();
    echo '</footer>';
?>
    </body>
</html>
