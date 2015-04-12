<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/jquery.img.preload.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/hint.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/visualize/jquery.visualize.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/jwysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/fancybox/jquery.fancybox-1.3.0.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/mycustom.js"></script>
<script src="<?php echo base_url() ?>public/jpage/js/jPages.js"></script>

<script type="text/javascript" charset="utf-8"> 
$(function(){ 
    // find all the input elements with title attributes
    $('input[title!=""]').hint();
    $('#login_info').click(function(){
		$(this).fadeOut('fast');
	});
});
</script>
<script>
  $(function(){

    /* initiate the plugin */
    $("div.holder").jPages({
      containerID  : "content",
      perPage      : 10,
      startPage    : 1,
      startRange   : 1,
      midRange     : 5,
      endRange     : 1
    });

  });
  </script>
