<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin/suntech') ?>" title="Back">Quay lại</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
        <?php if(count($post) > 0) { 
         
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
                	<td width="125"><label>Tiêu đề bài viết</label></td>
                    <td>
                        <input type="text" id="name"  name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo $post['name'] ?>" size="45"  />
                        <?php echo form_error('name') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Ảnh đại diện</label></td>
                    <td>
                        <input type="file" id="image"  name="image"/>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Kích thước</label></td>
                    <td>
                        Chiều rộng: <input type="text" id="width"  name="width" value="<?php if(isset($_POST['width'])) echo $_POST['width']; else echo 120; ?>" size="3"  /> px 
                         <?php echo form_error('width') ?> 
                        Chiều cao:  <input type="text" id="height"  name="height" value="<?php if(isset($_POST['height'])) echo $_POST['height']; else echo 120; ?>" size="3"  /> px 
                        <?php echo form_error('height') ?>
                        (Nếu giá trị bằng 0 hoặc không nhập hệ thống sẽ lấy kích thước mặc định)  
                    </td>
				</tr>
                <tr>
                	<td width="125" style="vertical-align: top;"><label>Mô tả ngắn</label></td>
                    <td>
                        <?php 
                              if($this->input->post('desciption')) {
                                $desciption = $this->input->post('desciption');
                              } else {
                                $desciption = $post['desciption'];
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
                	<td width="125" style="vertical-align: top;"><label>Mô tả chi tiết</label></td>
                    <td>
                        <?php 
                              if($this->input->post('detail')) {
                                $detail = $this->input->post('detail');
                              } else {
                                $detail = $post['detail'];
                              }
                              $fck = new FCKeditor('detail');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value  = $detail;
                              $fck->Width  = '100%';
                              $fck->Height = 350;
                              $fck->Create();
                        ?>
                        <?php echo form_error('detail') ?>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Trạng thái</label></td>
                    <td>
                        <select name="active" id="active">
                           <option value="1" <?php if($post['active'] == 1) echo 'selected="selected"'; elseif(isset($_POST['active']) && $_POST['active'] == 1) echo 'selected="selected"';  ?>>Hiển thị</option>
                            <option value="0" <?php if($post['active'] == 0) echo 'selected="selected"'; elseif(isset($_POST['active']) && $_POST['active'] == 0) echo 'selected="selected"';  ?>>Không hiển thị</option>
                        </select>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Thứ tự</label></td>
                    <td>
                        <input type="text" id="order"  name="order" value="<?php if(isset($_POST['order'])) echo $_POST['order']; else echo $post['order'] ?>" size="3"  />
                        <?php echo form_error('order') ?>    
                    </td>
				</tr>
                 <tr>
                	<td width="125"><label>Description</label></td>
                    <td>
                        <input type="text" id="order"  name="meta" value="<?php echo $post['meta']; ?>" size="100"  />
                        <?php echo form_error('order') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Key</label></td>
                    <td>
                        <input type="text" id="order"  name="key" value="<?php echo $post['key']; ?>" size="100"  />
                        <?php echo form_error('order') ?>    
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