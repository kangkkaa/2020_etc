<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">SERVER</a>
            </li>
            <li class="breadcrumb-item active">MODIFY</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> SERVER MODIFY</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('/server/modify_ok/'); ?>
                        <b><?php echo validation_errors(); ?></b>
                        <input type="hidden" name="idx" id="idx" value="<?php if(!set_value('idx')) echo $_GET['idx']; else echo set_value('idx');?>">
                        <div class="form-group input-group">
                            <label>서버이름</label>
                            <input type="text" name="server_name" id="server_name" value="<?php if(!set_value('server_name')) echo $data['server_name']; else echo set_value('server_name'); ?>" class="form-control" >
                        </div>
                        <div class="form-group input-group">
                            <label>서버아이피</label>
                            <input type="text" name="server_ip" id="server_ip" value="<?php if(!set_value('server_ip')) echo $data['server_ip']; else echo set_value('server_ip'); ?>" class="form-control" >
                        </div>
                        <div class="form-group input-group">
                            <label>설명</label>
                            <input type="text" name="server_comment" id="server_comment" value="<?php if(!set_value('server_comment')) echo $data['server_comment']; else echo set_value('server_comment'); ?>" class="form-control">
                        </div>
                        <div align="right">
                            <input type="button" value="등록" onclick="submitChk(this.form)" class="btn btn-success"/>
                            <input type="button" value="목록" onclick=goURL('/scheduler/server/') class="btn btn-danger"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer small text-muted"></div>
        </div>
    </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->
<script type="text/javascript">
    function submitChk(frm){
        var ipReg =  /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/

        if(frm.server_name.value==""){
            alert("서버이름 항목은 필수항목입니다.");
            frm.server_name.focus();
            return false;
        }
        if(frm.server_name.length>50){
            alert("서버이름 항목의 길이가 초과되었습니다.");
            frm.server_name.focus();
            return false;
        }
        if(frm.server_ip.value==""){
            alert("서버아이피 항목은 필수항목입니다.");
            frm.server_ip.focus();
            return false;
        }
        if(frm.server_ip.length>14){
            alert("서버아이피 항목의 길이가 초과되었습니다.");
            frm.server_ip.focus();
            return false;
        }
        if(!ipReg.test(frm.server_ip.value)){
            alert("서버아이피 항목의 형식이 맞지 않습니다.");
            frm.server_ip.focus();
            return false;
        }
        if(frm.server_comment.value==""){
            alert("설명 항목은 필수항목입니다.");
            frm.server_comment.focus();
            return false;
        }
        if(frm.server_name.length>100){
            alert("설명 항목의 길이가 초과되었습니다.");
            frm.server_name.focus();
            return false;
        }
        frm.submit();
    }
</script>