<div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/project/create') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Project mới" title="Project mới" /></a></li>
            </ul>
    	</div>
        <br class="clear" />
    	<div class="content">
            <?php if(isset($project) && $project != null) { ?>
            <form id="form_data" name="form_data"  method="post">
            <table class="data" width="100%" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width:1%;vertical-align:middle">#ID</th>
                        <th style="width:1%;vertical-align:middle">Ảnh đại diện</th>
                        <th style="width:10%;vertical-align:middle">Tên project</th>
                        <th style="width: 5%;vertical-align:middle">Số bài viết</th>
                        <th style="width: 3%;vertical-align:middle">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($project as $key => $value): ?>
                    <tr>
                        <td align="left"><?php echo $value['project_id'] ?></td>
                        <td align="left"><img src="<?php echo $value['project_image'] ?>" width="60" /></td>
                        <td align="left"><a href='<?php echo base_url('admin/project/update?id='.$value['project_id']) ?>'><?php echo $value['project_name'] ?></a></td>
                        <td align="left"><?php echo $value['tuts_number']; ?></td>
                        <td align="center">
                            <a href="<?php echo base_url('admin/project/update?id='.$value['project_id']) ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="Sửa" class="help" title="Sửa" style="vertical-align: middle;"></a>
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