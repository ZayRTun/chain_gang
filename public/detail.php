<?php require_once('../private/initialize.php'); ?>

<?php

  // Get requested ID
  $id = $_GET['id'] ?? false;

  if (!$id) {
    redirect_to('bicycles.php');
  }

  // Find bicycle using ID
  $bike = Bicycle::find_by_id($id);

?>

<?php $page_title = $bike->name(); ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div class="container-fluid" id="main">
  <div class="row">
    <div class="col-xs-12">
      <a href="bicycles.php">Back to Inventory</a>
    </div>
  </div>
  <div class="row">
    <h4 class="col-xs-11 col-xs-offset-1"><u>Bicycle Details</u></h4>
    <div class="col-xs-11 col-xs-offset-1">
      <dl class="row">
        <dt class="col-xs-2">Brand</dt>
        <dd class="col-xs-6"><?php echo h($bike->brand); ?></dd>
      </dl>
      <dl class="row">
        <dt class="col-xs-2">Model</dt>
        <dd class="col-xs-6"><?php echo h($bike->model); ?></dd>
      </dl>
      <dl class="row">
        <dt class="col-xs-2">Year</dt>
        <dd class="col-xs-6"><?php echo h($bike->year); ?></dd>
      </dl>
      <dl class="row">
        <dt class="col-xs-2">Category</dt>
        <dd class="col-xs-6"><?php echo h($bike->category); ?></dd>
       </dl>
      <dl class="row">
        <dt class="col-xs-2">Gender</dt>
        <dd class="col-xs-6"><?php echo h($bike->gender); ?></dd>
      </dl>
      <dl class="row">
        <dt class="col-xs-2">Color</dt>
        <dd class="col-xs-6"><?php echo h($bike->color); ?></dd>
      </dl>
      <dl class="row">
        <dt class="col-xs-2">Weight</dt>
        <dd class="col-xs-6"><?php echo h($bike->weight_kg()) . ' / ' . h($bike->weight_lbs()); ?></dd>
      </dl>
      <dl class="row">
        <dt class="col-xs-2">Condition</dt>
        <dd class="col-xs-6"><?php echo h($bike->condition()); ?></dd>
      </dl>
      <dl class="row">
        <dt class="col-xs-2">Price</dt>
        <dd class="col-xs-6"><?php echo h("$".number_format($bike->price, 2)); ?></dd>
      </dl>
      <dl class="row">
        <dt class="col-xs-2">Description</dt>
        <dd class="col-xs-6"><?php echo h($bike->description); ?></dd>
      </dl>
    </div>
  </div>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
