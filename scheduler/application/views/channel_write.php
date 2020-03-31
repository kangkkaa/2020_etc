<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">CHANNEL</a>
            </li>
            <li class="breadcrumb-item active">WRITE</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> CHANNEL WRITE</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('/channel/write_ok/'); ?>
                        <b><?php echo validation_errors(); ?></b>
                            <div class="form-group input-group">
                                <label>채널이름</label>
                                <input name="channel_name" id="channel_name" value="<?php echo set_value('channel_name'); ?>" class="form-control" >
                            </div>
                            <div class="form-group input-group">
                                <label>ACCOUNT_INFO</label>
                                <input type="text" name="account_info" value="<?php echo set_value('account_info'); ?>" id="account_info" class="form-control">
                            </div>
                            <div align="right">
                            <input type="button" value="등록" onclick="submitChk(this.form)" class="btn btn-success"/>
                            <input type="button" value="목록" onclick=goURL('/scheduler/channel/') class="btn btn-danger"/>
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

        if(frm.channel_name.value==""){
            alert("채널이름 항목은 필수항목입니다.");
            frm.channel_name.focus();
            return false;
        }
        if(frm.channel_name.length>50){
            alert("채널이름 항목의 길이가 초과되었습니다.");
            frm.channel_name.focus();
            return false;
        }
        if(frm.account_info.length>100){
            alert("ACCOUNT_INFO 항목의 길이가 초과되었습니다.");
            frm.account_info.focus();
            return false;
        }
        if (frm.account_info.value.replace(/[0-9a-zA-Z_]/g,'').length > 0) {
            alert("ACCOUNT_INFO 항목은 영문,숫자,밑줄(_)만 사용이 가능합니다.");
            frm.account_info.focus();
            return false;
        }
        frm.submit();
    }
</script>