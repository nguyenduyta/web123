<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin/groupmenunews') ?>" title="Back">Quay lại</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
        <?php if(count($groupmenunews) > 0) { 
      
?>
    	<form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
        <table class="data" width="100%" cellpadding="0" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
                <tr>
                	<td width="125"><label>Tiêu đề loại tin tức</label></td>
                    <td>
                        <input type="text" id="nametype"  name="nametype" value="<?php if(isset($_POST['nametype'])) echo $_POST['nametype']; else echo $groupmenunews['nametype'] ?>" size="48"  />
                        <?php echo form_error('nametype') ?>    
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Thứ tự</label></td>
                    <td>
                        <input type="text" id="ordertype"  name="ordertype" value="<?php if(isset($_POST['ordertype'])) echo $_POST['ordertype']; else echo $groupmenunews['ordertype']?>" size="3"  />
                        <?php echo form_error('ordertype') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Hình ảnh</label></td>
                    <td>
                       <input type="file" name="img" value="" /><br />
                       <?php if(isset($errors)) echo $errors; ?>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Trạng thái</label></td>
                    <td>
                        <select name="activetype" id="activetype">
                             <option value="1" <?php if($groupmenunews['activetype'] == 1) echo 'selected="selected"'; elseif(isset($_POST['activetype']) && $_POST['activetype'] == 1) echo 'selected="selected"';  ?>>Hiển thị</option>
                            <option value="0" <?php if($groupmenunews['activetype'] == 0) echo 'selected="selected"'; elseif(isset($_POST['activetype']) && $_POST['activetype'] == 0) echo 'selected="selected"';  ?>>Không hiển thị</option>
                        </select>
                    </td>
				</tr>
                 <tr>
                	<td width="125" style="vertical-align:top; vertical-align:middle;"><label>Mô tả ngắn</label></td>
                    <td>
                        <?php 
                              if($this->input->post('desciption')) {
                                $desciption = $this->input->post('desciption');
                              } else {
                                $desciption = $groupmenunews['desc'];
                              }
                              $fck = new FCKeditor('desciption');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value  = $desciption;
                              $fck->Width  = '100%';
                              $fck->Height = 350;
                              $fck->Create();
                        ?>
                        <?php echo form_error('desciption') ?>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Description</label></td>
                    <td>
                        <input type="text" id="ordertype"  name="meta" value="<?php echo $groupmenunews['meta']; ?>" size="100"  />
                        <?php echo form_error('ordertype') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Tag</label></td>
                    <td>
                        <input type="text" id="ordertype"  name="key" value="<?php echo $groupmenunews['key']; ?>" size="100"  />
                        <?php echo form_error('ordertype') ?>    
                    </td>
				</tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="hidden" name="isSubmit" value="1" />
                        <input type="submit" name="btnAdd" value="Sửa" />
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