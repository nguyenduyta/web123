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
				<tr>
                	<td width="125"><label>Tên đăng nhập hiện tại</label></td>
                    <td>
                        <input type="text" id="name" name="name" onfocus="alert('Tên không được thay đổi')" size="35" value="<?php echo $_SESSION['admin']; ?>"  />
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Mật khẩu hiện tại</label> (<span class="require">*</span>)</td>
                    <td>
                        <input type="password" id="oldpass"  name="oldpass" value="" size="35" style="float:left;"  />  
                        <?php echo form_error('oldpass') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Nhập lại mật khẩu</label> (<span class="require">*</span>)</td>
                    <td>
                        <input type="password" id="reoldpass"  name="reoldpass" value="" size="35" style="float:left;"   />  
                        <?php echo form_error('reoldpass') ?>  
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Mật khẩu mới</label> (<span class="require">*</span>)</td>
                    <td>
                        <input type="password" id="newpass"  name="newpass" value="" size="35"  style="float:left;"   />    
                        <?php echo form_error('newpass') ?>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Nhập lại mật khẩu</label> (<span class="require">*</span>)</td>
                    <td>
                        <input type="password" id="newpass"  name="renewpass" value="" size="35" style="float:left;"   />  
                        <?php echo form_error('renewpass') ?>  
                    </td>
				</tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="hidden" name="isSubmit" value="1" />
                        <input type="submit" name="btnAdd" value="Thay đổi" />&nbsp;
                        <input type="reset" name="btnReset" value="Nhập lại" />
                    </td>
                </tr>
                <tr>
                	<td colspan="2" style="color: blue; padding-left: 150px;"><?php if(isset($alert)){ echo $alert; } ?></td>
				</tr>
			</tbody>
		</table>
	<!-- End bar chart table-->
	</form>
  </div>
</div>
</div>