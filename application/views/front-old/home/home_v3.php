<script type="text/javascript" src="<?php echo $this->config->item('layout_v3') ?>js/jssor.slider.min.js"></script>

<script>
    jssor_1_slider_init = function () {

        var jssor_1_options = {
            $AutoPlay: true,
            $AutoPlaySteps: 5,
            $SlideDuration: 160,
            $SlideWidth: 300,
            $SlideSpacing: 3,
            $Cols: 5,
            $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $Steps: 5
            },
            $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$,
                $SpacingX: 1,
                $SpacingY: 1
            }
        };

        var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

        //responsive code begin
        //you can remove responsive code if you don't want the slider scales while window resizing
        function ScaleSlider() {
            var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
            if (refSize) {
                refSize = Math.min(refSize, 1109);
                jssor_1_slider.$ScaleWidth(refSize);
            }
            else {
                window.setTimeout(ScaleSlider, 30);
            }
        }

        ScaleSlider();
        $Jssor$.$AddEvent(window, "load", ScaleSlider);
        $Jssor$.$AddEvent(window, "resize", $Jssor$.$WindowResizeFilter(window, ScaleSlider));
        $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
        //responsive code end
    };

    jssor_2_slider_init = function () {

        var jssor_2_options = {
            $AutoPlay: true,
            $AutoPlaySteps: 5,
            $SlideDuration: 160,
            $SlideWidth: 300,
            $SlideSpacing: 3,
            $Cols: 5,
            $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $Steps: 5
            },
            $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$,
                $SpacingX: 1,
                $SpacingY: 1
            }
        };

        var jssor_2_slider = new $JssorSlider$("jssor_2", jssor_2_options);

        //responsive code begin
        //you can remove responsive code if you don't want the slider scales while window resizing
        function ScaleSlider() {
            var refSize = jssor_2_slider.$Elmt.parentNode.clientWidth;
            if (refSize) {
                refSize = Math.min(refSize, 1109);
                jssor_2_slider.$ScaleWidth(refSize);
            }
            else {
                window.setTimeout(ScaleSlider, 30);
            }
        }

        ScaleSlider();
        $Jssor$.$AddEvent(window, "load", ScaleSlider);
        $Jssor$.$AddEvent(window, "resize", $Jssor$.$WindowResizeFilter(window, ScaleSlider));
        $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
        //responsive code end
    };
</script>

<style>
    .jssorb03 {
        position: absolute;
    }

    .jssorb03 div, .jssorb03 div:hover, .jssorb03 .av {
        position: absolute;
        /* size of bullet elment */
        width: 21px;
        height: 21px;
        text-align: center;
        line-height: 21px;
        color: white;
        font-size: 12px;
        background: url('<?php echo $this->config->item('layout_v3') ?>images/b03.png') no-repeat;
        overflow: hidden;
        cursor: pointer;
    }

    .jssorb03 div {
        background-position: -5px -4px;
    }

    .jssorb03 div:hover, .jssorb03 .av:hover {
        background-position: -35px -4px;
    }

    .jssorb03 .av {
        background-position: -65px -4px;
    }

    .jssorb03 .dn, .jssorb03 .dn:hover {
        background-position: -95px -4px;
    }

    .jssora03l, .jssora03r {
        display: block;
        position: absolute;
        /* size of arrow element */
        width: 55px;
        height: 55px;
        cursor: pointer;
        background: url('<?php echo $this->config->item('layout_v3') ?>images/a03.png') no-repeat;
        overflow: hidden;
    }

    .jssora03l {
        background-position: -3px -33px;
    }

    .jssora03r {
        background-position: -63px -33px;
    }

    .jssora03l:hover {
        background-position: -123px -33px;
    }

    .jssora03r:hover {
        background-position: -183px -33px;
    }

    .jssora03l.jssora03ldn {
        background-position: -243px -33px;
    }

    .jssora03r.jssora03rdn {
        background-position: -303px -33px;
    }
</style>

<!-- Carousel -->
<div id="myCarousel" class="carousel slide">
    <div class="carousel-inner">
        <?php foreach ($listHeadline->result() as $headline): ?>
            <div class="item">
                <img
                    src="<?php if ($headline->NEWS_PICTURE != "") echo $this->config->item('img_path') . 'news/' . $headline->NEWS_PICTURE; else echo "http://www.placehold.it/650x350/EFEFEF/AAAAAA&amp;text=No+Image+Available"; ?>"
                    alt="<?php echo $headline->NEWS_TITLE ?>"/>

                <div class="container">
                    <div class="carousel-caption">
                        <h1><?php echo $this->bogcamp->substr($headline->NEWS_TITLE, 40) ?></h1>

                        <p class="lead"><?php echo $this->bogcamp->substr($headline->META_DESC, 80) ?></p>
                        <!--<a class="btn btn-large btn-primary"
                           href="<?//php echo site_url('news/read/' . $headline->NEWS_ID . '/' . $headline->ALIAS) ?>">Baca
                            Selengkapnya</a>-->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
</div><!-- /.carousel -->

<!-----------------------Tentang Kami------------------------->

<div id="full-pic">
    <div class="shadow-box">
        <a id="about"></a>

        <h2 style="font-size:32px; font-weight:200; color: #F9F9F9">Selayang Pandang Gubernur</h2>

        <p style="width:500px; margin:0 auto;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <br>

        <!--<p style="width:500px; margin:0 auto;">
            <a href="visimisi.html" target="_blank">Selengkapnya >></a>
        </p>-->
    </div>
</div>


<section id="berita" style="padding-top:100px">


        <h2 style="text-align:center; margin-bottom:50px; font-size:52px; font-weight:200;">Berita</h2>

        <div class="row-fluid">

            <div class="thumbnails" id="jssor_2"
                 style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1100px; height: 230px; overflow: hidden; visibility: hidden;">
                <!-- Loading Screen -->
                <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                    <div
                        style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                    <div
                        style="position:absolute;display:block;background:url('<?php echo $this->config->item('layout_v3') ?>images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                </div>
                <div data-u="slides"
                     style="cursor: default; position: relative; top: 0px; left: 0px; width: 1100px; height: 230px; overflow: hidden;">
                    <?php foreach($listLatestNews->result() as $news){ ?>
                        <div class="span3" style="display: none;">
                            <img data-u="image" src="<?php if ($news->NEWS_PICTURE != "") echo $this->config->item('img_path') . 'news/' . $news->NEWS_PICTURE; else echo "http://www.placehold.it/4000x200/EFEFEF/AAAAAA&amp;text=No+Image+Available"; ?>"/>
                           <a href="<?php echo site_url('news/read/' . $news->NEWS_ID . '/' . $news->ALIAS) ?>"> <span style="padding:3px;background: rgb(0, 0, 0) none repeat scroll 0% 0%;color: rgb(255, 255, 255);position: absolute;bottom: 0px;"><?php echo $news->NEWS_TITLE ?></span></a>
                        </div>
                    <?php } ?>
                </div>

                <!-- Arrow Navigator -->
            <span data-u="arrowleft" class="jssora03l" style="top:0px;left:8px;width:55px;height:55px;"
                  data-autocenter="2"></span>
            <span data-u="arrowright" class="jssora03r" style="top:0px;right:8px;width:55px;height:55px;"
                  data-autocenter="2"></span>
            </div>
            <script>
                jssor_2_slider_init();
            </script>

        </div>
        <div style="text-align: center; padding-top: 20px; ">
        <a class="btn btn-large btn-primary"
                           href="<?php echo site_url('news/news_list') ?>">Baca
                            Selengkapnya</a>
        </div>

</section>


<!-- Marketing messaging and featurettes  -->
<!-- Produk Website -->
<section id="produkweb" style="padding-top:100px">
    <div class="container marketing">
        <!-- Three columns of text below the carousel -->
        <div class="row">

            <h2 style="text-align:center; margin-bottom:50px; font-size:40px; font-weight:200;">Bidang - Bidang Terkait</h2>

            <div class="span3">
                <a href="<?php echo base_url() ?>news/read/197/bidang-hukum.html"><img
                        src="<?php echo $this->config->item('layout_v3') ?>images/logo-korpri-1.gif"
                        style="width: 100px; height: 100px;" alt="140x140" class="center-block"
                        data-src="holder.js/140x140"></a>

                <h3 style="text-align: center;">Bidang Hukum</h3>

                <p style="text-align: center;">Deskripsi Singkat</p>
            </div>
            <!-- /.span4 -->
            <div class="span3">
                <a href="<?php echo base_url() ?>news/read/198/bidang-kerjasama.html"><img
                        src="<?php echo $this->config->item('layout_v3') ?>images/logo-korpri-1.gif"
                        style="width: 100px; height: 100px;" alt="140x140" class="center-block"
                        data-src="holder.js/140x140"></a>

                <h3 style="text-align: center;">Bidang Kerjasama</h3>

                <p style="text-align: center;">Deskripsi Singkat</p></div>
            <!-- /.span4 -->
            <div class="span3">
                <a href="<?php echo base_url() ?>news/read/199/bidang-mental-dan-rohani.html"><img
                        src="<?php echo $this->config->item('layout_v3') ?>images/logo-korpri-1.gif"
                        style="width: 100px; height: 100px;" alt="140x140" class="center-block"
                        data-src="holder.js/140x140"></a>

                <h3 style="text-align: center;">Bidang Mental dan Rohani</h3>

                <p style="text-align: center;">Desktipsi Singkat</p>
            </div>
            <!-- /.span4 -->
            <div class="span3">
                <a href="<?php echo base_url() ?>news/read/200/bidang-sosial-dan-wirausaha.html"><img
                        src="<?php echo $this->config->item('layout_v3') ?>images/logo-korpri-1.gif"
                        style="width: 100px; height: 100px;" alt="140x140" class="center-block"
                        data-src="holder.js/140x140"></a>

                <h3 style="text-align: center;">Bidang Sosial dan Wirausaha</h3>

                <p style="text-align: center;">Desktipsi Singkat</p>
            </div>
        </div>
        <!-- /.row -->
    </div>
</section>
<!-- / .close container mareketing -->

<!-- START THE FEATURETTES -->

<!--<hr class="featurette-divider">-->

<!-- Wrap the rest of the page in another container to center all the content. -->
<section id="infopulau" style="padding-top:100px">
    <div class="container marketing">
        <!-- Three columns of text below the carousel -->
        <div class="row">
            <a id="web"></a>

            <h2 style="text-align:center; margin-bottom:50px; font-size:40px; font-weight:200;">Aplikasi KORPRI</h2>

            <?php foreach ($listProgram->result() as $row) { ?>
                <?php
                if ($row->TYPE == 2) {
                    $uri = ($row->TYPE == 1) ? base_url() . 'program/detail/' . $row->ALIAS : $row->REF_URL;
                    ?>
                    <div class="span4">
                        <a href="<?php echo $uri;?>" target="_blank">
                            <img src="<?php echo $this->config->item('img_path_upload') . 'news/' . $row->IMAGE;?>"
                                 style="width: 200px; height: 200px;" alt="140x140" class="img-circle"
                                 data-src="holder.js/140x140">

                            <h2><?php echo $row->TITLE ?></h2>
                        </a>

                        <p><?php echo $row->META_DESC ?></p>
                    </div><!-- /.span4 -->
                <?php }
            } ?>

        </div>
        <!-- /.row -->
    </div>
    <!-- / .close container mareketing -->

    <!-- / .close container mareketing -->
</section>

<section id="galery" style="padding-top:100px">


    <h2 style="text-align:center; margin-bottom:50px; font-size:52px; font-weight:200;">Galeri</h2>

    <div class="row-fluid">

        <div class="thumbnails" id="jssor_1"
             style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1100px; height: 230px; overflow: hidden; visibility: hidden;">
            <!-- Loading Screen -->
            <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div
                    style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                <div
                    style="position:absolute;display:block;background:url('<?php echo $this->config->item('layout_v3') ?>images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
            </div>
            <div data-u="slides"
                 style="cursor: default; position: relative; top: 0px; left: 0px; width: 1100px; height: 230px; overflow: hidden;">
                <?php $nHeadLine = 1;
                foreach ($listAllFoto->result() as $headline): ?>
                    <div class="span3" style="display: none;">
                        <img data-u="image"
                             src="<?php echo $this->config->item('img_path') . 'potogal/' . $headline->EMBED; ?>"/>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Arrow Navigator -->
            <span data-u="arrowleft" class="jssora03l" style="top:0px;left:8px;width:55px;height:55px;"
                  data-autocenter="2"></span>
            <span data-u="arrowright" class="jssora03r" style="top:0px;right:8px;width:55px;height:55px;"
                  data-autocenter="2"></span>
        </div>
        <script>
            jssor_1_slider_init();
        </script>

    </div>

</section>

<hr class="featurette-divider">