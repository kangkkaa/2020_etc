function goURL(url){
    location.href = url;
}

function DelData(url){
    if(confirm("데이터를 삭제하시겠습니까?\n삭제된 데이터는 복구할 수 없습니다")){
        location.href = url;
    }else{
        return false;
    }
}
function openWin(url,width,height) {
    var posx = 0
    var posy = 0
    posx = (screen.width - width)/2-1;
    posy = (screen.height - height)/2-1;
    newwin = window.open(url,"stock","width="+width+",height="+height+",toolbar=0,scrollbars=1,resizable=1,status=0");
    newwin.moveTo(posx,posy);
    newwin.focus();
}
function searchWin(url,width,height,search_type, search_word) {
    var posx = 0
    var posy = 0
    url = url + "/?" + search_type + "=" + search_word;
    posx = (screen.width - width)/2-1;
    posy = (screen.height - height)/2-1;
    newwin = window.open(url,"stock","width="+width+",height="+height+",toolbar=0,scrollbars=1,resizable=1,status=0");
    newwin.moveTo(posx,posy);
    newwin.focus();
}

