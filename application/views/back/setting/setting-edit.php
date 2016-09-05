			<!-- TagIt -->	
			<script src="<?php echo $this->config->item('ext_js');?>plugins/jquery-ui/js/jquery-ui-1.10.2.custom.min.js"></script>
			<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/jquery-ui/css/Aristo/Aristo.css">
			
			<script src="<?php echo $this->config->item('ext_js');?>plugins/tag-it/js/tag-it.min.js" type="text/javascript"></script>
			<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/tag-it/css/jquery.tagit.css">
			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-adm").addClass('active open');
		    		$("#submenu-setting-list").addClass('active');
		    		
		    	    $("#keyword").tagit();
		    	    $("#admin").tagit();
		        });

		    	function cancel(){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/'?>"; 
				}
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i>Pengaturan</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/setting')?>">Administrasi</a><span class="divider">/</span></li>
						<li class='active'>Ubah HalamanPengaturan</li>
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
		    	
				<form action="<?php echo site_url('backoffice/setting/submit') ?>" class="form-horizontal form-bordered form-validate" method="post" id="aa">
				
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-edit"></i>
								<span>Pengaturan</span>
							</div>
							<div class="box-body box-body-nopadding">
								
									<div class="control-group">
										<label for="textfield" class="control-label">Nama Website</label>
										<div class="controls">
											<input type="text" value="<?php echo $this->bogcamp->getSetting(1);?>" name="1" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Slogan Website</label>
										<div class="controls">
											<input type="text" value="<?php echo $this->bogcamp->getSetting(2);?>" name="2" class="input-xlarge span12" data-rule-required="true">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Meta Desription</label>
										<div class="controls">
											<textarea name="3" class="input-block-level" rows="5" data-rule-required="true"><?php echo $this->bogcamp->getSetting(3);?></textarea>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Meta Keyword</label>
										<div class="controls">
											<div style="padding: 0px;">
												<input type="text" id="keyword" value="<?php echo $this->bogcamp->getSetting(4);?>" name="4" class="input-xlarge span12" data-rule-required="true">
											</div>
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
								<span>Social Plugin</span>
							</div>
							<div class="box-body box-body-nopadding">
									<div class="control-group">
										<label for="textfield" class="control-label">Facebook Fan Page</label>
										<div class="controls">
											<input type="text" value="<?php echo $this->bogcamp->getSetting(5);?>" name="5" class="input-xlarge span12" data-rule-required="true">
											<span class="help-block">
												Contoh: http://www.facebook.com/<span style="font-weight: bold;color: red">username</span> &raquo; Harap masukan username nya saja
											</span>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Twitter</label>
										<div class="controls">
											<input type="text" value="<?php echo $this->bogcamp->getSetting(6);?>" name="6" class="input-xlarge span12" data-rule-required="true">
											<span class="help-block">
												Contoh: http://www.twitter.com/<span style="font-weight: bold;color: red">username</span> &raquo; Harap masukan username nya saja
											</span>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Facebook App ID</label>
										<div class="controls">
											<input type="text" value="<?php echo $this->bogcamp->getSetting(7);?>" name="7" class="input-xlarge span12" data-rule-required="true">
											<span class="help-block">
												Facebook SDK - App ID
											</span>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">FB Admin</label>
										<div class="controls">
											<div style="padding: 0px;">
												<input type="text" id="admin" placeholder="ID Facebook" value="<?php echo $this->bogcamp->getSetting(8);?>" name="8" class="input-xlarge span12" data-rule-required="true">
											</div>
											<span class="help-block">
												Masukan id facebook admin, digunakan untuk moderasi social plugin fb pada website (Moderasi Komentar)<br />
												Tidak tahu ID Facebook? coba <a href="http://findmyfacebookid.com/" target="_blank">findmyfacebookid.com</a>
											</span>
										</div>
									</div>
									
									<div class="form-actions">
										<button type="submit" name="save" value="Simpan" class="button button-basic-blue">Simpan</button>
										<a href="javascript:void();" class="button button-basic" onclick="confirmPopUp('cancel();', 'Peringatan..', 'Anda yakin ingin membatalkan ??', 'Ya', 'Tidak');">Batal</a>
									</div>
							</div>
							
						</div>
					</div>
				</div>
				</form>
			</div>
			
			
			