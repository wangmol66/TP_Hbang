/**
 * Created by maomao on 2016/11/30111.
 */
var Smelly={
    confirm:function (func,message) {
        confirmMessage({
            info:message,
            confirmCallback:func,
        });
    },
    /**
     * 配置提示请求数据，POST
     */
    confirmAlert:function(url,message,data,func){
	confirmMessage({
		url:url,
		info:message,
		data:data,
		func:func,
		confirmCallback:function(option){
		App.blockUI({message:'保存中...'});
		$.ajax(option.url, {
			dataType:'json',
			type:'post',
			data:option.data,
			error:function(){
				show_message({status:0, message:'请求超时'}); 
				App.unblockUI();
			},
			timeout:60000,
			success:function(data,textStatus,jqXHR){
				show_message(data);
				if(data.status && $('#datatable').length){
					$('#datatable').dataTable().fnDraw(true);
				}
				
				if(data.status && typeof ajaxRequestCallBack === 'function'){
					ajaxRequestCallBack(data);
				}
				
				if(typeof option.func === 'function'){
					option.func(data);
				}
				App.unblockUI();
			}
		});
		}
	});	
}


}




