<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">SERVER</a>
            </li>
            <li class="breadcrumb-item active">LIST</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> SERVER LIST</div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="tablesaw-overflow">
                        <table class="table table-bordered tablesaw" id="" width="100%" cellspacing="0" data-tablesaw-mode="columntoggle">
                            <thead>
                            <tr>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="1">서버이름</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="2">서버아이피</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="3">서버설명</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="4">수정/삭제</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($data as $val){ ?>
                                <tr>
                                    <td><a href="/scheduler/server/view/?idx=<?php echo $val['server_info_id']; ?>"><?php echo $val['server_name']; ?></a></td>
                                    <td><a href="/scheduler/server/view/?idx=<?php echo $val['server_info_id']; ?>"><?php echo $val['server_ip']; ?></a></td>
                                    <td><a href="/scheduler/server/view/?idx=<?php echo $val['server_info_id']; ?>"><?php echo $val['server_comment']; ?></a></td>
                                    <td>
                                        <input type="button" value="수정" class="btn btn btn-primary btn-sm" onclick=goURL("/scheduler/server/modify/?idx=<? echo $val['server_info_id']; ?>")>
                                        <input type="button" value="삭제" class="btn btn btn-success btn-sm" onclick=DelData("/scheduler/server/delete/?idx=<? echo $val['server_info_id']; ?>")>
                                    </td>
                                </tr>
                            <? } ?>
                            <? if($count['cnt']==0) { ?>
                                <tr>
                                    <td colspan="4">등록된 데이터가 없습니다.</td>
                                </tr>
                            <? } ?>
                            </tbody>
                        </table>
                    </div>
                    <div align="right">
                        <input type="button" value="등록" class="btn btn btn-default btn-sm" onclick=goURL('/scheduler/server/write/')>
                    </div>
                </div>
            </div>
            <div class="card-footer small text-muted"></div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
