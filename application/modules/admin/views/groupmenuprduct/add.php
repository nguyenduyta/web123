    <div class="onecolumn">
        <div class="header">
        	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
            <span style="float:right; margin-right:15px;">
            	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
                	<li><a href="#"></a></li>
                    <li><a href="<?php echo base_url('admin/groupmenuproduct') ?>" title="Back">Quay lại</a></li>
                </ul>
            </span>
        </div>
        <div class="frmSearch" style="padding: 8px; clear: both;">
            
        </div>        
    	<div class="content">
            <form id="form_data" name="form_data"  method="post">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
                <form action="" method="post">
				<tbody>
					<tr>
						<td width='10%'><label>Tên danh mục</label></td>
						<td><input type="text" name="name" id="" value="" size="35" />
                            <?php echo form_error('name') ?>
                        </td>
                    </tr>
                    <tr>
						<td width='10%'><label>Trạng thái</label></td>
						<td>
                        <input type="radio" name="active" id="" value="1" checked="checked" /> Bật&nbsp;&nbsp;
                        <input type="radio" name="active" id="" value="0" /> Tắt&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
						<td><label>&nbsp;</label></td>
						<td>
                            <input type="submit" name="isSubmit" id="" value="Thêm" size="35" />
                            <input type="reset" name="" id="" value="Làm lại" size="35" />
                        </td>
                    </tr>
				</tbody>
                </form>
			</table>
			<div id="chart_wrapper" class="chart_wrapper"></div>
		<!-- End bar chart table-->
		</form>
	</div>
</div>