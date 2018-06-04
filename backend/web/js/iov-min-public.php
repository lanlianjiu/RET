<?php
use yii\helpers\Url;
 $url = $_SERVER["REQUEST_URI"];
 function getUrlparams($url) 
	{ 
		$refer_url = parse_url($url); 
		
		$params = $refer_url['query']; 
		
		$arr = array(); 
		if(!empty($params)) 
		{ 
			$paramsArr = explode('&',$params); 
		
			foreach($paramsArr as $k=>$v) 
			{ 
				$a = explode('=',$v); 
				$arr[$a[0]] = $a[1]; 
			} 
		} 
		return $arr; 
	};
	$severUrlparam = getUrlparams($url);
?>
<script>

/*表格初始化*/
$('[data-toggle="table"]').each(function () {

	var $this = $(this);
	var tableId = $("#" + $this.attr("id"));
	var tableUrl = $this.attr("data-custom-url");
	var exportType = $this.attr("data-export-type") || "all";
	var autoHeight = $.utils.windowHeight() - tableId.offset().top - (Number(tableId.attr('data-autoheight')));

	var option = {
		url: tableUrl,
		height: autoHeight,
		queryParamsType:'limit',
		queryParams:getParams
	};
	var postParams = <?php echo json_encode($severUrlparam); ?>;

	//获取参数
	function getParams(params) {
		var temp = { 
			order : params.order, 
			limit : params.limit,
			offset : params.offset,
			postParams: JSON.stringify(postParams)
		};
		return temp;
	}

	$.extend(tableId.bootstrapTable.defaults, option);
	
	$(window).resize(function () {
		tableId.bootstrapTable('resetView');
	});

	//导出
	function DoOnCellHtmlData(cell, row, col, data) {
		var result = "";
		if (typeof data != 'undefined' && data != "") {
			var html = $.parseHTML(data);

			$.each(html, function () {
				if (typeof $(this).html() === 'undefined')
					result += $(this).text();
				else if (typeof $(this).attr('class') === 'undefined' || $(this).hasClass('th-inner') === true)
					result += $(this).html();
			});
		}
		return result;
	};

	tableId.bootstrapTable('refreshOptions', {
		exportOptions: {
			ignoreColumn: [0, 1], // or as string array: ['0','checkbox']
			onCellHtmlData: DoOnCellHtmlData,
			exportDataType: exportType
		}
	});

});
/*表格初始化*/

//表格搜索
$("[bootstrap-table-search]").on('click', function () {
	$this = $(this);

	var table_id = $this.attr("bootstrap-table-search");

	var searchForm = $("[bootstrap-table-form=" + table_id + "]");

	var searchParams = searchForm.serializeObject();

	var tableUrl = $("#" + table_id).attr("data-custom-url");

	var params = {
		url: tableUrl,
		query: searchParams
	};

	$("#" + table_id).bootstrapTable('refresh', params);

});

</script>