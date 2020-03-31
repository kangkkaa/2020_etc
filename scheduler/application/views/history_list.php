<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">HISTORY</a>
            </li>
            <li class="breadcrumb-item active">LIST</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> HISTORY LIST</div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="tablesaw-overflow">
                        <table class="table table-bordered tablesaw" id="" width="100%" cellspacing="0" data-tablesaw-mode="columntoggle">
                            <thead>
                            <tr>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="1">PROCESS DATA</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="2">스케쥴러</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="3">삭제</th>

                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($data as $val){ ?>
                                <tr>
                                    <td><a href="/scheduler/history/view/?idx=<?php echo $val['scheduler_history_id']; ?>"><?php echo $val['process_date']; ?></a></td>
                                    <td><a href="/scheduler/history/view/?idx=<?php echo $val['scheduler_history_id']; ?>"><?php echo $val['scheduler_info_id']; ?></a></td>
                                    <td>
                                        <input type="button" value="삭제" class="btn btn btn-success btn-sm" onclick=DelData("/scheduler/history/delete/?idx=<?php echo $val['scheduler_history_id']?>")>
                                    </td>
                                </tr>
                            <? } ?>
                            <? if($count['cnt']==0) { ?>
                                <tr>
                                    <td colspan="3">등록된 데이터가 없습니다.</td>
                                </tr>
                            <? } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer small text-muted"></div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
