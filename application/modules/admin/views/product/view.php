    <div class="onecolumn">
    	<div class="header">
    		<span><?php echo $title ?></span>
    	</div>
        <div class="clear"></div>
        <?php if(count($csv) > 0) { ?>
        <form id="form_data" name="form_data"  method="post">
        <div align="center"  style="margin: 10px 0;">
        <input type="hidden" value="1" name="isSubmit" />
        <input type="submit" name="isUpdate" value="Cập nhật Sản phẩm" />
        </div>
    	<div class="content">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
                        <th style="width:2%">STT</th>
						<th style="width:2%">ID</th>
                        <th style="width:5%">Mã SP</th>
                        <th style="width:2%">Giá mới(VNĐ)</th>
                        <th style="width:2%">Giá khuyến mại(VNĐ)</th>
						
					</tr>
				</thead>
				<tbody>
                    <?php $stt = 1; ?>
                    <?php
                      foreach ($csv as $key =>  $line){
                        echo '<tr>';
                        foreach ($line as $f=>$d){
                           $newF =  trim(str_replace('"', '', $f));
                           $newD =  trim(str_replace('"', '', $d));
                           $newArr = explode(',', $newD);
                     ?>
                           <td align="center"><?php echo $stt++ ?></td>
                           <td align="center"><?php echo $newArr[0] ?></td>
                           <td><?php echo $newArr[1] ?></td>
                           <td><?php echo $newArr[2] ?></td>
                           <td><?php echo $newArr[3] ?></td>
                     <?php      
                        }
                        echo '</tr>';
                      }
                    ?> 
				</tbody>
			</table>
        
		</form>
		<?php } else echo '<div class="no_record" align="center">Có lỗi trong quá trình Import. Vui lòng thử lại</div>';?>
	</div>
</div>