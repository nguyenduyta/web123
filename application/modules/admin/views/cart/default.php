<script type="text/javascript">
    $(document).ready(function(){
        $('.order').focusout(function(){
        var confirmBox;
        var current = $(this).val();
        if(isNaN(current)){
            alert("Thứ tự phải là số. Vui lòng kiểm tra lại");
            return false;
        }
        confirmBox = confirm('Bạn có muốn thay đổi không');
        if(confirmBox == true){
            var order = $(this).val();
            var id = $(this).attr('getid');  
            $.ajax({
                url:"http://192.168.1.104/adminngc1/admin/menunews/sort/",
                type: "POST",
                data:"order="+order+"&id="+id,
                async:false, 
                success: function(kq){
                }
            });
            location.href="http://192.168.1.104/adminngc1/admin/menunews";
        }else{
            location.href="http://192.168.1.104/adminngc1/admin/menunews";
        }
      })
      
    })
</script>
    <div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="javascript:void(0)" onclick="actionDelete('form_data')"><img src="<?php echo base_url() ?>public/admin/images/icon_delete_all.png" alt="Xóa tất cả" title="Xóa tất cả" /></a></li>
            </ul>
    	</div>
        
        <div class="frmSearch" style="padding: 8px; clear: both;">
            <form action="<?php echo base_url('admin/cart/search') ?>" method="post" name="formSearch" id="formSearch"  class="formSearch">
                <input type="text" size="45" name="keyword" id="keyword" value="<?php if(isset($_POST['keyword'])) echo $_POST['keyword']; else echo 'Nhập tiêu đề đơn hàng cần tìm'; ?>" onblur="clearText(this)" onfocus="clearText(this)" />
                <input type="button" onclick="actionSearch('formSearch', 'keyword')" name="btnSearch" id="btnSearch" style="padding: 5px;" value="Tìm kiếm" />
            </form>
        </div>
                
    	<div class="content">
            <?php if(isset($cartinfo) && $cartinfo != NULL){ ?>
            <form id="form_data" name="form_data"  method="post">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th style="width:3%" align="center"><input type="checkbox" id="check_all" name="check_all"></th>
						<th style="width:3%" align="center">STT</th>
						<th style="width:3%" align="center">ID</th>
						<th style="width:20%">Tên khách hàng</th>
                        <th style="width:20%" align="center">Địa chỉ email</th>
                        <th style="width:10%">Số điện thoại</th>
                        <th style="width:10%">Ngày gửi</th>
                        <th style="width: 5%;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
                <?php
                    $info = array();
                    $stt = 1;
				    foreach($cartinfo as $key=>$value){
                    $info = unserialize($value['cart_user']);
                ?>
                    <tr class="class_jpage">
                        <td align="center"><input type="checkbox" name="cid[]" id="cid" class="item" value="<?php echo $value['cart_id'] ?>"></td>
                        <td align="center"><?php echo $stt++; ?></td>
                        <td align="center"><?php echo $value['cart_id']; ?></td>
                        <td><a href="<?php echo base_url(); ?>admin/cart/detail/<?php echo $value['cart_id'];  ?>" alt="delete" class="help" title="Xem chi tiết đơn hàng của: <?php echo $info['Tên khác hàng']; ?>" ><?php echo $info['Tên khác hàng']; ?></a></td>
                        <td align="center"><?php echo $info['Địa chỉ email']; ?></td>
                        <td align="center"><?php echo $info['Số điện thoại']; ?></td>
                        <td align="center"><?php echo date('d-m-Y',$value['cart_id']); ?></td>
                        <td align='center'>
							<a href="<?php echo base_url('admin/cart/delete/'.$value['cart_id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_delete.png" alt="delete" class="help" title="Delete"></a>
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
		</form>
        <?php } else { ?>
        <div class="no_record">No record</div>
        <?php } ?>
	</div>
</div>