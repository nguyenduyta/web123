    <div class="onecolumn">
        <div class="header">
    		<span><?php echo $title ?></span>
            <ul id="control">
                <li><a href="<?php echo base_url('admin/tuts/add') ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_add_big.png" alt="Thêm danh mục" title="Thêm danh mục" /></a></li>
            </ul>
    	</div>
        <br class="clear" />
        <div class="content">
            <form action="/admin/tuts/index"  id="form_data" name="form_data"  method="post">
			<table class="data" width="100%" cellpadding="0" cellspacing="0">
				<tr>
                    <td>&nbsp;</td>
                    <td><input type="text" value="" name="news_name" size="28" /></td>
                    <td>
                        <select name="course" style="width:100px;">
                            <option value=""></option>
                            <?php if(isset($course) && $course != null ): 
                                foreach ($course as $courseList): ?>
                            <option value="<?php echo $courseList['id'] ?>"><?php echo $courseList['course_name'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </td>
                    <td>
                        <select style="width:100px;" name="toppic">
                            <option value=""></option>
                            <?php if(isset($toppic) && $toppic != null ): 
                                foreach ($toppic as $toppicList): ?>
                            <option value="<?php echo $toppicList['id'] ?>"><?php echo $toppicList['name'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </td>
                    <td>
                        <select style="width:100px;" name="project">
                            <option value=""></option>
                        </select>
                    </td>
                    <td>&nbsp;</td>
                    <td>
                        <select style="width:100px;" name="user">
                            <option value=""></option>
                            <?php if(isset($user) && $user != null ): 
                                foreach ($user as $userList): ?>
                            <option value="<?php echo $userList['user_id'] ?>"><?php echo $userList['user_name']; ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </td>
                    <td>&nbsp;</td>
                    <td>
                        <select style="width:100px;">
                            <option value=""></option>
                            <option value="">Course name</option>
                            <option value="">Course name</option>
                            <option value="">Course name</option>
                            <option value="">Course name</option>
                            <option value="">Course name</option>
                            <option value="">Course name</option>
                        </select>
                    </td>
                    <td><input type="submit" value="Filter" name="filter" /></td>
                </tr>
                <thead>
					<tr>
                        <th style="width:5%">Images</th>
						<th style="width:25%">Tut name</th>
                        <th style="width:10%">Course</th>
                        <th style="width:10%">Toppic</th>
                        <th style="width:10%">Project</th>
                        <th style="width:5%">Order</th>
                        <th style="width: 5%;">User</th>
                        <th style="width:5%">Status</th>
                        <th style="width: 5%;">Date</th>
                        <th style="width: 3%;">Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php  if(isset($tuts) && $tuts != NULL){
                        foreach ($tuts as $key => $value): ?>
                        <tr>
                            <td><img src="<?php echo $value['news_images']; ?>" style="vertical-align: middle; width: 65px; margin:5px;" /></td>
                            <td style="padding:5px;"><a href="<?php echo base_url('admin/tuts/edit/'.$value['news_id']) ?>/<?php echo isset($page) && $page != null ? $page : "1"; ?>" style="font-size:12px;"><?php echo $value['news_name']; ?></a></td>
                            <td style="padding:5px;"><?php echo $value['course_name'] != null ? $value['course_name'] : "Not Course"; ?></td>
                            <td style="padding:5px;"><?php echo $value['toppic_name'] != null ? $value['toppic_name'] : "Not Toppic"; ?></td>
                            <td style="padding:5px;"><?php echo $value['project_name'] != null ? $value['project_name'] : "Not Project"; ?></td>
                            <td style="padding:5px;"><?php echo $value['news_order']; ?></td>
                            <td style="padding:5px;"><?php echo $value['user_name']; ?></td>
                            <td style="padding:5px;"><?php echo $value['news_active'] == 1 ? "Enable" : "Disable"; ?></td>
                            <td style="padding:5px;"><?php echo date('d/m/Y',$value['news_date']); ?></td>
                            <td align="center">
                                <a href="<?php echo base_url('admin/tuts/edit/'.$value['news_id']) ?>/<?php echo isset($page) && $page != null ? $page : "1"; ?>"><img src="<?php echo base_url() ?>public/admin/images/icon_edit.png" alt="edit" class="help" title="Sửa"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php } else { echo "<tr><td colspan='10' align='center'><p>Không có tuts nào </p></td></tr>"; } ?> 
				</tbody>
			</table>	
		<!-- Begin pagination -->
            <?php if($tuts != null ): ?>
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
