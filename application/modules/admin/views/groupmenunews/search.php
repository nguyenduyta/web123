    <div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
    	</div>
        <div class="frmSearch" style="padding: 8px; clear: both;">
            <form action="<?php echo base_url('admin/groupmenunews/search') ?>" method="post" name="formSearch" id="formSearch"  class="formSearch">
                <input type="text" size="45" name="keyword" id="keyword" value="<?php if(isset($_POST['keyword'])) echo $_POST['keyword']; else echo 'Nhập tiêu đề loại tin tức cần tìm'; ?>" onblur="clearText(this)" onfocus="clearText(this)" />
                <input type="button" onclick="actionSearch('formSearch', 'keyword')" name="btnSearch" id="btnSearch" style="padding: 5px;" value="Tìm kiếm" />
            </form>
        </div>
        
    	<div class="content">
        <?php if(count($result) > 0) { ?>
        <form id="form_data" name="form_data"  method="post">
            
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
                    <tr><td colspan="8" align="center"><span class="result">Tìm thấy <?php echo count($result) ?> bản ghi phù hợp từ khóa</span></td></tr>
					<tr>
                        <th style="width:3%"><input type="checkbox" id="check_all" name="check_all"></th>
						<th style="width:3%">STT</th>
						<th style="width:20%">Tiêu đề</th>
                        <th style="width:5%">Thứ tự</th>
                        <th style="width: 5%;">Người tạo</th>
                        <th style="width: 5%;">Ngày tạo</th>
                        <th style="width: 5%;">Thao tác</th>
						
					</tr>
				</thead>
				<tbody>
                    
                    <?php $stt = 1 ?>
                    <?php foreach($result as $key=>$val) { ?>
				    <tr  class="class_jpage">
                        <td align="center"><input type="checkbox" name="cid[]" id="cid" class="item" value="<?php echo $val['id'] ?>"></td>
						<td align="center"><?php echo $stt++ ?></td>
						<td style="vertical-align: top;"><?php echo $val['nametype']?></td>
                        <td align="center"><input type="text" name="order" size="3" id="order" size=""  value="<?php echo $val['ordertype'] ?>"/></td>
                        <td align="center"><?php echo $val['user_name'] ?></td>
                        <td align="center"><?php echo $val['user_name'] ?></td>
						<td align="center">
							<a href="<?php echo base_url('admin/groupmenunews/edit/'.$val['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="edit" class="help" title="Edit"></a>
							<a href="<?php echo base_url('admin/groupmenunews/delete/'.$val['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_delete.png" alt="delete" class="help" title="Delete"></a>
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