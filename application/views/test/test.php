<html>
<head>
	<title>Test</title>
	<!-- jQuery -->
	<script src="<?php echo $this->config->item('layout_front');?>js/jquery-1.7.2.min.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url()?>extra/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>extra/ckfinder/ckfinder.js"></script>
	
	<!-- TagIt -->	
	<script src="<?php echo $this->config->item('ext_js');?>plugins/jquery-ui/js/jquery-ui-1.10.2.custom.min.js"></script>
	<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/jquery-ui/css/Aristo/Aristo.css">
	
	<script src="<?php echo $this->config->item('ext_js');?>plugins/tag-it/js/tag-it.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="<?php echo $this->config->item('ext_js');?>plugins/tag-it/css/jquery.tagit.css">
</head>
<body>
<form action="" method="post">
<textarea id="editor1"></textarea>
<script type="text/javascript">
	var editor = CKEDITOR.replace( 'editor1' );
	//editor.setData( '<p>Just click the <b>Image</b> or <b>Link</b> button, and then <b>&quot;Browse Server&quot;</b>.</p>' );
	
	// Just call CKFinder.setupCKEditor and pass the CKEditor instance as the first argument.
	// The second parameter (optional), is the path for the CKFinder installation (default = "/ckfinder/").
	CKFinder.setupCKEditor( editor, '<?php echo base_url()?>extra/ckfinder' ) ;
	
	// It is also possible to pass an object with selected CKFinder properties as a second argument.
	// CKFinder.setupCKEditor( editor, { basePath : '../', skin : 'v1' } ) ;
</script>
<input name="tags" id="mySingleFieldTags" value="fancy, new, tag, demo">

<input name="submit" type="submit"  value="Test"/>
</form>
	
<script type="text/javascript">
$(document).ready(function(){
	 var sampleTags = ['c++', 'java', 'php', 'coldfusion', 'javascript', 'asp', 'ruby', 'python', 'c', 'scala', 'groovy', 'haskell', 'perl', 'erlang', 'apl', 'cobol', 'go', 'lua'];
     $("#mySingleFieldTags").tagit({
         availableTags: sampleTags
     });
});
</script>
</body>
</html>