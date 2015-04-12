<style type="text/css">
    .opt {
        display: none;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
    
    $("input[name$=links]").change(function() {
        var test = $(this).val();
        $(".opt").hide();
        $("#" + test).show();
    });
    $("input[name$=links]:checked").change();
});
</script>
<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin/slideshow') ?>" title="Quay lui">Back</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
    	<form id="form_data" name="form_data" action="" method="post">
        <table class="data" width="100%" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="125"><label>Tiêu đề slideshow (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="name"  name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>"  size="45" />
                        <?php echo form_error('name') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Thứ tự xắp xếp</label></td>
                    <td>
                        <input type="text" id="order"  name="order" value="<?php if(isset($_POST['order'])) echo $_POST['order']; else {echo 1;} ?>" size="3"  />
                        <?php echo form_error('order') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Vị trí slide show</label></td>
                    <td>
                        <select name="pos">
                        	<option value="top">Slide show top</option>
                            <option value="qc">Quảng cáo</option>
                        </select>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Hình ảnh  (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="image"  name="image" value="" size="40"  />
                        <a onclick="PopupCenter('<?php echo base_url() ?>ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=form&elementId=image', '', 800, 500)" >
                            <img src="<?php echo base_url() ?>public/admin/images/upload.gif" alt="Upload" title="Tải ảnh" style="cursor: pointer;" />
                        </a> (Kích thước khuyến cáo: 998x342px)
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
                        <input type="submit" name="btnAdd" value="Thêm mới" />
                         <input type="reset" name="btnReset" value="Nhập lại" />
                    </td>
                </tr>
			</tbody>
		</table>
	</form>
  </div>
</div>
</div>