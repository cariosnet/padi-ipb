			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-adsbanner").addClass('active open');
		    		$("#submenu-adsbanner-create").addClass('active');
		        });
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i> Tambah Iklan Banner Baru</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/adsbanner')?>">Iklan Banner</a><span class="divider">/</span></li>
						<li class='active'>Tambah Iklan - Pilih Ukuran</li>
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
										
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-table"></i>
								<span>Pilih Ukuran</span>
							</div>
							<div class="box-body box-body-nopadding">
								<table class="table table-nomargin table-hover">
									<thead>
										<tr>
											<th width="20px">No.</th>
											<th>Ukuran</th>
											<th width="80px">Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td style="text-align: center;">1</td>
											<td style="font-weight: bold;">Lebar: 972px, Tinggi: Bebas (Disarankan: 90px)</td>
											<td>
												<div class="btn-toolbar" style="margin: 0; padding: 0;">
													<div class="btn-group">
														<a href="<?php echo site_url('backoffice/adsbanner/create/a')?>" class='button button-basic button-small' rel="tooltip" title="Pilih Ukuran"><i class="icon-plus"></i> Tambah Banner</a>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td style="text-align: center;">2</td>
											<td style="font-weight: bold;">Lebar: 320px, Tinggi: Bebas || Posidi: Sidebar</td>
											<td>
												<div class="btn-toolbar" style="margin: 0; padding: 0;">
													<div class="btn-group">
														<a href="<?php echo site_url('backoffice/adsbanner/create/b')?>" class='button button-basic button-small' rel="tooltip" title="Pilih Ukuran"><i class="icon-plus"></i> Tambah Banner</a>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			