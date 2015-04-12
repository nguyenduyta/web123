<div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/comment/create') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Khóa học mới" title="Khóa học mới" /></a></li>
            </ul>
    	</div>
        <br class="clear" />
    	<div class="content">
            <?php if(isset($course) && $course != null) { ?>
            <form id="form_data" name="form_data"  method="post">
            <table class="data" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="2"></td>
                    <td align="left">
                        <input type="text" name="name" value=""/>
                    </td>
                    <td align="left">
                        <input type="text" name="email" value=""/>
                    </td>
                    <td align="left">
                        <input type="text" name="phone" value=""/>
                    </td>
                    <td align="left">
                        <select name="status">
                            <option value="3"></option>
                            <option value="0">Publish</option>
                            <option value="1">Pendding</option>
                            <option value="2">Disable</option>
                        </select>
                    </td>
                    <td>
                        <input type="submit" name="filter" value="Filter" />
                    </td>
                </tr>
                <thead>
                    <tr>
                        <th style="width:1%;">#ID</th>
                        <th style="width:10%;">Avata</th>
                        <th style="width:5%;">Full name</th>
                        <th style="width: 5%;">Email</th>
                        <th style="width:5%;">Phone</th>
                        <th style="width:5%;">Status</th>
                        <th style="width: 3%;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($course as $key => $value): ?>
                    <tr>
                        <td align="left"><?php echo $value['comment_id'] ?></td>
                        <td align="left"><img src="<?php echo $value['comment_image'] ?>" width="60" /></td>
                        <td align="left"><a href=""><?php echo $value['comment_author'] ?></a></td>
                        <td align="left"><?php echo $value['comment_email'] ?></td>
                        <td align="left"><?php echo $value['comment_phone'] ?></td>
                        <td align="left">
                            <?php 
                                switch ($value['comment_status']) {
                                    case '0':
                                        echo "<span>Publish</span>";
                                        break;
                                    case '1':
                                        echo "<span>Pendding</span>";
                                        break;
                                    case '1':
                                        echo "<span>Disable</span>";
                                        break;
                                }
                             ?>
                        </td>
                        <td align="center">
                            <a href="<?php echo base_url('admin/comment/update?id='.$value['comment_id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="Sửa" class="help" title="Sửa" style="vertical-align: middle;"></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
		<!-- Begin pagination -->
			<div class="pagination">
                
			</div>
		<!-- End pagination -->
		</form>
        <?php } else {  ?>
        <div class="no_record">Thông tin đang cập nhật</div>
        <?php } ?>
	</div>
</div>