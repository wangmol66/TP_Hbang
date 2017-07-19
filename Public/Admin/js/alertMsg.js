alertMsg=function(text1,text2,number) {
    $("body").append('<a href="javascript:;" data-toggle="modal" data-target="#alertModal" id="alertBtn"></a><div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> <h4 class="modal-title" id="myModalLabel">'+text1+'</h4> </div> <div class="modal-body"> <div class="form-group"> <label class="control-label">'+text2+'</label> </div> </div> </div> </div></div>');
    var alertModal = $("#alertModal");
    var alertBtn=$("#alertBtn");
    var close = $(".close");
    setTimeout(function () {
        close.click();
        if(number==1){
            history.go(0);
        }
    }, 3000);
    alertBtn.click();
}