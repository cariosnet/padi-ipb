			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-ads").addClass('active open');
		    		$("#submenu-adscat-list").addClass('active');
		        });

		    	function deleteRow(id){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/ads_properties/cat/delete/'?>"+id; 
				}
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i> Kategori Iklan</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/ads')?>">Ikan</a><span class="divider">/</span></li>
						<li class='active'>Kategori Iklan</li>
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
								<span>Daftar Kategori Iklan Baris</span>
							</div>
							<div class="box-body box-body-nopadding">
								<div class="highlight-toolbar">
									<div class="pull-left"><div class="btn-toolbar">
										<div class="btn-group">
											<a href="<?php echo site_url('backoffice/ads_properties/cat/add')?>" class="button button-basic" rel="tooltip" title="Tambah Kanal"><i class="icon-plus"></i> Tambah Kategori</a>
										</div>
									</div></div>
								</div>
								<table class="table table-nomargin table-hover">
									<thead>
										<tr>
											<th width="20px">No.</th>
											<th>Kanal</th>
											<th width="200px">Alias</th>
											<th width="60px">Urutan</th>
											<th width="80px">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php $no = 1;
										foreach ($listParent->result() as $row){ ?>
										<tr>
											<td style="text-align: center;"><?php echo $no++;?>.</td>
											<td style="font-weight: bold;"><?php echo $row->CAT_NAME?></td>
											<td style="font-weight: bold;"><?php echo $row->CAT_ALIAS?></td>
											<td style="text-align: center; font-weight: bold;"><?php echo $row->CAT_ORDER?></td>
											<td>
												<div class="btn-toolbar" style="margin: 0; padding: 0;">
													<div class="btn-group">
														<a href="<?php echo site_url('backoffice/ads_properties/cat/edit/'.$row->ID)?>" class='button button-basic button-small' rel="tooltip" title="Ubah"><i class="icon-edit"></i></a>
														<a href="javascript:void(0);" class='button button-basic button-small' rel="tooltip" title="Hapus" onclick="confirmPopUp('deleteRow(<?php echo $row->ID?>)', 'Peringatan..', 'Anda yakin ingin dihapus ??', 'Ya', 'Tidak');"><i class="icon-trash"></i></a>
													</div>
												</div>
											</td>
										</tr>
										<?php 
											//Kategori Level 2
											foreach ($this->X_Ads_Category_Model->getListCat($row->ID)->result() as $row2){
												echo '<tr>';
												echo '<td></td>';
												echo '<td style="padding-left: 40px;">'.$row2->CAT_NAME.'</td>';
												echo '<td>'.$row2->CAT_ALIAS.'</td>';
												echo '<td style="text-align: center;">'.$row2->CAT_ORDER.'</td>';
												echo '<td><div class="btn-toolbar" style="margin: 0; padding: 0;"><div class="btn-group">'; 
													
												echo '<a href="'.site_url('backoffice/ads_properties/cat/edit/'.$row2->ID).'" class="button button-basic button-small" rel="tooltip" title="Ubah"><i class="icon-edit"></i></a>';
												echo '<a href="javascript:void(0);" class="button button-basic button-small" rel="tooltip" title="Hapus" onclick="confirmPopUp(\'deleteRow('.$row2->ID.')\', \'Peringatan..\', \'Anda yakin ingin dihapus ??\', \'Ya\', \'Tidak\');"><i class="icon-trash"></i></a>';
														
												echo '</div></div></td>';
												echo '</tr>';
												
												//Kategori Level 3
												foreach ($this->X_Ads_Category_Model->getListCat($row2->ID)->result() as $row3){
													echo '<tr>';
													echo '<td></td>';
													echo '<td style="padding-left: 80px;">'.$row3->CAT_NAME.'</td>';
													echo '<td>'.$row3->CAT_ALIAS.'</td>';
													echo '<td style="text-align: center;">'.$row3->CAT_ORDER.'</td>';
													echo '<td><div class="btn-toolbar" style="margin: 0; padding: 0;"><div class="btn-group">';
														
													echo '<a href="'.site_url('backoffice/ads_properties/cat/edit/'.$row3->ID).'" class="button button-basic button-small" rel="tooltip" title="Ubah"><i class="icon-edit"></i></a>';
													echo '<a href="javascript:void(0);" class="button button-basic button-small" rel="tooltip" title="Hapus" onclick="confirmPopUp(\'deleteRow('.$row3->ID.')\', \'Peringatan..\', \'Anda yakin ingin dihapus ??\', \'Ya\', \'Tidak\');"><i class="icon-trash"></i></a>';
												
													echo '</div></div></td>';
												
													//Kategori Level 3
												
													echo '</tr>';
												}
											}
										?>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			