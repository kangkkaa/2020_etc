<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">SCHEDULER</a>
            </li>
            <li class="breadcrumb-item active">LIST</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i>SCHEDULER LIST</div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="tablesaw-overflow">
                        <table class="table table-bordered tablesaw" id="" width="100%" cellspacing="0" data-tablesaw-mode="columntoggle">
                            <thead>
                            <tr>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="1">채널</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="2">서버</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="3">프로세스코드</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="4">프로세스코드SUB1</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="5">설명</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="6">period</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="7">파일경로</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="8">사용여부</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="9">나쁜횟수</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="10">위험횟수</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="12">수정/삭제</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($data as $val){ ?>
                                <tr>
                                    <td><a href="/scheduler/scheduler/view/?idx=<?php echo $val['scheduler_info_id']; ?>"><?php echo $val['channel_name']; ?></a></td>
                                    <td><a href="/scheduler/scheduler/view/?idx=<?php echo $val['scheduler_info_id']; ?>"><?php echo $val['server_name']; ?></a></td>
                                    <td><a href="/scheduler/scheduler/view/?idx=<?php echo $val['scheduler_info_id']; ?>"><?php echo $val['process_code']; ?></a></td>
                                    <td><a href="/scheduler/scheduler/view/?idx=<?php echo $val['scheduler_info_id']; ?>"><?php echo $val['process_code_sub1']; ?></a></td>
                                    <td><a href="/scheduler/scheduler/view/?idx=<?php echo $val['scheduler_info_id']; ?>"><?php echo $val['comment']; ?></a></td>
                                    <td><a href="/scheduler/scheduler/view/?idx=<?php echo $val['scheduler_info_id']; ?>"><?php echo $val['period']; ?></a></td>
                                    <td><a href="/scheduler/scheduler/view/?idx=<?php echo $val['scheduler_info_id']; ?>"><?php echo $val['file_path']; ?></a></td>
                                    <td><a href="/scheduler/scheduler/view/?idx=<?php echo $val['scheduler_info_id']; ?>"><?php echo $val['use_yn']; ?></a></td>
                                    <td><a href="/scheduler/scheduler/view/?idx=<?php echo $val['scheduler_info_id']; ?>"><?php echo $val['warning_cnt']; ?></a></td>
                                    <td><a href="/scheduler/scheduler/view/?idx=<?php echo $val['scheduler_info_id']; ?>"><?php echo $val['danger_cnt']; ?></a></td>
                                    <td>
                                        <input type="button" value="수정" class="btn btn btn-primary btn-sm" onclick=goURL("/scheduler/scheduler/modify/?idx=<? echo $val['scheduler_info_id']; ?>")>
                                        <input type="button" value="삭제" class="btn btn btn-success btn-sm" onclick=DelData("/scheduler/scheduler/delete/?idx=<? echo $val['scheduler_info_id']; ?>")>
                                    </td>
                                </tr>
                            <? } ?>
                            <? if($count==0) { ?>
                                <tr>
                                    <td colspan="11">등록된 데이터가 없습니다.</td>
                                </tr>
                            <? } ?>
                            </tbody>
                        </table>
                    </div>
                    <div align="right">
                        <input type="button" value="등록" class="btn btn btn-default btn-sm" onclick=goURL('/scheduler/scheduler/write/')>
                    </div>
                </div>
            </div>
            <div class="card-footer small text-muted"></div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->