<style>
    .infouser{
        color: #000;
        padding-left: 5px;
        font-size:16px;
        line-height: 22px;
        width: 500px;
    }
    .infouser label{
        width: 120px;
    }
</style>
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
        <form id="form_data" name="form_data"  method="post">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><h3 style="vertical-align: middle;"><a title="Quay lui" href="<?php echo base_url(); ?>admin/cart/">Back</a></h3></li>
            </ul>
    	</div>
                
    	<div class="content">
            <?php
                if(isset($info) && $info != NULL){
                    $info_user = unserialize($info['cart_user']);
                    //var_dump($info_user);
                    foreach($info_user as $key=>$value){
                        echo "<div class='infouser'><label>".$key."</label> : ".$value."</div>";   
                    }
                }
            ?>
        
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th style="width:20%">Tên sản phẩm</th>
                        <th style="width:20%" align="center">Hình ảnh</th>
                        <th style="width:5%">Số lượng</th>
                        <th style="width:10%">Đơn giá</th>
                        <th style="width: 10%;">Thành tiền</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                        if(isset($info) && $info != NULL){
                            $info_cart = unserialize($info['cart_info']);
                            echo "<pre>";
                            //print_r($info_cart);
                            echo "</pre>";
        				    foreach($info_cart as $key=>$value){
                    ?>
                    <tr>
                        <td style="vertical-align: middle; padding-left: 5px;"><?php echo $value['pname']; ?></td>
                        <td align="center" style="vertical-align: middle;"><img src="<?php echo base_url(); ?>uploads/product/product/thumb_<?php echo $value['pimage1']; ?>" height="60" /></td>
                        <td align="center" style="vertical-align: middle;" ><?php echo $value['pro_qty']; ?></td>
                        <td align="center" style="vertical-align: middle;"><?php echo number_format($value['price'],0); ?></td>
                        <td align='center' style="vertical-align: middle;">
						      <?php
                                echo number_format(($value['pro_qty']*$value['price']),0). "VNĐ";
                              ?>
                        </td>
                    </tr>
                <?php }  
                } ?>
        		</tbody>
			</table>
			<div id="chart_wrapper" class="chart_wrapper"></div>
		<!-- End bar chart table-->
        		
		<!-- Begin pagination -->
			<div class="pagination">
				<!--<a href="#">«</a>
				<a href="#" class="active">1</a>
				<a href="#">2</a>
				<a href="#">3</a>
				<a href="#">4</a>
				<a href="#">5</a>
				<a href="#">6</a>
				<a href="#">»</a> -->
			</div>
		<!-- End pagination -->
	</div>
</div>