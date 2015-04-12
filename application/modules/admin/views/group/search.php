    <div class="onecolumn">    	
        <div class="header">
    		<span><?php echo $title ?></span>
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
                        <th style="width:5%">Người tạo</th>
                        <th style="width: 5%;">Ngày tạo</th>	
					</tr>
				</thead>
				<tbody>  
                    <?php $i = 1; ?>  
                    <?php foreach($group as $key=>$val) { ?>
					<tr class="class_jpage">
						<td align="center"><?php echo $i++ ?></td>
                        <td align="center"><?php echo $val['id'] ?></td>
						<td style="vertical-align: top;"><?php echo $val['name'] ?></td>
                        <td align="center"><?php echo $val['user_name'] ?></td>
                        <td style="width: 5%;" align="center"><?php echo date('d-m-Y', $val['date']) ?></td>
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