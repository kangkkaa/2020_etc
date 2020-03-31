<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">SERVER</a>
            </li>
            <li class="breadcrumb-item active">VIEW</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> SERVER VIEW</div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="tablesaw-overflow">
                        <table class="table table-bordered tablesaw" id="" width="100%" cellspacing="0" data-tablesaw-mode="columntoggle">
                            <tr>
                                <td>서버이름</td>
                                <td> <?php echo $data['server_name']?></td>
                            </tr>
                            <tr>
                                <td>서버아이피</td>
                                <td><?php echo $data['server_ip']?></td>
                            </tr>
                            <tr>
                                <td>설명</td>
                                <td><?php echo $data['server_comment']?></td>
                            </tr>
                        </table>
                    </div>
                    <div align="right">
                        <input type="submit" value="수정" onclick=goURL("/scheduler/server/modify/?idx=<?php echo $data['server_info_id']; ?>") class="btn btn-success"/>
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
