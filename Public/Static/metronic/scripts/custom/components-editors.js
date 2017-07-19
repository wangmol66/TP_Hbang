var ComponentsEditors = function () {
    
    var handleWysihtml5 = function () {

        //console.log($('.wysihtml5').prev().prop("tagName"))
        // if($('.wysihtml5').prev().prop("tagName") == 'UL'){
        //     return;
        // }
        if (!jQuery().wysihtml5) {

            return;
        }

        if ($('.wysihtml5').size() > 0) {
            $('.wysihtml5').wysihtml5({
                "stylesheets": ["Public/static/metronic/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
            });
        }
    }


    return {
        //main function to initiate the module
        init: function () {
            handleWysihtml5();
        }
    };

}();