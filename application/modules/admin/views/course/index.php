<div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/course/create') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Khóa học mới" title="Khóa học mới" /></a></li>
            </ul>
    	</div>
        <br class="clear" />
    	<div class="content">
            <?php if(isset($course) && $course != null) { ?>
            <form id="form_data" name="form_data"  method="post">
            <table class="data" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td><input type="text" name="id" value="" size="3" /></td>
                    <td><input type="text" name="name" value="" size="45" /></td>
                    <td colspan="5" align="right">
                        <input type="submit" name="filter" value="Filter" />
                    </td>
                </tr>
                <thead>
                    <tr>
                        <th style="width:1%;vertical-align:middle">
                            <a href="<?php echo isset($sortId) ? $sortId : "#"; ?>">#ID</a>
                        </th>
                        <th style="width:10%;vertical-align:middle">
                            <a href="<?php echo isset($sortName) ? $sortName : "#"; ?>">Tên khóa học</a>
                        </th>
                        <th style="width:5%;vertical-align:middle">Học phí</th>
                        <th style="width: 5%;vertical-align:middle">Khuyến mãi</th>
                        <th style="width:5%;vertical-align:middle">Bài viết</th>
                        <th style="width:5%;vertical-align:middle">Video</th>
                        <th style="width: 3%;vertical-align:middle">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($course as $key => $value): ?>
                    <tr>
                        <td align="left"><?php echo $value['id'] ?></td>
                        <td align="left"><a href='<?php echo base_url('admin/course/update?id='.$value['id']) ?>'><?php echo $value['course_name'] ?></a></td>
                        <td align="left"><?php echo number_format($value['course_price'],0); ?></td>
                        <td align="left"><?php echo $value['promotion'] != null ? $value['promotion'] : "Không có"; ?></td>
                        <td align="left"><?php echo $value['article_number']; ?></td>
                        <td align="left"><?php echo $value['video_number'] ?></td>
                        <td align="center">
                            <a href="<?php echo base_url('admin/course/update?id='.$value['id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="Sửa" class="help" title="Sửa" style="vertical-align: middle;"></a>
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