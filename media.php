<?php
$menu = $_GET['menu'];
switch ($menu) {
  case 'blog':
    include_once 'blog.php';
    break;
  case 'daftar':
    include_once 'daftar.php';
    break;
  case 'gallery':
    include_once 'gallery.php';
    break;

  default:
    include_once 'home.php';
    break;
}
