CKEDITOR.dialog.add('question', function(editor){
    var escape = function(value){
        return value;
    };
    return {
	        title: '选择题目',
	        minWidth: 1100,
	        minHeight: 500,
	        contents: [{
	        	id: "tab1",
	        	padding: 0,
	        	expand: true,
	            elements: [{
	                type:'html',
		            html:'<iframe scrolling="no" iid="select-question-iframe" src="" style="width:100%;height:500px;overflow-y:hidden;"></iframe>'
	            }]
	        }],
	        onOk: function(){
	    		var data = getQuestionData()
	    		for(var k in data){
		    		editor.insertHtml('<iframe class="question-box-'+data[k]+'">题</iframe>');
	    		}
	        },
	        onShow:function(){
	        	$('[iid="select-question-iframe"]').attr('src', "admin.php?s=/Article/selectQuestion.html&r="+Math.random());
	        }
	    };
});