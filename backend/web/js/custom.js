$(document).ready(function (){

    let texArea = $('#jsonTextArea');
    if (texArea.length !== 0) {
        let ugly = texArea.val();
        let obj = JSON.parse(ugly);
        let pretty = JSON.stringify(obj, undefined, 4);
        texArea.val(pretty);
    }



    $('.toogle-list-btn').click(function(e) {
        e.stopPropagation();
        $(this).siblings().toggle();
    });
})