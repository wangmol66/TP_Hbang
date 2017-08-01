<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
defined("FIST_DAY")             or define("FIST_DAY",16);//客户需求:专业知识考核统计时间段暂定上个月份16日到当月15日，作为当月的考核成绩 1-16 2-15 作为1月
defined("END_DAY")              or define("END_DAY",15);
defined("EXAM_NUMBER")          or define("EXAM_NUMBER",2); //考试次数
##华邦制药微信公众号
defined("APPID")                or define("APPID",'wxb7274b4fbe5f9f4c'); //微信管理员 LS__0626  华邦 罗双 微信号 2627369377@qq.com 密码:
defined("APPSECRET")            or define("APPSECRET",'a44baae313f7779a21016a2f0ad378d5');
/**
 * 后台公共文件
 * 主要定义后台公共函数库
 */
define('UC_AUTH_KEY', '*]f)={.zRuS;FZWUv6"TGJPO_5g<Kx#~k&|7nj(I'); //加密KEY
/* 解析列表定义规则*/

function get_list_field($data, $grid){

    // 获取当前字段数据
    foreach($grid['field'] as $field){
        $array  =   explode('|',$field);
        $temp  =    $data[$array[0]];
        // 函数支持
        if(isset($array[1])){
            $temp = call_user_func($array[1], $temp);
        }
        $data2[$array[0]]    =   $temp;
    }
    if(!empty($grid['format'])){
        $value  =   preg_replace_callback('/\[([a-z_]+)\]/', function($match) use($data2){return $data2[$match[1]];}, $grid['format']);
    }else{
        $value  =   implode(' ',$data2);
    }

    // 链接支持
    if('title' == $grid['field'][0] && '目录' == $data['type'] ){
        // 目录类型自动设置子文档列表链接
        $grid['href']   =   '[LIST]';
    }
    if(!empty($grid['href'])){
        $links  =   explode(',',$grid['href']);
        foreach($links as $link){
            $array  =   explode('|',$link);
            $href   =   $array[0];
            if(preg_match('/^\[([a-z_]+)\]$/',$href,$matches)){
                $val[]  =   $data2[$matches[1]];
            }else{
                $show   =   isset($array[1])?$array[1]:$value;
                // 替换系统特殊字符串
                $href   =   str_replace(
                    array('[DELETE]','[EDIT]','[LIST]'),
                    array('setstatus?status=-1&ids=[id]',
                    'edit?id=[id]&model=[model_id]&cate_id=[category_id]',
                    'index?pid=[id]&model=[model_id]&cate_id=[category_id]'),
                    $href);

                // 替换数据变量
                $href   =   preg_replace_callback('/\[([a-z_]+)\]/', function($match) use($data){return $data[$match[1]];}, $href);

                $val[]  =   '<a href="'.U($href).'">'.$show.'</a>';
            }
        }
        $value  =   implode(' ',$val);
    }
    return $value;
}

/* 解析插件数据列表定义规则*/

function get_addonlist_field($data, $grid,$addon){
    // 获取当前字段数据
    foreach($grid['field'] as $field){
        $array  =   explode('|',$field);
        $temp  =    $data[$array[0]];
        // 函数支持
        if(isset($array[1])){
            $temp = call_user_func($array[1], $temp);
        }
        $data2[$array[0]]    =   $temp;
    }
    if(!empty($grid['format'])){
        $value  =   preg_replace_callback('/\[([a-z_]+)\]/', function($match) use($data2){return $data2[$match[1]];}, $grid['format']);
    }else{
        $value  =   implode(' ',$data2);
    }

    // 链接支持
    if(!empty($grid['href'])){
        $links  =   explode(',',$grid['href']);
        foreach($links as $link){
            $array  =   explode('|',$link);
            $href   =   $array[0];
            if(preg_match('/^\[([a-z_]+)\]$/',$href,$matches)){
                $val[]  =   $data2[$matches[1]];
            }else{
                $show   =   isset($array[1])?$array[1]:$value;
                // 替换系统特殊字符串
                $href   =   str_replace(
                    array('[DELETE]','[EDIT]','[ADDON]'),
                    array('del?ids=[id]&name=[ADDON]','edit?id=[id]&name=[ADDON]',$addon),
                    $href);

                // 替换数据变量
                $href   =   preg_replace_callback('/\[([a-z_]+)\]/', function($match) use($data){return $data[$match[1]];}, $href);

                $val[]  =   '<a href="'.U($href).'">'.$show.'</a>';
            }
        }
        $value  =   implode(' ',$val);
    }
    return $value;
}

/**
 * 上传文件
 * @param string $path
 * @param string $sub
 * @param string $filename
 * @return array
 */
function upload($path,$sub = '' ,$filename = '',$file = 'file',$min = FALSE){

	$upload = new \Think\Upload();// 实例化上传类
	$upload->replace   =     true ;// 同名允许覆盖
	$upload->maxSize   =     3145728 ;// 设置附件上传大小
	$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
	$upload->savePath  =     $path; // 设置附件上传（子）目录
	if($filename){
		$upload->saveName   =	 $filename;
	}
	$upload->subName   =	 $sub;

	if (file_exists($path)) {
		mkdir($path,0777,true);
	}

	// 上传文件
	$info   =   $upload->upload();
	if(!$info) {// 上传错误提示错误信息
		return array('status'=>0,'msg'=>$upload->getError());
	}else{// 上传成功
		$base = 'Uploads/'.$info[$file]['savepath'];
		if ($min){
			$image = new \Think\Image();
			//print_r($info);
			$image->open($base.$info[$file]['savename']);
			$image->thumb(60,60)->save($base.'min_'.$info[$file]['savename']);
		}
	}

	return array('status'=>1,'msg'=>'上传成功','path'=>array('big'=>$base.$info[$file]['savename'],'min'=>$base.'min_'.$info[$file]['savename']));
}

// 获取模型名称
function get_model_by_id($id){
    return $model = M('Model')->getFieldById($id,'title');
}

// 获取属性类型信息
function get_attribute_type($type=''){
    // TODO 可以加入系统配置
    static $_type = array(
        'num'       =>  array('数字','int(10) UNSIGNED NOT NULL'),
        'string'    =>  array('字符串','varchar(255) NOT NULL'),
        'textarea'  =>  array('文本框','text NOT NULL'),
        'date'      =>  array('日期','int(10) NOT NULL'),
        'datetime'  =>  array('时间','int(10) NOT NULL'),
        'bool'      =>  array('布尔','tinyint(2) NOT NULL'),
        'select'    =>  array('枚举','char(50) NOT NULL'),
        'radio'     =>  array('单选','char(10) NOT NULL'),
        'checkbox'  =>  array('多选','varchar(100) NOT NULL'),
        'editor'    =>  array('编辑器','text NOT NULL'),
        'picture'   =>  array('上传图片','int(10) UNSIGNED NOT NULL'),
        'file'      =>  array('上传附件','int(10) UNSIGNED NOT NULL'),
    );
    return $type?$_type[$type][0]:$_type;
}

/**
 * 获取对应状态的文字信息
 * @param int $status
 * @return string 状态文字 ，false 未获取到
 * @author huajie <banhuajie@163.com>
 */
function get_status_title($status = null){
    if(!isset($status)){
        return false;
    }
    switch ($status){
        case -1 : return    '已删除';   break;
        case 0  : return    '禁用';     break;
        case 1  : return    '正常';     break;
        case 2  : return    '待审核';   break;
        default : return    false;      break;
    }
}

// 获取数据的状态操作
function show_status_op($status) {
    switch ($status){
        case 0  : return    '启用';     break;
        case 1  : return    '禁用';     break;
        case 2  : return    '审核';       break;
        default : return    false;      break;
    }
}

/**
 * 获取文档的类型文字
 * @param string $type
 * @return string 状态文字 ，false 未获取到
 * @author huajie <banhuajie@163.com>
 */
function get_document_type($type = null){
    if(!isset($type)){
        return false;
    }
    switch ($type){
        case 1  : return    '目录'; break;
        case 2  : return    '主题'; break;
        case 3  : return    '段落'; break;
        default : return    false;  break;
    }
}

/**
 * 获取配置的类型
 * @param string $type 配置类型
 * @return string
 */
function get_config_type($type=0){
    $list = C('CONFIG_TYPE_LIST');
    return $list[$type];
}

/**
 * 获取配置的分组
 * @param string $group 配置分组
 * @return string
 */
function get_config_group($group=0){
    $list = C('CONFIG_GROUP_LIST');
    return $group?$list[$group]:'';
}

/**
 * select返回的数组进行整数映射转换
 *
 * @param array $map  映射关系二维数组  array(
 *                                          '字段名1'=>array(映射关系数组),
 *                                          '字段名2'=>array(映射关系数组),
 *                                           ......
 *                                       )
 * @author 朱亚杰 <zhuyajie@topthink.net>
 * @return array
 *
 *  array(
 *      array('id'=>1,'title'=>'标题','status'=>'1','status_text'=>'正常')
 *      ....
 *  )
 *
 */
function int_to_string(&$data,$map=array('status'=>array(1=>'正常',-1=>'删除',0=>'禁用',2=>'未审核',3=>'草稿'))) {
    if($data === false || $data === null ){
        return $data;
    }
    $data = (array)$data;
    foreach ($data as $key => $row){
        foreach ($map as $col=>$pair){
            if(isset($row[$col]) && isset($pair[$row[$col]])){
                $data[$key][$col.'_text'] = $pair[$row[$col]];
            }
        }
    }
    return $data;
}

/**
 * 动态扩展左侧菜单,base.html里用到
 * @author 朱亚杰 <zhuyajie@topthink.net>
 */
function extra_menu($extra_menu,&$base_menu){
    foreach ($extra_menu as $key=>$group){
        if( isset($base_menu['child'][$key]) ){
            $base_menu['child'][$key] = array_merge( $base_menu['child'][$key], $group);
        }else{
            $base_menu['child'][$key] = $group;
        }
    }
}

/**
 * 获取参数的所有父级分类
 * @param int $cid 分类id
 * @return array 参数分类和父类的信息集合
 * @author huajie <banhuajie@163.com>
 */
function get_parent_category($cid){
    if(empty($cid)){
        return false;
    }
    $cates  =   M('Category')->where(array('status'=>1))->field('id,title,pid')->order('sort')->select();
    $child  =   get_category($cid); //获取参数分类的信息
    $pid    =   $child['pid'];
    $temp   =   array();
    $res[]  =   $child;
    while(true){
        foreach ($cates as $key=>$cate){
            if($cate['id'] == $pid){
                $pid = $cate['pid'];
                array_unshift($res, $cate); //将父分类插入到数组第一个元素前
            }
        }
        if($pid == 0){
            break;
        }
    }
    return $res;
}

/**
 * 检测验证码
 * @param  integer $id 验证码ID
 * @return boolean     检测结果
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function check_verify($code, $id = 1){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

/**
 * 获取当前分类的文档类型
 * @param int $id
 * @return array 文档类型数组
 * @author huajie <banhuajie@163.com>
 */
function get_type_bycate($id = null){
    if(empty($id)){
        return false;
    }
    $type_list  =   C('DOCUMENT_MODEL_TYPE');
    $model_type =   M('Category')->getFieldById($id, 'type');
    $model_type =   explode(',', $model_type);
    foreach ($type_list as $key=>$value){
        if(!in_array($key, $model_type)){
            unset($type_list[$key]);
        }
    }
    return $type_list;
}

/**
 * 获取当前文档的分类
 * @param int $id
 * @return array 文档类型数组
 * @author huajie <banhuajie@163.com>
 */
function get_cate($cate_id = null){
    if(empty($cate_id)){
        return false;
    }
    $cate   =   M('Category')->where('id='.$cate_id)->getField('title');
    return $cate;
}

 // 分析枚举类型配置值 格式 a:名称1,b:名称2
function parse_config_attr($string) {
    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    if(strpos($string,':')){
        $value  =   array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k]   = $v;
        }
    }else{
        $value  =   $array;
    }
    return $value;
}

// 获取子文档数目
function get_subdocument_count($id=0){
    return  M('Document')->where('pid='.$id)->count();
}



 // 分析枚举类型字段值 格式 a:名称1,b:名称2
 // 暂时和 parse_config_attr功能相同
 // 但请不要互相使用，后期会调整
function parse_field_attr($string) {
    if(0 === strpos($string,':')){
        // 采用函数定义
        return   eval('return '.substr($string,1).';');
    }elseif(0 === strpos($string,'[')){
        // 支持读取配置参数（必须是数组类型）
        return C(substr($string,1,-1));
    }
    
    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    if(strpos($string,':')){
        $value  =   array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k]   = $v;
        }
    }else{
        $value  =   $array;
    }
    return $value;
}

/**
 * 获取行为数据
 * @param string $id 行为id
 * @param string $field 需要获取的字段
 * @author huajie <banhuajie@163.com>
 */
function get_action($id = null, $field = null){
    if(empty($id) && !is_numeric($id)){
        return false;
    }
    $list = S('action_list');
    if(empty($list[$id])){
        $map = array('status'=>array('gt', -1), 'id'=>$id);
        $list[$id] = M('Action')->where($map)->field(true)->find();
    }
    return empty($field) ? $list[$id] : $list[$id][$field];
}

/**
 * 根据条件字段获取数据
 * @param mixed $value 条件，可用常量或者数组
 * @param string $condition 条件字段
 * @param string $field 需要返回的字段，不传则返回整个数据
 * @author huajie <banhuajie@163.com>
 */
function get_document_field($value = null, $condition = 'id', $field = null){
    if(empty($value)){
        return false;
    }

    //拼接参数
    $map[$condition] = $value;
    $info = M('Model')->where($map);
    if(empty($field)){
        $info = $info->field(true)->find();
    }else{
        $info = $info->getField($field);
    }
    return $info;
}

/**
 * 获取行为类型
 * @param intger $type 类型
 * @param bool $all 是否返回全部类型
 * @author huajie <banhuajie@163.com>
 */
function get_action_type($type, $all = false){
    $list = array(
        1=>'系统',
        2=>'用户',
    );
    if($all){
        return $list;
    }
    return $list[$type];
}

/**
 * 加载界面静态插件
 *
 * @param	string	$plugins	插件名称 ，多个以“,”隔开
 * @return	string
 */

function loadStaticPlugin($plugins){

	$tA = array();
	if($plugins){
		
		$tAp = explode(',', $plugins);
		foreach ($tAp as $v){
			if( ! $v) continue;
			
			$tA[] = C($v);
		}
	}
	
	if( empty($tA)) return $str;
       
	foreach ($tA as $v){
		if(is_array($v)){
			foreach ($v as $vv){
				
				$ext = pathinfo($vv, PATHINFO_EXTENSION);
				if($ext == 'css'){
                        $str .= '<link href="'.__ROOT__.'/'.$vv.'" rel="stylesheet" type="text/css"/>';
                    }
                    else if($ext == 'js'){
                        $str .= '<script type="text/javascript" src="'.__ROOT__.'/'.$vv.'"></script>';
                    }
                    
                    $str .= "\r\n";
			}
		}else{
			$ext = pathinfo($v, PATHINFO_EXTENSION);
			if($ext == 'css'){
                    $str .= '<link href="'.__ROOT__.'/'.$v.'" rel="stylesheet" type="text/css"/>';
                }
                else if($ext == 'js'){
                    $str .= '<script type="text/javascript" src="'.__ROOT__.'/'.$v.'"></script>';
                }
                $str .= "\r\n";
		}
	}
	
    return $str;
}


function GET_START_TIME($time=null){
    if (!is_null($time)){
        return date($time.'-'.FIST_DAY,time());
    }

    $now=date('Y-m-d',time());
    $nowTime=date('Y-m-'.FIST_DAY,time());

    ##判断当前日期，是当前月
    if($now>=$nowTime){
        ##2月18 >= 2月16   那么就用   data in 2月16-3月15之间
        return date('Y-m-'.FIST_DAY,time());
    }else{
        ##2月8 >= 2月16   那么就用   data in 1月16-2月15之间
        return date('Y-m-'.FIST_DAY,strtotime("-1 months",time()));

    }

}

function GET_END_TIME($time=null){
    if (!is_null($time)){
        return date($time.'-'.END_DAY,time());
    }
    $now=date('Y-m-d',time());
    $nowTime=date('Y-m-'.FIST_DAY,time());
    ##判断当前日期，是当前月
    if($now>=$nowTime){
        ##2月18 >= 2月16   那么就用   data in 2月16-3月15之间
        return date('Y-m-'.END_DAY,strtotime("+1 months",time()));
    }else{
        ##2月8 >= 2月16   那么就用   data in 1月16-2月15之间
        return date('Y-m-'.END_DAY,time());
    }

}
/**
 * 返回查询该月的条件
 * @param string $field
 * @return string
 */
function TIME_BETWEEN($field=null){

    if (!is_null($field)){
        //return $field.' BETWEEN DATE_FORMAT(NOW(),"%Y-%m-15") AND DATE_ADD(DATE_FORMAT(NOW(),"%Y-%m-16"),INTERVAL 1 MONTH)';    // 第一个版本

        return ' CASE WHEN DATE_FORMAT(NOW(),"%Y-%m-%d") >= DATE_FORMAT(NOW(),"%Y-%m-16")'
        .' THEN '.
        $field.' BETWEEN DATE_FORMAT(NOW(),"%Y-%m-16") AND DATE_ADD(DATE_FORMAT(NOW(),"%Y-%m-15"),INTERVAL 1 MONTH)'
        .' ELSE '.
        $field.' BETWEEN DATE_ADD(DATE_FORMAT(NOW(),"%Y-%m-16"),INTERVAL -1 MONTH) AND DATE_FORMAT(NOW(),"%Y-%m-15")'
        .' END';
    }
    return '1=1';
}


/**
 * @param $year
 * @param $month
 * @return array
 */
function Month_To_Date($year,$month){

    $date=array();
    //如果 2月份 则 1月16-2月15
    if($month>1){
        $date=array(
            $year.'-'.($month-1).'-'.FIST_DAY.' 00:00:00',
            $year.'-'.$month.'-'.END_DAY.' 23:59:59'
        );
        return $date;
    }else{
        $date=array(
            ($year-1).'-12-'.FIST_DAY.' 00:00:00',
            $year.'-'.$month.'-'.END_DAY.' 23:59:59'
        );
        return $date;
    }
}

/**
 * 导出数据为excel表格
 *@param $data    一个二维数组,结构如同从数据库查出来的数组
 *@param $title   excel的第一行标题,一个数组,如果为空则没有标题
 *@param $filename 下载的文件名
 *@examlpe
$stu = M ('User');
$arr = $stu -> select();
exportexcel($arr,array('id','账户','密码','昵称'),'文件名!');
 */
function export($data=array(),$title=array(),$filename='report'){
    header("Content-type:text/csv");
    header("Content-Disposition:attachment;filename=".$filename.".csv");
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
    header('Expires:0');
    header('Pragma:public');
    //导出xls 开始
    if (!empty($title)){
        $title= implode(",", $title);
        echo iconv('utf-8','gb2312', $title."\n");
    }

    foreach ($data as $k=>$v){
        $str = $k+1;
        $str .= ','.$v['username'];
        $str .= ','.$v['section'];
        $str .= ','.$v['is_admin'];
        $str .= ','.$v['assetype'];
        $str .= ','.$v['assessment_result'];
        $str .= ','.$v['standard_score'];
        $str .= ','.$v['coefficient'];
        $str .= ','.$v['year'];
        $str .= ','.$v['month'];
        $str .= ','.$v['create_time'];
        echo iconv('utf-8','gb2312', $str."\n");
    }
}

/**
+----------------------------------------------------------
 * Export Excel | 2013.08.23
 * Author:HongPing <hongping626@qq.com>
+----------------------------------------------------------
 * @param $expTitle     string File name
+----------------------------------------------------------
 * @param $expCellName  array  Column name
+----------------------------------------------------------
 * @param $expTableData array  Table data
+----------------------------------------------------------
 */
function exportExcel($expTitle,$expCellName,$expTableData){
    $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
    $fileName = $_SESSION['loginAccount'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
    $cellNum = count($expCellName);
    $dataNum = count($expTableData);
    vendor("PHPExcel.PHPExcel");
    $objPHPExcel = new PHPExcel();
    $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

    //$objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
    //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
    for($i=0;$i<$cellNum;$i++){
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'1', $expCellName[$i][1]);
    }
    // Miscellaneous glyphs, UTF-8
    for($i=0;$i<$dataNum;$i++){
        for($j=0;$j<$cellNum;$j++){
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+2), $expTableData[$i][$expCellName[$j][0]]);
        }
    }

    header('pragma:public');
    header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
    header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}

function downloadExcel($filename = '20170104.xls'){
	$filename='Excel/'.$filename;
	$file=fopen($filename,"r");
	//    print_r($filename);
	//    return;
	//打开文件
	header("Content-type:application/octet-stream");
	header("Accept-Ranges:bytes");
	header("Content-Type:application/msexcel");
	header("Accept-Length:".filesize($filename));
	header("Content-Disposition:attachment;filename=".$filename);
	echo fread($file,filesize($filename));
	fclose($file);
}
/**
+----------------------------------------------------------
 * Import Excel | 2013.08.23
 * Author:HongPing <hongping626@qq.com>
+----------------------------------------------------------
 * @param  $file   upload file $_FILES
+----------------------------------------------------------
 * @return array   array("error","message")
+----------------------------------------------------------
 */
function importExecl($file){
    if(!file_exists($file)){
        return array("error"=>0,'message'=>'file not found!');
    }
    Vendor("PHPExcel.PHPExcel.IOFactory");
    $objReader = PHPExcel_IOFactory::createReader('Excel5');
//    print_r($objReader);
    try{
        $PHPReader = $objReader->load($file);
    }catch(Exception $e){}
    if(!isset($PHPReader)) return array("error"=>0,'message'=>'read error!');
    $allWorksheets = $PHPReader->getAllSheets();
    $i = 0;
    foreach($allWorksheets as $objWorksheet){
        $sheetname=$objWorksheet->getTitle();
        $allRow = $objWorksheet->getHighestRow();//how many rows
        $highestColumn = $objWorksheet->getHighestColumn();//how many columns
        $allColumn = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $array[$i]["Title"] = $sheetname;
        $array[$i]["Cols"] = $allColumn;
        $array[$i]["Rows"] = $allRow;
        $arr = array();
        $isMergeCell = array();
        foreach ($objWorksheet->getMergeCells() as $cells) {//merge cells
            foreach (PHPExcel_Cell::extractAllCellReferencesInRange($cells) as $cellReference) {
                $isMergeCell[$cellReference] = true;
            }
        }
        for($currentRow = 1 ;$currentRow<=$allRow;$currentRow++){
            $row = array();
            for($currentColumn=0;$currentColumn<$allColumn;$currentColumn++){;
                $cell =$objWorksheet->getCellByColumnAndRow($currentColumn, $currentRow);
                $afCol = PHPExcel_Cell::stringFromColumnIndex($currentColumn+1);
                $bfCol = PHPExcel_Cell::stringFromColumnIndex($currentColumn-1);
                $col = PHPExcel_Cell::stringFromColumnIndex($currentColumn);
                $address = $col.$currentRow;
                $value = $objWorksheet->getCell($address)->getValue();
                if(substr($value,0,1)=='='){
                    return array("error"=>0,'message'=>'can not use the formula!');
                    exit;
                }
                if($cell->getDataType()==PHPExcel_Cell_DataType::TYPE_NUMERIC){
                    $cellstyleformat=$cell->getParent()->getStyle( $cell->getCoordinate() )->getNumberFormat();
                    $formatcode=$cellstyleformat->getFormatCode();
                    if (preg_match('/^([$[A-Z]*-[0-9A-F]*])*[hmsdy]/i', $formatcode)) {
                        $value=gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($value));
                    }else{
                        $value=PHPExcel_Style_NumberFormat::toFormattedString($value,$formatcode);
                    }
                }
                $temp='';
                if($isMergeCell[$col.$currentRow]&&$isMergeCell[$afCol.$currentRow]&&!empty($value)){
                    $temp = $value;
                }elseif($isMergeCell[$col.$currentRow]&&$isMergeCell[$col.($currentRow-1)]&&empty($value)){
                    $value=$arr[$currentRow-1][$currentColumn];
                }elseif($isMergeCell[$col.$currentRow]&&$isMergeCell[$bfCol.$currentRow]&&empty($value)){
                    $value=$temp;
                }
                $row[$currentColumn] = $value;
            }
            $arr[$currentRow] = $row;
        }
        $array[$i]["Content"] = $arr;
        $i++;
    }
    //spl_autoload_register(array('Think','autoload'));//must, resolve ThinkPHP and PHPExcel conflicts
    unset($objWorksheet);
    unset($PHPReader);
    unset($PHPExcel);
    unlink($file);
    return array("error"=>1,"data"=>$array);
}


/**
 * 返回导入的数据
 * @param string $name
 * @return mixed
 */
function getImport($name = 'import'){
	if(isset($_FILES[$name]) && ($_FILES[$name]["error"] == 0)){
		$result = importExecl($_FILES[$name]["tmp_name"]);
		$data = array();
		if($result["error"] == 1){
			$data = $result["data"][0]["Content"];
		}
		return $data;
	}
}