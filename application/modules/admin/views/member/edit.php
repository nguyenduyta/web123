<?php
    if(isset($info)){
        $other = json_decode($info['user_option'],true);
    }
?>
<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin/member') ?>" title="Quay lui">Back</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
    	<form id="form_data" action="<?php echo site_url("admin/member/edit/".$info['user_id']); ?>" name="form_data" method="post" enctype="multipart/form-data">
        <table class="data" width="100%" cellpadding="0" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
			    <tr>
                	<td width="125"><label>Tên truy cập (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="user_name"  name="user_name" value="<?php echo $info['user_name']; ?>"  size="45" />
                        <?php echo form_error('user_name') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Mật khẩu (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="password" id="password"  name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>"  size="45" />
                        <?php echo form_error('password') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Nhập lại mật khẩu(<span class="require">*</span>)</label></td>
                    <td>
                        <input type="password" id="repassword"  name="repassword" value="<?php if(isset($_POST['repassword'])) echo $_POST['repassword']; ?>"  size="45" />
                        <?php echo form_error('repassword') ?>
                    </td>
				</tr>
	
                <tr>
                	<td width="125"><label>Hình đại diện</label></td>
                    <td>
                        <input type="text" id="user_avatar"  name="user_avatar" value="" size="40"  />
                        <a onclick="PopupCenter('<?php echo base_url() ?>ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=form&elementId=user_avatar', '', 800, 500)" >
                            <img src="<?php echo base_url() ?>public/admin/images/upload.gif" alt="Upload" title="Tải ảnh" style="cursor: pointer;" />
                        </a>
                    </td>
				</tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><?php
                                if($info['avata'] == ""){
                            ?>
                                <img src="<?php echo base_url()?>uploads/avatar/no-avatar.jpg" />
                            <?php
                                }else{
                            ?>
                            <img src="<?php echo $info['avata'];  ?>" width='45' height='45' />
                            <?php } ?></td>
                </tr>
            	
                <tr>
                	<td width="125"><label>Email  (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="user_email"  name="user_email" value="<?php echo $info['user_email']; ?>"  size="45" />
                        <?php echo form_error('user_email') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Tên đầy đủ  (<span class="require">*</span>)</label></td>
                    <td>
                        <input type="text" id="fullname"  name="fullname" value="<?php echo $info['fullname']; ?>"  size="45" />
                        <?php echo form_error('fullname') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Ngày sinh</label></td>
                    <td>
                   	    <div class="select">
                        	<select name="user_day">
            					<option value="">- Chọn -</option>
            					<?php for ($i = 1; $i<= 31; $i++) { ?>
                                <?php if(isset($_POST['user_day']) && $_POST['user_day'] == $i) { ?>
            					<option value="<?php echo $i?>" selected="selected"><?php echo $i?></option>
                                <?php } else { ?>
                                <option value="<?php echo $i?>" <?php if($other['ngaysinh'] == $i ){ ?> selected="selected"><?php }?><?php echo $i?></option>
            					<?php } ?>
                                <?php } ?>
                        	</select> --
                        	<select name="user_month">
            					<option value="">- Chọn -</option>
            					<?php for ($j = 1; $j<= 12; $j++) { ?>
                                <?php if(isset($_POST['user_month']) &&  $_POST['user_month'] == $j) { ?>
            					<option value="<?php echo $j?>" selected="selected"><?php echo $j?></option>
                                <?php } else { ?>
                                <option value="<?php echo $j?>" <?php if($other['thangsinh'] == $j ){ ?> selected="selected"><?php }?><?php echo $j?></option>
                                <?php } ?>
            					<?php }?>
                        	</select> --     
                        	<select name="user_year">
            					<option value="">- Chọn -</option>
            					<?php for ($k = 1945 ; $k<= date('Y') - 10; $k++) { ?>
                                <?php if(isset($_POST['user_year']) && $_POST['user_year'] == $k) { ?>
            					<option value="<?php echo $k?>" selected="selected"><?php echo $k?></option>
                                <?php } else { ?>
                                <option value="<?php echo $k?>" <?php if($other['namsinh'] == $k ){ ?> selected="selected"><?php }?><?php echo $k?></option>
                                <?php } ?>
            					<?php }?>
                        	</select>
        				</div>
                    </td>
				</tr>
                         
                <tr>
                	<td width="125"><label>Giới tính </label></td>
                    <td>
                   	    <select name="user_sex">
        					<option value="1" <?php if($other['sex'] == 1) echo 'selected="selected"' ?>>Nam</option>
        					<option value="0" <?php if($other['sex'] == 0) echo 'selected="selected"' ?>>Nữ</option>
            	       </select>
                    </td>
				</tr> 
				
                
                <tr>
                	<td width="125"><label>Địa chỉ</label></td>
                    <td>
                   	    <input type="text" name="user_address" size="45" class="input" value="<?php echo $other['address']; ?>"/>
            	        <?php echo form_error('user_address')?> 
                    </td>
				</tr> 
   				
                <tr>
                	<td width="125"><label>Điện thoại</label></td>
                    <td>
                   	    <input type="text" name="user_phone" size="45" class="input" value="<?php echo $other['phone']; ?>"/>
            	        <?php echo form_error('user_phone')?> (Chỉ nhập số: 0-9)
                    </td>
				</tr>         
            	
                
                <tr>
                	<td width="125"><label>Di động</label></td>
                    <td>
                   	    <input type="text" name="user_mobile" size="45" class="input" value="<?php echo $other['mobile']; ?>"/>
            	        <?php echo form_error('user_mobile')?> (Chỉ nhập số: 0-9)
                    </td>
				</tr>     
    	
                <tr>
                	<td width="125"><label>Yahoo</label></td>
                    <td>
                   	    <input type="text" name="user_yahoo" size="45" class="input" value="<?php echo $other['yahoo']; ?>"/>
            	        <?php echo form_error('user_yahoo')?> (Nhập Tài khoản Yahoo: Ex: sieuthiannam)
                    </td>
				</tr>   
                
                <tr>
                	<td width="125"><label>Skype</label></td>
                    <td>
                   	    <input type="text" name="user_skype" size="45" class="input" value="<?php if(isset($other['skype']) )echo $other['skype']; ?>"/>
            	        <?php echo form_error('user_skype')?> (Nhập Tài khoản Skype: Ex: sieuthiannam)
                    </td>
				</tr> 
        
                <tr>
                	<td width="125"><label>Facebook</label></td>
                    <td>
                   	    <input type="text" name="user_facebook" size="45" class="input" value="<?php echo $other['facebook']; ?>"/>
            	        <?php echo form_error('user_facebook')?> (Nhập Tài khoản Facebook: Ex: sieuthiannam)
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Nhóm thành viên (<span class="require">*</span>)</label></td>
                    <td>
               	        <select name="user_level" id="user_level">
                            <?php if(count($group) > 0) { ?>
                            <?php foreach($group as $key1=>$val1) { ?>
                            <?php if(isset($_POST['user_level']) && $_POST['user_level'] == $val1['id']) { ?>
                            
                                <option value="<?php echo $val1['id'] ?>"><?php echo $val1['name']; ?></option>
                                
                                <?php } else { ?>
                                <option value="<?php echo $val1['id'] ?>" <?php if($info['user_level'] == $val1['id']){ ?> selected="selected"<?php } ?>><?php echo $val1['name'] ?></option>
                                <?php } ?>
                            <?php } ?>
                            <?php } ?>
            	       </select>
                       <?php echo form_error('user_level') ?>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Thứ tự xắp xếp</label></td>
                    <td>
                        <input type="text" id="user_order"  name="user_order" value="<?php echo $info['order']; ?>" size="3"  />
                        <?php echo form_error('user_order') ?>    
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Trạng thái</label></td>
                    <td>
                        <select name="user_active" id="user_active">
                            <option value="1" <?php if($info['active'] == 1) echo 'selected="selected"'; ?>>Hiển thị</option>
                            <option value="0" <?php if($info['active'] == 0) echo 'selected="selected"'; ?>>Không hiển thị</option>
                        </select>
                    </td>
				</tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="hidden" name="isSubmit" value="1" />
                        <input type="submit" name="btnAdd" value="Sửa" />
                        <input type="reset" name="btnReset" value="Nhập lại" />
                    </td>
                </tr>
			</tbody>
		</table>
	</form>
  </div>
</div>
</div>