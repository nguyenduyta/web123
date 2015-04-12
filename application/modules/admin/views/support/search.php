    <div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/support/add') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm danh mục" title="Thêm danh mục" /></a></li>
                <li><a href="javascript:void(0)" onclick="actionDelete('form_data')"><img src="<?php echo base_url() ?>public/admin/images/icon_delete_all.png" alt="Xóa tất cả" title="Xóa tất cả" /></a></li>
            </ul>
    	</div>
        
        <div class="frmSearch" style="padding: 8px; clear: both;">
            <form action="<?php echo base_url('admin/support/search') ?>" method="post" name="formSearch" id="formSearch"  class="formSearch">
                <input type="text" size="45" name="keyword" id="keyword" value="<?php if(isset($_POST['keyword'])) echo $_POST['keyword']; else echo 'Nhập tên tài khoản hỗ trợ cần tìm'; ?>" onblur="clearText(this)" onfocus="clearText(this)" />
                <input type="button" onclick="actionSearch('formSearch', 'keyword')" name="btnSearch" id="btnSearch" style="padding: 5px;" value="Tìm kiếm" />
            </form>
        </div>
        
        <?php if(count($support) > 0) { ?>
        <form id="form_data" name="form_data"  method="post">
    	<div class="content">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
                    <tr><td colspan="12" align="center"><span class="result">Tìm thấy <?php echo count($support) ?> bản ghi phù hợp từ khóa</span></td></tr>
					<tr>
						<th style="width:3%"><input type="checkbox" id="check_all" name="check_all"></th>
						<th style="width:3%">STT</th>
						<th style="width:10%">Tên tài khoản</th>
						<th style="width:5%">Yahoo</th>
                        <th style="width:5%">Skype</th>
                        <th style="width:5%">Facebook</th>
                        <th style="width:5%">Số điện thoại</th>
                        <th style="width:5%">Thứ tự</th>
                        <th style="width:5%">Hiển thị</th>
                        <th style="width: 5%;">Người tạo</th>
                        <th style="width: 5%;">Ngày tạo</th>
                        <th style="width: 5%;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
                    <?php $i = 1; ?>
                    <?php foreach($support as $key=>$val) { ?>
					<tr class="class_jpage">
                        
						<td align="center"><input type="checkbox" name="cid[]" id="cid" value="<?php echo $val['id'] ?>" class="item"></td>
						<td align="center"><?php echo $i++ ?></td>
						<td style="vertical-align: top;"><?php echo $val['name'] ?></td>
                        <td align="center"><?php echo $val['yahoo'] ?></td>
                        <td align="center"><?php echo $val['skype'] ?></td>
                        <td align="center"><?php echo $val['facebook'] ?></td>
                        <td><?php echo $val['phone'] ?></td>
                        <td align="center"><input type="text" name="order" size="3" id="order" value="<?php echo $val['order'] ?>"/></td>
                        <td align="center">
                            <?php if($val['active'] == 1) { ?>
                                <a href="<?php echo base_url('admin/support/status/inactive/id/'.$val['id']) ?>"><img class="status" src="<?php echo base_url() ?>public/admin/images/active.png" alt="Kích hoạt" title="Hiển thị" /></a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('admin/support/status/active/id/'.$val['id']) ?>"><img class="status" src="<?php echo base_url() ?>public/admin/images/deactive.png" alt="Không kích hoạt" title="Không hiển thị" /></a>
                            <?php } ?>
                        </td>
                        <td align="center"><?php echo $val['user_name'] ?></td>
                        <td align="center"><?php echo $val['user_name'] ?></td>
						<td align="center">
							<a href="<?php echo base_url('admin/support/edit/'.$val['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="edit" class="help" title="Edit"></a>
							<a href="<?php echo base_url('admin/support/delete/'.$val['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_delete.png" alt="delete" class="help" title="Delete"></a>
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