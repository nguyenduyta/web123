    <style type="text/css">
        iframe {
            width: 250px;
            height: 250px;
        }
    </style>
    <div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/youtube/add') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm danh mục" title="Thêm danh mục" /></a></li>
                <li><a href="javascript:void(0)" onclick="actionDelete('form_data')"><img src="<?php echo base_url() ?>public/admin/images/icon_delete_all.png" alt="Xóa tất cả" title="Xóa tất cả" /></a></li>
            </ul>
    	</div>
        <div class="frmSearch" style="padding: 8px; clear: both;">
            <form action="<?php echo base_url('admin/youtube/search') ?>" method="post" name="formSearch" id="formSearch"  class="formSearch">
                <input type="text" size="45" name="keyword" id="keyword" value="<?php if(isset($_POST['keyword'])) echo $_POST['keyword']; else echo 'Nhập tiêu đề youtube cần tìm'; ?>" onblur="clearText(this)" onfocus="clearText(this)" />
                <input type="button" onclick="actionSearch('formSearch', 'keyword')" name="btnSearch" id="btnSearch" style="padding: 5px;" value="Tìm kiếm" />
            </form>
        </div>
        
    	<div class="content">
            <?php if(count($youtube) > 0) { ?>
            <form id="form_data" name="form_data"  method="post">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th style="width:3%"><input type="checkbox" id="check_all" name="check_all"></th>
						<th style="width:3%">STT</th>
						<th style="width:10%">Tiêu đề</th>
                        <th style="width:5%">Trạng thái</th>
                        <th style="width:5%">Video</th>
                        <th style="width:5%">Thứ tự</th>
                        <th style="width: 5%;">Người tạo</th>
                        <th style="width: 5%;">Ngày tạo</th>
                        <th style="width: 5%;">Thao tác</th>
						
					</tr>
				</thead>
				<tbody>
                    <?php $stt = 1 ?>
                    <?php foreach($youtube as $key=>$val) { ?>
					<tr class="class_jpage">
						<td align="center" style="vertical-align: middle;"><input type="checkbox" name="cid[]" id="cid" class="item" value="<?php echo $val['id'] ?>"></td>
						<td align="center" style="vertical-align: middle;"><?php echo $stt++ ?></td>
						<td><?php echo $val['name'] ?></td>
                        <td align="center" style="vertical-align: middle;">
                            <?php if($val['active'] == 1) { ?>
                                <a href="<?php echo base_url('admin/youtube/status/inactive/id/'.$val['id']) ?>"><img class="status" src="<?php echo base_url() ?>public/admin/images/active.png" alt="Kích hoạt" title="Hiển thị" /></a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('admin/youtube/status/active/id/'.$val['id']) ?>"><img class="status" src="<?php echo base_url() ?>public/admin/images/deactive.png" alt="Không kích hoạt" title="Hiển thị" /></a>
                            <?php } ?>
                        </td>

                        <td align="center" style="vertical-align: top;"><iframe width="<?php echo $val['width'] ?>" height="<?php echo $val['height'] ?>" src="http://www.youtube.com/embed/<?php echo $val['link']?>" frameborder="0" allowfullscreen></iframe></td>
                        <td align="center"><input type="text" name="adsorder" size="3" id="adsorder" size=""  value="<?php echo $val['order'] ?>"/></td>
                        <td align="center"><?php echo $val['user_name'] ?></td>
                        <td align="center"><?php echo date('d-m-Y', $val['date']) ?></td>
						<td align="center">
							<a href="<?php echo base_url('admin/youtube/edit/'.$val['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="edit" class="help" title="Edit"></a>
							<a href="<?php echo base_url('admin/youtube/delete/'.$val['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_delete.png" alt="delete" class="help" title="Delete"></a>
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
        <input type="hidden" value="1" name="isDelete" />
		</form>
        <?php } else { ?>
        <div class="no_record">No record</div>
        <?php } ?>
	</div>
</div>