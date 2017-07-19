<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Addons\Ckeditor\Controller;
use Home\Controller\AddonsController;
use Think\Upload;

class UploadController extends AddonsController{

	public $uploader = null;

	/**
	 * 上传剪切图片
	 */
	public function upload(){
		
		$data = array();
		
		/* 上传配置 */
		$setting = C('EDITOR_UPLOAD');

		/* 调用文件上传组件上传文件 */
		$this->uploader = new Upload($setting, 'Local');
		$info   = $this->uploader->upload($_FILES);
		if($info){
			$url = C('EDITOR_UPLOAD.rootPath').$info['imgFile']['savepath'].$info['imgFile']['savename'];
			$url = str_replace('./', '', $url);
			$info['fullpath'] = $url;
		}
		session('upload_error', $this->uploader->getError());
		
		if( ! empty($info['upload']['savename'])){
		
			$data = array('filName' => $info['upload']['savename'],'uploaded' => 1, 
						  'error' => array('number' => 201, 'message' => '上传成功'),
						  'url' => $info['fullpath'].$info['upload']['savepath'].$info['upload']['savename']);
		}
		echo json_encode($data);
	}
	
	public function browse(){
	
	}
	
	/**
	 * 上传图片
	 * @return	void
	 */
	public function uploadImg(){
		
		$callBack = $_GET['CKEditorFuncNum'];
		echo $callBack;
		$data = array();
		
		/* 上传配置 */
		$setting = C('EDITOR_UPLOAD');

		/* 调用文件上传组件上传文件 */
		$this->uploader = new Upload($setting, 'Local');
		$info   = $this->uploader->upload($_FILES);
		if($info){
			$url = C('EDITOR_UPLOAD.rootPath').$info['imgFile']['savepath'].$info['imgFile']['savename'];
			$url = str_replace('./', ' ', $url);
			$info['fullpath'] = $url;
		}
		session('upload_error', $this->uploader->getError());
		
		if( ! empty($info['upload']['savename'])){
		
			$data = array('filName' => $info['upload']['savename'],'uploaded' => 1, 
						  'error' => array('number' => 201, 'message' => '上传成功'),
						  'url' => $info['fullpath'].$info['upload']['savepath'].$info['upload']['savename']);
			
			echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'.$callBack.'", "'.$data['url'].'", "");</script>';exit;
		}
		
		echo json_encode($data);
	
	}
}
