/** http://bootstrap-notify.remabledesigns.com/*/

function slideMessage(title, message, typeMessage, delay){

    // delay = typeof delay == 'undefined' ? 1200 : delay;

    var notify = $.notify(
        {
            title: '<strong>'+title+'</strong>'
            , message: ' <br/>'+message+''
        }
        , {
            type: typeMessage
            , allow_dismiss: false
            , element: 'body'
            , autoHideDelay: 2500
            , delay: 2500 /** timeout*/
            , offset: 70 /** padding for placement*/
            , z_index: 12000
            , placement: {
                from: "top",
                align: "center"
            }
        }
    );
}
