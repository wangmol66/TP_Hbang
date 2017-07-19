<?php
namespace Common\Library\validation;

/**
 * 数据验证类
 * 
 * @author Lihaiping
 *
 */
class Validation{

	//验证的数据
	public $validationData = array();
	
	//自定义的错误信息
	protected $errorMessages = array();
	
	//验证过后的错误信息
	protected $errorArray = array();
	
	//验证规则
	protected $configRules = array();
	
	
	/**
	 * 设置验证规则
	 */
	public function setRules($rules){
	
		$this->configRules = $rules;	
	}
	
	/**
	 * 设置验证数据
	 */
	public function setValidationData($data){
		$this->validationData = $data;
	}
	
	/**
	 * 验证开始
	 */
	public function run(){
		
		//设置验证数据
		if( ! $this->validationData) $this->validationData = $_POST;
		if( ! $this->configRules) return $this->errorArray;
				
		foreach ($this->configRules as $v){
			
			$field = $v[0];
			$label = $v[1];
			$rules = trim($v[2]);
			$message = '';
			if(isset($v[3])){
				$message = $v[3];
			}
			
			if( ! $rules) continue;

			
			
		}
	}
	
	/**
	 * 验证必填
	 * @param mixed $str
	 */
	protected function _required($str){
	
		return is_array($str) ? (bool) count($str) : (trim($str) !== '');
	}
	
	
	/**
	 * 获取错误消息
	 */
	protected function getErrorMessage(){
		
		$data = array(
					'required' => '{field}不能为空',
					'isset' => '{field}格式错误',
					'email' => '{field}格式错误',
					'emails' => '{field}不能为空',
					'url' => '{field}格式错误',
					'ip' => '{field}不是正确的IP',
					'min_length' => '{field}长度必须大于等于{param}',
					'max_length' => '{field}长度必须小于等于{param}',
					'alpha' => '{field}只能是字母',
					'numeric' => '{field}只能是数字',
					'integer' => '{field}必须是整数',
					'natural_no_zero' => '{field}必须是大于0的整数',
			);
	}
}
