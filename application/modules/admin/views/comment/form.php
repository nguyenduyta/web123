<div class="onecolumn">
<form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
<div class="header">
	<span style="float:left; width:70%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
            <li>
                <input type="hidden" name="isSubmit" value="1" />
                <input type="submit" name="btnAdd" value="Save" />&nbsp;
                <input type="reset" name="btnReset" value="Cancel" onclick="location.href='/admin/comment'" />
            </li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
        <table class="data" width="100%" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="125"><label>Full name (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="comment_author"  name="comment_author" size="50" value="<?php echo  isset($commentInfo['comment_author']) ? $commentInfo['comment_author'] : set_value("comment_author"); ?>"  size="45" />
                        <?php echo form_error('comment_author') ?>
                    </td>
				</tr>
                <tr>
                    <td width="125"><label>Email(<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="comment_email"  name="comment_email" size="50" value="<?php echo  isset($commentInfo['comment_email']) ? $commentInfo['comment_email'] : set_value("comment_email"); ?>"  size="45" />
                        <?php echo form_error('comment_email') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>Phone(<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="comment_phone"  name="comment_phone" size="50" value="<?php echo  isset($commentInfo['comment_phone']) ? $commentInfo['comment_phone'] : set_value("comment_phone"); ?>"  size="45" />
                        <?php echo form_error('comment_phone') ?>
                    </td>
                </tr>
                <tr>
                	<td width="125" style="vertical-align: top;"><label>Nội dung comment</label></td>
                    <td>
                        <?php 
                              $detail =  isset($commentInfo['comment_content']) ? $commentInfo['comment_content'] : $this->input->post('comment_content');
                              $fck = new FCKeditor('comment_content');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value  = $detail;
                              $fck->Width  = '100%';
                              $fck->Height = 150;
                              $fck->ToolbarSet = 'Basic';
                              $fck->Create();
                        ?>
                        <?php echo form_error('comment_content') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125" style="vertical-align: top;"><label>Status</label></td>
                    <td>
                        <select name="comment_status">
                            <option value="0" <?php echo isset($commentInfo) && $commentInfo['comment_status'] == '0' ? "selected='selected'" : ""; ?>>Publish</option>
                            <option value="1" <?php echo isset($commentInfo) && $commentInfo['comment_status'] == '1' ? "selected='selected'" : ""; ?>>Pendding</option>
                            <option value="2" <?php echo isset($commentInfo) && $commentInfo['comment_status'] == '2' ? "selected='selected'" : ""; ?>>Disable</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td width="125" style="vertical-align: top;"><label>Meta Description</label></td>
                    <td>
                    <textarea style="width:900px; height: 45px; resize:none" name="meta_desc" id="meta_desc"><?php echo isset($commentInfo['meta_desc']) && $commentInfo['meta_desc'] != null ? $commentInfo['meta_desc'] : @$_POST['meta_desc']; ?></textarea>
                        <?php echo form_error('meta_desc') ?>
                        <div id="length" style="font-weight:bold;"></div>
                    </td> 
				      </tr>
                <tr>
                    <td width="125" style="vertical-align: top;"><label>Meta Keyword</label></td>
                    <td>
                        <textarea style="width:900px; height: 45px; resize:none" name="meta_keyword" maxlength="156"><?php  echo  isset($commentInfo['meta_keyword']) && $commentInfo['meta_keyword'] != null ? $commentInfo['meta_keyword'] : @$_POST['meta_keyword']; ?></textarea>
                        <?php echo form_error('meta_keyword') ?>
                    </td> 
                </tr>
		        <tr>
                	<td width="125"><label>Hình ảnh đại diện</label></td>
                    <td>
                       (<span style="color: red; font-weight: bold;">Dung lượng ảnh không quá 2mb, kích thước tối đa 2048x2048 (px), hỗ trợ định dạng: jpg | jpeg | gif | png</span>)<br />
                       <input type="file" name="image" /><br />
                       <?php if(isset($commentInfo) && $commentInfo['comment_image']): ?>
                            <img src="<?php echo $commentInfo['comment_image']; ?>" />
                       <?php endif; ?>
                       <?php if(isset($errors)) echo '<span style="font-weight: bold; color: red">'.$errors.'</span>'; ?>
                    </td>
				    </tr>
			</tbody>
		</table>
	<!-- End bar chart table-->
  </div>
</div>
</form>
</div>