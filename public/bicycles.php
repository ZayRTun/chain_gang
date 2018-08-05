<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Inventory'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div class="container-fluid" id="main">
  <div class="row">

    <div id="page">
      <div class="col-md-6 col-md-offset-3 intro">
        <img class="img-responsive center-block inset" src="<?php echo url_for('/images/AdobeStock_55807979_thumb.jpeg') ?>" />
        <h2 class="text-center">Our Inventory of Used Bicycles</h2>
        <p class="text-center">Choose the bike you love.</p>
        <p class="text-center">We will deliver it to your door and let you try it before you buy it.</p>
      </div>

      <div class="col-md-8 col-md-offset-2">
        <table class="table table-condensed table-bordered table-striped table-hover" id="inventory">
      </div>
        <tr>
          <th>Brand</th>
          <th>Model</th>
          <th>Year</th>
          <th>Category</th>
          <th>Gender</th>
          <th>Color</th>
          <th>Price</th>
          <th>&nbsp;</th>
        </tr>
  <?php

    $bikes = Bicycle::find_all();

  ?>
      <?php foreach ($bikes as $bike) { ?>
        <tr>
          <td><?php echo h($bike->brand); ?></td>
          <td><?php echo h($bike->model); ?></td>
          <td><?php echo h($bike->year); ?></td>
          <td><?php echo h($bike->category); ?></td>
          <td><?php echo h($bike->gender); ?></td>
          <td><?php echo h($bike->color); ?></td>
          <td><?php echo h("$".number_format($bike->price, 2)); ?></td>
          <td style="text-align: center"><a href="detail.php?id=<?php echo $bike->id; ?>">View</a></td>
        </tr>
      <?php } ?>

      </table>

    </div>

  </div>


</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>

