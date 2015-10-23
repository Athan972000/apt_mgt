<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
<?php foreach ($js as $j): ?>
    <script src="<?php echo base_url() . $j; ?>" type="application/javascript" ></script>
<?php endforeach; ?>