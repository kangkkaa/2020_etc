<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Scheduler Management-Scheduler</title>
    <link href="/scheduler/css/bootstrap.min.css" rel="stylesheet">
    <link href="/scheduler/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/scheduler/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="/scheduler/css/admin.css" rel="stylesheet">
    <link href="/scheduler/css/tablesaw.css" rel="stylesheet">
</head>
<body class="fixed-nav sticky-footer bg-light" id="page-top">
<div class="col-5">
    <div align="right" class="form-group input-group">
        채널이름 : <input name="serach_word" id="serach_word" value="<?php echo $_GET['search_word']?>" class="form-control">
        <button class="btn btn-default" type="button" onclick=goURL("<?php echo $_SERVER['PHP_SELF']?>?search_word="+$("#serach_word").val())><i class="fa fa-search"></i></button>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> CHANNEL LIST
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="tablesaw-overflow">
                <table class="table table-bordered tablesaw" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>채널이름</td>
                            <td>ACCOUNT_INFO</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $val) { ?>
                        <tr>
                            <td><a href="#" onclick=insertop("<?php echo $val['channel_id']?>","<?php echo $val['channel_name']?>")><?php echo $val['channel_name']?></a></td>
                            <td><a href="#" onclick=insertop("<?php echo $val['channel_id']?>","<?php echo $val['channel_name']?>")><?php echo $val['account_info']?></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div align="right">
                <input type="button" value="닫기" class="btn btn btn-default btn-sm" onclick="self.close()">
            </div>
        </div>
    </div>
</div>
<script src="/scheduler/js/jquery.min.js"></script>
<script src="/scheduler/js/bootstrap.bundle.min.js"></script>
<script src="/scheduler/js/jquery.easing.min.js"></script>

<script src="/scheduler/js/admin.min.js"></script>
<script src="/scheduler/js/tablesaw.js"></script>
<script src="/scheduler/js/tablesaw-init.js"></script>

<script src="/scheduler/js/function.js"></script>
<script type="text/javascript">
    function insertop(idx, name){
        try {
            opener.document.getElementById("channel_id").value = idx;
            opener.document.getElementById("channel_name").value = name;
        }
        catch(e) {
            alert(e.description);
        }
        self.close();
    }
</script>
</body>
</html>
