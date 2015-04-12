    <div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/adsposition/add') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm danh mục" title="Thêm danh mục" /></a></li>
            </ul>
    	</div>
  
    	<div class="content">
            <?php if(count($adsposition) >0 ) { ?>
             <form id="form_data" name="form_data"  method="post">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th style="width:3%"><input type="checkbox" id="check_all" name="check_all"></th>
						<th style="width:3%">STT</th>
						<th style="width:20%">Vị trí</th>
                        <th style="width:5%">Hiển thị</th>
                        <th style="width:5%">Thứ tự</th>
                        <th style="width: 5%;">Người tạo</th>
                        <th style="width: 5%;">Ngày tạo</th>
					</tr>
				</thead>
				<tbody>
                    <?php $i = 1 ?>
                    <?php foreach($adsposition as $key=>$val) { ?>
				    <tr class="class_jpage">
						<td align="center"><input type="checkbox" name="adsid[]" id="adsid" class="item" value=""></td>
						<td align="center"><?php echo $i++ ?></td>
						<td><?php echo $val['posname'] ?></td>
                        <td align="center">
                            <?php if($val['posactive'] == 1) { ?>
                                <a href="<?php echo base_url('admin/adsposition/status/inactive/id/'.$val['id']) ?>"><img class="status" src="<?php echo base_url() ?>public/admin/images/active.png" alt="Kích hoạt" title="Hiển thị" /></a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('admin/adsposition/status/active/id/'.$val['id']) ?>"><img class="status" src="<?php echo base_url() ?>public/admin/images/deactive.png" alt="Không kích hoạt" title="Không hiển thị" /></a>
                            <?php } ?>
                        </td>
                        <td align="center"><input type="text" name="posorder" id="posorder" value="<?php echo $val['posorder'] ?>" size="2" /></td>
                        <td align="center"><?php echo $val['user_name'] ?></td>
                        <td align="center"><?php echo date('d-m-Y', $val['date']) ?></td>
					</tr>
                    <?php } ?>
				</tbody>
			</table>
			<div id="chart_wrapper" class="chart_wrapper"></div>
		<!-- End bar chart table-->
        		
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