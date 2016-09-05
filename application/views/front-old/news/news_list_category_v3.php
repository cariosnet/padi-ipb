<script type="text/javascript">
    $(document).ready(function(){
        $.datepicker.setDefaults($.datepicker.regional['in_ID']);
        $("#datepicker").datepicker({
            changeYear: true,
            changeMonth: true,
            dateFormat: 'dd-mm-yy',
            yearRange: '2000:2020'
        });

    });
    function sendFilterRequest(){
        document.location.href = "<?php echo base_url();?>berita/"+$("#kategoriField").val();
    }
</script>

<div style="margin-top:150px;"></div>
<br>

<div class="container marketing">
    <div class="form-group">
    <form id="ajax_filter" action="<?php echo site_url('indeks/ajax_filter')?>" method="post">
        <select class="form-control" name="cat" id="kategoriField" onblur="sendFilterRequest();" style="height: 46px;">
            <option value="">Semua Kategori</option>
            <?php foreach ($listCat->result() as $row): ?>
                <option value="<?php echo $row->CAT_ALIAS ?>" <?php if($row->CAT_ALIAS == $cat->CAT_ALIAS)echo 'selected="selected"'?>><?php echo $row->CAT_NAME ?></option>

                <?php foreach ($this->X_News_Category_Model->getListCat($row->ID, $row->ID)->result() as $row2): ?>
                    <option value="<?php echo $row2->CAT_ALIAS ?>" style="padding-left: 20px;" <?php if($row2->CAT_ALIAS == $cat->CAT_ALIAS)echo 'selected="selected"'?>><?php echo $row2->CAT_NAME ?></option>

                    <?php foreach ($this->X_News_Category_Model->getListCat($row2->ID, $row2->ID)->result() as $row3): ?>
                        <option value="<?php echo $row3->CAT_ALIAS ?>" style="padding-left: 40px;" <?php if($row3->CAT_ALIAS == $cat->CAT_ALIAS)echo 'selected="selected"'?>><?php echo $row3->CAT_NAME ?></option>
                    <?php endforeach;?>
                <?php endforeach;?>
            <?php endforeach;?>
        </select>
        <a href="javascript:void(0)" onclick="sendFilterRequest();" style="margin-top: -10px;" class="btn btn-default btn-sm" data-loading-text="Loading...">Lihat Berita</a>
    </form>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <div class="blog_medium">
                <?php if($news->num_rows() != 0){?>
                <?php foreach ($news->result() as $row){?>

                    <article class="post">
                        <figure class="post_img">
                            <a href="<?php echo site_url('news/read/'.$row->NEWS_ID.'/'.$row->ALIAS)?>">
                                <img src="<?php if($row->NEWS_PICTURE != "")echo $this->config->item('img_path').'news/'.$row->NEWS_PICTURE; else echo "http://www.placehold.it/650x350/EFEFEF/AAAAAA&amp;text=No+Image+Available";?>" alt="<?php echo $row->NEWS_TITLE?>">
                            </a>
                        </figure>
                        <div class="post_content">
                            <div class="post_meta">
                                <h2>
                                    <a href="<?php echo site_url('news/read/'.$row->NEWS_ID.'/'.$row->ALIAS)?>" ><?php echo $this->bogcamp->substr($row->NEWS_TITLE, 80) ?></a>
                                </h2>
                                <div class="metaInfo">
                                    <span><i class="fa fa-user"></i> By <a href="#"><?php echo $row->WRITER ?></a> </span>
                                    <span><i class="fa fa-tag"></i> <a href="<?php echo site_url('berita/'.$cat->CAT_ALIAS)?>"><?php echo $cat->CAT_NAME;?></a></span>
                                </div>
                            </div>
                            <p><?php echo $row->META_DESC ?></p>
                            <a class="btn btn-small btn-default" href="<?php echo site_url('news/read/'.$row->NEWS_ID.'/'.$row->ALIAS)?>">Baca Selengkapnya</a>

                        </div>
                    </article>

                <?php }?>
                <?php }else{ echo "<i>Tidak ada berita pada kriteria ini</i>";}?>

            </div>
        </div>

        <?php echo $this->pagination->create_links();?>
    </div><!--/.row-->

    <!-- FaceBook -->
    <div style="float: left; margin-right: 5px;" class="fb-like" data-href="<?php echo site_url('search')?>" data-send="true" data-layout="button_count" data-width="100" data-show-faces="true" data-action="recommend"></div>

    <!-- Twitter  -->
    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo site_url('search')?>" data-via="jametson" data-lang="id" data-hashtags="">Tweet</a>
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

</div>


<hr class="featurette-divider">