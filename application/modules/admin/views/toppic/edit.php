<div class="onecolumn">
<div class="header">
    <form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
	<span style="float:left;"><?php if(isset($title)){ echo $title; } ?></span>
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
        <?php if(isset($info)){ ?>
    	
        
        <table class="data" width="100%" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="125"><label>Toppic name (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="name"  name="name" value="<?php echo $info['name']; ?>"  size="45" />
                        <?php echo form_error('name') ?>
                    </td>
				</tr>
                <tr>
                    <td width="125"><label>Title (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="title"  name="title" value="<?php echo $info['title']; ?>"  size="100" />
                        <?php echo form_error('title') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>URL (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="url"  name="url" value="<?php echo $info['url']; ?>"  size="100" />
                        <?php echo form_error('url') ?>
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
                	<td width="125" style="vertical-align: top;"><label>Thuộc Toppic(<span class="require">*</span>)</label></td>
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
							  $fck->Create();
						?>
                        <?php echo form_error('desciption') ?>
                    </td>
		    </tr>
            <tr>
                    <td width="125"><label>Meta Description</label></td>
                    <td>
                        <textarea style="width:900px; height:45px; resize:none;" name="meta_desc"><?php echo $info['meta_desc'];  ?></textarea>
                        <?php echo form_error('meta_desc') ?>
                    </td>
                </tr>
                 <tr>
                    <td width="125"><label>Meta Keywords</label></td>
                    <td>
                        <textarea style="width:900px; height:45px; resize:none;" name="meta_keyword"><?php echo $info['meta_keyword'];  ?></textarea>
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
                       <?php if($info['images'] != null ) { ?>
                            <img src="<?php echo $info['images']; ?>" width='80' />
                       <?php } ?>
                    </td>
				</tr>
			</tbody>
		</table>
	
    <?php } ?>
  </div>
  </form>
</div>
</div>