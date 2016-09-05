<script type="text/javascript">
    $(document).ready(function(){
        sendFilterRequest();
    });

    function viewAll(){
        $("#title").val("");
        sendFilterRequest();
    }

    function sendFilterRequest(){
        var loader = "<?php echo $this->config->item('ext_img').'loader/loading-git.gif' ?>";

        jQuery.ajax({
            url: "<?php echo site_url('agenda/ajax_filter_special/agenda')?>",
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
    <form id="ajax_filter" action="<?php echo site_url('indeks/ajax_filter_special')?>" method="post" onsubmit="return sendFilterRequest()">
        <input type="text" name="title" id="title" style="width: 275px;" value="" placeholder="Judul" />
        <input type="hidden" name="type" value="1" />
        <input type="hidden" name="name" value="Agenda" />
        <a href="javascript:void(0)" onclick="sendFilterRequest();" style="margin-top: -10px;" class="btn btn-default btn-lg" data-loading-text="Loading...">Cari Agenda</a>
        <a href="javascript:void(0)" onclick="viewAll();" style="margin-top: -10px;" class="btn btn-success btn-lg" data-loading-text="Loading...">Tampilkan Semua Agenda</a>
    </form>

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <div class="blog_medium">
                <div id="result" style="margin-left: 30px;"></div>
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