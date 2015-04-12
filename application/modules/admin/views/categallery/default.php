    <div class="onecolumn">
        
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/categallery/add') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm danh mục" title="Thêm danh mục" /></a></li>
                <li><a href="javascript:void(0)" onclick="actionDelete('form_data')"><img src="<?php echo base_url() ?>public/admin/images/icon_delete_all.png" alt="Xóa tất cả" title="Xóa tất cả" /></a></li>
            </ul>
    	</div>
        <div class="frmSearch" style="padding: 8px; clear: both;">
            
        </div>
    	<div class="content">
        <?php if(count($listcate) > 0) { ?>
        <form id="form_data" name="form_data"  method="post">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th style="width:3%">STT</th>
						<th style="width:20%">Tiêu đề</th>
                        <th>Hình ảnh</th>
                        <th style="width: 10%;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
                    <?php $stt = 1 ?>
                    <?php foreach($listcate as $key=>$val) { ?>
				    <tr  class="class_jpage">
						<td align="center" style="vertical-align: middle;"><?php echo $stt++ ?></td>
						<td style="vertical-align: middle;"><?php echo $val['name']?></td>
                        <td style="vertical-align: middle;">
                            <img src="<?php echo base_url() ?>uploads/product/product/<?php echo $val['img']; ?>" width="100" />
                        </td>
						<td align="center" style="vertical-align: middle;">
							<a href="<?php echo base_url('admin/categallery/edit/'.$val['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="edit" class="help" title="Edit"></a>
							<a href="<?php echo base_url('admin/categallery/delete/'.$val['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_delete.png" alt="delete" class="help" title="Delete"></a>
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
        <?php }else{
			echo "<p align='center'><font color='#FF0000'><b>Dữ liệu đang cập nhật</b></font></p>";
		} ?>
	</div>
</div>