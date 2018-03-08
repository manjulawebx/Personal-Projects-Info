<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Projects Book</title>

	<link rel="stylesheet" href="<?php echo base_url();?>/css/styles.css" type="text/css" media="screen" charset="utf-8">
</head>
<body>

<div id="container">
	<h1>ProjectsBook</h1>


	<div id="side-panel">
		<ul>
			<li><a href="<?php echo base_url("index.php/clients"); ?>">Clients</a></li>
			<li><a href="<?php echo base_url("index.php/projects"); ?>">Projects</a></li>

		</ul>
		
		<?php echo form_open("projects/search/", array('method' => 'get')); ?>
			<p>
				<?php echo form_input('search_text', set_value('search_text', isset($search_text)?$search_text:"", "")); ?>
			</p>
			
			<p>
				<?php echo form_submit('submit', 'Search'); ?>
			</p>
		
		<?php echo form_close(); ?>
		
	</div>



<?php //var_dump($client); ?>
	
	<div id="body">
		
		<h2>Projects </h2>
		
		
		
		
		<?php if(isset($message)){ ?>
		    <p><?php echo $message; ?></p>		    
		<?php } ?>
		
		
		
		
		<!-- LIST -->
		
		<p><?php echo anchor(base_url("index.php/projects/add"), "Add");?></p>
		
		<div id="list">
			<?php if(isset($projects) && is_array($projects)){ ?>
			
				<table class="data-table">
					<tr>
						<th>#</th>
						<th>Project Name</th>
						<th>Client</th>
						<th>Modified</th>
						<th></th>
					</tr>
					<?php foreach($projects as $project){ ?>
					<tr>
						<td><?php echo $project->id; ?></td>
						<td><?php echo anchor('projects/view/'.$project->id, $project->prj_name, 'title="View"'); ?></td>
						<td><?php echo anchor('clients/edit/'.$project->client_id, $clients[$project->client_id]); ?></td>
						<td><?php echo $project->prj_modified; ?></td>
						<td><?php echo anchor('projects/add/'.$project->id, "Edit"); ?></td>
					</tr>
					<?php } ?>
				</table>
			
			<?php }else{ ?>
			
				<p>NO RECORDS</p>
			
			<?php } ?>
		</div>		
		<!-- END LIST -->
		

	</div>





</div>

	<p class="footer"><?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</body>
</html>