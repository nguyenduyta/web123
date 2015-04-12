<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin/tagproduct') ?>" title="Quay lui">Back</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
        <?php if(count($tagproduct) > 0) { ?>
    	<form id="form_data" name="form_data" action="" method="post">
        <table class="data" width="100%" cellpadding="0" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="125"><label>Tiêu đề  Tag sản phẩm (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="name"  name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo $tagproduct['name'] ?>"  size="45" />
                        <?php echo form_error('name') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Thứ tự xắp xếp</label></td>
                    <td>
                        <input type="text" id="order"  name="order" value="<?php if(isset($_POST['order'])) echo $_POST['order']; else echo $tagproduct['order'] ?>" size="3"  />
                        <?php echo form_error('order') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Mở web</label></td>
                    <td>
                        <select name="open" id="open">
                            <option value="1">Mở tab mới</option>
                            <option value="2">Mở trên trang</option>
                        </select>   
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Liên kết tới  (<span class="require">*</span>)</label></td>
                    <td>
                        <div>
                            <input type="radio" name="links"  value="div1"  checked="checked"/> Link liên kết sản phẩm
                        </div>
                        
                        <div id="div4" class="opt">
                        <?php $i = 1 ?>
                        <?php if(count($product) > 0) { ?>
                        <select name="productlink" id="productlink" size="15" style="width: 400px;">
                            <?php foreach($product as $key2=>$val2) { ?>
                            <?php if($tagproduct['link'] == $val2['id']) { ?>
                            <option  value="<?php echo $val2['id'] ?>" selected="selected"><?php echo $i++ ?>.<?php echo $val2['pname'] ?></option>
                            <?php } else { ?>
                            <option  value="<?php echo $val2['id'] ?>"><?php echo $i++ ?>.<?php echo $val2['pname'] ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                        <?php } ?>
                        </div>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Trạng thái</label></td>
                    <td>
                        <select name="active" id="active">
                            <option value="1" <?php if(isset($_POST['active']) && $_POST['active'] == 1) echo 'selected="selected"'; ?>>Hiển thị</option>
                            <option value="0" <?php if(isset($_POST['active']) && $_POST['active'] == 0) echo 'selected="selected"'; ?>>Không hiển thị</option>
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