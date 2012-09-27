<!doctype html>
<html lang="'en'">
<head>
    <meta charset="utf-8">
<?php
echo '<title>', $title, '</title>', PHP_EOL;

if ($favicon) {
    echo '<link rel ="shortcut icon" href="' .URL::base(TRUE, FALSE) . $favicon. '" type="image/x-icon" />';
}
$media = Media::instance();

foreach (array('keywords', 'description') as $property) {
    if (!$property)
        continue;
    echo '<meta name="'. $property.'" content="' .$property.'"/>';
}

foreach (Media::styles() as $file => $type) {
    echo HTML::style($file, array('media' => $type)), PHP_EOL;
}
echo $media->inline_style();
$development_mode = isset(Kohana::$environment) && Kohana::$environment == Kohana::DEVELOPMENT;
?>

<script>
    var development_mode = <?php echo $development_mode ? 'true' : 'false' ?>;
    var url_base = '<?php echo URL::base(true, true) ?>';
shareUrls = ["" + url_base + "/media/js/ui_lib.js", '//platform.twitter.com/widgets.js', 'http://static.ak.fbcdn.net/connect.php/js/FB.Share', 'https://apis.google.com/js/plusone.js', 'http://platform.linkedin.com/in.js'];

  for (_i = 0, _len = shareUrls.length; _i < _len; _i++) {
    i = shareUrls[_i];
    e = document.createElement('script');
    e.src = shareUrls.shift();
    e.async = true;
    document.getElementsByTagName('head')[0].appendChild(e);
  }

</script>

<?php
foreach (Media::scripts() as $file) {
    echo HTML::script($file), PHP_EOL;
}
echo $media->inline_script();
?>
</head>
    <body>