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
            <li><a href="<?php echo base_url('admin/brand') ?>" title="Quay lui">Back</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
    	<form id="form_data" name="form_data" action="" method="post">
        <table class="data" width="100%" cellpadding="0" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="125"><label>Tên hãng (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="brandname"  name="brandname" value="<?php if(isset($_POST['brandname'])) echo $_POST['brandname']; ?>"  size="45" />
                        <?php echo form_error('brandname') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Thứ tự xắp xếp</label></td>
                    <td>
                        <input type="text" id="brandorder"  name="brandorder" value="<?php if(isset($_POST['brandorder'])) echo $_POST['brandorder']; else {echo 1;} ?>" size="3"  />
                        <?php echo form_error('brandorder') ?>    
                    </td>
				</tr>

                <tr>
                	<td width="125"><label>Hình ảnh</label></td>
                    <td>
                        <input type="text" id="brandimage"  name="brandimage" value="" size="40"  />
                        <a onclick="PopupCenter('<?php echo base_url() ?>ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=form&elementId=brandimage', '', 800, 500)" >
                            <img src="<?php echo base_url() ?>public/admin/images/upload.gif" alt="Upload" title="Tải ảnh" style="cursor: pointer;" />
                        </a>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Trạng thái</label></td>
                    <td>
                        <select name="brandactive" id="brandactive">
                            <option value="1" <?php if(isset($_POST['brandactive']) && $_POST['brandactive'] == 1) echo 'selected="selected"'; ?>>Hiển thị</option>
                            <option value="0" <?php if(isset($_POST['brandactive']) && $_POST['brandactive'] == 0) echo 'selected="selected"'; ?>>Không hiển thị</option>
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