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
            return false;
        }
      })
    })
</script>
    <form action="<?php echo base_url(); ?>admin/menunews/delete" id="form_data" name="form_data"  method="post">
    <div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/news/add') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm danh mục" title="Thêm danh mục" /></a></li>
                <li><input type="submit" onclick="return delete_multil_form('item');" name="deleteall" value="" /></li>
            </ul>
    	</div>
        <div class="frmSearch" style="padding: 8px; clear: both;">
            <input type="text" size="45" name="keyword" id="keyword" value="Nhập tên danh mục cần tìm" onblur="clearText(this)" onfocus="clearText(this)" />
            <input type="button" name="btnSearch" id="btnSearch" style="padding: 5px;" value="Tìm kiếm" />
        </div>
        <div class="content">
            <?php 
                if(isset($listnew) && $listnew != NULL){
            ?>
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th style="width:3%"><input type="checkbox" id="check_all" name="check_all"></th>
						<th style="width:3%">STT</th>
						<th style="width:3%">ID</th>
                        <th style="width:10%">Hình đại diện</th>
						<th style="width:20%">Tên bài viết</th>
                        <th style="width:5%">Trạng thái</th>
                        <th style="width:10%">Thuộc danh mục</th>
                        <th style="width:5%">Thứ tự</th>
                        <th style="width: 5%;">Người tạo</th>
                        <th style="width: 5%;">Người sửa</th>
                        <th style="width: 5%;">Ngày tạo</th>
                        <th style="width: 5%;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                        $stt = 1;
                        foreach($listnew as $list_news){
                    ?>
					<tr class="class_jpage">
						<td align="center">
                            <input type="checkbox" name="idnew[]" class="item" value="<?php echo $list_news['news_id'] ?>" />
                            </td>
						<td align="center"><?php echo $stt; ?></td>
						<td align="center"><?php echo $list_news['news_id']; ?></td>
                        <td align='center'>
                            <img src="<?php echo base_url() ?>uploads/news/news/thumbs/<?php echo $list_news['news_images']; ?>" style="vertical-align: middle;" />
                        </td>
						<td><?php echo $list_news['news_name']; ?></td>
                        <td align="center">
                            <?php 
                                if($list_news['news_active'] == 1){
                            ?>
                            <a href="<?php echo base_url('admin/news/active/'.$list_news['news_active']).'/'.$list_news['news_id']; ?>">
                                <img class="status" src="<?php echo base_url() ?>public/admin/images/active.png" alt="Kích hoạt" title="Hiển thị" />
                            </a>
                            <?php }else{ ?>
                            <a href="<?php echo base_url('admin/news/active/'.$list_news['news_active'].'/'.$list_news['news_id']) ?>">
                                <img class="status" src="<?php echo base_url() ?>public/admin/images/deactive.png" alt="Không kích hoạt" title="Không hiển thị" />
                            </a>
                            <?php } ?>
                            </td>
                        <td align="center"><?php echo $list_news['name']; ?></td>
                        <td align="center"><input  type="text"  class="order" value="<?php echo $list_news['news_order']; ?>" size="2" getid="<?php echo $list_news['news_id']; ?>" /></td>
                        <td align="center"><?php echo $list_news['user_name']; ?></td>
                        <td align="center"><?php echo $list_news['user_name']; ?></td>
                        <td align="center"><?php echo date('d-m-Y',$list_news['news_date']); ?></td>
						<td align="center">
							<a href="<?php echo base_url('admin/news/edit/'.$list_news['news_id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="edit" class="help" title="Sửa"></a>
							<a href="<?php echo base_url('admin/news/delete/'.$list_news['news_id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_delete.png" alt="delete" class="help" title="Xóa" ></a>
						</td>
					</tr>
                    <?php $stt++; } ?>
				</tbody>
			</table>	
            <?php
                }else{
                    echo "<p><b>Bài viết đang cập nhật</b></p>";
                }
            ?>	
		<!-- Begin pagination -->
			<div class="pagination">
                <?php
                    if(isset($listnew) && $listnew != NULL){
                ?>
                    <div class="holder"></div>
                <?php      
                    }
                ?>
			</div>
	  <!-- End pagination --></div>
</div>
</form>