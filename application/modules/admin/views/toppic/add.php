<div class="onecolumn">
<form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
<div class="header">
	<span style="float:left; width:75%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li>
                <input type="submit" name="btnAdd" value="Save" />
                <input type="reset" name="btnReset" onclick="location.href='/admin/toppic'" value="Cancel" />
            </li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
    	
        <table class="data" width="100%" cellpadding="0">
            <tr>
                <td align="right">
                    <h5 style="float:left;">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</h5>
                    <input type="hidden" name="isSubmit" value="1" />
                </td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="125"><label>Toppic name (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="name"  name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>"  size="100" />
                        <?php echo form_error('name') ?>
                    </td>
				</tr>
                <tr>
                    <td width="125"><label>Title (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="title"  name="title" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>"  size="100" />
                        <?php echo form_error('title') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>URL (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="url"  name="url" value="<?php if(isset($_POST['url'])) echo $_POST['url']; ?>"  size="100" />
                        <?php echo form_error('url') ?>
                    </td>
                </tr>
                <tr>
                	<td width="125"><label>Order</label></td>
                    <td>
                        <input type="text" id="order"  name="order" value="<?php if(isset($_POST['order'])) echo $_POST['order']; else {echo 1;} ?>" size="5"  />
                        <?php echo form_error('order') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125" style="vertical-align: top;"><label>Danh mục (<span class="require">*</span>)</label></td>
                    <td>
                        <?php 
                            $system = new recursive($menuproduct);
                            $result = $system->buildArray();
                            $attr   = array('size'=> 15, 'style'=> 'width: 300px');
                            $select = createSelect('parent',0, $result, $attr);
                            echo $select;
                        ?>
                        <?php echo form_error('parent') ?>    
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
                	<td width="125" style="vertical-align: top;">
                        <label>Thông tin</label>
                    </td>
                    <td>
                         <?php 
							  $desc = $this->input->post('desciption');
							  $fck = new FCKeditor('desciption');
							  $fck->BasePath = sBASEPATH;
							  $fck->Value  = $desc;
							  $fck->Width  = '100%';
							  $fck->Height = 350;
							  $fck->Create();
						?>
                        <?php echo form_error('desciption') ?>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Meta Description</label></td>
                    <td>
                        <textarea style="width:900px; height:45px; resize:none;" name="meta_desc"><?php if(isset($_POST['meta_desc'])) echo $_POST['meta_desc'];  ?></textarea>
                        <?php echo form_error('meta_desc') ?>
                    </td>
		        </tr>
                 <tr>
                	<td width="125"><label>Meta Keywords</label></td>
                    <td>
                        <textarea style="width:900px; height:45px; resize:none;" name="meta_keyword"><?php if(isset($_POST['meta_keyword'])) echo $_POST['meta_keyword'];  ?></textarea>
                        <?php echo form_error('meta_keyword') ?>
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
			</tbody>
		</table>
	<!-- End bar chart table-->
  </div>
</div>
</form>
</div>