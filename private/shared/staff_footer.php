<footer>
  &copy; <?php echo date('Y'); ?> Chain Gang
</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="<?php echo url_for('/script/script.js'); ?>"></script>
</body>
</html>

<?php
  db_disconnect($database);
?>
<!--public/script/script.js-->