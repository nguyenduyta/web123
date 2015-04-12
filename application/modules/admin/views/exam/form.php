<div class="onecolumn">
<form id="form_data" name="form_data" action="" method="post" enctype="multipart/form-data">
<div class="header">
	<span style="float:left; width:70%;"><?php if(isset($title)){ echo $title; } ?></span>
    <span style="float:right; margin-right:15px;">
    	<ul id="control" style="margin:0px; padding:0px; list-style:none;">
            <li>
                <input type="hidden" name="isSubmit" value="1" />
                <input type="submit" name="btnAdd" value="Save" />&nbsp;
                <input type="reset" name="btnReset" value="Cancel" onclick="location.href='/admin/exam'" />
            </li>
        </ul>
    </span>
</div>
<br class="clear"/>
<div class="content" style="min-height:400px;">
    <div class="gt">
        <table class="data" width="100%" cellpadding="0">
            <tr>
                <td align="center">Chú ý: (<span class="require">*</span>) bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table class="data" width="100%" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
          <td width="125"><label>Tên bài thi(<span class="require">*</span>)</label></td>
            <td>
              <input type="text" id="name"  name="name" size="60" value="<?php echo  isset($infoExam['name']) ? $infoExam['name'] : set_value("name"); ?>"  size="45" />
              <?php echo form_error('name') ?>
            </td>
				</tr>
        <tr>
          <td width="125"><label>Ngày thi</label></td>
          <td style="height:40px;">
              <input id="datepicker" name="enable_date" value="<?php echo  isset($infoExam['enable_date']) ? $infoExam['enable_date'] : set_value("enable_date"); ?>" style="width:150px;" />
          </td>
        </tr>
        <tr>
          <td width="125" style="vertical-align:middle"><label>Giới thiệu</label></td>
          <td>
            <?php 
                $info_desc = isset($infoExam['info_desc']) && $infoExam['info_desc'] != null 
                                ? $infoExam['info_desc'] : $this->input->post("info_desc");
                $fck = new FCKeditor('info_desc');
                $fck->BasePath = sBASEPATH;
                $fck->Value  = $info_desc;
                $fck->Width  = '100%';
                $fck->Height = 180;
                $fck->ToolbarSet = 'Basic';
                $fck->Create();
            ?>
          </td>
        </tr>
			</tbody>
		</table>
	<!-- End bar chart table-->
  </div>
</div>
</form>
</div>
    <base href="http://demos.telerik.com/kendo-ui/datepicker/index">
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.318/styles/kendo.common-material.min.css" />
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.318/styles/kendo.material.min.css" />
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.318/styles/kendo.dataviz.min.css" />
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2015.1.318/styles/kendo.dataviz.material.min.css" />
    <script src="http://cdn.kendostatic.com/2015.1.318/js/jquery.min.js"></script>
    <script src="http://cdn.kendostatic.com/2015.1.318/js/kendo.all.min.js"></script>
    <script>
            $(document).ready(function() {
                // create DatePicker from input HTML element
                $("#datepicker").kendoDatePicker({
                    format: "yyyy-MM-dd"
                });
                $("#monthpicker").kendoDatePicker({
                    // defines the start view
                    start: "year",
                    // defines when the calendar should return date
                    depth: "year",
                    // display month and year in the input
                    format: "YYYY MMMM DDDD "
                });
            });
    </script>