$(".message-frame b").click(function () {
    var ths=$(this);
    ths.parents(".message-frame").slideUp();
});

var mask_theme=$(".theme-popover-mask");
mask_theme.click(function () {
    $(this).fadeOut();
});

function highlight_subnav(url){
    $('.sub-menu').find('a[href="'+url+'"]').addClass('selected');
}
$(function(){
    var sub_a=$(".sub-menu a");
    for(var i=0;i<sub_a.length;i++){
        if(sub_a.eq(i).hasClass("selected")){
            sub_a.eq(i).parents(".start").addClass("open");
            sub_a.eq(i).parents(".sub-menu").show();
        }
    }
})