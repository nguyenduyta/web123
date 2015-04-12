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
    	<form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
        <table width="100%" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
		</table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
                <tr>
                    <td>Chọn chuyên mục</td>
                    <td>
                        <select name="catega">
                            <?php
                                if(isset($listcate) && $listcate != NULL){
                                    foreach($listcate as $listCates){
                            ?>
                                <option value="<?php echo $listCates['id'] ?>" <?php if($info['ga_id'] == $listCates['id']){  ?>selected="selected" <?php } ?> ><?php echo $listCates['name'];   ?></option>
                            <?php }} ?>
                        </select>
                         <?php echo form_error('catega') ?>
                    </td>
                </tr>
                <tr>
                	<td width="125"><label>Tên gallery</label></td>
                    <td>
                        <input type="text" id="nametype"  name="nametype" value="<?php if(isset($info)){ echo $info['ga_name']; } ?>" size="48"  />
                        <?php echo form_error('nametype') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Hình ảnh</label></td>
                    <td>
                        <input type="file" id="ordertype"  name="img"  value=""  />
                    </td>
				</tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <img src="<?php echo base_url() ?>uploads/product/product/<?php echo $info['ga_img']; ?>" width="100" />
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
  </div>
</div>
</div>