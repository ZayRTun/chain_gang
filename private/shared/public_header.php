<!doctype html>

<html lang="en">
  <head>
    <title>Chain Gang <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>" />
  </head>

  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="<?php echo url_for('/index.php'); ?>" class="navbar-brand">
            Chain Gang
          </a>
        </div>
        <ul class="nav navbar-nav" id="menu">
          <li><a href="<?php echo url_for('/bicycles.php'); ?>">View Our Inventory</a></li>
          <li><a href="<?php echo url_for('/about.php'); ?>">About Us</a></li>
        </ul>
      </div>
    </nav>

