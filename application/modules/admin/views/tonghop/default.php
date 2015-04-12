<div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/tonghop/add') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm danh mục" title="Thêm danh mục" /></a></li>
            </ul>
    	</div>
        <div class="frmSearch" style="padding: 8px; clear: both;">
            <form action="<?php echo base_url('admin/tonghop/search') ?>" method="post" name="formSearch" id="formSearch"  class="formSearch">
                <input type="text" size="45" name="keyword" id="keyword" value="Nhập tiêu đề tin tức cần tìm" onblur="clearText(this)" onfocus="clearText(this)" />
                <input type="submit" onclick="actionSearch('formSearch', 'keyword')" name="btnSearch" id="btnSearch" style="padding: 5px;" value="Tìm kiếm" />
            </form>
        </div>
        <div class="content">
            <?php  if(isset($listnew) && $listnew != NULL){ ?>
            <form  id="form_data" name="form_data"  method="post">
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
                        <th style="width: 5%;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
                    <?php $stt = 1; ?>
                    <?php foreach($listnew as $list_news){ ?>
					<tr class="class_jpage">
						<td align="center">
                            <input type="checkbox" name="cid[]" id="cid" class="item" value="<?php echo $list_news['id'] ?>" />
                        </td>
						<td align="center"><?php echo $stt; ?></td>
						<td align="center"><?php echo $list_news['id']; ?></td>
                        <td align='center'>
                            <img src="<?php echo base_url() ?>uploads/news/news/thumbs/<?php echo $list_news['img']; ?>" style="vertical-align: middle;" />
                        </td>
						<td><?php echo $list_news['title']; ?></td>
                        <td align="center">
                            <?php 
                                if($list_news['active'] == 1){
                            ?>
                            <a href="<?php echo base_url('admin/tonghop/active/'.$list_news['active']).'/'.$list_news['id']; ?>">
                                <img class="status" src="<?php echo base_url() ?>public/admin/images/active.png" alt="Kích hoạt" title="Hiển thị" />
                            </a>
                            <?php }else{ ?>
                            <a href="<?php echo base_url('admin/tonghop/active/'.$list_news['active'].'/'.$list_news['id']) ?>">
                                <img class="status" src="<?php echo base_url() ?>public/admin/images/deactive.png" alt="Không kích hoạt" title="Không hiển thị" />
                            </a>
                            <?php } ?>
                            </td>
                        <td align="center">
                            <?php
                                switch($list_news['post']){
                                    case 1: echo "PHP căn bản"; break;
                                    case 1: echo "PHP nâng cao"; break;
                                    case 1: echo "PHP Framework"; break;
                                    
                                } ; ?></td>
						<td align="center">
							<a href="<?php echo base_url('admin/tonghop/edit/'.$list_news['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="edit" class="help" title="Sửa"></a>
						</td>
					</tr>
                    <?php $stt++; } ?>
				</tbody>
			</table>	
            <?php }else{ echo "<div class='no_record'>Bài viết đang cập nhật</div>"; }
            ?>	
		<!-- Begin pagination -->
			<div class="pagination">
               <?php
                    echo $this->pagination->create_links();
               ?>
			</div>
	  <!-- End pagination -->
      </form>
    </div>
</div>
