/**
 * Created by doannd on 2019-04-10.
 */
$(function() {
    var queryParameters = {},
        queryString = location.search.substring(1),
        re = /([^&=]+)=([^&]*)/g, m,
        target ;

    // Creates a map with the query string parameters
    while (m = re.exec(queryString)) {
        queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
    }
    target = queryParameters['target'];

    $('iframe').changeParamIFrame(target);
});

$.fn.changeParamIFrame = function (target) {
    var reExp = /target=.*/;
    var url = $(this).attr('src');
    var newUrl = url.replace(reExp, "target=" + target);

    $(this).attr('src', newUrl);
};