<div class="onecolumn">
<form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
<div class="header">
	<span style="float:left; width:70%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:5px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
            <input type="submit" name="btnadd" value="Save" />
            <input type="reset" name="btnadd" value="Cancel" onclick="location.href='/admin/tuts'" />
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
                	<td width="125"><label>Tuts name (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="news_name"  name="news_name" value="<?php if(isset($_POST['news_name'])) echo $_POST['news_name']; ?>" style="width: 650px;" />
                        <?php echo form_error('news_name') ?>
                    </td>
                </tr>
                <tr>
                	<td width="125"><label>Title (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="news_title"  name="news_title" value="<?php if(isset($_POST['news_title'])) echo $_POST['news_title']; ?>" style="width: 650px;" />
                        <?php echo form_error('news_title') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>URL (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="news_url"  name="news_url" value="<?php if(isset($_POST['news_url'])) echo $_POST['news_url']; ?>" style="width: 650px;" />
                        <?php echo form_error('news_url') ?>
                    </td>
                </tr>
                <tr>
                	<td width="125" style="vertical-align:top; vertical-align:middle;"><label>Mô tả ngắn</label></td>
                    <td>
                        <?php 
                              $desc = $this->input->post('desc');
                              $fck = new FCKeditor('desc');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value  = $desc;
                              $fck->Width  = '100%';
                              $fck->Height = 200;
							  $fck->ToolbarSet = 'Basic';
                              $fck->Create();
                        ?>
                        <?php echo form_error('desc') ?>
                    </td>
				</tr>
                <tr>
                	<td width="125" style="vertical-align: top; vertical-align: middle;">
                    <label>
                        Toppics / <br/>
                        Course / <br/>
                        Project
                    </label>
                    </td>
                    <td>
                        <?php 
                            $system = new recursive($menuproduct);
                            $result = $system->buildArray();
                            $attr   = array('size'=> 15, 'style'=> 'width: 250px');
                            $select = createSelect('parent',null, $result, $attr);
                            echo $select;
                        ?>
                        <?php echo form_error('parent') ?>
                        <select name="course" id="parent" size="15" style="width: 250px">
                            <option value="0">Chọn khóa học</option>
                            <?php if(isset($course) && $course != null ): 
                                foreach ($course as $courseList): ?>
                            <option value="<?php echo $courseList['id'] ?>">+&nbsp;<?php echo $courseList['course_name'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>    
                        <?php if(isset($project) && $project != null ): ?>
                        <select name="project" id="parent" size="15" style="width: 400px">
                            <option value="0">Chọn project</option>
                        <?php foreach ($project as $key => $value) { ?>
                            <option value="<?php echo $value['project_id']; ?>"><?php echo $value['project_name']; ?></option>
                        <?php } ?>
                        </select>    
                        <?php endif; ?>
                    </td>
				</tr>
                <tr>
                    <td width="125"><label>New share</label></td>
                    <td><input type="checkbox" name="news_share" value="1" /></td>
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
                        <input type="text" id="porder" value="1" name="porder" value="<?php if(isset($_POST['porder'])) echo $_POST['porder']; ?>"  size="20" /> (Tùy chọn)
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
                              $detail = $this->input->post('detail');
                              $fck = new FCKeditor('detail');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value  = $detail;
                              $fck->Width  = '100%';
                              $fck->Height = 600;
                              $fck->Create();
                        ?>
                        <?php echo form_error('detail') ?>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Meta Description</label></td>
                    <td>
                        <textarea name="meta" style="width: 900px; height: 45px; resize:none;"><?php if(isset($_POST['meta'])) echo $_POST['meta']; ?></textarea>
                        <?php echo form_error('meta') ?>
                        <div id="length" style="font-weight:bold;"></div>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Meta Keyword</label></td>
                    <td>
                        <textarea name="key" style="width: 900px; height: 45px; resize:none;"><?php if(isset($_POST['key'])) echo $_POST['key']; ?></textarea>
                    </td>
				</tr>
			</tbody>
		</table>
	<!-- End bar chart table-->
  </div>
</div>
</form>
</div>
