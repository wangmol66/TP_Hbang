function loadRegion(sel,type_id,selName,url){
	jQuery("#"+selName+" option").each(function(){
		jQuery(this).remove();
	});
	jQuery("<option value=0>请选择</option>").appendTo(jQuery("#"+selName));
	if(jQuery("#"+sel).val()==0){
		return;
	}
	jQuery.getJSON(url,{parentId:jQuery("#"+sel).val(),level:type_id},
		function(data){
			if(data){
				jQuery.each(data,function(idx,item){
					jQuery("<option value="+item.code+">"+item.name+"</option>").appendTo(jQuery("#"+selName));
				});
			}else{
				jQuery("<option value='0'>请选择</option>").appendTo(jQuery("#"+selName));
			}
		}
	);
}