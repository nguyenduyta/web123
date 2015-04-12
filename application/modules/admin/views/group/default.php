    <div class="onecolumn">    	
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/group/add') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm nhóm" title="Thêm nhóm" /></a></li>
                <li><a href="javascript:void(0)" onclick="actionDelete('form_data')"><img src="<?php echo base_url() ?>public/admin/images/icon_delete_all.png" alt="Xóa tất cả" title="Xóa tất cả" /></a></li>
            </ul>
    	</div>
        
        <div class="frmSearch" style="padding: 8px; clear: both;">
            <form action="<?php echo base_url('admin/group/search') ?>" method="post" name="formSearch" id="formSearch"  class="formSearch">
                <input type="text" size="45" name="keyword" id="keyword" value="<?php if(isset($_POST['keyword'])) echo $_POST['keyword']; else echo 'Nhập tên nhóm cần tìm'; ?>" onblur="clearText(this)" onfocus="clearText(this)" />
                <input type="button" onclick="actionSearch('formSearch', 'keyword')" name="btnSearch" id="btnSearch" style="padding: 5px;" value="Tìm kiếm" />
            </form>
        </div>
        
    	<div class="content">
            <?php if(count($group) > 0) { ?>
            <form id="form_data" name="form_data"  method="post">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th style="width:3%">STT</th>
                        <th style="width:3%">ID</th>
						<th style="width:20%">Tên nhóm</th>
                        <th style="width:20%">Quyền quản trị</th>
                        <th style="width:5%">Người tạo</th>
                        <th style="width: 5%;">Ngày tạo</th>
                        <th style="width: 5%;">Thao tác</th>		
					</tr>
				</thead>
				<tbody>  
                    <?php $i = 1; ?>  
                    <?php foreach($group as $key=>$val) { ?>
					<tr class="class_jpage">
						<td align="center"><?php echo $i++ ?></td>
                        <td align="center"><?php echo $val['id'] ?></td>
						<td style="vertical-align: top;"><?php echo $val['name'] ?></td>
                        <td style="vertical-align: top;" align="center">
                        <?php if($val['permission'] == 'none') { ?>
                        Không có quyền quản trị
                        <?php } elseif($val['permission'] == 'all') { ?>
                        <span style="color: red; font-weight: bold;">Toàn quyền quản trị</span>
                        <?php } else { ?>
                        Quản trị theo chức năng
                        <?php } ?>
                        </td>
                        <td align="center"><?php echo $val['user_name'] ?></td>
                        <td style="width: 5%;" align="center"><?php echo date('d-m-Y', $val['date']) ?></td>
						<td align="center">
                            <?php if($val['id'] > 3) { ?>
                            <a href="<?php echo base_url('admin/group/edit/'.$val['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="edit" class="help" title="Edit"></a>
							<a href="<?php echo base_url('admin/group/delete/'.$val['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_delete.png" alt="delete" class="help" title="Delete"></a>
                            <?php } ?>
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
        <?php } ?>
	</div>
</div>