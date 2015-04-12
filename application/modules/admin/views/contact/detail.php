    <div class="onecolumn">    	
        <div class="header">
        	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
            <span style="float:right; margin-right:15px;">
            	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
                	<li><a href="#"></a></li>
                    <li><a href="<?php echo base_url('admin/contact') ?>" title="Quay lui">Back</a></li>
                </ul>
            </span>
        </div>
    	<div class="content">
            <?php if(count($content) > 0) { ?>
                <?php $arrContact = json_decode($content['option'],true) ?>
                <?php
                    switch($arrContact['khoahoc']){
                        case 1: echo "<p>Đã đăng ký khóa học web giao diện - Web tĩnh </p>";break;
                        case 2: echo "<p>Đã đăng ký khóa học PHP căn bản </p>";break;
                        case 3: echo "<p>Đã đăng ký khóa học PHP nâng cao </p>";break;
                        case 4: echo "<p>Đã đăng ký khóa học PHP chuyên sâu - PHP Framework </p>";break;
                    } 
                    echo $arrContact['mess'] 
                
                ?>
            <?php } else { ?>
                <div class="no_record" align="center">No record</div>
            <?php } ?>
        </div>
	</div>
</div>