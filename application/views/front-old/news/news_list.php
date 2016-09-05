<div class="col-md-9 main">

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

    <div class="banner-section">
        <div class="form-group">
            <form id="ajax_filter" action="<?php echo site_url('indeks/ajax_filter')?>" method="post">
                <select class="form-control" name="cat" id="kategoriField" onblur="sendFilterRequest();" style="height: 46px;">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($listCat->result() as $row): ?>
                        <option value="<?php echo $row->CAT_ALIAS ?>" <?php if($row->CAT_ALIAS == $cat)echo 'selected="selected"'?>><?php echo $row->CAT_NAME ?></option>

                        <?php foreach ($this->X_News_Category_Model->getListCat($row->ID, $row->ID)->result() as $row2): ?>
                            <option value="<?php echo $row2->CAT_ALIAS ?>" style="padding-left: 20px;" <?php if($row2->CAT_ALIAS == $cat)echo 'selected="selected"'?>><?php echo $row2->CAT_NAME ?></option>

                            <?php foreach ($this->X_News_Category_Model->getListCat($row2->ID, $row2->ID)->result() as $row3): ?>
                                <option value="<?php echo $row3->CAT_ALIAS ?>" style="padding-left: 40px;" <?php if($row3->CAT_ALIAS == $cat)echo 'selected="selected"'?>><?php echo $row3->CAT_NAME ?></option>
                            <?php endforeach;?>
                        <?php endforeach;?>
                    <?php endforeach;?>
                </select>
                <a href="javascript:void(0)" onclick="sendFilterRequest();" style="margin-top: -10px;" class="btn btn-default btn-sm" data-loading-text="Loading...">Lihat Berita</a>
            </form>
        </div>

        <div class="blog_medium">
            <?php foreach ($listCatAll->result() as $row):?>
                <?php $content_news = $this->news->getNewsByCat($row->ID);
                if($content_news->num_rows() != 0){?>

                    <?php foreach ($this->news->getNewsByCat($row->ID)->result() as $row2){?>
                        <article class="post">
                            <figure class="post_img">
                                <a href="<?php echo site_url('news/read/'.$row2->NEWS_ID.'/'.$row2->ALIAS)?>">
                                    <img src="<?php if($row2->NEWS_PICTURE != "")echo $this->config->item('img_path').'news/'.$row2->NEWS_PICTURE; else echo "http://www.placehold.it/650x350/EFEFEF/AAAAAA&amp;text=No+Image+Available";?>" alt="blog post">
                                </a>
                            </figure>
                            <div class="post_content">
                                <div class="post_meta">
                                    <h2>
                                        <a href="<?php echo site_url('news/read/'.$row2->NEWS_ID.'/'.$row2->ALIAS)?>"><?php echo $this->bogcamp->substr($row2->NEWS_TITLE, 80) ?></a>
                                    </h2>
                                    <div class="metaInfo">
                                        <span><i class="fa fa-user"></i> By <a href="#"><?php echo $row2->WRITER ?></a> </span>
                                        <span><i class="fa fa-tag"></i> <a href="<?php echo site_url('berita/'.$row->CAT_ALIAS)?>"><?php echo $row->CAT_NAME;?></a></span>
                                    </div>
                                </div>
                                <p><?php echo $row2->META_DESC ?></p>
                                <a class="btn btn-small btn-default" href="<?php echo site_url('news/read/'.$row2->NEWS_ID.'/'.$row2->ALIAS)?>">Baca Selengkapnya</a>

                            </div>
                        </article>
                    <?php }} endforeach;?>

        </div>



        <div class="clearfix"></div>
    </div>