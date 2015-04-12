<div class="onecolumn">
        <div class="header">
            <span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/video/create') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Khóa học mới" title="Khóa học mới" /></a></li>
            </ul>
        </div>
        <br class="clear" />
        <div class="content">
            <?php if(isset($course) && $course != null) { ?>
            <form id="form_data" name="form_data"  method="post">
            <table class="data" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td><input type="text" name="id" value="" size="3" /></td>
                    <td>&nbsp;</td>
                    <td><input type="text" name="name" value="" size="45" /></td>
                    <td colspan="4" align="right">
                        <input type="submit" name="filter" value="Filter" />
                    </td>
                </tr>
                <thead>
                    <tr>
                        <th style="width:1%;vertical-align:middle">
                            #ID
                        </th>
                        <th style="width:1%;vertical-align:middle">Images</th>
                        <th style="width:10%;vertical-align:middle">
                            <a href="<?php echo isset($sortName) ? $sortName : "#"; ?>">Tên video</a>
                        </th>
                        <th style="width:5%;vertical-align:middle">Khóa học</th>
                        <th style="width: 5%;vertical-align:middle">Toppic</th>
                        <th style="width:5%;vertical-align:middle">User</th>
                        <th style="width: 3%;vertical-align:middle">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($course as $key => $value): ?>
                    <tr>
                        <td align="left"><?php echo $value['video_id'] ?></td>
                        <td align="left"><img src="<?php echo $value['video_image'] != null ? $value['video_image'] : "/uploads/suntech/default_image.png" ?>" width="80"/></td>
                        <td align="left"><a href='<?php echo base_url('admin/video/update?id='.$value['video_id']) ?>'><?php echo $value['video_name'] ?></a></td>
                        <td align="left"><?php echo $value['course_name']; ?></td>
                        <td align="left"><?php echo $value['name']; ?></td>
                        <td align="left"><?php echo $value['user_name']; ?></td>
                        <td align="center">
                            <a href="<?php echo base_url('admin/video/update?id='.$value['video_id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="Sửa" class="help" title="Sửa" style="vertical-align: middle;"></a>
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