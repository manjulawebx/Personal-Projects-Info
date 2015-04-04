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



<?php //var_dump($client); ?>
	
	<div id="body">
		
		<h2>Clients </h2>
		
		
		
		
		<?php if(isset($message)){ ?>
		    <p class="message"><?php echo $message; ?></p>		    
		<?php } ?>
		
		
		<!-- EDIT -->
		<?php if(isset($action) && $action=="edit"){ ?>
		
		
		<div id="edit_client" class="form_box">
			<h3>Edit &raquo; </h3>
			<?php echo form_open('clients/edit/'.$client->id, '', array('id'=>$client->id) ); ?>
				<p>Client Name:<br>
					<?php echo form_input('client_name', $client->name); ?>
				</p>
				<p>Telephone:<br>
					<?php echo form_input('client_tele', $client->telephone); ?>
				</p>
				<p>E-Mail:<br>
					<?php echo form_input('client_email', $client->email); ?>
				</p>
				<p>
					Created:<?php echo $client->added; ?><br>
					Modified: <?php echo $client->modified; ?>
				</p>
				<p><?php echo form_submit('submit', 'Update Client'); ?></p>
			<?php echo form_close(); ?>
		</div>
		<!-- END EDIT -->
		
		
		<?php }elseif(isset($action) && $action=="add"){ ?>
		
		
		<!-- ADD -->
		<p><?php echo anchor(base_url("index.php/clients/"), "&laquo; back");?></p>
		
		<div id="add_client" class="box">
			<h3>Add a new client</h3>
			<?php echo form_open('clients/add'); ?>
				<p>Client Name:<br>
					<?php echo form_input('client_name'); ?>
				</p>
				<p>Telephone:<br>
					<?php echo form_input('client_tele'); ?>
				</p>
				<p>E-Mail:<br>
					<?php echo form_input('client_email'); ?>
				</p>
				<p><?php echo form_submit('submit', 'Add Client'); ?></p>
			<?php echo form_close(); ?>
		</div>
		<!-- END ADD -->
		
		
		<?php }else{ ?>
		
		<!-- LIST -->
		
		<p><?php echo anchor(base_url("index.php/clients/add"), "Add");?></p>
		
		<div id="list">
			<?php if($clients){ ?>
			<table class="data-table">
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Telephone</th>
				</tr>
				<?php foreach($clients as $client){ ?>
				<tr>
					<td><?php echo $client->id; ?></td>
					<td><?php echo anchor('clients/edit/'.$client->id, $client->name, 'title="Edit"'); ?></td>
					<td><?php echo mailto( $client->email, $client->email); ?></td>
					<td><?php echo $client->telephone; ?></td>
				</tr>
				<?php } ?>
			</table>
			<?php }else{ ?>
			
			<p>NO CLIENT RECORDS</p>
			
			<?php } ?>
		</div>		
		<!-- END LIST -->
		
		
		
		<?php } ?>
	</div>





</div>

</body>
</html>