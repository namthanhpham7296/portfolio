/**
 * Created by chaunp on 6/15/2016.
 */

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('.tt_large').tooltip({
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner large"></div></div>'
    });
})

function activateTooltipSmall() {
    $('[data-toggle="tooltip"]').tooltip();
}

function activateTooltipLarge(){
    $('[data-toggle="tooltip"]').tooltip();
    $('.tt_large').tooltip({
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner large"></div></div>'
    });
}