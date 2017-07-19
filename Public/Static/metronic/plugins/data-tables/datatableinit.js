/**
 * 老版datatable
 */
(function($){$.fn.enx_datatable=function(options){this.options={"iDisplayLength":25,"oLanguage":{"sSearch":lang.search,"sLengthMenu":lang.records_per_page.replace("{","").replace("}",""),"sZeroRecords":lang.data_not_found,"sInfo":lang.list_page_info.replace("{","").replace("}","").replace("{","").replace("}","").replace("{","").replace("}",""),"sInfoEmpty":lang.list_page_empty.replace("{","").replace("}","").replace("{","").replace("}","").replace("{","").replace("}",""),"oPaginate":{"sPrevious":lang.sPrevious,"sNext":lang.sNext,},},"sZeroRecords":lang.data_not_found,};this.options=$.extend(this.options,options);return _init(this,this.options);function _init(obj,options){var $parant=obj.parents(".dataTables_wrapper");var $dt_search=$parant.find(".dt_search");var $submit_dt_search=$parant.find(".submit_dt_search");options.fnDrawCallback=function(oSettings){if(options.sAjaxSource!=undefined){App.unblockUI(obj.parents(".dataTables_wrapper"))}var $parant=obj.parents(".dataTables_wrapper");if($.fn.uniform){$("input[type='checkbox']").uniform()}jQuery(".dataTables_filter input").addClass("form-control input-medium");jQuery(".dataTables_length select").addClass("m-wrap small");if($.fn.select2){jQuery(".dataTables_length select").select2();$parant.find("select").select2()}obj.find(".tooltips").tooltip();if(options.placeholder!=undefined){$parant.find("input").attr("placeholder",options.placeholder)}};options.fnPreDrawCallback=function(){if(options.sAjaxSource!=undefined){l_blockUI({target:obj.parents(".dataTables_wrapper")})}};if(!options.aoColumns){var column_settings=[];var th_num=0;options.aaSorting=[];var that=this;obj.find("th").each(function(){if($(this).attr("sort")=="false"){column_settings.push({"bSortable":false})}else{column_settings.push({"bSortable":true})}if($(this).attr("desc")=="true"){options.aaSorting.push([th_num,"desc"])}if($(this).attr("asc")=="true"){options.aaSorting.push([th_num,"asc"])}th_num++});options.aoColumns=column_settings}if(options.sAjaxSource){if(options.bServerSide==undefined){options.bServerSide=true}if(options.bProcessing==undefined){options.bProcessing=false}}var id=obj.attr("id");if(options.fnServerData==undefined||options.fnServerData==null){options.fnServerData=function(sSource,aoData,fnCallback){$dt_search.each(function(){var prop_name=$(this).attr("name");var prop_val=$(this).val();if($(this).attr("type")=="checkbox"){prop_val=$(this).attr("checked")=="checked"}aoData.push({"name":prop_name,"value":prop_val})});$("#other_seach_"+id).find(".dt_search").each(function(){var prop_name=$(this).attr("name");var prop_val=$(this).val();if($(this).attr("type")=="checkbox"){prop_val=$(this).attr("checked")=="checked"}aoData.push({"name":prop_name,"value":prop_val})});$.getJSON(sSource,aoData,function(json){fnCallback(json)})}}var $submit_search=$("#other_seach_"+id).find(".submit_dt_search");if($submit_search.length>=1){$submit_search.click(function(){obj.dataTable().fnDraw()})}if($submit_dt_search.length>=1){$submit_dt_search.click(function(){obj.dataTable().fnDraw()})}return obj.dataTable(options)}}})(jQuery);

/**
 * 新版datatable
 */
var newDatatable = function() {
    var tableOptions;
    var dataTable;
    var table;
    var tableContainer;
    var tableWrapper;
    var tableInitialized = false;
    var ajaxParams = [];
    var countSelectedRecords = function() {
        var selected = $('tbody > tr > td:nth-child(1) input[type="checkbox"]:checked', table).size();
        var text = tableOptions.dataTable.oLanguage.sGroupActions;
        if (selected > 0) {
            $(".table-group-actions > span", tableWrapper).text(text.replace("_TOTAL_", selected))
        } else {
            $(".table-group-actions > span", tableWrapper).text("")
        }
    };
    return {
        init: function(options) {
            if (!$().dataTable) {
                return
            }
            var the = this;
            options = $.extend(true, {
                src: "",
                filterApplyAction: "filter",
                filterCancelAction: "filter_cancel",
                resetGroupActionInputOnSuccess: true,
                dataTable: {
                    "sDom": "<'row'<'col-md-7 col-sm-12'pli><'col-md-5 col-sm-12'<'table-group-actions pull-right'>>r><'table-scrollable't><'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>r>>",
                    "aLengthMenu": [[10, 25, 50], [10, 25, 50]],
                    "iDisplayLength": 10,
                    "oLanguage": {
                        "sProcessing": '<img src="Public/static/metronic/img/loading-spinner-grey.gif"/><span>&nbsp;&nbsp;加载中...</span>',
                        "sLengthMenu": "<span class='seperator'>|</span>查看 _MENU_ 条",
                        "sInfo": "  <span class='seperator'>|</span>共 _TOTAL_ 条",
                        "sInfoEmpty": '无相关数据',
                        "sGroupActions": "_TOTAL_ records selected:  ",
                        "sAjaxRequestGeneralError": '数据错误',
                        "sEmptyTable": '无相关数据',
                        "sZeroRecords": '无相关数据',
                        "oPaginate": {
                            "sPrevious": "Prev",
                            "sNext": "Next",
                            "sPage": "当前页",
                            "sPageOf": "共"
                        }
                    },
                    "aoColumnDefs": [{
                        "bSortable": false,
                        "aTargets": [0]
                    }],
                    "bAutoWidth": false,
                    "bSortCellsTop": true,
                    "sPaginationType": "bootstrap_extended",
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "",
                    "sServerMethod": "get",
                    "fnServerData": function(sSource, aoData, fnCallback, oSettings) {
                        $('.form-filter').each(function(){
                            if($(this).val)
                            {
                                var prop_name = $(this).attr("name");
                                var prop_val = $(this).val();
                                if($(this).attr("type")=="checkbox") {
                                    prop_val = $(this).attr("checked")=="checked";
                                }
                                aoData.push({"name": prop_name, "value": prop_val});
                            }
                        });
                        oSettings.jqXHR = $.ajax({
                            "dataType": "json",
                            "type": "get",
                            "url": sSource,
                            "data": aoData,
                            "success": function(res, textStatus, jqXHR) {
                                if (res.sMessage) {
                                    App.alert({
                                        type: (res.sStatus == "OK" ? "success": "danger"),
                                        icon: (res.sStatus == "OK" ? "check": "warning"),
                                        message: res.sMessage,
                                        container: tableWrapper,
                                        place: "prepend"
                                    })
                                }
                                if (res.sStatus) {
                                    if (tableOptions.resetGroupActionInputOnSuccess) {
                                        $(".table-group-action-input", tableWrapper).val("")
                                    }
                                }
                                if ($(".group-checkable", table).size() === 1) {
                                    $(".group-checkable", table).attr("checked", false);
                                    $.uniform.update($(".group-checkable", table))
                                }
                                if (tableOptions.onSuccess) {
                                    tableOptions.onSuccess.call(the)
                                }
                                fnCallback(res, textStatus, jqXHR)
                            },
                            "error": function() {
                                if (tableOptions.onError) {
                                    tableOptions.onError.call(the)
                                }
                                App.alert({
                                    type: "danger",
                                    icon: "warning",
                                    message: tableOptions.dataTable.oLanguage.sAjaxRequestGeneralError,
                                    container: tableWrapper,
                                    place: "prepend"
                                });
                                $(".dataTables_processing", tableWrapper).remove()
                            }
                        })
                    },
                    "fnServerParams": function(aoData) {
                        for (var i in ajaxParams) {
                            var param = ajaxParams[i];
                            aoData.push({
                                "name": param.name,
                                "value": param.value
                            })
                        }
                    },
                    "fnDrawCallback": function(oSettings) {
                        if (tableInitialized === false) {
                            tableInitialized = true;
                            table.show()
                        }
                        App.initUniform($('input[type="checkbox"]', table));
                        countSelectedRecords()
						
						var classs = 'odd';
						var t_name = '';
                        var table1 = $('#datatable_products>tbody');
                        table1.find('tr').find('td:eq(2)').each(function(){

                        	var name = $.trim($(this).html());
                        	if(name != t_name){

                        		if(classs == 'odd') classs = 'even';
                        		else classs = 'odd';
                            }
                        	$(this).parents('tr').removeClass('odd').removeClass('even').addClass(classs);
                        	t_name = name;
                        });
                        
                        if($.fn.select2){jQuery(".table-scrollable select").not('.no-select2').select2();}
                    }
                }
            },
            options);
            tableOptions = options;
            table = $(options.src);
            tableContainer = table.parents(".table-container");
            $.fn.dataTableExt.oStdClasses.sWrapper = $.fn.dataTableExt.oStdClasses.sWrapper + " dataTables_extended_wrapper";
            dataTable = table.dataTable(options.dataTable);
            tableWrapper = table.parents(".dataTables_wrapper");
            $(".dataTables_length select", tableWrapper).addClass("form-control input-xsmall input-sm");
            if ($(".table-actions-wrapper", tableContainer).size() === 1) {
                $(".table-group-actions", tableWrapper).html($(".table-actions-wrapper", tableContainer).html());
                $(".table-actions-wrapper", tableContainer).remove()
            }
            $(".group-checkable", table).change(function() {
                var set = $('tbody > tr > td:nth-child(1) input[type="checkbox"]', table);
                var checked = $(this).is(":checked");
                $(set).each(function() {
                    $(this).attr("checked", checked)
                });
                $.uniform.update(set);
                countSelectedRecords()
            });
            table.on("change", 'tbody > tr > td:nth-child(1) input[type="checkbox"]',
            function() {
                countSelectedRecords()
            });
            table.on("click", ".filter-submit",
            function(e) {
                e.preventDefault();
                the.addAjaxParam("sAction", tableOptions.filterApplyAction);
                $('textarea.form-filter, select.form-filter, input.form-filter:not([type="radio"],[type="checkbox"])', table).each(function() {
                    the.addAjaxParam($(this).attr("name"), $(this).val())
                });
                $('input.form-filter[type="checkbox"]:checked, input.form-filter[type="radio"]:checked', table).each(function() {
                    the.addAjaxParam($(this).attr("name"), $(this).val())
                });
                dataTable.fnDraw();
            });
            table.on("click", ".filter-cancel",
            function(e) {
                e.preventDefault();
                $("textarea.form-filter, select.form-filter, input.form-filter", table).each(function() {
                    $(this).val("")
                });
                $('input.form-filter[type="checkbox"]', table).each(function() {
                    $(this).attr("checked", false)
                });
                the.addAjaxParam("sAction", tableOptions.filterCancelAction);
                the.clearAjaxParams();
                dataTable.fnDraw();
            })
        },
        getSelectedRowsCount: function() {
            return $('tbody > tr > td:nth-child(1) input[type="checkbox"]:checked', table).size()
        },
        getSelectedRows: function() {
            var rows = [];
            $('tbody > tr > td:nth-child(1) input[type="checkbox"]:checked', table).each(function() {
                rows.push({
                    name: $(this).attr("name"),
                    value: $(this).val()
                })
            });
            return rows
        },
        addAjaxParam: function(name, value) {
            ajaxParams.push({
                "name": name,
                "value": value
            })
        },
        clearAjaxParams: function(name, value) {
            ajaxParams = []
        },
        getDataTable: function() {
            return dataTable
        },
        getTableWrapper: function() {
            return tableWrapper
        },
        gettableContainer: function() {
            return tableContainer
        },
        getTable: function() {
            return table
        }
    }
};

var datatable_init = function(option){
	var table = new newDatatable(); 
	var defaultOptions = {
			src:option.src
	}
	var dataTable = { 
			iDisplayLength:25,
            lengthMenu: [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
            pageLength: 10,
        };
	dataTable =  $.extend(dataTable, option);
	defaultOptions.dataTable = dataTable;
	table.init(defaultOptions);
}
$(function(){
$('.table-group-action-input').live('click', function(){
	 $(this).val('').change();
});})