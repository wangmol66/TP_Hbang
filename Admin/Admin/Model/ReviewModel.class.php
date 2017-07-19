<?php
namespace Admin\Model;
use Think\Model;
class ReviewModel extends Model {

	public $tableName 			= 'hbang_review';			//往期回顾
	public $tbReviewReply 		= 'hbang_review_reply';		//回复列表
	public $tbReviewUserLog 	= 'hbang_review_user_log';	//用户操作记录
	public $tbReivewLunbo 	= 'hbang_reivew_lunbo';	//轮播
	public $tbReivewCategory= 'hbang_review_category';	//轮播
}