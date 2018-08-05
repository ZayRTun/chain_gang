      
  <?php if(isset($super_hero_image)) { ?>
    
    <div class="container-fluid expanding-wrapper">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <?php $image_url = url_for('/images/' . $super_hero_image); ?>
          <img class="img-responsive" id="super-hero-image" src="<?php echo $image_url; ?>" />
        </div>
      </div>
      <footer>
        <?php include(SHARED_PATH . '/public_copyright_disclaimer.php'); ?>
      </footer>
    </div>
    
  <?php } else { ?>
    
    <footer>
      <?php include(SHARED_PATH . '/public_copyright_disclaimer.php'); ?>
    </footer>
    
  <?php } ?>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="<?php echo url_for('/script/script.js'); ?>"></script>
  </body>
</html>

  <?php db_disconnect($database); ?>
