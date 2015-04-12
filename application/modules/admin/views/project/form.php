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
                	<td width="125"><label>Tên project (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="project_name"  name="project_name" size="50" value="<?php echo  isset($projectInfo['project_name']) ? $projectInfo['project_name'] : set_value("project_name"); ?>"  size="45" />
                        <?php echo form_error('project_name') ?>
                    </td>
				        </tr>
                <tr>
                    <td width="125"><label>Title(<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="project_title"  name="project_title" size="50" value="<?php echo  isset($projectInfo['project_title']) ? $projectInfo['project_title'] : set_value("project_title"); ?>"  size="45" />
                        <?php echo form_error('project_title') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125"><label>URL(<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="project_url"  name="project_url" size="50" value="<?php echo  isset($projectInfo['project_url']) ? $projectInfo['project_url'] : set_value("project_url"); ?>"  size="45" />
                        <?php echo form_error('project_url') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125" style="vertical-align: top;"><label>Project Description</label></td>
                    <td>
                        <?php 
                              $desc = isset($projectInfo['project_desc']) ? $projectInfo['project_desc'] : $this->input->post('project_desc');
                              $fck = new FCKeditor('project_desc');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value  = $desc;
                              $fck->Width  = '100%';
                              $fck->Height = 450;
                              $fck->Create();
                        ?>
                    </td>
                </tr>
                <tr>
                	<td width="125" style="vertical-align: top;"><label>Meta Description</label></td>
                    <td>
                    <textarea style="width:900px; height: 45px; resize:none" name="meta_desc" id="meta_desc"><?php echo isset($projectInfo['meta_desc']) && $projectInfo['meta_desc'] != null ? $projectInfo['meta_desc'] : @$_POST['meta_desc']; ?></textarea>
                        <?php echo form_error('meta_desc') ?>
                        <div id="length" style="font-weight:bold;"></div>
                    </td> 
				        </tr>
                <tr>
                    <td width="125" style="vertical-align: top;"><label>Meta Keyword</label></td>
                    <td>
                        <textarea style="width:900px; height: 45px; resize:none" name="meta_keyword" maxlength="156"><?php  echo  isset($projectInfo['meta_keyword']) && $projectInfo['meta_keyword'] != null ? $projectInfo['meta_keyword'] : @$_POST['meta_keyword']; ?></textarea>
                        <?php echo form_error('meta_keyword') ?>
                    </td> 
                </tr>
		            <tr>
                	<td width="125"><label>Hình ảnh đại diện</label></td>
                    <td>
                       (<span style="color: red; font-weight: bold;">Dung lượng ảnh không quá 2mb, kích thước tối đa 2048x2048 (px), hỗ trợ định dạng: jpg | jpeg | gif | png</span>)<br />
                       <input type="file" name="image" /><br />
                       <?php if(isset($projectInfo) && $projectInfo['project_image']): ?>
                            <img src="<?php echo $projectInfo['project_image']; ?>" />
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