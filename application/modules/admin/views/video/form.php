<div class="onecolumn">
<form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
<div class="header">
	<span style="float:left; width:70%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
            <li>
                <input type="hidden" name="isSubmit" value="1" />
                <input type="submit" name="btnAdd" value="Save" />&nbsp;
                <input type="reset" name="btnReset" value="Cancel" onclick="location.href='/admin/course'" />
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
                	<td width="125"><label>Tên video (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="video_name"  name="video_name" size="100" value="<?php echo  isset($videoInfo['video_name']) ? $videoInfo['video_name'] : set_value("video_name"); ?>"  size="45" />
                        <?php echo form_error('video_name') ?>
                    </td>
				        </tr>
                <tr>
                    <td width="125"><label>Title(<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="video_title"  name="video_title" size="100" value="<?php echo  isset($videoInfo['video_title']) ? $videoInfo['video_title'] : set_value("video_title"); ?>"  size="45" />
                        <?php echo form_error('video_title') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>URL(<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="video_url"  name="video_url" size="100" value="<?php echo  isset($videoInfo['video_url']) ? $videoInfo['video_url'] : set_value("video_url"); ?>"  size="45" />
                        <?php echo form_error('video_url') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>Link(<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="video_link"  name="video_link" size="100" value="<?php echo  isset($videoInfo['video_link']) ? $videoInfo['video_link'] : set_value("video_link"); ?>"  size="45" />
                        <?php echo form_error('video_link') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125" style="vertical-align: top;"><label>Giới thiệu video</label></td>
                    <td>
                        <?php 
                              $video_desc = isset($videoInfo['video_desc']) ? $videoInfo['video_desc'] : $this->input->post('video_desc');
                              $fck = new FCKeditor('video_desc');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value    =  $video_desc;
                              $fck->Width    = '100%';
                              $fck->Height   = 450;
                              $fck->Create();
                        ?>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>Toppic(<span class="require">*</span>)</label></td>
                    <td>
                        <select name="toppic">
                            <option value="">Select Toppic</option>
                            <?php 
                              if ($toppic != null) {
                                foreach ($toppic as $key => $value) {
                                  if($videoInfo['toppic_id'] == $value['id']) {
                                      $selected = "selected='selected'";
                                  } else {
                                      $selected = "";
                                  }
                                  echo "<option value='".$value['id']."' $selected>".$value['name']."</option>";
                                }
                              } 
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>Course</label></td>
                    <td>
                        <select name="course">
                            <option value="">Select Course</option>
                            <?php 
                              if ($course != null) {
                                foreach ($course as $key => $value) {
                                  if($videoInfo['course_id'] == $value['id']) {
                                      $selected = "selected='selected'";
                                  } else {
                                      $selected = "";
                                  }
                                  echo "<option value='".$value['id']."' $selected>".$value['course_name']."</option>";
                                }
                              } 
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="125" style="vertical-align: top;"><label>Meta Description</label></td>
                    <td>
                        <textarea style="width:900px; height: 45px; resize:none" name="meta_desc" id="meta_desc" maxlength="156"><?php  echo  isset($videoInfo['meta_desc']) && $videoInfo['meta_desc'] != null ? $videoInfo['meta_desc'] : @$_POST['meta_desc']; ?></textarea>
                        <?php echo form_error('meta_desc') ?>
                    </td> 
                </tr>
                <tr>
                    <td width="125" style="vertical-align: top;"><label>Meta Keyword</label></td>
                    <td>
                        <textarea style="width:900px; height: 45px; resize:none" name="meta_keyword" id="meta_keyword" maxlength="156"><?php  echo  isset($videoInfo['meta_keyword']) && $videoInfo['meta_keyword'] != null ? $videoInfo['meta_keyword'] : @$_POST['meta_keyword']; ?></textarea>
                        <?php echo form_error('meta_keyword') ?>
                    </td> 
                </tr>
		            <tr>
                	<td width="125"><label>Hình ảnh đại diện</label></td>
                    <td>
                       (<span style="color: red; font-weight: bold;">Dung lượng ảnh không quá 2mb, kích thước tối đa 2048x2048 (px), hỗ trợ định dạng: jpg | jpeg | gif | png</span>)<br />
                       <input type="file" name="video_image" /><br />
                       <?php if(isset($videoInfo) && $videoInfo['video_image']): ?>
                          <img src="<?php echo $videoInfo['video_image']; ?>" />
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