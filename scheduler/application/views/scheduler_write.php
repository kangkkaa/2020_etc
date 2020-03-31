<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">SCHEDULER</a>
            </li>
            <li class="breadcrumb-item active">WRITE</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> SCHEDULER WRITE</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('/scheduler/write_ok/'); ?>
                        <b><?php echo validation_errors(); ?></b>
                            <div class="form-group input-group">
                                <label>채널</label>
                                <input name="channel_name" id="channel_name" value="<?php echo set_value('channel_name'); ?>"  class="form-control">
                                <input type="hidden" name="channel_id" id="channel_id" value="<?php echo set_value('channel_id'); ?>" >
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick=searchWin("/scheduler/channel/popup",1000,500,"search_word",$("#channel_name").val())><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                            <div class="form-group input-group">
                                <label>서버</label>
                                <input name="server_name" id="server_name" value="<?php echo set_value('server_name'); ?>"  class="form-control">
                                <input type="hidden" name="server_info_id" id="server_info_id" value="<?php echo set_value('server_info_id'); ?>" >
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick=searchWin("/scheduler/server/popup",1000,500,"search_word",$("#server_name").val())><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                            <div class="form-group input-group">
                                <label>Process_code</label>
                                <input name="process_code" id="process_code" value="<?php echo set_value('process_code'); ?>"  class="form-control">
                            </div>
                            <div class="form-group input-group">
                                <label>Process_code_sub1</label>
                                <input name="process_code_sub1" id="process_code_sub1" value="<?php echo set_value('process_code_sub1'); ?>"  class="form-control">
                            </div>
                            <div class="form-group input-group">
                                <label>설명</label>
                                <input name="comment" id="comment" value="<?php echo set_value('comment'); ?>"  class="form-control">
                            </div>
                            <div class="form-group input-group">
                                <label>period</label>
                                <input name="period" id="period" value="<?php echo set_value('period'); ?>"  class="form-control">
                            </div>
                            <div class="form-group input-group">
                                <label>파일경로</label>
                                <input name="file_path" id="file_path" value="<?php echo set_value('file_path'); ?>"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label>사용여부</label>
                                <label class="radio-inline">
                                    <input type="radio" name="use_yn" id="use_yn" value="y" <?php echo set_radio('use_yn', 'y',TRUE); ?>>Y
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="use_yn" id="use_yn" value="n"  <?php echo set_radio('use_yn', 'n' ); ?>">N
                                </label>
                            </div>
                            <div class="form-group input-group">
                                <label>warning_cnt</label>
                                <input name="warning_cnt" id="warning_cnt" value="<?php echo set_value('warning_cnt'); ?>"  class="form-control">
                            </div>
                            <div class="form-group input-group">
                                <label>danger_cnt</label>
                                <input type="text" name="danger_cnt" id="danger_cnt" value="<?php echo set_value('danger_cnt'); ?>"  class="form-control">
                            </div>
                        <div align="right">
                            <input type="button" value="등록" onclick="submitChk(this.form)" class="btn btn-success"/>
                            <input type="button" value="목록" onclick=goURL('/scheduler/scheduler/') class="btn btn-danger"/>
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
        if(frm.channel_id.value=="" && frm.channel_name.value==""){
            alert("채널 항목은 필수항목입니다.\n검색 후 선택해주세요.");
            frm.channel_name.focus();
            return false;
        }
        if(frm.channel_id.value=="" && frm.channel_name.value!=""){
            alert("채널 항목은 검색 후 선택해주세요.");
            frm.channel_name.focus();
            return false;
        }
        if (isNaN(frm.channel_id.value)!==false) {
            alert("채널 항목은 검색 후 선택해주세요.");
            frm.channel_name.focus();
            return false;
        }
        if(frm.server_info_id.value=="" && frm.server_name.value==""){
            alert("서버 항목은 필수항목입니다.\n검색 후 선택해주세요.");
            frm.server_name.focus();
            return false;
        }
        if(frm.server_info_id.value=="" && frm.server_name.value!=""){
            alert("서버 항목은 검색 후 선택해주세요.");
            frm.server_name.focus();
            return false;
        }
        if (isNaN(frm.server_info_id.value)!==false) {
            alert("서버 항목을 검색 후 선택해주세요.");
            frm.server_name.focus();
            return false;
        }

        if(frm.process_code.value==""){
            alert("process_code 항목은 필수항목입니다.");
            frm.process_code.focus();
            return false;
        }
        if(frm.process_code.length>50){
            alert("process_code 항목의 길이가 초과되었습니다.");
            frm.process_code.focus();
            return false;
        }
        if(frm.process_code_sub1.value==""){
            alert("process_code_sub1 항목은 필수항목입니다.");
            frm.process_code_sub1.focus();
            return false;
        }
        if(frm.process_code_sub1.length>50){
            alert("process_code_sub1 항목의 길이가 초과되었습니다.");
            frm.process_code_sub1.focus();
            return false;
        }
        if(frm.comment.value==""){
            alert("설명 항목은 필수항목입니다.");
            frm.comment.focus();
            return false;
        }
        if(frm.comment.length>100){
            alert("설명 항목의 길이가 초과되었습니다.");
            frm.comment.focus();
            return false;
        }
        if(frm.file_path.value==""){
            alert("파일경로 항목은 필수항목입니다.");
            frm.file_path.focus();
            return false;
        }
        if(frm.use_yn.value==""){
            alert("사용여부 항목은 필수항목입니다.");
            frm.use_yn.focus();
            return false;
        }
        if(frm.warning_cnt.value==""){
            alert("warning_cnt 항목은 필수항목입니다.");
            frm.warning_cnt.focus();
            return false;
        }
        if (isNaN(frm.warning_cnt.value)!==false) {
            alert("warning_cnt 항목은 정수만 입력 가능합니다.");
            frm.warning_cnt.focus();
            return false;
        }
        if(frm.danger_cnt.value==""){
            alert("danger_cnt 항목은 필수항목입니다.");
            frm.danger_cnt.focus();
            return false;
        }
        if (isNaN(frm.danger_cnt.value)!==false) {
            alert("danger_cnt 항목은 정수만 입력 가능합니다.");
            frm.danger_cnt.focus();
            return false;
        }

        frm.submit();
    }
</script>