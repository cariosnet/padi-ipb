			<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
			<script type="text/javascript">
		    	$(document).ready(function(){
		    		/* $("#menu-adm").addClass('active open');
		    		$("#submenu-users-list").addClass('active'); */
		        });

		    	function cancel(){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/home'?>"; 
				}
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Ubah Profile</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/profile')?>">Profile Saya</a><span class="divider">/</span></li>
						<li class='active'>Ubah Profile</li>
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
		    	
				<form enctype="multipart/form-data" action="<?php echo site_url('backoffice/profile/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Data Login</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Username</label>
										<div class="controls">
											<input type="text" name="username" class="input-xlarge" data-rule-required="true" value="<?php echo $user->USERNAME?>" readonly="readonly">
											<input type="hidden" name="username_old" value="<?php echo $user->USERNAME?>">
											<input type="hidden" name="id" value="<?php echo $user->ID?>">
										</div>
									</div>
									<div class="control-group">
										<label for="pwfield" class="control-label">Password</label>
										<div class="controls">
											<input type="password" name="password" id="pwfield" class="input-xlarge">
											<span class="help-block">
												Kosongkan jika tidak mengubah password
											</span>
										</div>
									</div>
									<div class="control-group">
										<label for="confirmfield" class="control-label">Konfirmasi password</label>
										<div class="controls">
											<input type="password" name="confirmPassword" id="confirmfield" class="input-xlarge" data-rule-equalTo="#pwfield">
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
								<span>Data Pengguna</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Lengkap</label>
										<div class="controls">
											<input type="text" value="<?php echo $user->FULLNAME?>" name="fullname" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Gambar</label>
										<div class="controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 180px;"><img src="<?php if($user->IMAGE != '')echo $this->config->item('img_path').'users/'.$user->IMAGE; else echo 'http://www.placehold.it/180x230/EFEFEF/AAAAAA&amp;text=no+image' ?>" /></div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 180px; max-height: 230px; line-height: 20px;"></div>
												<div>
													<span class="button button-basic btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="image" /></span>
													<a href="#" class="button button-basic fileupload-exists" data-dismiss="fileupload">Remove</a>
												</div>
												
												<input type="hidden" name="image_old" value="<?php echo $user->IMAGE?>">
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Email</label>
										<div class="controls">
											<input type="text" name="email" value="<?php echo $user->EMAIL?>" data-rule-email="true" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div><div class="control-group">
										<label for="textfield" class="control-label">Telepon</label>
										<div class="controls">
											<input type="text" name="phone" value="<?php echo $user->PHONE?>" class="input-xlarge" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Alamat</label>
										<div class="controls">
											<textarea name="address" class='span12' rows="10" id="address"><?php echo $user->ADDRESS?></textarea>
								
											<script type="text/javascript">
												var editor = CKEDITOR.replace('address', {
													skin: 'moonocolor',
													toolbar :
														[
															{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
															{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
															{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
															{ name: 'tools', items : [ 'Maximize','-','About' ] }
														]
												});
											</script>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Bio</label>
										<div class="controls">
											<textarea name="bio" class='span12' rows="10" id="bio"><?php echo $user->BIO?></textarea>
								
											<script type="text/javascript">
												var editor = CKEDITOR.replace('bio', {
													skin: 'moonocolor',
													toolbar :
														[
															{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
															{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
															{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
															{ name: 'tools', items : [ 'Maximize','-','About' ] }
														]
												});
											</script>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Dibuat Oleh</label>
										<div class="controls" style="padding-top: 14px;">
											<strong><?php echo $user->CREATED_BY?></strong> | <?php echo $this->bogcamp->convertDate($user->CREATED_DATE)?>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Diperbarui Oleh</label>
										<div class="controls" style="padding-top: 14px;">
											<?php if($user->UPDATED_BY != ""){?>
												<strong><?php echo $user->UPDATED_BY?></strong> | <?php echo $this->bogcamp->convertDate($user->UPDATED_DATE)?>
											<?php }else echo "-";?>
										</div>
									</div>
									
									<div class="form-actions">
										<button type="submit" name="save" value="Simpan" class="button button-basic-blue">Simpan</button>
										<a href="javascript:void();" class="button button-basic" onclick="confirmPopUp('cancel();', 'Peringatan..', 'Anda yakin ingin membatalkan pembuatan berita ??', 'Ya', 'Tidak');">Batal</a>
									</div>
							</div>
							
						</div>
					</div>
				</div>
				
				</form>
			</div>
			
			
			