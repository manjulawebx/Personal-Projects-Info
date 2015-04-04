<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>ProjectsBook</title>

	<style type="text/css" media="screen">
		<?php echo $css; ?>
	</style>
</head>
<body>

<div id="container">
	<h1><a href="<?php echo base_url();?>">ProjectBook</a></h1>
	
	<div id="">
		
		<div class="project_view">
			
			<h2>Export Completed</h2>
			
			<p class="warning">Sensitive Data Exported. Copy them into an Encrypted Drive &amp; DELETE /exported/ folder content.</p>
			
			<div class="box">
				<table class="export_log">
				<?php foreach($export_log as $log){ ?>
				
					<tr class="<?php echo $log['status']; ?>">
						<td><?php echo $log['status']; ?></td>
						<td><?php echo $log['file']; ?></td>
					</tr>
					
				<?php } ?>
				</table>
			</div>
			
			
		</div><!-- /.project_view -->
		
		
		
	</div>

	<div class="clear"></div>
	<?php //var_dump($project_view); ?>


</div>

</body>
</html>