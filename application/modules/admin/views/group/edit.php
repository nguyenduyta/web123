<?php if(isset($_POST['name'])) {
    echo $_POST['name'];
    die();
}
?>
<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin/group') ?>" title="Back">Quay lại</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
        <?php if(count($group) > 0) { ?>
    	<form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
        <table class="data" width="100%" cellpadding="0" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
                <tr>
                	<td width="125"><label>Tên nhóm</label></td>
                    <td>
                        <input type="text" id="name"  name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo $group['name'] ?>" size="48"  />
                        <?php echo form_error('name') ?>    
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Thứ tự</label></td>
                    <td>
                        <input type="text" id="order"  name="order" value="<?php if(isset($_POST['order'])) echo $_POST['order']; else echo $group['order'] ?>" size="3"  />
                        <?php echo form_error('order') ?>    
                    </td>
				</tr>
                
                <tr>
                	<td width="125" style="vertical-align: top;"><label>Phân quyền (<span style="color: red">quản trị</span>)</label></td>
                    <td>
                        <select name="permission[]" class="selectper_formpost" multiple="multiple">
                            <option value="none" style="color:#F00;" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'none') echo 'selected = "selected"'; ?>>Không phân quyền quản trị</option>
                            <option value="config_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'config_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Cấu hình chung: Xem</option>
                            
                            <option value="groupmenunews_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'groupmenunews_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Loại bài viết: Xem</option>
                            <option value="groupmenunews_add" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'groupmenunews_add') echo 'selected = "selected"'; ?>>Loại bài viết: Thêm</option>
                            <option value="groupmenunews_edit" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'groupmenunews_edit') echo 'selected = "selected"'; ?>>Loại bài viết: Sửa</option>
                            <option value="groupmenunews_delete" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'groupmenunews_delete') echo 'selected = "selected"'; ?>>Loại bài viết: Xóa</option> 
                            
                            <option value="post_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'post_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Bài viết: Xem</option>
                            <option value="post_add" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'post_add') echo 'selected = "selected"';  ?>>Bài viết: Thêm</option>
                            <option value="post_edit" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'post_edit') echo 'selected = "selected"';  ?>>Bài viết: Sửa</option>
                            <option value="post_delete" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'post_delete') echo 'selected = "selected"';  ?>>Bài viết: Xóa</option> 
                                                                                                               
                            <option value="menunews_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'menunews_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Danh mục tin tức: Xem</option>
                            <option value="menunews_add" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'menunews_add') echo 'selected = "selected"';  ?>>Danh mục tin tức: Thêm</option>
                            <option value="menunews_edit" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'menunews_edit') echo 'selected = "selected"'; ?>>Danh mục tin tức: Sửa</option>
                            <option value="menunews_delete" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'menunews_delete') echo 'selected = "selected"';  ?>>Danh mục tin tức: Xóa</option>
                            
                            <option value="news_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Tin tức: Xem</option>
                            <option value="news_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Tin tức: Thêm</option>
                            <option value="news_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Tin tức: Sửa</option>
                            <option value="news_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Tin tức: Xóa</option>
                            
                            <option value="brand_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'brand_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Hãng sản xuất: Xem</option>
                            <option value="brand_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Hãng sản xuất: Thêm</option>
                            <option value="brand_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Hãng sản xuất: Sửa</option>
                            <option value="brand_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Hãng sản xuất: Xóa</option>
                            
                            <option value="groupmenuproduct_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'groupmenuproduct_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Nhóm danh mục sản phẩm: Xem</option>
                            <option value="groupmenuproduct_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Nhóm danh mục sản phẩm: Thêm</option>
                            <option value="groupmenuproduct_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Nhóm danh mục sản phẩm: Sửa</option>
                            <option value="groupmenuproduct_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"'; ?>>Nhóm danh mục sản phẩm: Xóa</option>
                            
                            <option value="menuproduct_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'menuproduct_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Danh mục sản phẩm: Xem</option>
                            <option value="menuproduct_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Danh mục sản phẩm: Thêm</option>
                            <option value="menuproduct_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Danh mục sản phẩm: Sửa</option>
                            <option value="menuproduct_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Danh mục sản phẩm: Xóa</option>
                            
                            <option value="product_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'product_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Sản phẩm: Xem</option>
                            <option value="product_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Sản phẩm: Thêm</option>
                            <option value="product_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Sản phẩm: Sửa</option>
                            <option value="product_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Sản phẩm: Xóa</option>
                            
                            <option value="tagproduct_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'tagproduct_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Tag Sản phẩm: Xem</option>
                            <option value="tagproduct_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"'; ?>>Tag Sản phẩm: Thêm</option>
                            <option value="tagproduct_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Tag Sản phẩm: Sửa</option>
                            <option value="tagproduct_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"'; ?>>Tag Sản phẩm: Xóa</option>
                            
                            <option value="slideshow_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'slideshow_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Slideshow: Xem</option>
                            <option value="slideshow_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Slideshow: Thêm</option>
                            <option value="slideshow_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Slideshow: Sửa</option>
                            <option value="slideshow_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Slideshow: Xóa</option>
                            
                            <option value="video_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'video_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Video: Xem</option>
                            <option value="video_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Video: Thêm</option>
                            <option value="video_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Video: Sửa</option>
                            <option value="video_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Video: Xóa</option>
                            
                            <option value="advertise_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'advertise_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Quảng cáo: Xem</option>
                            <option value="advertise_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Quảng cáo: Thêm</option>
                            <option value="advertise_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Quảng cáo: Sửa</option>
                            <option value="advertise_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"'; ?>>Quảng cáo: Xóa</option>
                            
                            <option value="file_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'file_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Tập tin: Xem</option>
                            <option value="file_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Tập tin: Thêm</option>
                            <option value="file_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"'; ?>>Tập tin: Sửa</option>
                            <option value="file_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"'; ?>>Tập tin: Xóa</option>
                            
                            <option value="support_view"<?php if(isset($_POST['permission']) && $_POST['permission'] == 'support_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Hỗ trợ: Xem</option>
                            <option value="support_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"'; ?>>Hỗ trợ: Thêm</option>
                            <option value="support_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"'; ?>>Hỗ trợ: Sửa</option>
                            <option value="support_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"'; ?>>Hỗ trợ: Xóa</option>
                            
                            <option value="group_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'group_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Nhóm Thành viên: Xem</option>
                            <option value="group_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Nhóm Thành viên: Thêm</option>
                            <option value="group_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Nhóm Thành viên: Sửa</option>
                            <option value="group_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"'; ?>>Nhóm Thành viên: Xóa</option>
                            
                            <option value="member_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'member_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Thành viên: Xem</option>
                            <option value="member_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"';  ?>>Thành viên: Thêm</option>
                            <option value="member_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"'; ?>>Thành viên: Sửa</option>
                            <option value="member_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'news_view') echo 'selected = "selected"'; ?>>Thành viên: Xóa</option>
                            
                            <option value="customer_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'customer_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Khách hàng: Xem</option>
     
                            <option value="recuitment_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'recuitment_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Tuyển dụng: Xem</option>
                            <option value="recuitment_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'recuitment_add') echo 'selected = "selected"';  ?>>Tuyển dụng: Thêm</option>
                            <option value="recuitment_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'recuitment_edit') echo 'selected = "selected"'; ?>>Tuyển dụng: Sửa</option>
                            <option value="recuitment_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'recuitment_delete') echo 'selected = "selected"'; ?>>Tuyển dụng: Xóa</option>
                            
                            <option value="application_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'application_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Hồ sơ: Xem</option>
                            
                            <option value="link_view" <?php if(isset($_POST['permission']) && $_POST['permission'] == 'link_view') echo 'selected = "selected"'; elseif(!isset($_POST['permission'])) echo 'selected = "selected"'; ?>>Liên kết: Xem</option>
                            <option value="link_add"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'link_add') echo 'selected = "selected"';?>>Liên kết: Thêm</option>
                            <option value="link_edit"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'link_edit') echo 'selected = "selected"';?>>Liên kết: Sửa</option>
                            <option value="link_delete"  <?php if(isset($_POST['permission']) && $_POST['permission'] == 'link_delete') echo 'selected = "selected"';?>>Liên kết: Xóa</option>
                        </select>
                    </td>
				</tr>
                
                <tr>
                	<td width="125"><label>Trạng thái</label></td>
                    <td>
                        <select name="active" id="active">
                             <option value="1" <?php if($group['active'] == 1) echo 'selected="selected"'; elseif(isset($_POST['active']) && $_POST['active'] == 1) echo 'selected="selected"';  ?>>Hiển thị</option>
                             <option value="0" <?php if($group['active'] == 0) echo 'selected="selected"'; elseif(isset($_POST['active']) && $_POST['active'] == 0) echo 'selected="selected"';  ?>>Không hiển thị</option>
                        </select>
                    </td>
				</tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="hidden" name="isSubmit" value="1" />
                        <input type="submit" name="btnAdd" value="Thêm mới" />
                        <input type="reset" name="btnReset" value="Nhập lại" />
                    </td>
                </tr>
			</tbody>
		</table>
	</form>
    <?php } ?>
  </div>
</div>
</div>