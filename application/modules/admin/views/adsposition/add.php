<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin/adsposition') ?>" title="Back">Quay lại</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
    	<form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
        <table class="data" width="100%" cellpadding="0" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="125"><label>Vị trí quảng cáo (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="posname"  name="posname" value="<?php if(isset($_POST['posname'])) echo $_POST['posname'];  ?>" size="45"  />
                        <?php echo form_error('posname') ?>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Thứ tự xắp xếp</label></td>
                    <td>
                        <input type="text" id="posorder"  name="posorder" value="<?php if(isset($_POST['posorder'])) echo $_POST['posorder']; else {echo 1;} ?>" size="45"  />
                        <?php echo form_error('posorder') ?>    
                    </td>
				</tr>

                <tr>
                	<td width="125"><label>Trạng thái</label></td>
                    <td>
                        <select name="posactive" id="active">
                            <option value="1" <?php if(isset($_POST['posactive']) && $_POST['posactive'] == 1) echo 'selected="selected"'; ?>>Hiển thị</option>
                            <option value="0" <?php if(isset($_POST['posactive']) && $_POST['posactive'] == 0) echo 'selected="selected"'; ?>>Không hiển thị</option>
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
	<!-- End bar chart table-->
	</form>
  </div>
</div>
</div>