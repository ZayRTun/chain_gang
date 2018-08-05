<?php
  if(!isset($page_title)) { $page_title = 'Staff Area'; }
?>

<!doctype html>

<html lang="en">
  <head>
    <title>Chain Gang - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />
  </head>

  <body>
  <div class="container-fluid">
    <header>
      <h1 class="text-center">Chain Gang Staff Area</h1>
    </header>
  </div>

    <nav class="navbar nav-navbar">
      <ul>
        <?php if ($session->is_logged_in()) { ?>
        <li>User: <?php echo $session->username; ?></li>
        <li><a href="<?php echo url_for('/staff/index.php'); ?>">Menu</a></li>
        <li><a href="<?php echo url_for('/staff/logout.php'); ?>">Logout</a></li>
        <?php } ?>
      </ul>
    </nav>

    <?php echo display_session_message(); ?>
