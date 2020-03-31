<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
    <head>
        <title> sjisbmoc </title>
<script language='javascript'>
<!--
function fncMove( from, to ){
    var fm = document.getElementById(from);
    var to = document.getElementById(to);
    var tby = fm.childNodes[1];
    for(var i=0; i<tby.childNodes.length; i++){
        if(tby.childNodes[i].childNodes[0].childNodes[0].checked==true){
            tby.childNodes[i].childNodes[0].childNodes[0].checked = false;
            if(from!='tb2')
                fncAddRow(tby.childNodes[i],to);
            if(from!='tb1')
                fncDelRow(tby.childNodes[i]);
            i--;
        }
    }
}
function fncAddRow(tr,tab){
    var tby = tab.childNodes[1];
    var nrw = tby.insertRow();
    for( var i=0; i<tr.childNodes.length; i++ ){
        var ntd = nrw.insertCell();
        ntd.innerHTML = tr.childNodes[i].innerHTML;
    }
}
function fncDelRow(obj){
    obj.parentNode.removeChild(obj);
}
//-->
</script>
    </head>
    <body topmargin='0' leftmargin='0' border='0'>
<form name='frm1'>
        <table id='tb1' border='1'>
            <thead>
                <th>Check</th>
                <th>상품명</th>
                <th>Desc</th>
            </thead>
            <tbody>
                <tr>
                    <td><input type='checkbox' name='chk'></td>
                    <td>상품 1</td>
                    <td><input type='text' name='txt' size='20' value='상품설명1'></td>
                </tr>
                <tr>
                    <td><input type='checkbox' name='chk'></td>
                    <td>상품 2</td>
                    <td><input type='text' name='txt' size='20' value='상품설명2'></td>
                </tr>
                <tr>
                    <td><input type='checkbox' name='chk'></td>
                    <td>상품 3</td>
                    <td><input type='text' name='txt' size='20' value='상품설명3'></td>
                </tr>
                <tr>
                    <td><input type='checkbox' name='chk'></td>
                    <td>상품 4</td>
                    <td><input type='text' name='txt' size='20' value='상품설명4'></td>
                </tr>
            </tbody>
        </table>
</form>
        <input type='button' name='btn' value='선택된 상품 담기' onclick='fncMove("tb1","tb2");'>
<form name='frm2'>
        <table id='popup' cellpadding='0' cellspacing='0' border='0' style='border:1px solid #000000;' style='background-color:yellow; position:absolute; top:150px; left:200px;' width='400' height='300'>
            <tr>
                <td align='center' height='40px;'>카트</td>
            </tr>
            <tr>
                <td align='center' height='220px;'>
                    <table id='tb2'>
                        <thead>
                            <th width='60'>Check</th>
                            <th width='80'>Value</th>
                            <th width='140'>Desc</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align='center' height='40px;'><input type='button' name='btn' value='선택된 상품 빼기' onclick='fncMove("tb2","tb1");'></td>
            </tr>
        </table>
</form>
    </body>
</html>