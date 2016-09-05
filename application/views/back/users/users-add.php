			<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-adm").addClass('active open');
		    		$("#submenu-users-list").addClass('active');
		        });

		    	function cancel(){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/users/'?>"; 
				}
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Pengguna Baru</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/users')?>">Administrasi</a><span class="divider">/</span></li>
						<li class='active'>Tambah Pengguna</li>
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
								<span>Data Login Pengguna Baru</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Username</label>
										<div class="controls">
											<input type="text" name="username" class="input-xlarge" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="pwfield" class="control-label">Password</label>
										<div class="controls">
											<input type="password" name="password" id="pwfield" class="input-xlarge" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="confirmfield" class="control-label">Konfirmasi password</label>
										<div class="controls">
											<input type="password" name="confirmPassword" id="confirmfield" class="input-xlarge" data-rule-equalTo="#pwfield" data-rule-required="true">
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
								<span>Form Pengguna Baru</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Lengkap</label>
										<div class="controls">
											<input type="text" name="fullname" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Gambar</label>
										<div class="controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 180px; height: 230px;"><img src="http://www.placehold.it/180x230/EFEFEF/AAAAAA&amp;text=no+image" /></div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 180px; max-height: 230px; line-height: 20px;"></div>
												<div>
													<span class="button button-basic btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="image" /></span>
													<a href="#" class="button button-basic fileupload-exists" data-dismiss="fileupload">Remove</a>
												</div>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Email</label>
										<div class="controls">
											<input type="text" name="email" data-rule-email="true" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div><div class="control-group">
										<label for="textfield" class="control-label">Telepon</label>
										<div class="controls">
											<input type="text" name="phone" class="input-xlarge" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Alamat</label>
										<div class="controls">
											<textarea name="address" class='span12' rows="10" id="address"></textarea>
								
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
											<textarea name="bio" class='span12' rows="10" id="bio"></textarea>
								
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
										<label for="textfield" class="control-label">Status</label>
										<div class="controls">
											<label class='radio-uniformed'>
												<input type="radio" name="status" value="A" class='uniform-me' data-rule-required="true"> Aktif
											</label>
											<label class='radio-uniformed'>
												<input type="radio" name="status" value="N" class='uniform-me' data-rule-required="true"> Tidak Aktif
											</label>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Role</label>
										<div class="controls">
											<label class='radio-uniformed'>
												<input type="radio" name="role" value="1" class='uniform-me' data-rule-required="true"> Super User (SU)
											</label>
											<label class='radio-uniformed'>
												<input type="radio" name="role" value="2" class='uniform-me' data-rule-required="true"> Redaktur
											</label>
											<label class='radio-uniformed'>
												<input type="radio" name="role" value="3" class='uniform-me' data-rule-required="true"> Marketing
											</label>
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
			
			
			