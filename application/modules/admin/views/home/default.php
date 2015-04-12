
<div class="onecolumn">
    <div class="header">
    <span>Gửi yêu cầu hỗ trợ</span>
    </div>
    <br class="clear"/>
    <div class="content">
    <form action="#" method="post">
        <?php 
              $fck = new FCKeditor('support');
              $fck->BasePath = sBASEPATH;
              $fck->Value  = 'Nhập nội dung cần hỗ trợ';
              $fck->Width  = '100%';
              $fck->Height = 250;
              $fck->ToolbarSet = 'Basic';
              $fck->Create();
        ?>
        <input type="button" name="btnSend" id="btnSend" value="Gửi yêu cầu" />
    </form>
    </div>
</div>
