    <div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/question/create'); ?>">
                    <img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm danh mục" title="Thêm danh mục" />
                    </a></li>
            </ul>
    	</div>
        <br class="clear" />
        <div class="content">
            <form action=""  id="form_data" name="form_data"  method="post">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<tr>
                    <td><input type="text" value="" name="news_name" size="80" /></td>
                    <td>&nbsp;</td>
                    <td align="right"><input type="submit" value="Filter" name="filter" /></td>
                </tr>
                <thead>
					<tr>
                        <th style="width:25%">Nội dung câu hỏi</th>
                        <th style="width:10%">Trạng thái</th>
                        <th style="width: 3%;">Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php  if(isset($listQuestin) && $listQuestin != NULL){
                        foreach ($listQuestin as $key => $value): ?>
                        <tr>
                            <td style="padding:5px;">
                                <?php echo $value['ques_content']; ?></a>
                            </td>
                            <td style="padding:5px;"><?php echo $value['ques_status'] == 0 ? "Active" : "Disable"; ?></td>
                            <td align="center">
                                <a href="/admin/question/update/<?php echo $value['id']; ?>">Sửa</a> | 
                                <a href="/admin/question/delete/<?php echo $value['id']; ?>">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php } else { echo "<tr><td colspan='10' align='center'><p>Không có đề thi nào</p></td></tr>"; } ?> 
				</tbody>
			</table>	
		<!-- Begin pagination -->
            <?php if(@$tuts != null ): ?>
			<div class="pagination">
               <?php
                    echo $this->pagination->create_links();
               ?>
			</div>
        <?php endif; ?>
	  <!-- End pagination -->
      </form>
    </div>
</div>
