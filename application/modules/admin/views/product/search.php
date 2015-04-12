    <div class="onecolumn">
    	<div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li>
                    <form name="exportForm" id="exportForm" method="post" action="<?php echo base_url('admin/product/export') ?>">
                        <input type="hidden" name="isExport" id="isExport" />
                        <input alt="Xuất ra Excel" title="Xuất ra file Excel" type="image" src="<?php echo base_url() ?>public/admin/images/icon_excel.png" />
                    </form>
                </li>
                <li><a href="<?php echo base_url('admin/product/add') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm sản phẩm" title="Thêm sản phẩm" /></a></li>
                <li><a href="javascript:void(0);"><img src="<?php echo base_url() ?>public/admin/images/icon_delete_all.png" alt="Xóa tất cả" title="Xóa tất cả" /></a></li>
            </ul>
    	</div>

        <div class="frmSearch" style="padding: 8px; clear: both;">
            <form action="<?php echo base_url('admin/product/search') ?>" method="post" name="formSearch" id="formSearch"  class="formSearch">
                <input type="text" size="45" name="keyword" id="keyword" value="<?php if(isset($_POST['keyword'])) echo $_POST['keyword']; else echo 'Nhập tên sản phẩm cần tìm'; ?>" onblur="clearText(this)" onfocus="clearText(this)" />
                <input type="button" onclick="actionSearch('formSearch', 'keyword')" name="btnSearch" id="btnSearch" style="padding: 5px;" value="Tìm kiếm" />
            </form>
        </div>

        <?php if(count($product) > 0) { ?>
        <form id="form_data" name="form_data"  method="post">
    	<div class="content">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th style="width:2%"><input type="checkbox" id="check_all" name="check_all"></th>
						<th style="width:2%">STT</th>
                        <th style="width:4%">ID</th>
						<th style="width:2%">Hình đại diện</th>
                        <th style="width:2%">Mã SP</th>
						<th style="width:15%">Tên sản phẩm</th>
                        <th style="width:5%">Giá (VNĐ)</th>
                        <th style="width:4%">Hiển thị</th>
                        <th style="width:10%">Thuộc danh mục</th>
                        <th style="width:5%">Thứ tự</th>
                        <th style="width: 8%;">Người tạo</th>
                        <th style="width: 6%;">Ngày tạo</th>
                        <th style="width: 5%;">Thao tác</th>
						
					</tr>
				</thead>
				<tbody>
                        <?php 
                            $stt = 1;
                            foreach($product as $key=>$val) {
                                $id = $val['id'];
                                $code = $val['code'];
                                $name = $val['pname'];
                                $price = $val['price'];
                                $active = $val['pactive'];
                                $created_by = $val['user_name'];
                                $order = $val['porder'];
                                $date = $val['date'];
                                $menu = $val['name'];
                                $image = $val['pimage1'];
                        ?>
                        
					<tr class="class_jpage">
						<td align="center" style="vertical-align: middle;"><input type="checkbox" name="cid[]" id="cid" value="<?php echo $id ?>"></td>
						<td align="center" style="vertical-align: middle;"><?php echo $stt++ ?></td>
                        <td align="center" style="vertical-align: middle;"><?php echo $val['id'] ?></td>
						<td align="center" style="vertical-align: middle;"><img src="<?php echo base_url() ?>uploads/product/product/<?php echo $image ?>" height="50" width="70" /></a></td>
                        <td align="left" style="vertical-align: middle;"><?php echo $code; ?></a></td>
						<td align="left" ><?php echo $name ?></td>
                        <td align="center" ><?php echo $price ?></td>
                        <td align="center" style="vertical-align: middle;">
                            <?php if($active == 1) { ?>
                                <a href="<?php echo base_url('admin/product/status/inactive/id/'.$id) ?>"><img class="status" src="<?php echo base_url() ?>public/admin/images/active.png" alt="Kích hoạt" title="Hiển thị" /></a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('admin/product/status/active/id/'.$id) ?>"><img class="status" src="<?php echo base_url() ?>public/admin/images/deactive.png" alt="Không kích hoạt" title="Không hiển thị" /></a>
                            <?php } ?>
                        </td>
                        <td align="center" style="vertical-align: middle;"><?php echo $val['name'] ?></td>
                        <td align="center" style="vertical-align: middle;"><input type="text" name="order[<?php echo $val['id'] ?>]" id="order" value="<?php echo $order; ?>" size="2" /></td>
                        <td align="center" style="vertical-align: middle;"><?php echo $created_by ?></td>
                        <td align="center" style="vertical-align: middle;"><?php echo date('d-m-Y', $date) ?></td>
						<td align="center" style="vertical-align: middle;">
							<a href="<?php echo base_url('admin/product/edit/'.$id) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="edit" class="help" title="Edit"></a>
							<a href="<?php echo base_url('admin/product/delete/'.$id) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_delete.png" alt="delete" class="help" title="Delete"></a>
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
		</form>
        <?php } else { ?>
        <div class="no_record">Không có bản ghi phù hợp. Hãy thử lại</div>
        <?php } ?>
	</div>
</div>