<style>
    td{ line-height: 36px; border: none ;}
</style>
<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
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
                <?php 
                    if(isset($info)){
                ?>
				<tr>
                	<td width="125"><label>Tên đăng nhập</label></td>
                    <td>
                        <input type="text" id="email" name="namelogin" onfocus="alert('Tên không được thay đổi')" size="35" value="<?php echo $_SESSION['admin']; ?>"  />
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Họ tên đầy đủ</label></td>
                    <td>
                        <input type="text" id="email" name="fullname" size="35"  value="<?php echo $info['fullname']; ?>"/>
                        <?php echo form_error('fullname') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Địa chỉ email</label></td>
                    <td>
                        <input type="text" id="email" name="email" size="35" value="<?php echo $info['user_email']; ?>" />
                        <?php echo form_error('email') ?> 
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Cấp quản trị</label></td>
                    <td>
                        <font color='red'><?php if($_SESSION['level'] == 2){ echo "Adminstrator"; }else{ echo "SupperAdministrator"; } ?></font>
                    </td>
				</tr>
                
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="hidden" name="oldpass" value="<?php  echo $info['password']; ?>" />
                        <input type="hidden" name="isSubmit" value="1" />
                        <input type="submit" name="btnAdd" value="Cập nhật lại thông tin" />&nbsp;
                    </td>
                </tr>
                <tr>
                	<td colspan="2" style="color: blue; padding-left: 150px;"><?php if(isset($alert)){ echo $alert; } ?></td>
				</tr>
                <?php
                    } 
                ?>
			</tbody>
		</table>
	<!-- End bar chart table-->
	</form>
  </div>
</div>
</div>