			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-home").addClass('active');
		        });
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i> Dashboard</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li class='active'>Dashboard</li>
					</ul>
				</div>
			</div>
			
			<div class="content-highlighted">
				<ul class="quick" data-collapse="collapse">
					<li><a href="<?php echo site_url('backoffice/news/create')?>"><img src="<?php echo $this->config->item('layout_back');?>img/icons/pen.png" alt="" /><span>Tulis Berita</span></a></li>
					<li><a href="<?php echo site_url('backoffice/pages')?>"><img src="<?php echo $this->config->item('layout_back');?>img/icons/attibutes.png" alt="" /><span>Halaman Khusus</span></a></li>
					<!-- 
					<li><a href="javascript:maintenance();"><img src="<?php //echo $this->config->item('layout_back');?>img/icons/comment.png" alt="" /><span>Komentar</span></a></li>
					<li><a href="javascript:maintenance();"><img src="<?php //echo $this->config->item('layout_back');?>img/icons/user.png" alt="" /><span>Pengguna Backoffice</span></a></li>
					<li><a href="javascript:maintenance();"><img src="<?php //echo $this->config->item('layout_back');?>img/icons/my-account.png" alt="" /><span>Pengaturan Akun</span></a></li>
					 -->
				</ul>
			</div>

			<div class="container-fluid" id="content-area" style="text-align: center;">
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
		    	
			</div>