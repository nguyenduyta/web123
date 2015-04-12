<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin/youtube') ?>" title="Quay lui">Back</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
        <?php if(count($youtube) > 0) { ?>
    	<form id="form_data" name="form_data" action="" method="post">
        <table class="data" width="100%" cellpadding="0" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="130"><label>Tiêu đề youtube (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="name"  name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo $youtube['name'] ?>"  size="45" />
                        <?php echo form_error('name') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="130"><label>Thứ tự xắp xếp</label></td>
                    <td>
                        <input type="text" id="order"  name="order" value="<?php if(isset($_POST['order'])) echo $_POST['order']; else echo $youtube['order'] ?>" size="3"  />
                        <?php echo form_error('order') ?>    
                    </td>
				</tr>

                <tr>
                	<td width="130" style="vertical-align: top;"><label>Link youtube  (<span class="require">*</span>)</label></td>
                    <td>
                       <textarea cols="60" rows="8" name="link" id="link">http://www.youtube.com/watch?v=<?php if(isset($_POST['link'])) echo $_POST['link']; else echo $youtube['link']?></textarea><br>
                       (Ex: http://www.youtube.com/watch?v=rZFUXUq0iL0)
                    </td>
				</tr>
                
                <tr>
                	<td width="130" style="vertical-align: top;"><label> Chiều cao:  (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" size="3" value="<?php if(isset($_POST['width'])) echo $_POST['width']; else echo $youtube['width']?>" name="width" /> (px)
                        <?php echo form_error('width') ?> 
                    </td>
				</tr>
                
                <tr>
                	<td width="130" style="vertical-align: top;"><label> Chiều rộng: (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" size="3" value="<?php if(isset($_POST['height'])) echo $_POST['height']; else echo $youtube['height'];?>" name="height" /> (px)
                        <?php echo form_error('height') ?> 
                    </td>
				</tr>
                
                <tr>
                	<td width="130"><label>Trạng thái</label></td>
                    <td>
                        <select name="active" id="active">
                            <option value="1" <?php if($youtube['active'] == 1) echo 'selected="selected"'; elseif(isset($_POST['active']) && $_POST['active'] == 1) echo 'selected="selected"';  ?>>Hiển thị</option>
                            <option value="0" <?php if($youtube['active'] == 0) echo 'selected="selected"'; elseif(isset($_POST['active']) && $_POST['active'] == 0) echo 'selected="selected"';  ?>>Không hiển thị</option>
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