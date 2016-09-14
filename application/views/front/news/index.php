
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-push-2">

            <?php foreach ($contentData['newsList']->result() as $news) { ?>
                <div class="card panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="img-container col-xs-3" style="background-image:url('<?php echo $this->config->item('img_path') ?>news/<?php echo $news->NEWS_PICTURE;?>')">
                            </div>
                            <div class="col-xs-9">
                                <h1><?php echo $news->NEWS_TITLE;?></h1>
                                <p><?php echo $news->WRITER;?></p>
                                <?php echo substr($news->NEWS_CONTENT,0,200) . " ...";?>
                                <div class="expander"><i class="fa fa-angle-down" data-toggle="collapse" data-target=".collapse"></i></div>
                                <div class="content-label">
                                    <p><a href="<?php echo base_url('home/news/view/'. $news->NEWS_ID);?>">Read More...</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
                <nav>
                    <ul class="pagination center-block">
                        <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>