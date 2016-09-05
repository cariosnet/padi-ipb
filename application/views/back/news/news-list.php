			<script type="text/javascript">
		    	$(document).ready(function(){
		    		$("#menu-news").addClass('active open');
		    		$("#submenu-news-list").addClass('active');

		    		$('#newsTable').dataTable({
		    			oLanguage:{
			    			sSearch: "<span>Search:</span> ",
			    			sInfo: "Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries",
			    			sLengthMenu: "<span>Show entries:</span> _MENU_",
			    			sLoadingRecords: "Please wait - loading...",
			    			sProcessing: "<div style='padding-top: 15px;'>Mohon Tunggu.. Sedang memproses data..</div>"
				    	},
		                bProcessing: true,
		                bServerSide: true,
		                sPaginationType: "full_numbers",
		                sAjaxSource: "<?php echo site_url('backoffice/news/ajax_news_listing') ?>",
		                aoColumns: [
		                    {bSortable: false, sClass: "center"},
		                    {bSortable: false },
		                    {bSortable: false },
		                    null,
		                    null,
		                    {bSortable: false },
		                    {bSortable: false },
		                    null,
		                    {bSortable: false }
		                ]
		            });
		        });

		    	function deleteRow(id){
					jQuery.facebox.close();
					window.location = "<?php echo base_url().'backoffice/news/delete/'?>"+id; 
				}
		    </script>
		    <style>
		    	table.my-custom tr td{
		    		vertical-align: top;
		    	}
		    </style>
		    
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i> Daftar Berita</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li><a href="<?php echo site_url('backoffice')?>">Home</a><span class="divider">/</span></li>
						<li><a href="<?php echo site_url('backoffice/news')?>">Berita</a><span class="divider">/</span></li>
						<li class='active'>Daftar Berita</li>
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
									<span>Daftar Berita</span>
								</div>
								<div class="box-body box-body-nopadding">
									<div class="highlight-toolbar">
										<div class="pull-left"><div class="btn-toolbar">
											<div class="btn-group">
												<a href="<?php echo site_url('backoffice/news/create')?>" class="button button-basic" rel="tooltip" title="Tambah Fokus"><i class="icon-pencil"></i> Buat Berita</a>
											</div>
										</div></div>
									</div>
									<table class="table table-nomargin table-bordered table-striped table-hover my-custom" id="newsTable">
										<thead>
											<tr>
												<th width="20px">No.</th>
												<th width="300px;">Judul</th>
												<th width="180px">Kanal</th>
												<th width="150px">Tanggal</th>
												<th width="80px">Penulis</th>
												<th width="20px">Status</th>
												<th width="20px">Headline</th>
												<th width="10px">View</th>
												<th width="70px">Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
			</div>