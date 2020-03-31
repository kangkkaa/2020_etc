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
                <i class="fa fa-table"></i> HISTORY VIEW</div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="tablesaw-overflow">
                        <table class="table table-bordered tablesaw" id="" width="100%" cellspacing="0" data-tablesaw-mode="columntoggle">
                            <tr>
                                <td>process_date</td>
                                <td><?php echo $data['process_date']?></td>
                            </tr>
                            <tr>
                                <td>스케쥴러ID</td>
                                <td><?php echo $data['scheduler_info_id']?></td>
                            </tr>
                        </table>
                    </div>
                    <div align="right">
                        <input type="button" value="목록" onclick=goURL('/scheduler/history/') class="btn btn-danger"/>
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
