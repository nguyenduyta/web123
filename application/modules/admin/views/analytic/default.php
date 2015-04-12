<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin') ?>" title="Back">Quay lại</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt" style="float: left; width: 50%;">
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="200"><label>Tổng số sản phẩm</label></td>
                    <td>
                        <?php echo $product ?>
                    </td>
				</tr>
				<tr>
                	<td width="200"><label>Tổng số tin tức</label></td>
                    <td>
                        <?php echo $news ?>
                    </td>
				</tr>
				<tr>
                	<td width="200"><label>Tổng số bài viết</label></td>
                    <td>
                        <?php echo $post ?>
                    </td>
				</tr>
				<tr>
                	<td width="200"><label>Tổng số danh mục sản phẩm</label></td>
                    <td>
                        <?php echo $menuproduct ?>
                    </td>
				</tr>
				<tr>
                	<td width="200"><label>Tổng số danh mục tin tức</label></td>
                    <td>
                        <?php echo $menunews ?>
                    </td>
				</tr>
				<tr>
                	<td width="200"><label>Tổng số khách hàng</label></td>
                    <td>
                        <?php echo $customer ?>
                    </td>
				</tr>
			</tbody>
		</table>
    </div>
    
    <div class="gt" style="float: right; width: 50%;">
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
                	<td width="200"><label>Tổng số đơn hàng</label></td>
                    <td>
                        0
                    </td>
				</tr>
				<tr>
                	<td width="200"><label>Tổng số đơn hàng mới</label></td>
                    <td>
                        0
                    </td>
				</tr>

			</tbody>
		</table>
    </div>
</div>
</div>