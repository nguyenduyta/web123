	<a href="javascript:;" id="show_menu">&raquo;</a>
	<div id="left_menu">
	<a href="javascript:;" id="hide_menu">&laquo;</a>
	<ul id="main_menu">
		<li><a href="<?php echo base_url('/admin/index') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_home.png" alt="Home"/>Trang chủ</a></li>
		<li><a id="menu_pages" href="/admin/students">
			<img src="<?php echo base_url() ?>public/admin/images/icon_pages.png" alt="Pages"/>
			Quản lý sinh viên</a>
		</li>
		<li><a id="menu_pages" href="/admin/exam">
			<img src="<?php echo base_url() ?>public/admin/images/icon_pages.png" alt="Pages"/>
			Ngân hàng đề thi</a>
		</li>
		<li><a id="menu_pages" href="/admin/question">
			<img src="<?php echo base_url() ?>public/admin/images/icon_pages.png" alt="Pages"/>
			Quản lý câu hỏi</a>
		</li>
		<li><a id="menu_pages" href="/admin/question">
			<img src="<?php echo base_url() ?>public/admin/images/icon_pages.png" alt="Pages"/>
			Quản lý khóa học</a>
		</li>
		<li><a id="menu_pages" href="/admin/question">
			<img src="<?php echo base_url() ?>public/admin/images/icon_pages.png" alt="Pages"/>
			Quản lý bài giảng</a>
		</li>
		<li><a id="menu_pages" href="javascript:void(0)">
			<img src="<?php echo base_url() ?>public/admin/images/icon_pages.png" alt="Pages"/>Quản lý tài khoản</a>
			<ul>
				<li><a href="/thong-tin-ca-nhan">Thông tin cá nhân</a></li>
				<li><a href="/thay-doi-mat-khau">Thay đổi mật khẩu</a></li>
			</ul>
		</li>
	</ul>
	<br class="clear"/>
	<!-- Begin left panel calendar -->
	<div id="calendar"></div>