<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: yangweijie <yangweijiester@gmail.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;

/**
 * 后台配置控制器
 * @author yangweijie <yangweijiester@gmail.com>
 */
class MenuController extends AdminController {

    /**
     * 后台菜单首页
     * @return none
     */
    public function index(){
        $pid  = I('get.pid',0);
        if($pid){
            $data = M('Menu')->where("id={$pid}")->field(true)->find();
            $this->assign('data',$data);
        }
       
        $this->meta_title = '菜单列表';
        
        //加载静态插件
        $this->assign('__plugins', 'datatable');
        $this->assign('__sidebar', 'Menu/index');
        
        $this->display();
    }
    
    /**
     * 获取菜单列表
     */
    public function getLists(){
    	
     	$pid  = I('get.pid',0);
     	$option = array('order' => 'sort asc,id asc');
        if($pid){
        	$option = array('where' => 'pid = '.$pid);
            $data = M('Menu')->where("id={$pid}")->field(true)->find();
            $this->assign('data', $data);
        }else{
        	$option = array('where' => 'pid = 0');
        }
        
    	$tA = $this->pagination(M('Menu'), $option);
    	$all_menu   =   M('Menu')->getField('id,title');
    	int_to_string($tA['data'], array('hide'=>array(1=>'是',0=>'否'),'is_dev'=>array(1=>'是',0=>'否')));
		if( ! empty($tA['data'])){
			int_to_string($tA['data'], array('type'=>C('HOOKS_TYPE')));
			foreach ($tA['data'] as $k => $v){
				
				$btn = '<a href="'.U('edit?id='.$v['id'].'&pid='.$pid).'" 
					   class="btn default  btn-xs blue-stripe">编辑</a>';
				$btn .= ' <a href="'.U('del?id='.$v['id']).'" 
						class="btn ajax-request-btn default btn-xs red-stripe" alert-message="确认是否删除？">删除</a>';
				$tA['aaData'][$k][] = $v['id'];
				$tA['aaData'][$k][] = '<a href="'.U('Menu/index?pid='.$v['id']).'">'.$v['title'].'</a>';
				$tA['aaData'][$k][] =  ! empty($all_menu[$v['pid']]) ? $all_menu[$v['pid']] : '无';
				$tA['aaData'][$k][] = $v['group'];
				$tA['aaData'][$k][] = $v['url'];
				$tA['aaData'][$k][] = $v['sort'];
				$tA['aaData'][$k][] = $v['is_dev_text'];
				$tA['aaData'][$k][] = $v['hide_text'];
				$tA['aaData'][$k][] = $btn;
			}	
		}
		
		unset($tA['data']);
		echo json_encode($tA);
    }

    /**
     * 新增菜单
     * @author yangweijie <yangweijiester@gmail.com>
     */
    public function add(){
    	$pid  = I('get.pid',0);
        if(IS_POST){
            $Menu = D('Menu');
            $data = $Menu->create();
            if($data){
                $id = $Menu->add();
                if($id){
                    session('ADMIN_MENU_LIST',null);
                    //记录行为
                    action_log('update_menu', 'Menu', $id, UID);
                    $this->success('新增成功', U('index?pid='.$pid));
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Menu->getError());
            }
        } else {
            $this->assign('info',array('pid'=>I('pid')));
            $menus = M('Menu')->field(true)->select();
            $menus = D('Common/Tree')->toFormatTree($menus);
            $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $menus);
            $this->assign('Menus', $menus);
            
            $data = M('Menu')->where("id={$pid}")->field(true)->find();
            $this->assign('data', $data);
            
            $this->meta_title = '新增菜单';
            //加载静态插件
       		$this->assign('__plugins', 'validation,uniform');
       		$this->assign('__sidebar', 'Menu/index');
            $this->display('edit');
        }
    }

    /**
     * 编辑配置
     * @author yangweijie <yangweijiester@gmail.com>
     */
    public function edit($id = 0){
    	
    	$pid  = I('get.pid',0);
        if(IS_POST){
            $Menu = D('Menu');
            $data = $Menu->create();
            if($data){
                if($Menu->save()!== false){
                    session('ADMIN_MENU_LIST',null);
                    //记录行为
                    action_log('update_menu', 'Menu', $data['id'], UID);
                    $this->success('更新成功', U('index?pid'.$pid));
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($Menu->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Menu')->field(true)->find($id);
            $menus = M('Menu')->field(true)->select();
            $menus = D('Common/Tree')->toFormatTree($menus);
			
            $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $menus);
            $this->assign('Menus', $menus);
            if(false === $info){
                $this->error('获取后台菜单信息错误');
            }
            
            $data = M('Menu')->where("id={$pid}")->field(true)->find();
            $this->assign('data', $data);
             $this->assign('edit', true);
            $this->assign('info', $info);
            $this->thisaddress = array('系统设置','编辑后台菜单');
            $this->meta_title = '编辑后台菜单';
            //加载静态插件
       		$this->assign('__plugins', 'validation,uniform');
       		$this->assign('__sidebar', 'Menu/index');
            $this->display();
        }
    }

    /**
     * 删除后台菜单
     * @author yangweijie <yangweijiester@gmail.com>
     */
    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        //$map = array('id' => array('in', $id), 'pid' => array('in', $id), 'logic' => 'OR');
        $res1=M('Menu')->where(array('id' => array('in', $id)))->delete();
        $res2=M('Menu')->where(array('pid' => array('in', $id)))->delete();
        if($res1||$res2){
            session('ADMIN_MENU_LIST',null);
            //记录行为
            action_log('update_menu', 'Menu', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

    public function toogleHide($id,$value = 1){
        session('ADMIN_MENU_LIST',null);
        $this->editRow('Menu', array('hide'=>$value), array('id'=>$id));
    }

    public function toogleDev($id,$value = 1){
        session('ADMIN_MENU_LIST',null);
        $this->editRow('Menu', array('is_dev'=>$value), array('id'=>$id));
    }

    public function importFile($tree = null, $pid=0){
        if($tree == null){
            $file = APP_PATH."Admin/Conf/Menu.php";
            $tree = require_once($file);
        }
        $menuModel = D('Menu');
        foreach ($tree as $value) {
            $add_pid = $menuModel->add(
                array(
                    'title'=>$value['title'],
                    'url'=>$value['url'],
                    'pid'=>$pid,
                    'hide'=>isset($value['hide'])? (int)$value['hide'] : 0,
                    'tip'=>isset($value['tip'])? $value['tip'] : '',
                    'group'=>$value['group'],
                )
            );
            if($value['operator']){
                $this->import($value['operator'], $add_pid);
            }
        }
    }

    public function import(){
        if(IS_POST){
            $tree = I('post.tree');
            $lists = explode(PHP_EOL, $tree);
            $menuModel = M('Menu');
            if($lists == array()){
                $this->error('请按格式填写批量导入的菜单，至少一个菜单');
            }else{
                $pid = I('post.pid');
                foreach ($lists as $key => $value) {
                    $record = explode('|', $value);
                    if(count($record) == 2){
                        $menuModel->add(array(
                            'title'=>$record[0],
                            'url'=>$record[1],
                            'pid'=>$pid,
                            'sort'=>0,
                            'hide'=>0,
                            'tip'=>'',
                            'is_dev'=>0,
                            'group'=>'',
                        ));
                    }
                }
                session('ADMIN_MENU_LIST',null);
                $this->success('导入成功',U('index?pid='.$pid));
            }
        }else{
            $this->meta_title = '批量导入后台菜单';
            $pid = (int)I('get.pid');
            $this->assign('pid', $pid);
            $data = M('Menu')->where("id={$pid}")->field(true)->find();
            $this->assign('data', $data);
            $this->display();
        }
    }

    /**
     * 菜单排序
     * @author huajie <banhuajie@163.com>
     */
    public function sort(){
        if(IS_GET){
            $ids = I('get.ids');
            $pid = I('get.pid');

            //获取排序的数据
            $map = array('status'=>array('gt',-1));
            if(!empty($ids)){
                $map['id'] = array('in',$ids);
            }else{
                if($pid !== ''){
                    $map['pid'] = $pid;
                }
            }
            $list = M('Menu')->where($map)->field('id,title')->order('sort asc,id asc')->select();

            $this->assign('list', $list);
            $this->meta_title = '菜单排序';
            $this->display();
        }elseif (IS_POST){
            $ids = I('post.ids');
            $ids = explode(',', $ids);
            foreach ($ids as $key=>$value){
                $res = M('Menu')->where(array('id'=>$value))->setField('sort', $key+1);
            }
            if($res !== false){
                session('ADMIN_MENU_LIST',null);
                $this->success('排序成功！');
            }else{
                $this->error('排序失败！');
            }
        }else{
            $this->error('非法请求！');
        }
    }
}