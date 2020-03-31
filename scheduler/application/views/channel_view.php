<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">CHANNEL</a>
            </li>
            <li class="breadcrumb-item active">VIEW</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> CHANNEL VIEW</div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="tablesaw-overflow">
                        <table class="table table-bordered tablesaw" id="" width="100%" cellspacing="0" data-tablesaw-mode="columntoggle">
                            <tr>
                                <td>채널이름</td>
                                <td> <?php echo $data['channel_name']?></td>
                            </tr>
                            <tr>
                                <td>ACCOUNT_INFO</td>
                                <td><?php echo $data['account_info']?></td>
                            </tr>
                        </table>
                    </div>
                    <div align="right">
                        <input type="submit" value="수정" onclick=goURL("/scheduler/channel/modify/?idx=<?php echo $data['channel_id']; ?>") class="btn btn-success"/>
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
