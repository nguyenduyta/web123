<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
            <li><a href="<?php echo base_url('admin/news') ?>" title="Back">Quay lại</a></li>
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
                	<td width="125"><label>Tên bài viết (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="news_name"  name="news_name" value="<?php if(isset($info)) echo $info['news_name']; ?>"  size="45" />
                        <?php echo form_error('news_name') ?>
                    </td>
                </tr>
                <tr>
                	<td width="125"><label>Tên tác giả (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="news_author"  name="news_author" value="<?php if(isset($info)) echo $info['news_author']; ?>"  size="45" />
                        <?php echo form_error('news_author') ?>
                    </td>
                </tr>
                <tr>
                	<td width="125" style="vertical-align:top; vertical-align:middle;"><label>Mô tả ngắn</label></td>
                    <td>
                        <?php 
                              if($this->input->post('desc')) {
                                $desc = $this->input->post('desc');
                              } else {
                                $desc = $info['news_desc'];
                              }
                              $fck = new FCKeditor('desc');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value  = $desc;
                              $fck->Width  = '100%';
                              $fck->Height = 200;
                              $fck->Create();
                        ?>
                        <?php echo form_error('desc') ?>
                    </td>
				</tr>
                <tr>
                	<td width="125" style="vertical-align: top; vertical-align: middle;"><label>Thuộc danh mục (<span class="require">*</span>)</label></td>
                    <td>
                        <?php 
                            $system = new recursive($menuproduct);
                            $result = $system->buildArray();
                            $attr   = array('size'=> 15, 'style'=> 'width: 350px');
                            $select = createSelect('parent',$info['news_menu'], $result, $attr);
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
                	<td width="125"><label>Thứ tự</label></td>
                    <td>
                        <input type="text" id="porder" value="1" size="10"  name="porder" value="<?php if(isset($_POST['porder'])) echo $_POST['porder']; ?>"  size="20" /> (Tùy chọn)
                        <?php echo form_error('porder') ?>
                    </td> 
				</tr>
		        <tr>
                	<td width="125"><label>Hình ảnh</label></td>
                    <td>
                       (<span style="color: red; font-weight: bold;">Dung lượng ảnh không quá 2mb, kích thước tối đa 1024x1024 (px), hỗ trợ định dạng: jpg | jpeg | gif | png</span>)<br />
                       <input type="file" name="img" value="" /><br />
                       <?php if(isset($errors)) echo $errors; ?>
                    </td>
				</tr>
                <tr>
                	<td width="125" style="vertical-align: top;vertical-align:middle;"><label>Mô tả chi tiết</label></td>
                    <td>
                        <?php 
                              if($this->input->post('detail')) {
                                $detail = $this->input->post('detail');
                              } else {
                                $detail = $info['news_full'];
                              }
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
                	<td width="125"><label>Meta</label></td>
                    <td>
                        <textarea name="meta" style="width: 600px; height: 50px;"><?php echo $info['meta']; ?></textarea>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Key</label></td>
                    <td>
                        <textarea name="key" style="width: 600px; height: 50px;"><?php echo $info['key']; ?></textarea>
                    </td>
				</tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" name="btnadd" value="Sửa" />
                        <input type="reset" name="btnadd" value="Làm lại" />
                    </td>
                </tr>
			</tbody>
		</table>
	<!-- End bar chart table-->
	</form>
  </div>
</div>
</div>
