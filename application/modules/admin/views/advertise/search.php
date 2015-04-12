    <div class="onecolumn">    	
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/advertise/add') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm danh mục" title="Thêm danh mục" /></a></li>
                <li><a href="javascript:void(0)" onclick="actionDelete('form_data')"><img src="<?php echo base_url() ?>public/admin/images/icon_delete_all.png" alt="Xóa tất cả" title="Xóa tất cả" /></a></li>
            </ul>
    	</div>

        <div class="frmSearch" style="padding: 8px; clear: both;">
            <form action="<?php echo base_url('admin/advertise/search') ?>" method="post" name="formSearch" id="formSearch"  class="formSearch">
                <input type="text" size="45" name="keyword" id="keyword" value="<?php if(isset($_POST['keyword'])) echo $_POST['keyword']; else echo 'Nhập tiêu đề quảng cáo cần tìm'; ?>" onblur="clearText(this)" onfocus="clearText(this)" />
                <input type="button" onclick="actionSearch('formSearch', 'keyword')" name="btnSearch" id="btnSearch" style="padding: 5px;" value="Tìm kiếm" />
            </form>
        </div>
        
    	<div class="content">
            <?php if(count($advertise) > 0) { ?>
            <form id="form_data" name="form_data"  method="post">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th style="width:3%"><input type="checkbox" id="check_all" name="check_all"></th>
						<th style="width:3%">STT</th>
						<th style="width:3%">Ảnh</th>
						<th style="width:20%">Tiêu đề</th>
                        <th style="width:8%">Mở web</th>
                        <th style="width:5%">Trạng thái</th>
                        <th style="width:5%">Kiểu</th>
                        <th style="width:5%">Thứ tự</th>
                        <th style="width: 5%;">Người tạo</th>
                        <th style="width: 5%;">Ngày tạo</th>
                        <th style="width: 5%;">Thao tác</th>
						
					</tr>
				</thead>
				<tbody>
                    <?php $i = 1 ?>
                    <?php foreach($advertise as $key=>$val) { ?>
					<tr class="class_jpage">
						<td align="center"><input type="checkbox" name="" id="" class="item" value="<?php echo $val['id'] ?>"></td>
						<td align="center"><?php echo $i++ ?></td>
						<td align="center"><img src="<?php echo $val['adsfile'] ?>" width="100" /></a></td>
						<td style="vertical-align: top;"><?php echo $val['adsname'] ?></td>
                        <td align="center" style="vertical-align: top;"><?php if($val['open'] == 1) echo 'Mở tab mới'; else echo 'Mở trên trang' ?></td>
                        <td align="center" style="vertical-align: top;">
                            <?php if($val['adsactive'] == 1) { ?>
                                <a href="<?php echo base_url('admin/adsposition/status/inactive/id/'.$val['id']) ?>"><img class="status" src="<?php echo base_url() ?>public/admin/images/active.png" alt="Kích hoạt" title="Hiển thị" /></a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('admin/adsposition/status/active/id/'.$val['id']) ?>"><img class="status" src="<?php echo base_url() ?>public/admin/images/deactive.png" alt="Không kích hoạt" title="Không hiển thị" /></a>
                            <?php } ?>
                        </td>
                        <td align="center" style="vertical-align: top;">
                            <?php 
                                $type = $val['adstype'] ;
                                if($type == 1) {
                                    $type = 'Image';
                                } elseif($type == 2) {
                                    $type = 'Flash';
                                } else {
                                    $type = 'Media';
                                }
                            ?>
                            <?php echo $type ?>
                        </td>
                        <td align="center" style="vertical-align: top;"><input type="text" name="adsorder" size="3" id="adsorder" size=""  value="<?php echo $val['adsorder']?>"/></td>
                        <td align="center" style="vertical-align: top;"><?php echo $val['user_name'] ?></td>
                        <td align="center" style="vertical-align: top;"><?php echo $val['user_name'] ?></td>
						<td align="center" style="vertical-align: top;">
							<a href="<?php echo base_url('admin/advertise/edit/'.$val['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="edit" class="help" title="Edit"></a>
							<a href="<?php echo base_url('admin/advertise/delete/'.$val['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_delete.png" alt="delete" class="help" title="Delete"></a>
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