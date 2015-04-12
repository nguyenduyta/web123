    <div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/exam/create'); ?>">
                    <img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm danh mục" title="Thêm danh mục" />
                    </a></li>
            </ul>
    	</div>
        <br class="clear" />
        <div class="content">
            <form action="/admin/tuts/index"  id="form_data" name="form_data"  method="post">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<tr>
                    <td><input type="text" value="" name="news_name" size="80" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="submit" value="Filter" name="filter" /></td>
                </tr>
                <thead>
					<tr>
                        <th style="width:25%">Tên bài thi</th>
                        <th style="width:10%">Số câu hỏi</th>
                        <th style="width:10%">Trạng thái</th>
                        <th style="width: 3%;">Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php  if(isset($examList) && $examList != NULL){
                        foreach ($examList as $key => $value): ?>
                        <tr>
                            <td style="padding:5px;">
                                <a href="/admin/exam/update/<?php echo $value['id']; ?>" title="<?php echo $value['name']; ?>" style="font-style:italic; font-size:13px;">
                                <?php echo $value['name']; ?></a>
                            </td>
                            <td style="padding:5px;"></td>
                            <td style="padding:5px;"></td>
                            <td align="center">
                                <a href="/admin/exam/update/<?php echo $value['id']; ?>">Sửa</a>
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
