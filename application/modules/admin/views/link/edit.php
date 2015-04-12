<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin/link') ?>" title="Back">Quay lại</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
        <?php if(count($link) > 0) { ?>
    	<form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
        <table class="data" width="100%" cellpadding="0" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
                <tr>
                	<td width="125"><label>Tiêu đề liên kết</label></td>
                    <td>
                        <input type="text" id="name"  name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else  echo $link['name']; ?>" size="48"  />
                        <?php echo form_error('name') ?>    
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Liên kết tới</label></td>
                    <td>
                        <strong>http://</strong><input type="text" id="link"  name="link" value="<?php if(isset($_POST['link'])) echo $_POST['link']; else echo $link['link'] ?>" size="40"  />
                        <?php echo form_error('link') ?>    
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Thứ tự</label></td>
                    <td>
                        <input type="text" id="order"  name="order" value="<?php if(isset($_POST['order'])) echo $_POST['order'];  echo $link['order'] ?>" size="3"  />
                        <?php echo form_error('order') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Trạng thái</label></td>
                    <td>
                        <select name="active" id="active">
                            <option value="1" <?php if($link['active'] == 1) echo 'selected="selected"'; elseif(isset($_POST['active']) && $_POST['active'] == 1) echo 'selected="selected"';  ?>>Hiển thị</option>
                            <option value="0" <?php if($link['active'] == 0) echo 'selected="selected"'; elseif(isset($_POST['active']) && $_POST['active'] == 0) echo 'selected="selected"';  ?>>Không hiển thị</option>
                        </select>
                    </td>
				</tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="hidden" name="isSubmit" value="1" />
                        <input type="submit" name="btnAdd" value="Thay đổi" />
                        <input type="reset" name="btnReset" value="Nhập lại" />
                    </td>
                </tr>
			</tbody>
		</table>
	</form>
    <?php } ?>
  </div>
</div>
</div>