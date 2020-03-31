<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">SCHEDULER </a>
            </li>
            <li class="breadcrumb-item active">VIEW</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> SCHEDULER VIEW</div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="tablesaw-overflow">
                        <table class="table table-bordered tablesaw" id="" width="100%" cellspacing="0" data-tablesaw-mode="columntoggle">
                            <tr>
                                <td>채널이름</td>
                                <td><?php echo $data['channel_name']?></td>
                            </tr>
                            <tr>
                                <td>서버이름</td>
                                <td> <?php echo $data['server_name']?></td>
                            </tr>
                            <tr>
                                <td>프로세스코드</td>
                                <td><?php echo $data['process_code']?></td>
                            </tr>
                            <tr>
                                <td>프로세스코드SUB1</td>
                                <td> <?php echo $data['process_code_sub1']?></td>
                            </tr>
                            <tr>
                                <td>설명</td>
                                <td> <?php echo $data['comment']?></td>
                            </tr>
                            <tr>
                                <td>period</td>
                                <td> <?php echo $data['period']?></td>
                            </tr>
                            <tr>
                                <td>파일경로</td>
                                <td> <?php echo $data['file_path']?></td>
                            </tr>
                            <tr>
                                <td>사용여부</td>
                                <td> <?php echo $data['use_yn']?></td>
                            </tr>
                            <tr>
                                <td>warning_cnt</td>
                                <td> <?php echo $data['warning_cnt']?></td>
                            </tr>
                            <tr>
                                <td>danger_cnt</td>
                                <td> <?php echo $data['danger_cnt']?></td>
                            </tr>
                        </table>
                    </div>
                    <div align="right">
                        <input type="submit" value="수정" onclick=goURL("/scheduler/scheduler/modify/?idx=<?php echo $data['scheduler_info_id']; ?>") class="btn btn-success"/>
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
