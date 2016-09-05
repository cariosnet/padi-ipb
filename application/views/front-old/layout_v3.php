<!DOCTYPE html>
<html lang="en"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?php echo $pageTitle?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="<?php echo $this->config->item('layout_v3') ?>images/logo.png" type="image/x-icon" />
    <?php
        if(isset($meta_desc))echo "<meta name='description' content='".quotes_to_entities($meta_desc)."' />";else echo "<meta name='description' content='".quotes_to_entities($this->bogcamp->getSetting(3))."' />";
        if(isset($meta_key))echo "<meta name='keywords' content='".$meta_key."' />";else echo "<meta name='keywords' content='".$this->bogcamp->getSetting(4)."' />";
    ?>

    <!-- Facebook SDK, Open Graph Configurations -->
    <?php
        $fb_admins = array();
        $fb_admins = explode(",", $this->bogcamp->getSetting(8));

        for($i = 0; $i < count($fb_admins); $i++){
            echo '<meta property="fb:admins" content="'.$fb_admins[$i].'" />';
        }
        unset($i)
    ?>
    <meta property="fb:app_id" content="<?php echo $this->bogcamp->getSetting(7);?>" />

    <meta property="og:type"   content="article" />
    <meta property="og:url"    content="<?php echo $this->bogcamp->getFullUrlRequest();?>" />
    <meta property="og:title"  content="<?php echo $pageTitle?>" />
    <?php
    if(isset($meta_desc))echo "<meta property='og:description' content='".quotes_to_entities($meta_desc)."' />";else echo "<meta property='og:description' content='".quotes_to_entities($this->bogcamp->getSetting(3))."' />";
    if(isset($og_image))echo "<meta property='og:image' content='".$og_image."' />";else echo "<meta property='og:image' content='".$this->config->item('ext_img')."icon/200x200.png' />";
    ?>

    <meta name="alexaVerifyID" content="l1Tx8_LUvMgaxSyJNJ3Q6OHpkyY" />

    <!-- Le styles -->
    <link rel="stylesheet" href="<?php echo $this->config->item('layout_v3');?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('layout_v3');?>css/bootstrap-responsive.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('layout_v3');?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('layout_v3');?>css/onip.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('layout_v3');?>css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('layout_v3');?>css/scrolling-nav.css">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="<?php echo $this->config->item('layout_v3');?>js/html5shiv.js">
    <![endif]-->

    <!-- Fav and touch icons -->
    <style type="text/css" id="holderjs-style">.holderjs-fluid {font-size:16px;font-weight:bold;text-align:center;font-family:sans-serif;margin:0}</style></head>
    <script src="<?php echo $this->config->item('layout_v3');?>js/jquery.js"></script>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url() ?>" style="width: 350px;">
                <img src="<?php echo $this->config->item('layout_v3') ?>images/logo-korpri-1.gif" width="40px" height="40px" style="float:left; padding-right:10px;">
                Sekretariat Dewan Pengurus KORPRI<br> Provinsi DKI Jakarta
            </a>
        </div>
        <div id="navbar" class="navbar-collapse page-scroll collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="<?php echo ($this->uri->segment(1) == '') ? 'active' : '' ?>">
                    <a class="page-scroll" href="<?php echo ($this->uri->segment(1) != '') ? site_url() : '#page-top' ?>">Beranda<br>
                        <div style="font-size:9px; margin-top:-5px;">utama</div>
                    </a>
                </li>
                <?php foreach($this->X_Pages_Model->getListNavigation(null) as $row){ ?>
                    <?php if($row['child_count'] > 0){ ?>

                        <li id="<?php echo $row['ALIAS'] ?>" class="dropdown <?php echo ($this->uri->segment(1) == 'pages')?>">
                            <?php if($row['TYPE'] == 1){?>
                                <a href='<?php echo site_url('pages/'.$row['ALIAS'])?>' <?php echo ($row['child_count'] > 0) ? 'class="dropdown-toggle" data-toggle="dropdown"' : '' ?>>
                                    Tentang
                                    <br><div style="font-size:9px; margin-top:-5px; padding-bottom:5px;"><?php echo $row['TITLE'];?></div>
                                </a>
                            <?php }else{?>
                                <a href='<?php echo base_url($row['REF_URL']);?>' <?php echo ($row['child_count'] > 0) ? 'class="dropdown-toggle" data-toggle="dropdown"' : '' ?>>
                                    
                                    <div><?php echo $row['TITLE'];?></div>
                                </a>
                            <?php }?>

                            <?php if($row['child_count'] > 0){?>
                                <ul class="dropdown-menu">
                                    <?php foreach($row['child']->result() as $ch){ ?>
                                        <li>
                                            <?php if($ch->TYPE == 1){?>
                                                <a href='<?php echo site_url('pages/'.$ch->ALIAS)?>'><?php echo $ch->TITLE;?></a>
                                            <?php }else{?>
                                                <a href='<?php echo base_url($ch->REF_URL);?>'><?php echo $ch->TITLE;?></a>
                                            <?php }?>
                                        </li>
                                    <?php }?>
                                </ul>
                            <?php }?>
                        </li>
                    <?php } }?>
                <li><a class="page-scroll" href="<?php echo ($this->uri->segment(1) != '') ? site_url('#berita') : '#berita' ?>">Berita<br><div style="font-size:9px; margin-top:-5px; padding-bottom:5px;">Utama</div></a></li>
                <li><a class="page-scroll" href="<?php echo ($this->uri->segment(1) != '') ? site_url('#produkweb') : '#produkweb' ?>">Bidang<br><div style="font-size:9px; margin-top:-5px; padding-bottom:5px;">terkait</div></a></li>
                <li><a class="page-scroll" href="<?php echo ($this->uri->segment(1) != '') ? site_url('#infopulau') : '#infopulau' ?>">Aplikasi<br><div style="font-size:9px; margin-top:-5px;">KORPRI</div></a></li>
                <li><a class="page-scroll" href="<?php echo ($this->uri->segment(1) != '') ? site_url('#galery') : '#galery' ?>">Galeri<br><div style="font-size:9px; margin-top:-5px;">foto</div></a></li>
            
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<?php echo $this->load->view($content, $contentData);?>

<a href="#0" class="cd-top">Back to Top</a>

<!--------Contact-------->
<div class="container">
    <div class="row-fluid" style="font-weight:200;">
        <div class="span4">
            <h2 style="font-size:52px; font-weight:200;">Kontak Kami</h2>
            <p>Telepon: (021) 34830445
                <br>Fax: (021) 3822074
            </p>
            <p>E-mail: korpri@jakarta.go.id

            </p>
            <p>Jl. Kebon Sirih No. 18 Blok H Lantai 19<br>
                Jakarta, Indonesia.</p>
        </div>
        <div class="span4">
            <h2 style="font-size:52px; font-weight:200;">Media Sosial</h2>
            <p>Facebook | Twitter | Google+ | YouTube</p>
        </div>
        <div class="span4">
            <h2 style="font-size:52px; font-weight:200;">Website SKPD</h2>
            <?php foreach($this->link_model->getAll()->result() as $link){?>
                <a href='<?php echo $link->ref_url;?>'>
                    <h4><?php echo $link->nama;?></h4>
                </a>
            <?php } ?>
        </div>

    </div>

    <audio controls autoplay>
        <source src=<?php echo $this->config->item('img_path') . 'mars.mp3' ?>>
        Browser anda tidak support audio player
    </audio>
<br><br>
    <footer>
        <p>© 2015 KORPRI DKI Jakarta.</p>
    </footer>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/bootstrap.min.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/bootstrap-transition.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/bootstrap-alert.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/bootstrap-modal.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/bootstrap-dropdown.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/bootstrap-scrollspy.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/bootstrap-tab.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/bootstrap-tooltip.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/bootstrap-popover.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/bootstrap-button.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/bootstrap-collapse.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/bootstrap-carousel.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/bootstrap-typeahead.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/jquery.isotope.min.js"></script>

<script src="<?php echo $this->config->item('layout_v3');?>js/scrolling-nav.js"></script>
<script src="<?php echo $this->config->item('layout_v3');?>js/jquery.easing.min.js"></script>

<link rel="stylesheet" href="<?php echo $this->config->item('layout_v3');?>pgw/pgwslider.css">
<script type="text/javascript" src="<?php echo $this->config->item('layout_v3') ?>pgw/pgwslider.min.js"></script>

<script>
    !function ($) {
        $(function(){
            // carousel demo
            $('#myCarousel').carousel()
        })
    }(window.jQuery)

    jQuery(document).ready(function($){
        var offset = 300,
            offset_opacity = 1200,
            scroll_top_duration = 700,
            $back_to_top = $('.cd-top');

        $(window).scroll(function(){
            ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
            if( $(this).scrollTop() > offset_opacity ) {
                $back_to_top.addClass('cd-fade-out');
            }
        });

        $back_to_top.on('click', function(event){
            event.preventDefault();
            $('body,html').animate({
                    scrollTop: 0 ,
                }, scroll_top_duration
            );
        });

    });

    $(document).ready(function() {
        $('.pgwSlider').pgwSlider();
    });
</script>
<script src="<?php echo $this->config->item('layout_v3');?>js/holder.js"></script>


</body></html>