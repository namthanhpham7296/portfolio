function activeSelect(domeHtml, isSearch, size){
    if(isSearch){
        $(domeHtml).selectpicker({
            liveSearch: true,
            noneSelectedText: '',
            size: size
        });
    }else{
        $(domeHtml).selectpicker({
            noneSelectedText: ''
            //liveSearch: true,
            //size: size
        });
    }
}

function refreshSelectPicker(){
    $('.selectpicker').selectpicker('refresh');
}
