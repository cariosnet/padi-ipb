<div style="margin-top:150px;"></div>
<div id="full-pic">
    <div class="shadow-box">
        <a id="about"></a><h2 style="font-size:32px; font-weight:200;"><a href="javascript:void(0);"><?php echo $news->NEWS_TITLE?></a></h2>
    </div>
</div>
<br>

<div class="container marketing">

    <div class="featurette">
        <img class="featurette-image pull-right" style="max-width: 600px;" src="<?php if($news->NEWS_PICTURE != "")echo $this->config->item('img_path').'news/'.$news->NEWS_PICTURE; else echo "http://www.placehold.it/610x300/EFEFEF/AAAAAA&amp;text=No+Image+Available";?>" alt="<?php echo $news->NEWS_TITLE?>">
        <p><?php echo $news->NEWS_CONTENT;?></p>
    </div>

    <div class="content_action">
        <!-- FaceBook -->
        <div style="float: left; margin-right: 5px;" class="fb-like" data-href="<?php echo site_url('news/read/'.$news->NEWS_ID.'/'.$news->ALIAS)?>" data-send="true" data-layout="button_count" data-width="100" data-show-faces="true" data-action="recommend"></div>

        <!-- Twitter  -->
        <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo site_url('news/read/'.$news->NEWS_ID.'/'.$news->ALIAS)?>" data-via="" data-lang="id" data-hashtags="">Tweet</a>
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

        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

    </div>
</div>

<hr class="featurette-divider">