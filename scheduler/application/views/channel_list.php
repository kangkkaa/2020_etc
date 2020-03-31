<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">CHANNEL</a>
            </li>
            <li class="breadcrumb-item active">LIST</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> CHANNEL LIST</div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="tablesaw-overflow">
                        <table class="table table-bordered tablesaw" id="" width="100%" cellspacing="0" data-tablesaw-mode="columntoggle">
                            <thead>
                            <tr>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="1">채널이름</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="2">ACCOUNT_INFO</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="3">수정/삭제</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data as $val){ ?>
                                <tr>
                                    <td><a href="/scheduler/channel/view/?idx=<?php echo $val['channel_id']; ?>"><?php echo $val['channel_name']; ?></a></td>
                                    <td><a href="/scheduler/channel/view/?idx=<?php echo $val['channel_id']; ?>"><?php echo $val['account_info']; ?></a></td>
                                    <td>
                                        <input type="button" value="수정" class="btn btn btn-primary btn-sm" onclick=goURL("/scheduler/channel/modify/?idx=<?php echo $val['channel_id']; ?>")>
                                        <input type="button" value="삭제" class="btn btn btn-success btn-sm" onclick=DelData("/scheduler/channel/delete/?idx=<?php echo $val['channel_id']; ?>")>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if($count['cnt']==0) { ?>
                                <tr>
                                    <td colspan="3">등록된 데이터가 없습니다.</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div align="right">
                        <input type="button" value="등록" class="btn btn btn-default btn-sm" onclick=goURL('/scheduler/channel/write/')>
                    </div>
                </div>
            </div>
            <div class="card-footer small text-muted"></div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
