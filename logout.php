<?php
session_start();

define('ROOT_URL', 'http://localhost/forum_web/');
session_destroy();
header('location: '. ROOT_URL);
die();

?>