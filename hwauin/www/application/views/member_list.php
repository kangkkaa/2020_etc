<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> 회원 리스트</div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="tablesaw-overflow">
                        <table class="table table-bordered tablesaw" id="" width="100%" cellspacing="0" data-tablesaw-mode="columntoggle">
                            <thead>
                            <tr>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="persist">idx</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="1">이름</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="2">아이디</th>
                                <th data-tablesaw-sortable-col data-tablesaw-priority="3">가입날짜</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach($member as $entry){ ?>
                            <tr>
                                    <td><?=$entry->idx?></td>
                                    <td><?=$entry->mem_name?></td>
                                    <td><?=$entry->mem_id?></td>
                                    <td><?=$entry->join_date?></td>
                            </tr>
                            <? } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->


