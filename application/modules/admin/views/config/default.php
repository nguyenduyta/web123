<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin') ?>" title="Back">Quay lại</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
    <?php if ($existFile == true) {?>
    <?php if ($isWrite == false) {?>
    <?php echo '<div class="error">Không thể ghi file</div>';?>
    <?php }?>
    <?php if ($successEdit == true) { ?>
    <?php echo '<div class="success">Lưu cấu hình thành công</div>';?>
    <?php }?>
    	<form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
        <h3>Giao diện</h3>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
                <tr>
                	<td width="180"><label>Màu nền website hiện tại</label></td>
                    <td>
                       <input type="text" value="<?php echo $this->config->item('config_background') ?>" disabled="disabled" id="bgold"  name="bgold"  size="25" />
                       <?php echo form_error('bgold') ?>    
                    </td>                 
				</tr>
                
                <tr>
               	    <td width="180"><label>Màu nền website mới</label></td>
                    <td>
                       <input type="text" class="izzyColor" id="bgnew"  name="bgnew" value="<?php echo $this->config->item('config_background') ?>" size="25" />
                       <?php echo form_error('bgnew') ?>    
                    </td>
                </tr>
                <tr>
                	<td width="180" style="vertical-align: top;"><label>Favicon website hiện tại</label></td>
                    <td>
                        <?php  if($this->config->item('config_favicon') == '') { ?>
                            <img src="<?php echo base_url() ?>public/admin/images/no-image.png" alt="No-image" title="No-Image" />
                        <?php } else {?>
                            <img src="<?php echo $this->config->item('config_favicon') ?>"/>
                        <?php } ?>  
                    </td>                 
				</tr>
                <tr>
               	    <td width="180"><label>Thay đổi Favicon</label></td>
                    <td>
                        <input type="text" id="favicon"  name="favicon" value="<?php echo $this->config->item('config_favicon') ?>" size="40"  />
                        <a onclick="PopupCenter('<?php echo base_url() ?>ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=form&elementId=favicon', '', 800, 500)" >
                            <img src="<?php echo base_url() ?>public/admin/images/upload.gif" alt="Upload" title="Tải ảnh" style="cursor: pointer;" />
                        </a>
                         <?php echo form_error('favicon') ?> 
                    </td>
                </tr>
                
                <tr>
                	<td width="180" style="vertical-align: top;"><label>Logo website hiện tại</label></td>
                    <td>
                        <?php  if($this->config->item('config_logo') == '') { ?>
                            <img src="<?php echo base_url() ?>public/admin/images/no-image.png" alt="No-image" title="No-Image" />
                        <?php } else {?>
                            <img width="325" src="<?php echo $this->config->item('config_logo') ?>"/>
                        <?php } ?>  
                    </td>                 
				</tr>
                
                <tr>
               	    <td width="180"><label>Thay đổi Logo</label></td>
                    <td>
                        <input type="text" id="logo_website"  name="logo_website" value="<?php echo $this->config->item('config_logo') ?>" size="40"  />
                        <a onclick="PopupCenter('<?php echo base_url() ?>ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=form&elementId=logo_website', '', 800, 500)" >
                            <img  src="<?php echo base_url() ?>public/admin/images/upload.gif" alt="Upload" title="Tải ảnh" style="cursor: pointer;" />
                        </a>
                         <?php echo form_error('logo_website') ?> 
                    </td>
                </tr>
			</tbody>
		</table>
        <br />
        <h3>Hiển thị trang nội dung</h3>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="125"><label>Bảo trì website</label></td>
                    <td>
                        <input type="checkbox" id="maintain" value="1"  name="maintain" <?php if($this->config->item('config_maintain') == 1)  echo 'checked="checked"';?> />
                        (Đưa website của bạn về trạng thái nâng cấp và bảo trì)
                    </td>
				</tr>
                
                <tr>
                	<td width="125" style="vertical-align: top;"><label>Bài giới thiệu</label></td>
                    <td>
                        <?php 
                              $fck = new FCKeditor('contact');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value  = $this->config->item('config_contact');
                              $fck->Width  = '100%';
                              $fck->Height = 450;
                              $fck->Create();
                        ?>
                    </td>
				</tr>
                
				<tr>
                	<td width="125" style="vertical-align: top;"><label>Nội dung trang dịch vụ</label></td>
                    <td>
                        <?php 
                              $fck = new FCKeditor('footer');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value  = $this->config->item('config_footer');
                              $fck->Width  = '100%';
                              $fck->Height = 450;
                              $fck->Create();
                        ?>
                    </td>
				</tr>
                
				<tr>
                	<td width="125" style="vertical-align: top;"><label>Chương trình khuyến mại</label></td>
                    <td>
                        <?php 
                              $fck = new FCKeditor('notice');
                              $fck->BasePath = sBASEPATH;
                              $fck->Value  = $this->config->item('config_notice');
                              $fck->Width  = '100%';
                              $fck->Height = 400;
                              $fck->Create();
                        ?>
                    </td>
				</tr>
			</tbody>
		</table>
        <br />
        <h3>Thông tin website</h3>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="125"><label>Tên giao dịch website></label></td>
                    <td>
                        <input type="text" id="website_name"  name="website_name" value="<?php echo $this->config->item('config_website_name') ?>"  size="45" />
                        <?php echo form_error('website_name') ?>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Tiêu đề website</label></td>
                    <td>
                         <input type="text" id="website_subject"  name="website_subject" value="<?php echo $this->config->item('config_website_subject') ?>"  size="45" /><br/>
                        (Tiêu đề dùng để hiển thị trên thanh địa chỉ của trình duyệt khi người dùng truy cập vào website)
                        <?php echo form_error('website_subject') ?>    
                    </td>
				</tr>
                
                
			</tbody>
		</table>
        <br />
        <h3>Thiết lập thông tin SEO</h3>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="125" style="vertical-align: top;"><label>Mô tả (MetaDescription)</label></td>
                    <td>
                        <textarea name="desciption" id="desciption" style="width:900px; height:60px;"><?php echo $this->config->item('config_desciption') ?></textarea><br />
                        Dùng để mô tả nội dung của một trang web. Nội dung nên ngắn gọn và xúc tích khoảng từ 20 đến 25 từ hoặc ít hơn. Dùng cho các bộ máy tìm kiếm (Search Engine) sử dụng để hiển thị nội dung kết quả tìm kiếm.
                        <?php echo form_error('desciption') ?>
                    </td>
				</tr>
				<tr>
                	<td width="125" style="vertical-align: top;"><label>Bản quyền(MetaKeywords)</label></td>
                    <td>
                        <textarea name="keywords" id="keywords" style="width:900px; height:60px;" ><?php echo $this->config->item('config_keywords') ?></textarea><br />
                        (Mô tả từ khóa cho website của bạn)
                        <?php echo form_error('keywords') ?>
                    </td>
				</tr>
                <tr>
                    <td width="125" style="vertical-align: top;"><label>Title page</label></td>
                    <td>
                        <input name="title_page" id="title_page" style="width:900px; height:32px;" value="<?php echo $this->config->item('title_page') ?>" />
                        <?php echo form_error('title_page') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125" style="vertical-align: top;"><label>Meta Description</label></td>
                    <td>
                        <textarea name="meta_desc" id="meta_desc" style="width:900px; height:60px;" ><?php echo $this->config->item('meta_desc') ?></textarea><br />
                        <div id="length"></div>
                        <?php echo form_error('meta_desc') ?>
                    </td>
                </tr>
                <tr>
                    <td width="125" style="vertical-align: top;"><label>Meta Keyword</label></td>
                    <td>
                        <textarea name="meta_keyword" id="meta_keyword" style="width:900px; height:60px;" ><?php echo $this->config->item('meta_keyword') ?></textarea><br />
                        <div id="length"></div>
                        <?php echo form_error('meta_keyword') ?>
                    </td>
                </tr>
			</tbody>
		</table>
        <br />
        <h3>Thông tin liên hệ</h3>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="125"><label>Địa chỉ: (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="address"  name="address" value="<?php echo $this->config->item('config_address') ?>"  size="45" />
                        <?php echo form_error('address') ?>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Tỉnh thành</label></td>
                    <td>
                        <input type="text" id="province"  name="province" value="<?php echo $this->config->item('config_province') ?>"  size="10" />
                        Quận / Huyện 
                        <input type="text" id="district"  name="district" value="<?php echo $this->config->item('config_district') ?>"  size="10" />
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Website: (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="website"  name="website" value="<?php echo $this->config->item('config_website') ?>"  size="45" />
                        <?php echo form_error('website') ?>
                    </td>
				</tr>
                
			     <tr>
                	<td width="125"><label>Email liên hệ (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="email"  name="email" value="<?php echo $this->config->item('config_email') ?>"  size="45" />
                        <?php echo form_error('name') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Skype</label></td>
                    <td>
                        <input type="text" id="skype"  name="skype" value="<?php echo $this->config->item('config_skype') ?>"  size="45" />
                        <?php echo form_error('skype') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Yahoo (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="yahoo"  name="yahoo" value="<?php echo $this->config->item('config_yahoo') ?>"  size="45" />
                        <?php echo form_error('yahoo') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Facebook</label></td>
                    <td>
                        <input type="text" id="facebook"  name="facebook" value="<?php echo $this->config->item('config_facebook') ?>"  size="45" />
                        <?php echo form_error('facebook') ?>
                    </td>
				</tr>
                      
                <tr>
                	<td width="125"><label>Hotline (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="phone"  name="phone" value="<?php echo $this->config->item('config_phone') ?>"  size="45" />
                        <?php echo form_error('phone') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Tư vấn kỹ thuật (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="mobile"  name="mobile" value="<?php echo $this->config->item('config_mobile') ?>"  size="45" />
                        <?php echo form_error('mobile') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Bộ phận kinh doanh </label></td>
                    <td>
                        <input type="text" id="fax"  name="fax" value="<?php echo $this->config->item('config_fax') ?>"  size="45" />
                        <?php echo form_error('fax') ?>
                    </td>
				</tr>
                
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="hidden" name="isSubmit" value="1" />
                        <input type="submit" name="btnAdd" value="Lưu cấu hình" />
                        <input type="reset" name="btnReset" value="Nhập lại" />
                    </td>
                </tr>
			</tbody>
		</table>
	<!-- End bar chart table-->
	</form>
    <?php } ?>
  </div>
</div>
</div>