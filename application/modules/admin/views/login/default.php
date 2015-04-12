<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/admin/login/css/style.css">
<!-- JS -->
<title>Administrator</title>
</head>
<body>
	<div id="content">
		<div >&nbsp;</div>
		<div id="login">
			<div id="top">
			</div>
			<div id="middle">
				<span id="lock"></span>
				<div id="login">
				<form action="<?php echo base_url(); ?>admin/login" name="frmlogin" id="frmlogin" method="post" >
					<p class="title">Đăng nhập hệ thống<span class="icolog"></span></p>
					<label for="username">Tài khoản</label> 
					<div class="default">
						<input id="username" name="username" value="<?php if(isset($_SESSION['re_name'])){ echo $_SESSION['re_name']; } ?>" type="text">
					</div>
					<label for="password">Mật khẩu</label> 
					<div class="default">
						<input id="password" type="password"  name="password" value="<?php if(isset($_SESSION['re_pass'])){echo $_SESSION['re_pass'];}?>" />
					</div>
					<label for="password">&nbsp;</label> 
					<div>
						<input id="remember" name="remember" type="checkbox" <?php if(isset($_SESSION['re_name']) && isset($_SESSION['re_pass'])){ echo "checked='checked'" ;} ?>>
						<span>Nhớ mật khẩu</span>
					</div>
					<div class="btnlogin">
						<button type="submit" id="btnlogin" name="btnlogin" value="">Đăng nhập</button>
					</div>
				</form>
				</div>
			</div>
			<div id="bottom">
                <p style=" font-weight: bold;"><?php if(isset($errors) && $errors != ""){ echo $errors; } ?></p>
			</div>
		</div>
	</div>
</body>
</html>