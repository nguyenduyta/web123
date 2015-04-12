-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2015 at 03:57 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `training_smart`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam_question`
--

CREATE TABLE IF NOT EXISTS `exam_question` (
`id` int(10) unsigned NOT NULL,
  `ques_id` int(10) NOT NULL,
  `exam_id` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `exam_question`
--

INSERT INTO `exam_question` (`id`, `ques_id`, `exam_id`) VALUES
(16, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_answer`
--

CREATE TABLE IF NOT EXISTS `tbl_answer` (
`id` int(10) unsigned NOT NULL,
  `ans_content` text CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `ques_id` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tbl_answer`
--

INSERT INTO `tbl_answer` (`id`, `ans_content`, `status`, `ques_id`) VALUES
(1, '555555555555555', 0, 6),
(2, 'Ddaps aaadasdsadasd', 0, 6),
(3, '11111111111111', 0, 6),
(4, '111111111111111111', 0, 6),
(5, '&#160;', 0, 7),
(6, '&#160;', 0, 7),
(7, '&#160;', 0, 7),
(8, '&#160;', 0, 7),
(9, '&#160;', 0, 8),
(10, '&#160;', 0, 8),
(11, '&#160;', 0, 8),
(12, '&#160;', 0, 8),
(13, '&#160;', 0, 9),
(14, '&#160;', 0, 9),
(15, '&#160;', 0, 9),
(16, '&#160;', 0, 9),
(17, '&#160;', 0, 10),
(18, '&#160;', 0, 10),
(19, '&#160;', 0, 10),
(20, '&#160;', 0, 10),
(21, '&#160;', 0, 11),
(22, '&#160;', 0, 11),
(23, '&#160;', 0, 11),
(24, '&#160;', 0, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam`
--

CREATE TABLE IF NOT EXISTS `tbl_exam` (
`id` int(11) unsigned NOT NULL,
  `name` text CHARACTER SET utf8 NOT NULL,
  `info_desc` text CHARACTER SET utf8 NOT NULL,
  `user` int(10) NOT NULL,
  `enable_date` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_exam`
--

INSERT INTO `tbl_exam` (`id`, `name`, `info_desc`, `user`, `enable_date`) VALUES
(1, 'Bài test đầu vào dành cho tuyển dụng Fresher ssss', 'Bài test dành cho tất cả đối tượng muốn trở thành Fresher của SmartOSC', 1, '2015-03-23'),
(2, 'Bài test PHP đầu vào', 'Bài test dành cho những bạn đã trở thành Fresher và chuẩn bị bước vào học PHP. Mục đích của bài test là để phân loại học viên, xem và tìm ra những bạn có khả năng học Magento ngay.', 1, '0000-00-00'),
(3, 'Bài test PHP Day1', 'Nội dung test là kiến thức day1 của chương trình Fresher', 1, '0000-00-00'),
(4, 'Test dsadasd', '&#160;', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

CREATE TABLE IF NOT EXISTS `tbl_group` (
`id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `permission` text NOT NULL,
  `order` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_group`
--

INSERT INTO `tbl_group` (`id`, `name`, `permission`, `order`, `active`, `created_by`, `modified_by`, `date`) VALUES
(2, 'Administrator', 'all', 1, 1, 1, 1, 1358261267),
(3, 'Moderator', 'post_add', 1, 1, 1, 1, 1358261267),
(1, 'BÃ¬nh thÆ°á»ng', 'none', 1, 1, 1, 1, 1358261267),
(9, 'Quáº£n trá»‹ cáº¥p II', 'config_view,groupmenunews_view,post_view,post_add,menunews_view,news_view,news_add,brand_view,brand_add,brand_edit,groupmenuproduct_view,menuproduct_view,menuproduct_add,menuproduct_edit,product_view,product_add,product_edit,tagproduct_view,tagproduct_add,tagproduct_edit,tagproduct_delete,slideshow_view,video_view,video_add,video_edit,advertise_view,file_view,file_add,file_edit,support_view,support_add,support_edit,group_view,member_view,member_add,customer_view,recuitment_view,recuitment_add,recuitment_edit,recuitment_delete,application_view,link_view', 1, 1, 12, 12, 1359790005),
(14, 'Quáº£n trá»‹ sáº£n pháº©m', 'config_view,groupmenunews_view,post_view,menunews_view,news_view,brand_view,brand_add,brand_edit,brand_delete,groupmenuproduct_view,groupmenuproduct_add,groupmenuproduct_edit,groupmenuproduct_delete,menuproduct_view,menuproduct_add,menuproduct_edit,menuproduct_delete,product_view,tagproduct_view,slideshow_view,video_view,advertise_view,file_view,support_view,group_view,member_view,customer_view,recuitment_view,application_view,link_view', 1, 1, 12, 12, 1359968632),
(13, 'Quáº£n trá»‹ tin tá»©c', 'config_view,groupmenunews_view,post_view,post_add,post_edit,post_delete,menunews_view,news_view,news_add,news_edit,news_delete,brand_view,groupmenuproduct_view,menuproduct_view,product_view,tagproduct_view,tagproduct_add,tagproduct_edit,tagproduct_delete,slideshow_view,video_view,advertise_view,file_view,file_add,file_edit,file_delete,support_view,group_view,member_view,customer_view,recuitment_view,recuitment_add,recuitment_edit,recuitment_delete,application_view,link_view', 1, 1, 12, 12, 1359968591);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE IF NOT EXISTS `tbl_question` (
`id` int(10) unsigned NOT NULL,
  `ques_content` text CHARACTER SET utf8 NOT NULL,
  `ques_status` char(1) CHARACTER SET utf8 NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`id`, `ques_content`, `ques_status`) VALUES
(6, 'HTML có phải là ngôn ngữ lập trình hay không', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
`user_id` int(10) unsigned NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `password` char(50) NOT NULL,
  `user_avatar` varchar(255) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_address` varchar(200) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1',
  `school` varchar(200) NOT NULL,
  `user_option` text,
  `user_level` int(5) DEFAULT NULL,
  `user_active` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `order` int(3) NOT NULL,
  `date` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `avata` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `fullname`, `password`, `user_avatar`, `user_email`, `user_address`, `user_phone`, `gender`, `school`, `user_option`, `user_level`, `user_active`, `created_by`, `modified_by`, `order`, `date`, `active`, `avata`) VALUES
(1, 'htkhoi', 'Phạm Kỳ Khôi', 'e10adc3949ba59abbe56e057f20f883e', '', 'phamkykhoi.info@gmail.com', '', '', 1, '', '{"ngaysinh":"","thangsinh":"","namsinh":"","sex":"0","address":"V\\u0129nh Ph\\u00fac","phone":"","mobile":"","yahoo":"","facebook":"","skype":""}', 2, 1, 1, 1, 1, 1358933059, 1, ''),
(30, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', 'Bình Xuyên - Vĩnh Phúc', '09728776123', 1, 'Cao đẳng FPT', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png'),
(31, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', '196 cau giay hanoi', '01648545829', 1, 'uet', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png'),
(32, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', 'cầu giấy', '01663757740', 1, 'công nghệ', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png'),
(33, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', 'Hanoi', '0983397580', 1, 'no where', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png'),
(34, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', 'ha n oi', '0984687726', 1, 'fpt', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png'),
(35, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', 'thanh pho tra vinh', '0907891036', 1, 'tra vinh', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png'),
(36, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', 'Ha Noi', '0968292866', 1, 'ĐH Mo - Dia Chat', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png'),
(37, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', '161 Quận 3', '0916891287', 1, 'Đại học khoa học xã hội và nhân văn', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png'),
(38, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', 'duy xuyên quảng nam', '01678030785', 1, 'thpt nguyễn hiền', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png'),
(39, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', 'duy xuyen quang nam', '01678030785', 1, 'nguyễn hiền', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png'),
(40, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', 'duy xuyen quang nam', '01678030785', 1, 'nguyễn hiền', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png'),
(41, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', '32312312', '321321312321', 1, '321321321321', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png'),
(42, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', 'dsada', '0909653912', 1, 'sASASA', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png'),
(43, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', 'nguyen trong tuyen', '0909653912', 1, 'Khoa hOc', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png'),
(44, '', 'Phạm Kỳ Khôi', '15ab0aac407b8f447acd0120e15e2be8', '', 'phamkykhoi.info@gmail.com', 'tphcm', '01667139369', 1, 'HCVNBCVT', NULL, 1, 0, 0, 0, 0, 0, 1, '/uploads/suntech/guest.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam_question`
--
ALTER TABLE `exam_question`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_group`
--
ALTER TABLE `tbl_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam_question`
--
ALTER TABLE `exam_question`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_group`
--
ALTER TABLE `tbl_group`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
