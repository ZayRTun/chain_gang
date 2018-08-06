<?php require_once('../../private/initialize.php'); ?>

<?php require_login(); ?>

<?php $page_title = 'Staff Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="container-fluid" id="content">
  <div class="row" id="main-menu">
    <div class="col-xs-12">
      <h2>Main Menu</h2>
      <ul>
        <li><a href="<?php echo url_for('/staff/bicycles/index.php'); ?>">Bicycles</a></li>
        <li><a href="<?php echo url_for('/staff/admins/index.php'); ?>">Admins</a></li>
    </ul>
    </div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
