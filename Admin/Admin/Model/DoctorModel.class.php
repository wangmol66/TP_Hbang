<?php
namespace Admin\Model;
use Think\Model;
class DoctorModel extends Model {

	public $tableName 			= 'hbang_doctor';			//往期回顾
	public $tbDoctorReply 		= 'hbang_doctor_reply';		//回复列表
	public $tbDoctorUserLog 	= 'hbang_doctor_user_log';	//用户操作记录
	public $tbDoctorCategory 	= 'hbang_doctor_category';	//用户操作记录
}