$(document).ready(function (){
    $('.toogle-list-btn').click(function(e) {
        e.stopPropagation();
        $(this).siblings().toggle();
    });
})