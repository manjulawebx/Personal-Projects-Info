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



<?php //var_dump($client); ?>
	
	<div id="body">
		
		<h2><?php echo anchor("projects", "Projects"); ?> &raquo; <?php echo $action; ?></h2>

<?php //var_dump($project_edit); ?>

		<?php if(isset($message)){ ?>
		    <p class="message"><?php echo $message; ?></p>		    
		<?php } ?>
		
		<div class="form_box">
		  <?php echo form_open(); ?>
		  
		  <?php 
			  if($action=="Edit"){
				  echo form_hidden("id", set_value("id", $project_edit->id, "") ); 
				}
			?>
			<div class="box">
				<p>
					<?php echo form_label("Client:") ?>
					<?php echo form_dropdown('prj_client_id', $clients, set_value('prj_client_id', $project_edit->client_id, "")); ?>
				</p>
				<p>
					<?php echo form_label("Project Name:") ?>
					<?php echo form_input('prj_name', set_value('prj_name', $project_edit->prj_name, "")); ?>
				</p>
				<p>
					<?php echo form_label("Description:") ?>
					<?php echo form_textarea('prj_desc', set_value('prj_desc', $project_edit->prj_description, "")); ?>
				</p>
				<p>
					<?php echo form_label("Est. Value:") ?>
					<?php echo form_input('prj_value', set_value('prj_value', $project_edit->prj_quotation_amount, "")); ?>
				</p>
			</div>
			
			<div class="box">
				<h3>Local (Development)</h3>
				
				<p>
					<?php echo form_label("Local Development URL:") ?>
					<?php echo form_input('prj_url_local', set_value('prj_url_local', $project_edit->prj_local_url, "")); ?>
				</p>
				
				<h4>Admin (Local)</h4>	
				<p>
					<?php echo form_label("Admin URL:") ?>
					<?php echo form_input('prj_url_local_admin', set_value('prj_url_local_admin', $project_edit->prj_local_admin_url, "")); ?>
				</p>
				<p>
					<?php echo form_label("Username:") ?>
					<?php echo form_input('prj_local_admin_un', set_value('prj_local_admin_un', $project_edit->prj_local_admin_un, "")); ?>
				</p>
				<p>
					<?php echo form_label("Password:") ?>
					<?php echo form_input('prj_local_admin_pw', set_value('prj_local_admin_pw', $project_edit->prj_local_admin_pw, "")); ?>
				</p>
				
				
			</div>
			
			<div class="box">	
				<h3>Remote (Production)</h3>
				<p>
					<?php echo form_label("Production URL:") ?>
					<?php echo form_input('prj_url_production', set_value('prj_url_production', $project_edit->prj_prod_url, "")); ?>
				</p>
				
				<h4>Admin (Remote)</h4>
				<p>
					<?php echo form_label("Admin URL:") ?>
					<?php echo form_input('prj_url_production_admin', set_value('prj_url_production_admin', $project_edit->prj_prod_admin_url, "")); ?>
				</p>
				<p>
					<?php echo form_label("Username:") ?>
					<?php echo form_input('prj_production_admin_un', set_value('prj_production_admin_un', $project_edit->prj_prod_admin_un, "")); ?>
				</p>
				<p>
					<?php echo form_label("Password:") ?>
					<?php echo form_input('prj_production_admin_pw', set_value('prj_production_admin_pw', $project_edit->prj_prod_admin_pw, "")); ?>
				</p>
			</div>
			
			<div class="box">	
				<h3>Remote (Testing)</h3>
				<p>
					<?php echo form_label("Testing URL (if any):") ?>
					<?php echo form_input('prj_url_testing', set_value('prj_url_testing', $project_edit->prj_testing_url, "")); ?>
				</p>
				<h4>Admin (Tesing)</h4>
				<p>
					<?php echo form_label("Admin URL:") ?>
					<?php echo form_input('prj_url_testing_admin', set_value('prj_url_testing_admin', $project_edit->prj_testing_admin_url, "")); ?>
				</p>
				<p>
					<?php echo form_label("Username:") ?>
					<?php echo form_input('prj_testing_admin_un', set_value('prj_testing_admin_un', $project_edit->prj_testing_admin_un, "")); ?>
				</p>
				<p>
					<?php echo form_label("Password:") ?>
					<?php echo form_input('prj_testing_admin_pw', set_value('prj_testing_admin_pw', $project_edit->prj_testing_admin_pw, "")); ?>
				</p>
			</div>
			
			<div class="box">
				<h3>.git</h3>
				<p>
					<?php echo form_label("GIT Repository URL:") ?>
					<?php echo form_input('prj_git_url', set_value('prj_git_url', $project_edit->prj_git_repo_url, "")); ?>
				</p>
			</div>
			
			<div class="box">
				<h3>Hosting</h3>
				<p>
					<?php echo form_label("cPanel/Hosting URL:") ?>
					<?php echo form_input('prj_host_url', set_value('prj_host_url', $project_edit->prj_host_url, "")); ?>
				</p>
				<p>
					<?php echo form_label("Hosting Username:") ?>
					<?php echo form_input('prj_host_un', set_value('prj_host_un', $project_edit->prj_host_un, "")); ?>
				</p>
				<p>
					<?php echo form_label("Password:") ?>
					<?php echo form_input('prj_host_pw', set_value('prj_host_pw', $project_edit->prj_host_pw, "")); ?>
				</p>
			</div>
			
			<div class="box">
				<h3>FTP Account (Production server if any)</h3>
				<p>
					<?php echo form_label("FTP Server:") ?>
					<?php echo form_input('prj_ftp_server', set_value('prj_ftp_server', $project_edit->prj_ftp_server, "")); ?>
				</p>
				<p>
					<?php echo form_label("FTP User:") ?>
					<?php echo form_input('prj_ftp_un', set_value('prj_ftp_un', $project_edit->prj_ftp_un, "")); ?>
				</p>
				<p>
					<?php echo form_label("FTP Password:") ?>
					<?php echo form_input('prj_ftp_pw', set_value('prj_ftp_pw', $project_edit->prj_ftp_pw, "")); ?>
				</p>
				<p>
					<?php echo form_label("FTP Path:") ?>
					<?php echo form_input('prj_ftp_path', set_value('prj_ftp_path', $project_edit->prj_ftp_path, "")); ?>
				</p>
			</div>
			
			<p>
				<?php echo form_submit('submit', 'Save'); ?>
			</p>
			
		  <?php echo form_close(); ?>
		  	
		</div><!-- /.form-box -->
		
	</div>





</div>

</body>
</html>