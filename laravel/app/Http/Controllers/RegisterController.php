<?php

namespace App\Http\Controllers;
use Session;
use Cookie;
use Request;
use DB;
use Mail;


/**
 *	@Modular 	注册页面
 *	@Class 		Register
 *	@Author 	宁铭杰
 *	@Time 		2016/05/17
**/


class RegisterController extends Controller
{

	/*注册表单展示页*/
	public function index()
	{
		 return view('Register/register');
	}
	

	/*邮件发送*/
	public function emailSend()
	{
		//接收邮箱地址
		$email= Request::get('email');
		$url='http://www.snail.com/register/act?email='.$email;
		$data = ['email'=>$email, 'name'=>'蜗牛', 'uid'=>'1', 'activationcode'=>'1','url'=>$url];
		Mail::send('Register/activation', $data, function($message) use($data)
		{
		    $message->to($data['email'], $data['name'])->subject('蜗牛家,我的家！');
		    echo 1;
		});


	}


  	/*注册*/
	public function register()
	{
		//接收注册
		$Mobile= Request::get('Mobile');
		$Password=Request::get('Password');
		$FromId=Request::get('FromId');
		$Email=Request::get('Email');
		$operation=DB::insert("insert into user (u_phone,u_pwd,u_email,u_evaluate) value('$Mobile','$Password','$Email',200)");
		if ($operation) {
			return view('Message/welcome');
		}else{
			echo "0";
		}
	}


	/*手机验证码验证*/
	public function phoneVerification()
	{
		$phone= Request::get('phone');	//获取手机号
		$yz= Request::get('yz');	//获取验证码
		$url="http://api.k780.com:88/?app=sms.send&tempid=50508&param=code%3d{$yz}&phone={$phone}&appkey=&sign=&format=json";
		$re=file_get_contents($url);
		$ar=json_decode($re,true);	//对接口返回数据进行数组转换
		if ($ar['success']==1) {	//判断状态是否成功
			echo 1;
		}
	}
	
	/*邮箱激活*/
	public function emailActivation()
	{
		$email= Request::get('email');
		//echo $email;
		$bool=DB::update("update user set u_evaluate=u_evaluate+'800' where u_email = '$email'");
		if ($bool) {
			echo "<script>alert('激活成功,留在本页')</script>";
		}
	}


	/*XSS测试-表单*/
	public function demo()
	{
		return view('Register/demo');
		
	}
	/*XSS测试*/
	public function demo1()
	{
		$user= Request::get('user');
		echo $user;
		
	}
}