<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>ProjectsBook</title>

	<link rel="stylesheet" href="<?php echo base_url();?>/css/styles.css" type="text/css" media="screen" charset="utf-8">
</head>
<body>

<div id="container">
	<h1><a href="<?php echo base_url();?>">ProjectsBook</a></h1>






	<div id="side-panel">
		<ul>
			<li><a href="<?php echo base_url("index.php/clients"); ?>">Clients</a></li>
			<li><a href="<?php echo base_url("index.php/projects"); ?>">Projects</a></li>

		</ul>
		
		<p>Now:<br><?php echo date('Y-m-d H:i:s'); ?></p>
	</div>




	
	<div id="body">
		
		<p><?php echo anchor("projects", "Projects"); ?> &raquo; <?php echo anchor( "projects/view/".$log_edit->project_id ,$project_name); ?> &raquo; edit log</p>



		<?php if(isset($message)){ ?>
		    <p class="message"><?php echo $message; ?></p>		    
		<?php } ?>
		
		<?php echo form_open('', '',array('log_id'=>$log_edit->id)); ?>
		
		<div class="form_box">
		  
		    <p>
			  <?php echo form_textarea('log_details', set_value('log_details', $log_edit->log_details, "")); ?>
			</p>
			
			<p>
				#<?php echo $log_edit->id; ?> <br> Created: <?php echo $log_edit->log_created; ?> <br> Modified: <?php echo $log_edit->log_modified; ?> 
			</p>
			
			<p>
				<?php echo form_submit('submit', 'Save'); ?>
			</p>
		</div>
			
		
			
		<?php echo form_close(); ?>
		  	
		</div><!-- /.form-box -->
		
	</div>





</div>

</body>
</html>