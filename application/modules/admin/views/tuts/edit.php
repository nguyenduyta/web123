
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
                        <input type="text" id="news_name"  name="news_name" value="<?php if(isset($info['news_name'])) echo $info['news_name']; ?>" style="width: 650px;" />
                        <?php echo form_error('news_name') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>Title (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="news_title"  name="news_title" value="<?php if(isset($info['news_title'])) echo $info['news_title']; ?>" style="width: 650px;" />
                        <?php echo form_error('news_title') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>URL (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="news_url"  name="news_url" value="<?php if(isset($info['news_url'])) echo $info['news_url']; ?>" style="width: 650px;" />
                        <?php echo form_error('news_url') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125" style="vertical-align:top; vertical-align:middle;"><label>Mô tả ngắn</label></td>
                    <td>
                        <?php 
                              $desc = $info['news_desc'];
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
                            $select = createSelect('parent',$info['toppic_id'], $result, $attr);
                            echo $select;
                        ?>
                        <?php echo form_error('parent') ?>
                        <select name="course" id="parent" size="15" style="width: 250px">
                            <option value="0">Chọn khóa học</option>
                            <?php if(isset($course) && $course != null ): 
                                foreach ($course as $courseList): 
                                  if($info['course_id'] == $courseList['id'] ) {
                                    $select = "selected='selected'";
                                  } else {
                                    $select = "";
                                  }
                                ?>
                            <option <?php echo $select; ?> value="<?php echo $courseList['id'] ?>">+&nbsp;<?php echo $courseList['course_name'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>    
                        <?php if(isset($project) && $project != null ): ?>
                        <select name="project" id="parent" size="15" style="width: 400px">
                            <option value="0">Chọn project</option>
                        <?php 
                            foreach ($project as $key => $value) { 
                                if($info['project_id'] == $value['project_id']) {
                                    $selected = "selected='selected'";
                                } else {
                                    $selected = "";
                                }
                        ?>
                            <option value="<?php echo $value['project_id']; ?>" <?php echo $selected; ?>><?php echo $value['project_name']; ?></option>
                        <?php } ?>
                        </select>    
                        <?php endif; ?>    
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>New share</label></td>
                    <?php $checked = isset($info['news_share']) && $info['news_share'] != 0 ? "checked='checked'" : ""; ?>
                    <td><input type="checkbox" name="news_share" value="1" <?php echo $checked; ?>/></td>
                </tr>
                <tr>
                    <td width="125"><label>Trạng thái</label></td>
                    <td>
                        <select name="active" id="active">
                            <option value="1" <?php if(isset($info['news_active']) && $info['news_active'] == 1) echo 'selected="selected"'; ?>>Hiển thị</option>
                            <option value="0" <?php if(isset($info['news_active']) && $info['news_active'] == 0) echo 'selected="selected"'; ?>>Không hiển thị</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>Thứ tự</label></td>
                    <td>
                        <input type="text" id="porder" name="porder" value="<?php if(isset($info['news_order'])) echo $info['news_order']; ?>"  size="20" /> (Tùy chọn)
                        <?php echo form_error('porder') ?>
                    </td> 
                </tr>
                <tr>
                    <td width="125"><label>Hình ảnh</label></td>
                    <td>
                       (<span style="color: red; font-weight: bold;">Dung lượng ảnh không quá 2mb, kích thước tối đa 1024x1024 (px), hỗ trợ định dạng: jpg | jpeg | gif | png</span>)<br />
                       <input type="file" name="img" value="" /><br />
                       <?php if(isset($errors)) echo $errors; ?>
                       <?php 
                            echo $info['news_images'] ? "<img src='".$info['news_images']."' width='80' />" : "";
                       ?>
                    </td>
                </tr>
                <tr>
                    <td width="125" style="vertical-align: top;vertical-align:middle;"><label>Mô tả chi tiết</label></td>
                    <td>
                        <?php 
                              $detail = $info['news_full'];
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
                        <textarea name="meta" id="meta_desc" style="width: 900px; height: 45px; resize:none;"><?php if(isset($info['meta_desc'])) echo $info['meta_desc']; ?></textarea>
                        <?php echo form_error('meta') ?>
                        <div id="length" style="font-weight:bold;"></div>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>Meta Keyword</label></td>
                    <td>
                        <textarea name="key" style="width: 900px; height: 45px; resize:none;"><?php if(isset($info['meta_keyword'])) echo $info['meta_keyword']; ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    <!-- End bar chart table-->
  </div>
</div>
</form>
</div>
