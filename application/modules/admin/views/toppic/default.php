    <div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/toppic/add') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm danh mục" title="Thêm danh mục" /></a></li>
            </ul>
    	</div>
        <br class="clear"/>
        <?php    
            $system = new recursive($menunews);
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
						<th style="width:10%">Tên Toppic</th>
                        <th style="width:3%">Tuts</th>
                        <th style="width:3%">Video</th>
                        <th style="width:5%">Thứ tự</th>
                        <th style="width: 5%;">Người tạo</th>
                        <th style="width: 5%;">Ngày tạo</th>
                        <th style="width: 5%;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
                        <?php 
                            $stt = 1;
                            foreach($result as $key=>$val){
                                $id = $val['id'];
                                if($val['level'] == 1) {
                                    $name = '+ <input type="text" value="'.$val['name'].'" size="45%" style="border:none;background:none; font-size:13px;" class="txtname" />';
                                } else {
                                    $name = ' - <input type="text" value="'.$val['name'].'" size="25%" style="border:none;background:none; font-size:11px;" />';
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
					<tr class="class_jpage">
						<td align="center"><input type="checkbox" name="cid[]" id="cid" class="item" value="<?php echo $id ?>" /></td>
						<td align="center"><?php echo $stt++ ?></td>
						<td align="center"><?php echo $id; ?></a></td>
						<td><?php echo $name ?></td>
                        <td><?php echo $val['tuts_number']; ?></td>
                        <td><?php echo $val['video_number']; ?></td>
                        <td align="center"><input  type="text" name="order[<?php echo $val['id'] ?>]"  class="order" value="<?php echo $order; ?>" size="2" getid="<?php echo $val['id'] ?>" /></td>
                        <td align="center"><?php echo $created_by ?></td>
                        <td align="center"><?php echo date('d-m-Y', $date) ?></td>
						<td align="center">
							<a href="<?php echo base_url('admin/toppic/edit/'.$id) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="edit" class="help" title="Edit"></a>
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
		<?php } else echo '<div class="no_record" align="center">Thông tin đang cập nhật</div>';?>
        </form>
	</div>
</div>
