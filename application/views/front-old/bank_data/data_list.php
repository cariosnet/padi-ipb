<script type="text/javascript">
    $(document).ready(function(){
        sendFilterRequest();
        $("#selectType").change(function(){
            if($(this).val() == "RE"){
                $("#regulasiOption").show();
            }else{
                $("#regulasiOption").hide();
            }
        });
    });

    function sendFilterRequest(){
        var loader = "<?php echo $this->config->item('ext_img').'loader/loading-git.gif' ?>";

        jQuery.ajax({
            url: "<?php echo site_url('bank_data/ajax_filter_data')?>",
            data: $("#ajax_filter").serialize(),
            beforeSend: function(){
                jQuery("#result").html('<div style="text-align: center;margin: 100px auto; font-size: 26px;"><img src="'+loader+'" /><br />Loading....</div>');
            },
            success: function(response){
                jQuery("#result").html(response);
            },
            type: "post",
            dataType: "html"
        });

        return false;
    }
</script>

<div style="margin-top:150px;"></div>
<br>

<div class="container marketing">
    <h2><?php echo $pageTitle; ?></h2>
    <form id="ajax_filter" action="<?php echo site_url('indeks/ajax_filter_special')?>" method="post" onsubmit="return sendFilterRequest()">
        <!--<table>-->
        <!--    <tr>-->
        <!--        <td>Tentang: </td>-->
        <!--        <td>Nomor: </td>-->
        <!--        <td>Tahun: </td>-->
        <!--        <td>Kategori: </td>-->
        <!--    </tr>-->
        <!--    <tr>-->
        <!--        <td><input type="text" name="title" id="title" style="width: 112px;" value="" /></td>-->
        <!--        <td><input type="text" name="nomor" id="nomor" style="width: 112px;" value="" /></td>-->
        <!--        <td><input type="text" name="tahun" id="tahun" style="width: 80px;" value="" /></td>-->
        <!--        <td>-->
        <!--            <select name="category">-->
        <!--                <option value="">Semua Kategori</option>-->
        <!--                <?php //foreach ($listCat->result() as $row){?>-->
        <!--                    <option <?php //if($category == $row->ID)echo "selected='selected'";?> value="<?php //echo $row->ID;?>"><?php //echo $row->CAT_NAME;?></option>-->
        <!--                <?php //}?>-->
        <!--            </select>-->
        <!--        </td>-->
        <!--    </tr>-->
        <!--    <tr>-->
        <!--    </tr>-->
        <!--    <tr>-->
        <!--        <td><a href="javascript:void(0)" onclick="sendFilterRequest();" class="btn btn-default btn-sm">Cari Dokumen</a></td>-->
        <!--        <td></td>-->
        <!--        <td></td>-->
        <!--        <td></td>-->
        <!--    </tr>-->
        <!--</table>-->
	
	<div class="row">
	    <div class="col-xs-2">
		<input type="text" name="nomor" id="nomor" class="form-control" placeholder="Nomor">
	    </div><!-- /.col-lg-6 -->
	    <div class="col-xs-2">
		<input type="text" name="tahun" id="tahun" class="form-control" placeholder="Tahun">
	    <!-- /input-group -->
	    </div><!-- /.col-lg-6 -->
	    <div class="col-xs-2">
		<input type="text" name="title" id="title" class="form-control" placeholder="Tentang">
	    </div>
	    <div class="col-xs-3">
	    
	    <select name="category" class="form-control" style="height: 46px;">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($listCat->result() as $row){?>
                            <option <?php if($category == $row->ID)echo "selected='selected'";?> value="<?php echo $row->ID;?>"><?php echo $row->CAT_NAME;?></option>
                        <?php }?>
                    </select>
	    </div>
	</div><!-- /.row -->
	
	<div class="row">
	    <div clas="col-xs-2" style="padding-left: 15px">
		<a href="javascript:void(0)" onclick="sendFilterRequest();">
		    <button type="button" class="btn btn-success">Success</button>
		</a>
	    </div>
	</div>
	
	<!-- Tipe:
						<select name="type" id="selectType">
							<option value="RE" <?php if($type == 'RE')echo "selected='selected'";?>>Regulasi</option>

							<option value="PR" <?php if($type == 'PR')echo "selected='selected'";?>>Produk</option>
						</select>  -->
    </form>

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <div class="blog_medium">
                <div id="result"></div>
            </div>
        </div>
    </div><!--/.row-->

    <!-- FaceBook -->
    <div style="float: left; margin-right: 5px;" class="fb-like" data-href="<?php echo site_url('search')?>" data-send="true" data-layout="button_count" data-width="100" data-show-faces="true" data-action="recommend"></div>

    <!-- Twitter  -->
    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo site_url('search')?>" data-via="" data-lang="id" data-hashtags="">Tweet</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

    <!-- Place this tag where you want the +1 button to render. -->
    <div  class="g-plusone" data-size="medium"></div>

    <!-- Place this tag after the last +1 button tag. -->
    <script type="text/javascript">
        window.___gcfg = {lang: 'id'};

        (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
    </script>

</div>


<hr class="featurette-divider">