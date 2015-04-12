    <div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/post/add') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm danh mục" title="Thêm danh mục" /></a></li>
                <li><a href="javascript:void(0)" onclick="actionDelete('form_data')"><img src="<?php echo base_url() ?>public/admin/images/icon_delete_all.png" alt="Xóa tất cả" title="Xóa tất cả" /></a></li>
            </ul>
    	</div>
        <div class="frmSearch" style="padding: 8px; clear: both;">
            <form action="<?php echo base_url('admin/post/search') ?>" method="post" name="formSearch" id="formSearch"  class="formSearch">
                <input type="text" size="45" name="keyword" id="keyword" value="<?php if(isset($_POST['keyword'])) echo $_POST['keyword']; else echo 'Tên bài viết...'; ?>" onblur="clearText(this)" onfocus="clearText(this)" />
                <input type="button" onclick="actionSearch('formSearch', 'keyword')" name="btnSearch" id="btnSearch" style="padding: 5px;" value="Tìm kiếm" />
            </form>
        </div>
        
    	<div class="content">
            <?php if(count($post) > 0) { ?>
            <form id="form_data" name="form_data"  method="post">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
                    <tr><td colspan="11" align="center"><span class="result">Tìm thấy <?php echo count($post) ?> bản ghi phù hợp từ khóa</span></td></tr>
					<tr>
                       <th style="width:3%;vertical-align:middle"><input type="checkbox" id="check_all" name="check_all"></th>
						<th style="width:3%;vertical-align:middle">STT</th>
						<th style="width:3%;vertical-align:middle">Ảnh đại diện</th>
						<th style="width:15%;vertical-align:middle">Tiêu đề</th>
                        <th style="width:15%;vertical-align:middle">Loại tin</th>
                        <th style="width:5%;vertical-align:middle">Trạng thái</th>
                        <th style="width:15%;vertical-align:middle">Liên kết</th>
                        <th style="width:5%;vertical-align:middle">Thứ tự</th>
                        <th style="width: 5%;vertical-align:middle">Người tạo</th>
                        <th style="width: 8%;vertical-align:middle">Ngày tạo</th>
                        <th style="width: 5%;vertical-align:middle">Thao tác</th>
						
					</tr>
				</thead>
				<tbody>
                <?php $i = 1 ?>
                <?php foreach($post as $key=>$val) { ?>
				<tr class="class_jpage">
                        <td align="center" style="vertical-align: middle;"><input type="checkbox" name="cid[]" id="cid" class="item" value="<?php echo $val['id']?>"></td>
						<td align="center" style="vertical-align: middle;"><?php echo  $i++ ?></td>
						<td align="center" style="vertical-align:middle;">
                        <?php if($val['image'] == 'no-image') { ?>
                        <img src="<?php echo base_url() ?>uploads/post/no-image.png" alt="No-image" width="120" style="vertical-align: middle;" />
                        <?php } else { ?>
                        <img src="<?php echo base_url() ?>uploads/post/<?php echo $val['image'] ?>" alt="<?php echo $val['name'] ?>" title="<?php echo $val['name'] ?>" width="120" style="vertical-align: middle;" />
                        <?php } ?>
                        </td>
						<td style="vertical-align: middle;"><?php echo $val['name'] ?></td>
                        <td style="vertical-align: middle;"><?php echo $val['nametype'] ?></td>
                         <td align="center" style="vertical-align:middle ;">
                            <?php if($val['active'] == 1) { ?>
                                <a href="<?php echo base_url('admin/post/status/inactive/id/'.$val['id']) ?>"><img class="status" src="<?php echo base_url() ?>public/admin/images/active.png" alt="Kích hoạt" title="Hiển thị" /></a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('admin/post/status/active/id/'.$val['id']) ?>"><img class="status" src="<?php echo base_url() ?>public/admin/images/deactive.png" alt="Không kích hoạt" title="Hiển thị" /></a>
                            <?php } ?>
                        </td>
                        <td align="left" style="vertical-align:middle ;"><a><?php echo site_url($val['link']) ?></a></td>
                        <td align="center" style="vertical-align:  middle;">
                        <input type="text" name="order" size="3" id="order"  value="<?php echo $val['order'] ?>"/></td>
                        <td align="center" style="vertical-align: middle;"><?php echo $val['user_name'] ?></td>
                        <td align="center" style="vertical-align: middle;"><?php echo $val['user_name'] ?></td>
						<td align="center" style="vertical-align: middle;">
							<a href="<?php echo base_url('admin/post/edit/'.$val['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="Sửa" class="help" title="Sửa"></a>
							<a href="<?php echo base_url('admin/post/delete/'.$val['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_delete.png" alt="Xóa" class="help" title="Xóa"></a>
						</td>
					</tr>
                    <?php } ?>
				</tbody>
			</table>
		<!-- Begin pagination -->
			<div class="pagination">
                <div class="holder"></div>
			</div>
		<!-- End pagination -->
        <input type="hidden" value="1" name="isSubmit" />
        <input type="hidden" value="1" name="isSort" />
        <input type="hidden" value="1" name="isDelete" />
		</form>
        <?php } else { ?>
        <div class="no_record">Không có bản ghi phù hợp. Hãy thử lại</div>
        <?php } ?>
	</div>
</div>