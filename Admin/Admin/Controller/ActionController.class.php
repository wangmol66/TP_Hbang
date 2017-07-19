<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;

/**
 * 行为控制器
 * @author huajie <banhuajie@163.com>
 */
class ActionController extends AdminController {

    /**
     * 行为日志列表
     * @author huajie <banhuajie@163.com>
     */
    public function actionLog(){
        //获取列表数据
        $map['status']    =   array('gt', -1);
        $list   =   $this->lists('ActionLog', $map);
        int_to_string($list);
        foreach ($list as $key=>$value){
            $model_id                  =   get_document_field($value['model'],"name","id");
            $list[$key]['model_id']    =   $model_id ? $model_id : 0;
        }
        $this->assign('_list', $list);
        $this->meta_title = '行为日志';
        
        $this->assign('__plugins', 'datatable');
        $this->assign('__sidebar', 'Action/actionLog');
        $this->display();
    }
    
    /**
     * 获取行为日志列表
     */
    public function getLogLists(){

    	$map['status']    =   array('gt', -1);
    	$option = array('where' => array('status' => array('gt', -1)), 'order' => 'id desc');
        $tA = $this->pagination('ActionLog', $option);
   		int_to_string($tA['data']);
        foreach ($tA['data'] as $key=>$value){
            $model_id = get_document_field($value['model'],"name","id");
            $tA['data'][$key]['model_id'] = $model_id ? $model_id : 0;
        }
        
   		if( ! empty($tA['data'])){
			foreach ($tA['data'] as $k => $v){
				
				$btn = '<div class="btn-group">
									<a href="'.U('edit?id='.$v['id']).'" class="btn btn-default btn-xs">
										<i class="fa fa-eye"></i> 详情
									</a>
									<button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-xs" type="button"><i class="fa fa-angle-down"></i></button>
									<ul role="menu" class="dropdown-menu pull-right">
										<li>
											<a href="'.U('remove?ids='.$v['id']).'" class="ajax-request-btn" alert-message="确认是否删除'.get_action($v['action_id'], 'title').'？">
												 删除
											</a>
										</li>
									</ul>
								</div>';
				
				$tA['aaData'][$k][] = $v['id'];
				$tA['aaData'][$k][] = get_action($v['action_id'], 'title');
				$tA['aaData'][$k][] = get_nickname($v['user_id']);
				$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['create_time']);
				$tA['aaData'][$k][] = $btn;
			}	
		}
		
       unset($tA['data']);
	   echo json_encode($tA); 
    }

    /**
     * 查看行为日志
     * @author huajie <banhuajie@163.com>
     */
    public function edit($id = 0){
        empty($id) && $this->error('参数错误！');

        $info = M('ActionLog')->field(true)->find($id);

        $this->assign('info', $info);
        $this->meta_title = '查看行为日志';
        $this->assign('__sidebar', 'Action/actionLog');
        $this->display();
    }

    /**
     * 删除日志
     * @param mixed $ids
     * @author huajie <banhuajie@163.com>
     */
    public function remove($ids = 0){
        empty($ids) && $this->error('参数错误！');
        if(is_array($ids)){
            $map['id'] = array('in', $ids);
        }elseif (is_numeric($ids)){
            $map['id'] = $ids;
        }
        $res = M('ActionLog')->where($map)->delete();
        if($res !== false){
            $this->success('删除成功！');
        }else {
            $this->error('删除失败！');
        }
    }

    /**
     * 清空日志
     */
    public function clear(){
        $res = M('ActionLog')->where('1=1')->delete();
        if($res !== false){
            $this->success('日志清空成功！');
        }else {
            $this->error('日志清空失败！');
        }
    }

}
