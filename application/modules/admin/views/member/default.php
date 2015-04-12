    <div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/member/add') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm thành viên" title="Thêm thành viên" /></a></li>
            </ul>
    	</div>
                
        <div class="frmSearch" style="padding: 8px; clear: both;">
            <form action="<?php echo base_url('admin/member/search') ?>" method="post" name="formSearch" id="formSearch"  class="formSearch">
                <input type="text" size="45" name="keyword" id="keyword" value="<?php if(isset($_POST['keyword'])) echo $_POST['keyword']; else echo 'Nhập tên thành viên cần tìm'; ?>" onblur="clearText(this)" onfocus="clearText(this)" />
                <input type="button" onclick="actionSearch('formSearch', 'keyword')" name="btnSearch" id="btnSearch" style="padding: 5px;" value="Tìm kiếm" />
            </form>
        </div>
        
    	<div class="content">
            <form id="form_data" name="form_data"  method="post">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th style="width:3%">STT</th>
						<th style="width:10%">Tên đăng nhập</th>
                        <th style="width:10%">Họ tên đầy đủ</th>
                        <th style="width:10%">Cấp thành viên</th>  
                        <th style="width:5%">Địa chỉ email</th>
                        <th style="width: 5%;">Ngày kích hoạt</th>
                        <th style="width: 5%;">Hình đại diện</th>
                        <th style="width: 5%;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                        if(isset($user) && $user != NULL){
                            $stt =1;
                            foreach($user as $listuser){
                      
                    ?>
					<tr class="class_jpage">
						<td align="center" style="vertical-align: middle;"><?php echo $stt; $stt++; ?></td>
						<td style="vertical-align: middle;"><?php echo $listuser['user_name']; ?></td>
                        <td align='center' style="vertical-align: middle;"><?php echo $listuser['fullname']; ?></td>
                        <td align='left' style="vertical-align: middle;">
                        <?php echo $listuser['name'] ?>
                        </td>
                        <td align="center" style="vertical-align: middle;">
                            <?php echo $listuser['user_email']; ?>
                        </td>
                        <td align="center" style="vertical-align: middle;">
                            <?php echo date('d-m-Y',$listuser['date']); ?>
                        </td>
                        <td align="center" style="vertical-align: middle;">
                            <?php
                                if($listuser['avata'] == ""){
                            ?>
                                <img src="<?php echo base_url()?>uploads/avatar/no-avatar.jpg" />
                            <?php
                                }else{
                            ?>
                            <img src="<?php echo $listuser['avata'];  ?>" width='45' height='45' />
                            <?php } ?>
                        </td>
						<td align="center" style="vertical-align: middle;">
							<a href="<?php echo base_url('admin/member/edit/'.$listuser['user_id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="edit" class="help" title="Edit"></a>
                            <?php if($_SESSION['level'] < 2) { ?>
							<a href="<?php echo base_url('admin/member/delete/'.$listuser['user_id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_delete.png" alt="delete" class="help" title="Delete"></a>
                            <?php } ?>
						</td>
					</tr>
                    <?php
                        }  }
                    ?>
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
	</div>
</div>