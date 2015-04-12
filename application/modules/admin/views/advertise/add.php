<script type="text/javascript">
    function toggleDiv(divId) {
       $("#"+divId).toggle();
    }
</script>
<div class="onecolumn">
<div class="header">
	<span style="float:left; width:85%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
        	<li><a href="#"></a></li>
            <li><a href="<?php echo base_url('admin/advertise') ?>" title="Back">Quay lại</a></li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
    	<form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
        <table class="data" width="100%" cellpadding="0" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<!--<tr>
                	<td width="125"><label>Vị trí quảng cáo (<span class="require">*</span>)</label></td>
                    <td>
                        <?php if(count($adsposition) > 0) { ?>
                        <select name="adsposition" id="adsposition" >
                            <?php foreach($adsposition as $key=>$val) { ?>
                                <?php if(isset($_POST['adsposition']) && $_POST['adsposition'] == $val['id']) { ?>
                                <option value="<?php echo $val['id'] ?>" selected="selected"><?php echo $val['posname'] ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $val['id'] ?>"><?php echo $val['posname'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <?php } ?>
                        <a href="javascript:toggleDiv('myContent');" style="background-color: #424242; color: #fff; overflow: hidden; padding: 5px;">Ẩn/Hiện kích thước</a>
                        <div id="myContent" style="padding: 5px 10px; display: block;">
                           <table width="50%" align="left">
                                <tr>
                                    <td><strong>Loại quảng cáo</strong></td>
                                    <td><strong>Kích thước khuyến cáo</strong></td>
                                </tr>
                               
                                <tr>
                                    <td>Chạy dọc 2 bên</td>
                                    <td>Kích thước: 128x400 (px)</td>
                                </tr>
                                
                                <tr>
                                    <td>Quảng cáo bên phải</td>
                                    <td>Kích thước: 258xauto (px)</td>
                                </tr>
                                
                                <tr>
                                    <td>Quảng cáo Popup</td>
                                    <td>Kích thước: 638x342 (px)</td>
                                </tr>
                                
                                <tr>
                                    <td>Quảng cáo Góc</td>
                                    <td>Kích thước: 300x280 (px)</td>
                                </tr>
                           </table>
                        </div>
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Loại quảng cáo</label></td>
                    <td>
                        <select name="adstype" id="adstype">
                            <option value="1">Image</option>
                            <option value="2">Flash</option>
                            <option value="3">Media</option>
                        </select>   
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Mở web</label></td>
                    <td>
                        <select name="open" id="open">
                            <option value="1">Mở tab mới</option>
                            <option value="2">Mở trên trang</option>
                        </select>   
                    </td>
				</tr>
                -->
                <tr>
                	<td width="125"><label>Tên khách hàng</label></td>
                    <td>
                        <input type="text" id="adsname"  name="adsname" value="<?php if(isset($_POST['adsname'])) echo $_POST['adsname']; ?>" size="45"  />
                        <?php echo form_error('adsname') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Hình ảnh</label></td>
                    <td>
                        <input type="text" id="adsfile"  name="adsfile" value="<?php if(isset($_POST['adsfile'])) echo $_POST['adsfile']; ?>" size="40"  />
                        <a onclick="PopupCenter('<?php echo base_url() ?>ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=form&elementId=adsfile', '', 800, 500)" >
                            <img src="<?php echo base_url() ?>public/admin/images/upload.gif" alt="Upload" title="Tải ảnh" style="cursor: pointer;" />
                        </a>
                         <?php echo form_error('adsfile') ?> 
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Thứ tự</label></td>
                    <td>
                        <input type="text" id="adsorder"  name="adsorder" value="<?php if(isset($_POST['adsorder'])) echo $_POST['adsorder']; else {echo 1;} ?>" size="3"  />
                        <?php echo form_error('adsorder') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Kích thước</label></td>
                    <td>
                        Chiều rộng: <input type="text" id="width"  name="width" value="<?php if(isset($_POST['width'])) echo $_POST['width']; ?>" size="3"  /> px 
                         <?php echo form_error('width') ?> 
                        Chiều cao:  <input type="text" id="height"  name="height" value="<?php if(isset($_POST['height'])) echo $_POST['height']; ?>" size="3"  /> px 
                        <?php echo form_error('height') ?>
                        (Nếu giá trị bằng 0 hoặc không nhập hệ thống sẽ lấy kích thước mặc định)  
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Liên kết tới</label></td>
                    <td>
                        <input type="text" id="adslink"  name="adslink" value="http://<?php if(isset($_POST['adslink'])) echo $_POST['adslink']; ?>" size="45"  />
                        <?php echo form_error('adslink') ?>    
                    </td>
				</tr>
                <tr>
                	<td width="125"><label>Trạng thái</label></td>
                    <td>
                        <select name="adsactive" id="adsactive">
                            <option value="1" <?php if(isset($_POST['active']) && $_POST['active'] == 1) echo 'selected="selected"'; ?>>Hiển thị</option>
                            <option value="0" <?php if(isset($_POST['active']) && $_POST['active'] == 0) echo 'selected="selected"'; ?>>Không hiển thị</option>
                        </select>
                    </td>
				</tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="hidden" name="isSubmit" value="1" />
                        <input type="submit" name="btnAdd" value="Thêm mới" />
                        <input type="reset" name="btnReset" value="Nhập lại" />
                    </td>
                </tr>
			</tbody>
		</table>
	<!-- End bar chart table-->
	</form>
  </div>
</div>
</div>