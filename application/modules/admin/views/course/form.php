<?php
    /*echo "<pre>";
    echo strlen("Khóa học Laravel Framework, Học laravel, Học laravel ở hà nội, khóa học lập trình laravel, học thiết kế web, học lập trình php mysql uy tín chất lượng nhất hà nội");
    echo "</pre>";
    die;*/
?>
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
                	<td width="125"><label>Tên khóa học (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="course_name"  name="course_name" size="50" value="<?php echo  isset($courseInfo['course_name']) ? $courseInfo['course_name'] : set_value("course_name"); ?>"  size="45" />
                        <?php echo form_error('course_name') ?>
                    </td>
				</tr>
                <tr>
                    <td width="125"><label>Title(<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="course_title"  name="course_title" size="50" value="<?php echo  isset($courseInfo['course_title']) ? $courseInfo['course_title'] : set_value("course_title"); ?>"  size="45" />
                        <?php echo form_error('course_title') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>URL(<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="course_url"  name="course_url" size="50" value="<?php echo  isset($courseInfo['course_url']) ? $courseInfo['course_url'] : set_value("course_url"); ?>"  size="45" />
                        <?php echo form_error('course_url') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>Author(<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="course_author"  name="course_author" size="50" value="<?php echo  isset($courseInfo['course_author']) ? $courseInfo['course_author'] : set_value("course_author"); ?>"  size="45" />
                        <?php echo form_error('course_author') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>Fee(<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="course_price"  name="course_price" size="25" value="<?php echo  isset($courseInfo['course_price']) ? $courseInfo['course_price'] : set_value("course_price"); ?>"  size="45" />
                        <?php echo form_error('course_price') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>Sale</label></td>
                    <td>
                        <input type="text" id="course_sale"  name="course_sale" size="25" value="<?php echo  isset($courseInfo['course_sale']) ? $courseInfo['course_sale'] : set_value("course_sale"); ?>"  size="45" />
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>Time</label></td>
                    <td>
                        <input type="text" id="course_time"  name="course_time" size="25" value="<?php echo  isset($courseInfo['course_time']) ? $courseInfo['course_time'] : set_value("course_time"); ?>"  size="45" />
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>Promotion(<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="course_promotion"  name="course_promotion" size="25" value="<?php echo  isset($courseInfo['course_promotion']) ? $courseInfo['course_promotion'] : @$_POST["course_promotion"]; ?>" />
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>Status(<span class="require">*</span>)</label></td>
                    <td>
                        <select name="status">
                            <option value="0" <?php echo isset($courseInfo['course_status']) && $courseInfo['course_status'] == 0 ? "selected='selected'" : ""; ?>>On</option>
                            <option value="1" <?php echo isset($courseInfo['course_status']) && $courseInfo['course_status'] == 1 ? "selected='selected'" : ""; ?>>Off</option>
                        </select>                        
                    </td>
                </tr>
                <tr>
                	<td width="125" style="vertical-align: top;"><label>Thông tin giới chung</label></td>
                    <td>
                        <?php 
                              $desc = isset($courseInfo['course_desc']) ? $courseInfo['course_desc'] : $this->input->post('course_desc');
                              $fck = new FCKeditor('course_desc');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value  = $desc;
                              $fck->Width  = '100%';
                              $fck->Height = 450;
                              $fck->Create();
                        ?>
                    </td>
				</tr>
                <tr>
                    <td width="125" style="vertical-align: top;"><label>Bạn được gì từ khóa học</label></td>
                    <td>
                        <?php 
                              $course_you = isset($courseInfo['course_you']) ? $courseInfo['course_you'] : $this->input->post('course_you');
                              $fck = new FCKeditor('course_you');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value    =  $course_you;
                              $fck->Width    = '100%';
                              $fck->Height   = 450;
                              $fck->Create();
                        ?>
                    </td>
                </tr>
                <tr>
                    <td width="125" style="vertical-align: top;"><label>Đối tượng tham gia</label></td>
                    <td>
                        <?php 
                              $course_object = isset($courseInfo['course_object']) ? $courseInfo['course_object'] : $this->input->post('course_object');
                              $fck = new FCKeditor('course_object');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value    =  $course_object;
                              $fck->Width    = '100%';
                              $fck->Height   = 450;
                              $fck->Create();
                        ?>
                    </td>
                </tr>
                <tr>
                    <td width="125" style="vertical-align: top;"><label>Chương trình khuyến mãi</label></td>
                    <td>
                        <?php 
                              $course_event = isset($courseInfo['course_event']) ? $courseInfo['course_event'] : $this->input->post('course_event');
                              $fck = new FCKeditor('course_event');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value    =  $course_event;
                              $fck->Width    = '100%';
                              $fck->Height   = 450;
                              $fck->Create();
                        ?>
                        <?php echo form_error('course_desc') ?>
                    </td>
                </tr>
                <tr>
                	<td width="125" style="vertical-align: top;"><label>Thông tin chi tiết</label></td>
                    <td>
                        <?php 
                              $detail =  isset($courseInfo['course_detail']) ? $courseInfo['course_detail'] : $this->input->post('course_detail');
                              $fck = new FCKeditor('course_detail');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value  = $detail;
                              $fck->Width  = '100%';
                              $fck->Height = 650;
                              $fck->Create();
                        ?>
                        <?php echo form_error('course_detail') ?>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Order</label></td>
                    <td>
                        <input type="text" id="course_order" value="1" size="5"  name="course_order" value="<?php echo  isset($courseInfo['course_order']) ? $courseInfo['course_order'] : set_value('course_order'); ?>"  size="15" />
                    </td> 
				</tr>
                <tr>
                	<td width="125" style="vertical-align: top;"><label>Meta Description</label></td>
                    <td>
                    <textarea style="width:900px; height: 45px; resize:none" name="meta_desc" id="meta_desc"><?php echo isset($courseInfo['meta_desc']) && $courseInfo['meta_desc'] != null ? $courseInfo['meta_desc'] : @$_POST['meta_desc']; ?></textarea>
                        <?php echo form_error('meta_desc') ?>
                        <div id="length" style="font-weight:bold;"></div>
                    </td> 
				</tr>
                <tr>
                    <td width="125" style="vertical-align: top;"><label>Meta Keyword</label></td>
                    <td>
                        <textarea style="width:900px; height: 45px; resize:none" name="meta_keyword" maxlength="156"><?php  echo  isset($courseInfo['meta_keyword']) && $courseInfo['meta_keyword'] != null ? $courseInfo['meta_keyword'] : @$_POST['meta_keyword']; ?></textarea>
                        <?php echo form_error('meta_keyword') ?>
                    </td> 
                </tr>
		        <tr>
                	<td width="125"><label>Hình ảnh đại diện</label></td>
                    <td>
                       (<span style="color: red; font-weight: bold;">Dung lượng ảnh không quá 2mb, kích thước tối đa 2048x2048 (px), hỗ trợ định dạng: jpg | jpeg | gif | png</span>)<br />
                       <input type="file" name="image" /><br />
                       <?php if(isset($courseInfo) && $courseInfo['course_image']): ?>
                            <img src="<?php echo $courseInfo['course_image']; ?>" />
                       <?php endif; ?>
                       <?php if(isset($errors)) echo '<span style="font-weight: bold; color: red">'.$errors.'</span>'; ?>
                    </td>
				    </tr>
            <tr>
                  <td width="125"><label>Icon khóa học</label></td>
                    <td>
                       (<span style="color: red; font-weight: bold;">Dung lượng ảnh không quá 2mb, kích thước tối đa 2048x2048 (px), hỗ trợ định dạng: jpg | jpeg | gif | png</span>)<br />
                       <input type="file" name="icon_course" /><br />
                       <?php if(isset($courseInfo) && $courseInfo['course_icon_image']): ?>
                            <img src="<?php echo $courseInfo['course_icon_image']; ?>" />
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