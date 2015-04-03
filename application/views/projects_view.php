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
	<h1>ProjectBook</h1>






	<div id="side-panel">
		<ul>
			<li><a href="<?php echo base_url("index.php/clients"); ?>">Clients</a></li>
			<li><a href="<?php echo base_url("index.php/projects"); ?>">Projects</a></li>

		</ul>
		
		<p>Now:<br><?php echo date('Y-m-d H:i:s'); ?></p>
	</div>




	
	<div id="body">
		
		<h2><?php echo anchor("projects", "Projects"); ?> &raquo; View</h2>

<?php //var_dump($project_edit); ?>

		<?php if(isset($message)){ ?>
		    <p class="message"><?php echo $message; ?></p>		    
		<?php } ?>
		
		<div class="project_view">
			<h2><?php echo $project_view->prj_name; ?></h2>
			
			<div class="box">
	   			<p><span>Client:</span>
					<?php echo $project_view->cient_name; ?>
				</p>
			</div>
		</div>
		
	</div>

	<div class="clear"></div>
	<?php var_dump($project_view); ?>


</div>

</body>
</html>