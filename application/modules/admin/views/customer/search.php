    <div class="onecolumn">    	
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="javascript:void(0)" onclick="delete_multil('item','<?php echo "advertise/delete/" ?>','<?php echo "menuproduct" ?>','Vui lòng chọn danh mục bạn muốn xóa');"><img src="<?php echo base_url() ?>public/admin/images/icon_delete_all.png" alt="Xóa tất cả" title="Xóa tất cả" /></a></li>
            </ul>
    	</div>
        
        <div class="frmSearch" style="padding: 8px; clear: both;">
            <form action="<?php echo base_url('admin/customer/search') ?>" method="post" name="formSearch" id="formSearch"  class="formSearch">
                <input type="text" size="45" name="keyword" id="keyword" value="<?php if(isset($_POST['keyword'])) echo $_POST['keyword']; else echo 'Nhập khách hàng cần tìm'; ?>" onblur="clearText(this)" onfocus="clearText(this)" />
                <input type="button" onclick="actionSearch('formSearch', 'keyword')" name="btnSearch" id="btnSearch" style="padding: 5px;" value="Tìm kiếm" />
            </form>
        </div>
        
    	<div class="content">
            <?php if(count($customer) > 0) { ?>
            <form id="form_data" name="form_data"  method="post">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th style="width:3%"><input type="checkbox" id="check_all" name="check_all"></th>
						<th style="width:3%">STT</th>
						<th style="width:20%">Tên khách hàng</th>
                        <th style="width:5%">Điện Thoại</th>
                        <th style="width:5%">Email</th>
                        <th style="width:5%">Địa chỉ</th>
                        <th style="width: 5%;">Ngày tạo</th>
                        <th style="width: 5%;">Thao tác</th>
						
					</tr>
				</thead>
				<tbody>    
                <?php $stt = 1 ?>
                <?php foreach($customer as $key=>$val) { ?>
                <?php $array = json_decode($val['user_option']) ?>
					<tr class="class_jpage">
						<td align="center"><input type="checkbox" name="cid[]" id="cid" class="item" value="<?php echo $val['user_id'] ?>"/></td>
						<td align="center"><?php echo $stt++ ?></td>
						<td style="vertical-align: top;"><?php echo $val['user_name'] ?></td>
                        <td align="center"><?php echo $array->phone ?></td>
                        <td align="center"><?php echo $val['user_email'] ?></td>
                        <td align="center"><?php echo $array->address ?></td>
                        <td style="width: 5%;" align="center"><?php echo date('d-m-Y', $val['date']) ?></td>
						<td align="center">
							<a href="<?php echo base_url('admin/customer/delete/'.$val['user_id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_delete.png" alt="delete" class="help" title="Delete"></a>
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