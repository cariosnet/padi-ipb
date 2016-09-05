
<div class="col-md-9 main">
<!--banner-section-->
<div class="banner-section">
    <h3 class="tittle"></h3>
    <div class="banner">
        <div  class="callbacks_container">
            <ul class="rslides" id="slider4">

                <?php foreach ($listHeadline->result() as $headline): ?>
                      <li>
                        <img
                            src="<?php if ($headline->NEWS_PICTURE != "") echo $this->config->item('img_path') . 'news/' . $headline->NEWS_PICTURE; else echo "http://www.placehold.it/650x350/EFEFEF/AAAAAA&amp;text=No+Image+Available"; ?>"  class="img-responsive"
                            alt="<?php echo $headline->NEWS_TITLE ?>"/>


                <?php endforeach; ?>
                    </li>
                
            </ul>
        </div>
        <!--banner-->
        <script src="<?php echo $this->config->item('layout_korpri');?>js/responsiveslides.min.js"></script>
        <script>
            // You can also use "$(window).load(function() {"
            $(function () {
                // Slideshow 4
                $("#slider4").responsiveSlides({
                    auto: true,
                    pager:true,
                    nav:true,
                    speed: 500,
                    namespace: "callbacks",
                    before: function () {
                        $('.events').append("<li>before event fired.</li>");
                    },
                    after: function () {
                        $('.events').append("<li>after event fired.</li>");
                    }
                });

            });
        </script>
        <div class="clearfix"> </div>
        <div class="b-bottom">
            <h5 class="top"><a href="#">Selamat Datang di Website Resmi Sekretariat KORPRI DKI Jakarta</a></h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
    </div>
    <!--//banner-->
    <!--/top-news-->
    <div class="top-news">
        <div class="top-inner">
            <?php foreach($listLatestNews->result() as $keynews => $news){
                if ($keynews <= 1){
                ?>
            <div class="col-md-6 top-text">
                    <a href="<?php echo site_url('news/read/' . $news->NEWS_ID . '/' . $news->ALIAS) ?>"><img src="<?php if ($news->NEWS_PICTURE != "") echo $this->config->item('img_path') . 'news/' . $news->NEWS_PICTURE; else echo "http://www.placehold.it/4000x200/EFEFEF/AAAAAA&amp;text=No+Image+Available"; ?>" class="img-responsive" alt=""></a>
                    <h5 class="top"><a href="<?php echo site_url('news/read/' . $news->NEWS_ID . '/' . $news->ALIAS) ?>"><?php echo $news->NEWS_TITLE ?></a></h5>
                    <p><?php echo $news->NEWS_SUBTITLE ?></p>
                    <p><?php echo date("d M Y", strtotime( $news->DATE ))?><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span><?php echo $news->PAGE_VIEW ?> </a><a class="span_link" href="single.html"><span class="glyphicon glyphicon-circle-arrow-right"></span></a></p>

            </div>
            <?php }} ?>
            <div class="clearfix"> </div>
        </div>
        <div class="top-inner second">
            <?php foreach($listLatestNews->result() as $keynews => $news){
            if ($keynews > 1 and $keynews <=3){
            ?>
                <div class="col-md-6 top-text">
                    <a href="<?php echo site_url('news/read/' . $news->NEWS_ID . '/' . $news->ALIAS) ?>"><img src="<?php if ($news->NEWS_PICTURE != "") echo $this->config->item('img_path') . 'news/' . $news->NEWS_PICTURE; else echo "http://www.placehold.it/4000x200/EFEFEF/AAAAAA&amp;text=No+Image+Available"; ?>" class="img-responsive" alt=""></a>
                    <h5 class="top"><a href="<?php echo site_url('news/read/' . $news->NEWS_ID . '/' . $news->ALIAS) ?>"><?php echo $news->NEWS_TITLE ?></a></h5>
                    <p><?php echo $news->NEWS_SUBTITLE ?></p>
                    <p><?php echo date("d M Y", strtotime( $news->DATE ))?><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span><?php echo $news->PAGE_VIEW ?> </a><a class="span_link" href="single.html"><span class="glyphicon glyphicon-circle-arrow-right"></span></a></p>

                </div>
            <?php }} ?>
           <!-- <div class="col-md-6 top-text">
                <a href="single.html"><img src="<?php /*echo $this->config->item('img_path')*/?>images/pic3.jpg" class="img-responsive" alt=""></a>
                <h5 class="top"><a href="single.html">Consetetur sadipscing elit</a></h5>
                <p>Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt labore dolore magna aliquyam eratsed diam justo duo dolores rebum.</p>
                <p>On Jun 25 <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>0 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>56 </a><a class="span_link" href="single.html"><span class="glyphicon glyphicon-circle-arrow-right"></span></a></p>
            </div>
            <div class="col-md-6 top-text two">
                <a href="single.html"><img src="<?php /*echo $this->config->item('img_path')*/?>images/pic4.jpg" class="img-responsive" alt=""></a>
                <h5 class="top"><a href="single.html">Consetetur sadipscing elit</a></h5>
                <p>Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt labore dolore magna aliquyam eratsed diam justo duo dolores rebum.</p>
                <p>On Jun 27 <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>0 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>56 </a><a class="span_link" href="single.html"><span class="glyphicon glyphicon-circle-arrow-right"></span></a></p>
            </div>-->
            <div class="clearfix"> </div>
        </div>
    </div>
    <!--//top-news-->
</div>
<!--//banner-section-->

<!--/footer-->
