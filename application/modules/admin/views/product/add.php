<style type="text/css">
    .opt {
        display: block;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
    
    $("input[name$=radiosale]").change(function() {
        var test = $(this).val();
        $(".opt").hide();
        $("#" + test).show();
    });
    $("input[name$=radiosale]:checked").change();
});
</script>
<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin/product') ?>" title="Back">Quay lại</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
    	<form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
        <table class="data" width="100%" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="125"><label>Tên khóa học (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="pname"  name="pname" value="<?php if(isset($_POST['pname'])) echo $_POST['pname']; ?>"  size="45" />
                        <?php echo form_error('pname') ?>
                    </td>
				</tr>
                <tr>
                	<td width="125" style="vertical-align: top;"><label>Mô tả ngắn</label></td>
                    <td>
                        <?php 
                              $desc = $this->input->post('desc');
                              $fck = new FCKeditor('desc');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value  = $desc;
                              $fck->Width  = '100%';
                              $fck->Height = 250;
                              $fck->Create();
                        ?>
                        <?php echo form_error('desc') ?>
                    </td>
				</tr>
                <tr>
                	<td width="125" style="vertical-align: top;"><label>Mô tả chi tiết</label></td>
                    <td>
                        <?php 
                              $detail = $this->input->post('detail');
                              $fck = new FCKeditor('detail');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value  = $detail;
                              $fck->Width  = '100%';
                              $fck->Height = 450;
                              $fck->Create();
                        ?>
                        <?php echo form_error('detail') ?>
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
                	<td width="125"><label>Thứ tự</label></td>
                    <td>
                        <input type="text" id="porder" value="1" size="10"  name="porder" value="<?php if(isset($_POST['porder'])) echo $_POST['porder']; ?>"  size="20" /> (Tùy chọn)
                        <?php echo form_error('porder') ?>
                    </td> 
				</tr>
                <tr>
                	<td width="125"><label>Description</label></td>
                    <td>
                        <input type="text" id="porder" value="1" size="10"  name="meta" value="<?php if(isset($_POST['meta'])) echo $_POST['meta']; ?>"  size="20" /> (Tùy chọn)
                        <?php echo form_error('porder') ?>
                    </td> 
				</tr>
                <tr>
                	<td width="125"><label>Tag</label></td>
                    <td>
                        <input type="text" id="porder" value="1" size="10"  name="key" value="<?php if(isset($_POST['key'])) echo $_POST['key']; ?>"  size="20" /> (Tùy chọn)
                        <?php echo form_error('porder') ?>
                    </td> 
				</tr>
		        <tr>
                	<td width="125"><label>Hình ảnh</label></td>
                    <td>
                       (<span style="color: red; font-weight: bold;">Dung lượng ảnh không quá 2mb, kích thước tối đa 2048x2048 (px), hỗ trợ định dạng: jpg | jpeg | gif | png</span>)<br />
                       <input type="file" name="image1" /><br />
                       <?php if(isset($errors)) echo '<span style="font-weight: bold; color: red">'.$errors.'</span>'; ?>
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