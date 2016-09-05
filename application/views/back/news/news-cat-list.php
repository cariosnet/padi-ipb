			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-news").addClass('active open');
		    		$("#submenu-news-create").addClass('active');
		        });
		    </script>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i> Buat Berita Baru</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/news')?>">Berita</a><span class="divider">/</span></li>
						<li class='active'>Buat Berita</li>
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
								<span>Pilih Kategori Berita</span>
							</div>
							<div class="box-body box-body-nopadding">
								<table class="table table-nomargin table-hover">
									<thead>
										<tr>
											<th width="20px">No.</th>
											<th>Kategori</th>
											<th width="80px">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php $no = 1;
										foreach ($listCat->result() as $row){ ?>
										<tr>
											<td style="text-align: center;"><?php echo $no++;?>.</td>
											<td style="font-weight: bold;"><?php echo $row->CAT_NAME?></td>
											<td>
												<div class="btn-toolbar" style="margin: 0; padding: 0;">
													<div class="btn-group">
														<a href="<?php echo site_url('backoffice/news/create/cat/'.$row->ID)?>" class='button button-basic button-small' rel="tooltip" title="Pilih Kanal"><i class="icon-plus"></i> Buat Berita</a>
													</div>
												</div>
											</td>
										</tr>
										<?php 
											//Kategori Level 2
											foreach ($this->X_News_Category_Model->getListCat($row->ID)->result() as $row2){
												echo '<tr>';
												echo '<td></td>';
												echo '<td style="padding-left: 40px;">'.$row2->CAT_NAME.'</td>';
												echo '<td><div class="btn-toolbar" style="margin: 0; padding: 0;"><div class="btn-group">'; 
													
												echo '<a href="'.site_url('backoffice/news/create/cat/'.$row2->ID).'" class="button button-basic button-small" rel="tooltip" title="Pilih Kanal"><i class="icon-plus"></i> Buat Berita</a>';
														
												echo '</div></div></td>';
												echo '</tr>';
												
												//Kategori Level 3
												foreach ($this->X_News_Category_Model->getListCat($row2->ID)->result() as $row3){
													echo '<tr>';
													echo '<td></td>';
													echo '<td style="padding-left: 80px;">'.$row3->CAT_NAME.'</td>';
													echo '<td><div class="btn-toolbar" style="margin: 0; padding: 0;"><div class="btn-group">';
														
													echo '<a href="'.site_url('backoffice/news/create/cat/'.$row3->ID).'" class="button button-basic button-small" rel="tooltip" title="Pilih Kanal"><i class="icon-plus"></i> Buat Berita</a>';
												
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
			
			
			