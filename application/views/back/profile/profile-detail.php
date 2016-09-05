			<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("div.controls").css({'padding-top':'15px'});
		        });

		    	function cancel(){
			    	
				}
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Profile Saya</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/profile')?>">Profile</a><span class="divider">/</span></li>
						<li class='active'><?php echo $user->FULLNAME?></li>
					</ul>
				</div>
			</div>
			
			<div class="container-fluid" id="content-area">
				<?php if($this->session->flashdata('error') != null):?>
	        		<div class="alert alert-error">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?php echo $this->session->flashdata('error'); ?>
					</div>
		    	<?php endif;?>
		    	<?php if($this->session->flashdata('success') != null):?>
		        	<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?php echo $this->session->flashdata('success'); ?>
					</div>
		    	<?php endif;?>
		    	
				<form enctype="multipart/form-data" action="<?php echo site_url('backoffice/users/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Data Login <?php echo $user->FULLNAME?></span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Username</label>
										<div class="controls">
											<?php echo $user->USERNAME?>
										</div>
									</div>
									<div class="control-group">
										<label for="pwfield" class="control-label">Password</label>
										<div class="controls">
											**********************
										</div>
									</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span><?php echo $user->FULLNAME?></span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Lengkap</label>
										<div class="controls">
											<?php echo $user->FULLNAME?>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Gambar</label>
										<div class="controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 180px;"><img src="<?php if($user->IMAGE != '')echo $this->config->item('img_path').'users/'.$user->IMAGE; else echo 'http://www.placehold.it/180x230/EFEFEF/AAAAAA&amp;text=no+image' ?>" /></div>
												
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Email</label>
										<div class="controls">
											<?php echo $user->EMAIL?>
										</div>
									</div><div class="control-group">
										<label for="textfield" class="control-label">Telepon</label>
										<div class="controls">
											<?php echo $user->PHONE?>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Alamat</label>
										<div class="controls">
											<?php echo $user->ADDRESS?>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Bio</label>
										<div class="controls">
											<?php echo $user->BIO?>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Status</label>
										<div class="controls">
											<?php 
												if($user->STATUS == 'A')echo 'Aktif';
												else if($user->STATUS == 'N')echo 'Tidak Aktif';
											?>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Role</label>
										<div class="controls">
											<?php 
												if($user->ROLE == '1')echo 'Super User';
												else if($user->ROLE == '2')echo 'Redaktur';
												else echo 'Marketing';
											?>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Dibuat Oleh</label>
										<div class="controls">
											<strong><?php echo $user->CREATED_BY?></strong> | <?php echo $this->bogcamp->convertDate($user->CREATED_DATE)?>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Diperbarui Oleh</label>
										<div class="controls">
											<?php if($user->UPDATED_BY != ""){?>
												<strong><?php echo $user->UPDATED_BY?></strong> | <?php echo $this->bogcamp->convertDate($user->UPDATED_DATE)?>
											<?php }else echo "-";?>
										</div>
									</div>
							</div>
							
						</div>
					</div>
				</div>
				
				</form>
			</div>
			
			
			