<script type="text/javascript">
    $(document).ready(function(){
        $("#ques_content").val();

        var i = <?=@$numberAnswer+1?>;

        $('#add_answer').click(function(){

            $('<tr><td width="125" style="vertical-align:middle"><label>Đáp án <span class="answer_number">'+i+'</span></label><input required type="radio" value="'+(i-1)+'" name="answerchoose" /><button class="delete_answer">Xóa</button></td><td><?php $fck = new FCKeditor("answer'+i+'","answer[]");$fck->BasePath = sBASEPATH;$fck->Value  = "";$fck->Width  = "100%";$fck->Height = 120;$fck->ToolbarSet = "Basic";$fck->Create();?></td></tr>').insertBefore('.btn-add');
            
            i++;
            
            return false;

        });

        $(document).on('click','.delete_answer',function(){

            $(this).parents('tr:first').remove();

            i = 0;
            $('#question input[type=radio]').each(function(){
                $(this).val(i);
                $(this).parent().find('.answer_number').text(i+1);
                i++;
            })
            i++;
        });
    })
</script>
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
                <td align="center">Chú ý: (<span class="require">*</span>)bắt buộc nhập thông tin</td>
            </tr>
        </table>
		<table id="question" class="data" width="100%" cellpadding="0" cellspacing="0">
        		<tbody>
        		<tr>
                  <td width="125" style="vertical-align:middle;">
                    <label>Nội dung câu hỏi&nbsp;(<span class="require">*</span>)</label></td>
                    <td>
                      <?php 
                        $info_desc = isset($infoQuestion['ques_content']) && $infoQuestion['ques_content'] != null 
                                        ? $infoQuestion['ques_content'] : $this->input->post("ques_content");
                        $fck = new FCKeditor('ques_content');
                        $fck->BasePath = sBASEPATH;
                        $fck->Value  = $info_desc;
                        $fck->Width  = '100%';
                        $fck->Height = 180;
                        $fck->ToolbarSet = 'Basic';
                        $fck->Create();
                      ?>
                      <!--<?php echo form_error('ques_content') ?>-->
                      <p style="color:red;"><?php echo isset($errorQuestion) ? $errorQuestion : ""; ?></p>
                    </td>
        		</tr>
                <?php
                $i = 1;
                if(isset($infoQuestion['answer']) && is_array($infoQuestion['answer']) && !empty($infoQuestion['answer'])){
                    foreach ($infoQuestion['answer'] as $item) {
                ?>
                <tr>
                  <td width="125" style="vertical-align:middle"><label>Đáp án <span class="answer_number"><?=@$i?></span></label>
                    <input required type="radio" value="<?=@$i-1?>" <?php if(@$item['status'] == 1) echo "checked"?> name="answerchoose" />
                    <?php if($i > 2) echo '<button class="delete_answer">Xóa</button>'?>
                  </td>
                  <td>
                    <?php 
                        $fck = new FCKeditor('answer'.@$i++,'answer[]');
                        $fck->BasePath = sBASEPATH;
                        $fck->Value  = @$item['ans_content'];
                        $fck->Width  = '100%';
                        $fck->Height = 120;
                        $fck->ToolbarSet = 'Basic';
                        $fck->Create();
                    ?>
                  </td>
                </tr>
                <?php
                } }else{
                ?>
                <tr>
                  <td width="125" style="vertical-align:middle"><label>Đáp án <span class="answer_number">1</span></label>
                    <input required type="radio" value="0" name="answerchoose" />
                  </td>
                  <td>
                    <?php 
                        $fck = new FCKeditor('answer'.@$i++,'answer[]');
                        $fck->BasePath = sBASEPATH;
                        $fck->Value  = "";
                        $fck->Width  = '100%';
                        $fck->Height = 120;
                        $fck->ToolbarSet = 'Basic';
                        $fck->Create();
                    ?>
                  </td>
                </tr>
                <tr>
                  <td width="125" style="vertical-align:middle"><label>Đáp án <span class="answer_number">2</span></label>
                    <input required type="radio" value="1" name="answerchoose" />
                  </td>
                  <td>
                    <?php 
                        $fck = new FCKeditor('answer2','answer[]');
                        $fck->BasePath = sBASEPATH;
                        $fck->Value  =  "";
                        $fck->Width  = '100%';
                        $fck->Height = 120;
                        $fck->ToolbarSet = 'Basic';
                        $fck->Create();
                    ?>
                  </td>
                </tr>
                <?php
                }
                ?>
                 
                <tr class="btn-add">
                    <td width="125" style="vertical-align:middle">
                        <button id="add_answer">Add answer</button>
                    </td>
                    <td><p style="color:red;"><?php echo isset($errorAnswer) ? $errorAnswer : ""; ?></p></td>
                </tr>
                <tr>
                      <td width="125" style="vertical-align:middle"><label>Thuộc đề thi</label></td>
                      <td> 
                         <ul>
                            <?php 
                                if (isset($examList) && $examList != null):
                                    foreach ($examList as $key => $value) {
                                        if(isset($exam) && $exam != null ) {
                                            if(in_array($value['id'], $exam)) {
                                                $checked = "checked='checked'";
                                            } else {
                                                $checked = "";
                                            }
                                        } else {
                                            $checked = "";
                                        }
                                        echo '<li><input type="checkbox" name="exam[]" value="'.$value['id'].'" '.$checked.' />'.$value['name'].'</li>';
                                    }
                                endif;
                            ?>
                         </ul>
                         <p style="color:red;"><?php echo isset($errorExam) ? $errorExam : ""; ?></p>
                      </td>
                </tr>
                <tr>
                    <td width="125" style="vertical-align:middle"><label>Status</label></td>
                    <td>
                        <select name="ques_status">
                            <option value="0" selected>Enable</option>
                            <option value="1">Disable</option>
                        </select>
                    </td>
                </tr>
		  </tbody>
		</table>
	<!-- End bar chart table-->
  </div>
</div>
</form>
</div>