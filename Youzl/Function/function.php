<?php
/**
 * 函数库
 */

function pp(){
	echo "我是函数";
}


/**
 * 获取子集[递归][来自Youzl方法]
 * @param integer $pid		父级ID
 * @param array   $data		原始数据
 * @param string  $id		做为id的字段名称
 * @param string  $pid		做为pid的字段名称
 * @param string  $child	做为child的字段名称
 * @return array[][]
 */
function getchild($pid,$data,$id = 'id',$parent = 'pid',$child = 'child'){
	$DATA = array();
	foreach ($data as $k=>$v){
		if($v[$parent] == $pid){
			$v[$child] = getchild($v[$id], $data, $id, $parent, $child);
			$DATA[] = $v;
		}
	}
	
	return $DATA;
}


/**
 * 获取回复结构[递归][来自Youzl方法]
 * @param integer $pid		父级ID
 * @param array   $data		原始数据
 * @param string  $id		做为id的字段名称
 * @param string  $pid		做为pid的字段名称
 * @param string  $child	做为child的字段名称
 * @param string  $reply	做为回复列表的字段名称
 * @return array[][]
 */
/*
Array
(
		[0] => Array
		(
				[rid] => 1
				[prid] => 0
				[user_id] => 1
				[addtime] => 1494317856
				[content] => 啊啊啊啊啊啊啊啊啊啊啊啊
				[child] => Array
					(
						[0] => Array
							(
								[rid] => 3
								[prid] => 1
								[user_id] => 2
								[addtime] => 1494317856
								[content] => 啊啊啊啊啊是的发送到发送到发送到发送到是
								[reply] => Array
								(
										[rid] => 1
										[prid] => 0
										[user_id] => 1
										[addtime] => 1494317556
										[content] => 啊啊啊啊啊啊啊啊啊啊啊啊
								)
							)
							
					)

		)


)
*/
function getchildReply($pid,$data,$id = 'id',$parent = 'pid',$child = 'child',$reply = 'reply'){
	$DATA = array();
	$PARENT = array();
	foreach ($data as $k=>$v){

		//该数组是当前数组的父级
		if($v[$id] == $pid){
			$PARENT = $v;
		}

		if($v[$parent] == $pid){
			
			//再寻找子集
			$new = getchildReply($v[$id], $data, $id, $parent, $child);
			
			if($pid == 0){
				//父级时，则做为子集
				$v[$child] = $new;
				$DATA[] = $v;
				
			}else{
				
				//子集的相关处理
				$v[$reply] = $PARENT;
				$DATA[] = $v;
				$DATA = array_merge($DATA,$new);
			}
		}
	}

	return $DATA;
}



