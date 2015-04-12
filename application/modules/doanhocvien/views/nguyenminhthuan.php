<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Tổng hợp bài tập cuối khóa của học viên tại SUNTECH. Đây là những sản phẩm có mà các học viên đã xây dựng và áp dụng vào thực tế cho các doanh nghiệp sau khóa học. Đây là những bằng chứng khẳng định chất lượng đào tạo tại SUNTECH" />
    
	<title>Đồ án học viên suntech</title>
        <link rel="stylesheet" style="text/css" href="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/styles/style.css"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
	var $galitem = $('.neoslideshow2').children();
	var $galsize = $('.neoslideshow2 img').size();
	$('.neoslideshow2').append('<div id="galprev"></div><div id="galnext"></div>');
	$('.neoslideshow2 img:gt(0)').hide();
	$galitem.attr("id", function (arr) {
		return "galleryitem" + arr;
	});
	$currentimg = 0;
	$('#galprev').click(function () { 
		if ($currentimg > 0) {
			previmg($currentimg);
			$currentimg = $currentimg - 1;
		}
	});
	$('#galnext').click(function () { 
		if ($currentimg < $galsize - 1) {
			nextimg($currentimg, $galsize);
			$currentimg = $currentimg + 1;
		}
	});
	})
function nextimg($img, $size) {
	$n_img = $img + 1;
	if ($n_img < $size) {
		$('#galleryitem' + $img).fadeOut();
		$('#galleryitem' + $n_img).fadeIn();
	}
}
function previmg($img) {
	$p_img = $img - 1;
	if ($p_img >= 0) {
		$('#galleryitem' + $img).fadeOut();
		$('#galleryitem' + $p_img).fadeIn();
	}
}
</script>
</head>
<body>

<div id="support">
    <a href="#"></a>
</div>
<!----HEADER--->
<div id="header">
   <div id="inner_header">
       <div id="company">
            <h2>CÔNG TY TNHH THƯƠNG MẠI VÀ CÔNG NGHỆ NGUYÊN KIM</h2>
                <h3>CUNG CẤP THIẾT BỊ CƠ KHÍ - THIẾT BỊ ĐIỆN - TIN HỌC VĂN PHÒNG PHẨM </h3>
        </div>
       <div class="clear"></div>
    </div> 
</div>
<!----END HEADER--->
<div class="clear"></div>
<!-------NAVIGATION-------->
<div id="navigation">
    <div class="nav_content">
          <ul id="nav">
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Giới thiệu</a></li>
            <li><a href="#">Máy nông nghiệp</a>
                <ul>
                    <li><a href="#">Máy Thu Hoạch</a></li>
                    <li><a href="#">Máy Chế Biến Nông Sản</a></li>
                    <li><a href="#">Máy Nuôi Chồng Nấm</a></li>
                    <li><a href="#">Máy Cày Cấy</a></li>
                </ul>
            </li>
            <li><a href="#">Máy chế biến lâm sản</a>
                <ul>
                    <li><a href="#">Máy chế biến nhập khẩu</a></li>
                    <li><a href="#">Máy chế biến trong nước</a></li>
                    <li><a href="#">Máy chế biến cao cấp</a></li>
                    <li><a href="#">Máy Cày Cấy</a></li>
                </ul>    
            </li>
            <li><a href="#">Tin tức</a></li>
            <li><a href="#">Tuyển dụng</a></li>
            <li><a href="#">Liên hệ</a></li>
          </ul>  
    </div>
</div>
<!----------END NAVIGATION-------->
<!-----CONTAINER------>
<div id="container">
    <div id="top_container">
        <div class="home"><a href="#">Home</a></div>
        <div id="social">        
            <div class="icon">
                <a href="#"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/twitter.gif" alt="icon twitter"/></a>
                <a href="#"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/face.gif" alt="icon face"/></a>
                <a href="#"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/google.gif" alt="icon google"/></a>
            </div>
            <div class="search">
                 <form action="#" method="post" class="timkiem">
                    <input type="text" name="keywords" id="keywords"  value="Từ khóa" class="input_search"/>
                </form>
             <div class="button_search"><a href="">Tìm kiếm</a></div>
            </div>
        </div>
    </div>
    
    <div id="slideshow2">
        <div class="neoslideshow2">
          <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/slideshow.jpg" width="978" height="330" />
          <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/slideshow2.jpg" width="978" height="330" />
          <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/slideshow3.jpg" width="978" height="330" />
        </div>
    </div>
    <div id="bottom_container">
        <div id="left">
            <div id="tittle_content">
                    <h3>Sản phẩm mới nhất</h3>
                    <a href="#" class="more">Xem thêm<span class="bullet"></span></a>
            </div>
            <div class="clear"></div>
            <div class="in_content">
                    <ul>
                         <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy Gặt Đập Liên Hợp Mini</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">10 000 000 </a></span> vnđ</p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0)">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0">Đặt hàng</a></div>
                            <div class="newimg"></div>
                        </li> 
                        
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy đập lúa liên hoàn</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">Vui lòng gọi...</a></span></p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0">Đặt hàng</a></div>
                            <div class="newimg"></div>
                        </li> 
                        
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy nghiền nông sản</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">10 000 000 </a></span> vnđ</p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0">Đặt hàng</a></div>
                            <div class="newimg"></div>
                        </li>
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy Gặt Đập Liên Hợp Mini</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">10 000 000 </a></span> vnđ</p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0)">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0">Đặt hàng</a></div>
                            <div class="newimg"></div>
                        </li> 
                        
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy đập lúa liên hoàn</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">Vui lòng gọi...</a></span></p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0">Đặt hàng</a></div>
                            <div class="newimg"></div>
                        </li> 
                        
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy nghiền nông sản</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">10 000 000 </a></span> vnđ</p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0">Đặt hàng</a></div>
                            <div class="newimg"></div>
                        </li>  
                        
                    </ul>
            </div>
            <div class="clear"></div>
                        
            <div id="tittle_content">
                    <h3>Sản phẩm bán chạy</h3>
                    <a href="#" class="more">Xem thêm<span class="bullet"></span></a>
            </div>
            
            <div class="clear"></div>
            
            <div class="in_content">
                    <ul>
                         <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy Gặt Đập Liên Hợp Mini</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">10 000 000 </a></span> vnđ</p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0)">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0)">Đặt hàng</a></div>
                        </li> 
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy đập lúa liên hoàn</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">Vui lòng gọi...</a></span></p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0)">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0)">Đặt hàng</a></div>
                        </li> 
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy nghiền nông sản</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">10 000 000 </a></span> vnđ</p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0)">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0)">Đặt hàng</a></div>
                        </li>
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy Gặt Đập Liên Hợp Mini</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">10 000 000 </a></span> vnđ</p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0)">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0)">Đặt hàng</a></div>
                        </li> 
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy đập lúa liên hoàn</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">Vui lòng gọi...</a></span></p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0)">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0)">Đặt hàng</a></div>
                        </li> 
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy nghiền nông sản</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">10 000 000 </a></span> vnđ</p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0)">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0)">Đặt hàng</a></div>
                        </li>  
                        
                    </ul>
            </div>
            
            <div class="clear"></div>
            
            <div id="tittle_content">
                    <h3>Sản phẩm tiêu biểu</h3>
                    <a href="#" class="more">Xem thêm<span class="bullet"></span></a>
            </div>
            
            <div class="clear"></div>
            
            <div class="in_content">
                    <ul>
                         <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy Gặt Đập Liên Hợp Mini</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">10 000 000 </a></span> vnđ</p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0)">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0)#">Đặt hàng</a></div>
                        </li> 
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy đập lúa liên hoàn</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">Vui lòng gọi...</a></span></p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0)">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0)">Đặt hàng</a></div>
                        </li> 
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy nghiền nông sản</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">10 000 000 </a></span> vnđ</p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0)">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0)">Đặt hàng</a></div>
                        </li>
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy Gặt Đập Liên Hợp Mini</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">10 000 000 </a></span> vnđ</p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0)">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0)#">Đặt hàng</a></div>
                        </li> 
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy đập lúa liên hoàn</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">Vui lòng gọi...</a></span></p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0)">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0)">Đặt hàng</a></div>
                        </li> 
                        <li>
                            <div class="image1"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh-co-khi.jpg" alt="hinh 1" /></div>
                            <div class="name">
                                <h3><a href="#">Máy nghiền nông sản</a></h3>
                            </div>
                            <div class="price">
                                <p>Giá:<span class="color"><a href="#">10 000 000 </a></span> vnđ</p>
                            </div>
                            <div class="news_more"><a href="javascript:void(0)">Chi tiết</a></div>
                            <div class="order"><a href="javascript:void(0)">Đặt hàng</a></div>
                        </li>  
                    </ul>
            </div>
            
            
            </div>
            
            <div id="right">
                <div id="news">
                    <div class="title">
                        <h3>Tin tức nổi bật</h3>
                    </div>
                    
                    <div class="nav_news">
                        <ul>
                            <li><a href="#">Khuyến mại</a></li>
                            <li><a href="#">Sự kiện</a></li>
                            <li><a href="#">Dịch vụ</a>
                        </ul>
                    </div>
                                  
                    <div id="imfornew">
                        <ul >
                            <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                            
                             <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                            
                             <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                            
                             <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                             <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                            
                             <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                             <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                             <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                             <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                             <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                             <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                             <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                             <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                             <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                            <li>
                                <div class="image2">
                                    <img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/anh1.jpg"/>
                                </div>
                                <div class="text">
                                    <p>Chương trình khuyến mãi lơn khi mua sản phẩn dịp noel</p>
                                </div>
                            </li>
                        </ul>
                        <span class="more2">Xem thêm </span>
                    </div>
        </div>
        
        <div class="clear"></div>
        
        <div id="youtobe">
            <div class="tittle_youtobe">
                <h3>Nguyên Kim trên youtobe</h3>
            </div>
            
            <a href="#"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/video.jpg"/></a>
            
        </div>
        <div id="facebook">
            <div class="tittle_facebook">
                <h3>Kết nối với Nguyên Kim</h3>
            </div>
            <a href="#"><img src="<?php echo base_url(); ?>public/doanhocvien/nguyenminhthuan/images/friend.jpg"  style="width: 266px; height: 295px;"></a>
        </div>
        
        </div>
    </div>
    
  
</div>
<!-----END CONTAINER------>

<!------FOOTER------------>
<div id="footer">
    <div id="inner_footer">
                <ul>
            <li style="width: 195px;">
                <h3>Thông tin Nguyên Kim</h3>
                <div class="nd">
                    <p>Ngành nghề kinh doanh</p>
                </div>
                <div class="nd">
                    <p>Tầm nhìn sứ mệnh</p>
                </div>
            </li>
            <li style="width: 200px;">
                <h3>Trợ giúp mua hàng</h3>
                <div class="nd">
                    <p>Thanh toán trực tuyến</p>
                </div>
                <div class="nd">
                    <p>Hướng dẫn mua hàng</p>
                </div>
                <div class="nd">
                    <p>Phương thức thanh toán</p>
                </div>
            </li>
            <li style="width: 200px;">
                <h3>Chính sách chung</h3>
                <div class="nd">
                    <p>Chính sách bảo hành</p>
                </div>
                <div class="nd">
                    <p>Chính sách vận chuyển</p>
                </div>
                <div class="nd">
                    <p>Chính sách hoàn trả</p>
                </div>
            </li>
            <li style="width: 405px;">
                <h3 style="font-size: 13px;">CÔNG TY TNHH THƯƠNG MẠI VÀ CÔNG NGHỆ NGUYÊN KIM</h3>
                <div class="nd" >
                    <p>ĐC: Ngõ 120, Đường Trường Trinh - Hà Nội</p>
                    
                <div class="nd" >
                    <p>VPGD: VT49 - LK12 - KĐT Xa La - Phúc La - Hà Đông - HN</p> 
                </div>   
                 
                <div class="nd" >    
                    <p>ĐT: 0474 435 326 - 0973 080 456 * Email: nguyenkim@gmail.com</p>
                </div>
            </li>
        </ul>
    </div>
</div>
<!------END FOOTER------>
</body>
</html>