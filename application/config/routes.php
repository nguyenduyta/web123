<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "admin/index";

$route['404_override'] = 'home/notfound/index';

$route['khoilopci'] = "admin/index";
$route['thay-doi-mat-khau']	= 'admin/acount/index';
$route['thong-tin-ca-nhan']	= 'admin/acount/acount_info';
$route['admin/groupmenuproduct/(status).*']= 'admin/groupmenuproduct/active';
$route['admin/menuproduct/(status).*']= 'admin/menuproduct/active';
$route['admin/product/(status).*'] = 'admin/product/active';
$route['admin/menunews/(status).*']= 'admin/menunews/active';
$route['admin/adsposition/(status).*']= 'admin/adsposition/active';
$route['admin/link/(status).*']= 'admin/link/active';
$route['admin/support/(status).*']= 'admin/support/active';
$route['admin/post/(status).*']= 'admin/post/active';
$route['admin/groupmenunews/(status).*']= 'admin/groupmenunews/active';
$route['admin/slideshow/(status).*']= 'admin/slideshow/active';
$route['admin/brand/(status).*']= 'admin/brand/active';
$route['admin/youtube/(status).*']= 'admin/youtube/active';
$route['admin/recuitment/(status).*']= 'admin/recuitment/active';
$route['admin/tagproduct/(status).*']= 'admin/tagproduct/active';

//Comment
$route['admin/comment']				 = 'admin/comment';
$route['admin/comment/create']		 = 'admin/comment/create';
$route['admin/comment/update']		 = 'admin/comment/update';
//Course
$route['admin/course']				 = 'admin/course';
//Toppic
$route['admin/toppic']				= 'admin/toppic';
//Video
$route['admin/video']				= 'admin/video';
//Admin Login
$route['admin/index']				= 'admin/index';
//Admin Project
$route['admin/project']				= 'admin/project';
//Config Admin
$route['admin/config']				= 'admin/config';
/*Route Home*/
$route['index'] 						  = "home/index";
$route['hoc-php'] 						  = "home/index";
$route['hoc-php-o-ha-noi'] 				  = "home/index";
$route['hoc-thiet-ke-web'] 				  = "home/index";
$route['gioi-thieu'] 					  = "home/intro";
$route['hoc-php-o-ha-noi/(:num)-(:any)']    = "home/suntech/index/$1";
$route['chuyen-muc'] 					  	= "home/categories";
$route['chuyen-muc/(:num)-(:any)'] 		  	= "home/categories/index/$1";
$route['chi-tiet/(:num)-(:any)'] 		  	= "home/categories/detail/$1";
$route['bai-viet/(:num)-(:any)'] 		  	= "home/post";
$route['(:num)-(:any)'] 				  	= "home/post/detail/$1";
$route['lich-khai-giang'] 				  	= "home/lichkhaigiang";
$route['khach-hang'] 					  	= "home/customer";
$route['khoa-hoc'] 						  	= "home/khoahoc";
$route['do an-hoc-vien'] 				  	= "home/doanhocvien";
$route['lien-he'] 						  	= "home/contact";
$route['dang-ky-thanh-cong'] 			  	= "home/contact/success";
$route['chi-tiet-khoa-hoc/(:num)-(:any)'] 	= "home/khoahoc/detail/$1";
$route['lap-trinh-web/(:num)-(:any)'] 	  	= "home/service/index/$1";
$route['hoc-php-o-ha-noi/(:any)/phpmysql1'] = "home/suntech/suntechhanoigood/$1";

//Course
$route['loi-gioi-thieu']		  			= "home/pageintro";
$route['gioi-thieu-([a-z0-9-]+)']		  	= "home/course/intro";
$route['y-kien-hoc-vien']					= "home/comment/index";
$route['video-([a-z0-9-]+)'] 			  	= "home/course/video";
$route['([a-z0-9-!]+[^/][^admin])'] 		= "home/course/index";
$route['project-php/([a-z0-9-]+)'] 			= "home/project/index";
$route['chuyen-de/([a-z0-9-!]+[^/])'] 		= "home/toppic/index";
$route['bai-huong-dan/([a-z0-9-!]+[^/])']   = "home/tuts/tutsCourse";
$route['video-hoc-php/([a-z0-9-!]+[^/])']   = "home/video/detail";
$route['tim-kiem']				    		= "home/search";
$route['dang-ky']				    		= "home/userfrontend";
$route['logout']				    		= "home/userfrontend/logout";
$route['dang-nhap']				    		= "home/userfrontend/login";
$route['trang-ca-nhan']				    	= "home/userfrontend/infoUser";
$route['tim-kiem/(:any)']				    = "home/search";
$route['([a-z-!]+[^/][^adm/tuts])/([a-z0-9-!]+[^admin/tuts])'] 		= "home/tuts/detail";
$route['menu-da-cap-bang-css/test'] = 'demo/democss/menucapcap';