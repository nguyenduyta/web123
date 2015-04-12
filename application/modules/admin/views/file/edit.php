<style type="text/css">
    .opt {
        display: none;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
    
    $("input[name$=charge]").change(function() {
        var test = $(this).val();
        $(".opt").hide();
        $("#" + test).show();
    });
    $("input[name$=charge]:checked").change();
});
</script>
<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin/file') ?>" title="Quay lui">Back</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
        <?php if(count($file) > 0) { ?>
    	<form id="form_data" name="form_data" action="" method="post">
        <table class="data" width="100%" cellpadding="0" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="125"><label>Tên tập tin (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="name"  name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo $file['name'] ?>"  size="45" />
                        <?php echo form_error('name') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Thứ tự xắp xếp</label></td>
                    <td>
                        <input type="text" id="order"  name="order" value="<?php if(isset($_POST['order'])) echo $_POST['order']; else echo $file['order'] ?>" size="3"  />
                        <?php echo form_error('order') ?>    
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Thu phí</label></td>
                    <td>
                        <div>
                            <?php if($file['price'] != 0) { ?>
                            <input type="radio" name="charge"  value="div2"/> Không
                            <input type="radio" name="charge" checked="checked"  value="div1"  />Có
                            <?php } ?>
                        </div>
                        <div class="clear"></div>
                        <div id="div1" class="opt">
                            <input type="text" id="price" name="price" size="15" value="<?php echo $file['price'] ?>"/>
                            (Chỉ nhập số: ví dụ 20000)
                        </div>
                        <?php echo form_error('price') ?>
                    </td>
				</tr>

                <tr>
                	<td width="125"><label>Hình ảnh đại diện</label></td>
                    <td>
                        <input type="text" id="image"  name="image" value="<?php echo $file['image'] ?>" size="40"  />
                        <a onclick="PopupCenter('<?php echo base_url() ?>ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=form&elementId=image', '', 800, 500)" >
                            <img src="<?php echo base_url() ?>public/admin/images/upload.gif" alt="Upload" title="Tải ảnh" style="cursor: pointer;" />
                        </a>
                    </td>
                    <?php echo form_error('image') ?>
				</tr>
                
                <tr>
                	<td width="125"><label>Tải tập tin (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="file"  name="file" value="<?php echo $file['file'] ?>" size="40"  />
                        <a onclick="PopupCenter('<?php echo base_url() ?>ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=form&elementId=file', '', 800, 500)" >
                            <img src="<?php echo base_url() ?>public/admin/images/upload.gif" alt="Upload" title="Tải ảnh" style="cursor: pointer;" />
                        </a>
                        <?php echo form_error('file') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Trạng thái</label></td>
                    <td>
                        <select name="active" id="active">
                             <option value="1" <?php if($file['active'] == 1) echo 'selected="selected"'; elseif(isset($_POST['active']) && $_POST['active'] == 1) echo 'selected="selected"';  ?>>Hiển thị</option>
                            <option value="0" <?php if($file['active'] == 0) echo 'selected="selected"'; elseif(isset($_POST['active']) && $_POST['active'] == 0) echo 'selected="selected"';  ?>>Không hiển thị</option>
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