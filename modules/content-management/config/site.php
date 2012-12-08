<?php defined('SYSPATH') or die('No direct script access.');

$domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];

return array(
    "description" => "small site description",
    "copyright" => "owner@".$domain,
    "managingEditor" => "editor@".$domain,
    "webMaster" => "webmaster@".$domain,
);

