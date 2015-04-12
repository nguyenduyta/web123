<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin/menunews') ?>" title="Back">Quay lại</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
        <?php if(isset($info)){ ?>
    	<form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
        
        <table class="data" width="100%" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="125"><label>Tên danh mục (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="name"  name="name" value="<?php echo $info['name']; ?>"  size="45" />
                        <?php echo form_error('name') ?>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Thứ tự xắp xếp</label></td>
                    <td>
                        <input type="text" id="order"  name="order" value="<?php echo $info['order']; ?>" size="20"  />
                        <?php echo form_error('order') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125" style="vertical-align: top;"><label>Thuộc danh mục (<span class="require">*</span>)</label></td>
                    <td>
                        <?php 
                            $system = new recursive($menunews);
                            $result = $system->buildArray();
                            $attr   = array('size'=> 15, 'style'=> 'width: 350px');
                            if($info != NULL){
                                $select = createSelect('parent',$info['parent'], $result, $attr);
                            }else{
                                $select = createSelect('parent',null, $result, $attr);   
                            }
                            echo $select;
                        ?>
                        
                        <?php echo form_error('parent') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Trạng thái</label></td>
                    <td>
                        <select name="active" id="active">
                            <option value="1" <?php if($info['active'] == 1) echo 'selected="selected"'; ?>>Hiển thị</option>
                            <option value="0" <?php if($info['active'] == 0) echo 'selected="selected"'; ?>>Không hiển thị</option>
                        </select>
                    </td>
				</tr>
                     <tr>
                	<td width="125" style="vertical-align: top;">
                        <label>Thông tin</label>
                    </td>
                    <td>
                         <?php 
							  $desc = $info['info'];
							  $fck = new FCKeditor('desciption');
							  $fck->BasePath = sBASEPATH;
							  $fck->Value  = $desc;
							  $fck->Width  = '100%';
							  $fck->Height = 400;
							  $fck->ToolbarSet = 'Basic';
							  $fck->Create();
						?>
                        <?php echo form_error('desciption') ?>
                    </td>
		    </tr>
                    <tr>
                	<td width="125"><label>Description</label></td>
                    <td>
                        <input type="text" id="order"  name="meta" value="<?php echo $info['meta']; ?>" size="100"  />

                    </td>
		   </tr>
                 <tr>
                	<td width="125"><label>Keywords</label></td>
                    <td>
                        <input type="text" id="order"  name="key" value="<?php echo $info['key']; ?>" size="100"  />

                    </td>
		   </tr>
                       


		        <tr>
                	<td width="125"><label>Hình ảnh (nếu có)</label></td>
                    <td>
                       <input type="file" name="image" value="" /> <br />(Dung lượng tối đa: 1mb, kích thước: 1024x1024px, hỗ trợ định dạng: jpg | jpeg | gif | png)<br />
                       <?php if(isset($errors)) echo '<div class="error">'.$errors.'</div>'; ?>
                       <p  style="margin-bottom: 5px;">Chiều cao  : <input type="text" size="3" value="100" name="width" /> (px)</p>
                       <p>Chiều rộng: <input type="text" name="height" size="3" value="100" /> (px)</p>
                    </td>
				</tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="hidden" name="isSubmit" value="1" />
                        <input type="submit" name="btnEdit" value="Sửa" />
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