<!-- For success message -->
<?php if(isset($_SESSION['success'])){ $message = $_SESSION['success']; unset($_SESSION['success']); ?>
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong><?php echo $message ?></strong>
</div>
<?php } ?>

<!-- For error message -->

<?php if(isset($_SESSION['error'])){ $message = $_SESSION['error']; unset($_SESSION['error']);?>
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong><?php echo $message ?></strong>
</div>
<?php } ?>

<!-- For warning message -->
<?php if(isset($_SESSION['warning'])){ $message = $_SESSION['warning']; unset($_SESSION['warning']);?>
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong><?php echo $message ?></strong>
</div>
<?php } ?>

<!-- For info message -->
<?php if(isset($_SESSION['info'])){ $message = $_SESSION['info']; unset($_SESSION['info']); ?>
<div class="alert alert-info alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong><?php echo $message ?></strong>
</div>
<?php } ?>

