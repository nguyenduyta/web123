    <div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/menuproduct/add') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm danh mục" title="Thêm danh mục" /></a></li>
                <li><a href="javascript:void(0)" onclick="actionDelete('form_data')"><img src="<?php echo base_url() ?>public/admin/images/icon_delete_all.png" alt="Xóa tất cả" title="Xóa tất cả" /></a></li>
            </ul>
    	</div>
        
        <div class="frmSearch" style="padding: 8px; clear: both;">
            <form action="<?php echo base_url('admin/menuproduct/search') ?>" method="post" name="formSearch" id="formSearch"  class="formSearch">
                <input type="text" size="45" name="keyword" id="keyword" value="<?php if(isset($_POST['keyword'])) echo $_POST['keyword']; else echo 'Nhập tên danh mục cần tìm'; ?>" onblur="clearText(this)" onfocus="clearText(this)" />
                <input type="button" onclick="actionSearch('formSearch', 'keyword')" name="btnSearch" id="btnSearch" style="padding: 5px;" value="Tìm kiếm" />
            </form>
        </div>
        
        <?php    
            $system = new recursive($menuproduct);
            $result = $system->buildArray(); 
        ?>
        <?php if(count($result) > 0) { ?>   
    	<div class="content">
            <form id="form_data" name="form_data"  method="post">     
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th style="width:3%"><input type="checkbox" id="check_all" name="check_all"></th>
						<th style="width:3%">STT</th>
						<th style="width:3%">ID</th>
						<th style="width:20%">Tên danh mục</th>
                        <th style="width:5%">Trạng thái</th>
                        <th style="width:5%">Parent</th>
                        <th style="width:5%">Thứ tự</th>
                        <th style="width: 5%;">Người tạo</th>
                        <th style="width: 5%;">Ngày tạo</th>
                        <th style="width: 5%;">Thao tác</th>
						
					</tr>
				</thead>
				<tbody>
                        <?php 
                            $stt = 1;
                            foreach($result as $key=>$val) {
                                $id = $val['id'];
                                if($val['level'] == 1) {
                                    $name = '<strong> + '.$val['name'].'</strong>';
                                } else {
                                    $name = ' - '.$val['name'];
                                    $padding = ($val['level'] - 1)*25;
                                    $padding =  'padding-left: '.$padding . 'px';
                                    $name = '<div style="'.$padding.'">'.$name.'</div>';
                                }
                                $active = $val['active'];
                                $parent = $val['parent'];
                                $created_by = $val['user_name'];
                                $order = $val['order'];
                                $date = $val['date'];
                        ?>
					<tr  class="class_jpage">
						<td align="center"><input type="checkbox" name="cid[]" id="cid" class="item" value="<?php echo $id ?>"></td>
						<td align="center"><?php echo $stt++ ?></td>
						<td align="center"><?php echo $id; ?></a></td>
						<td><?php echo $name ?></td>
                        <td align="center">
                            <?php if($active == 1) { ?>
                                <a href="<?php echo base_url('admin/menuproduct/status/inactive/id/'.$id) ?>"><img class="status" src="<?php echo base_url() ?>public/admin/images/active.png" alt="Kích hoạt" title="Hiển thị" /></a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('admin/menuproduct/status/active/id/'.$id) ?>"><img class="status" src="<?php echo base_url() ?>public/admin/images/deactive.png" alt="Không kích hoạt" title="Không hiển thị" /></a>
                            <?php } ?>
                            
                        </td>
                        <td align="center"><?php echo $parent ?></td>
                        <td align="center"><input type="text" name="order" id="order" value="<?php echo $order; ?>" size="2" /></td>
                        <td align="center"><?php echo $created_by ?></td>
                        <td align="center"><?php echo date('d-m-Y', $date) ?></td>
						<td align="center">
							<a href="<?php echo base_url('admin/menuproduct/edit/'.$id) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="edit" class="help" title="Edit"></a>
							<a href="<?php echo base_url('admin/menuproduct/delete/'.$id) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_delete.png" alt="delete" class="help" title="Delete"></a>
						</td>
                        <?php } ?>
					</tr>
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
		<?php } else echo '<div class="no_record" align="center">No record</div>';?>
	</div>
</div>