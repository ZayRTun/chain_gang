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
    <div class="row">
      <header>
        <h1 class="text-center">Chain Gang Staff Area</h1>
      </header>
    </div>
  </div>

    <?php if ($session->is_logged_in()) { ?>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <h4 class="navbar-text"><strong><u>User: <?php echo $session->username; ?></u></strong></h4>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="<?php echo url_for('/staff/index.php'); ?>">Menu</a></li>
          <li><a href="<?php echo url_for('/staff/logout.php'); ?>">Logout</a></li>
        </ul>
      </div>
    </nav>
    <?php } ?>

    <?php echo display_session_message(); ?>
