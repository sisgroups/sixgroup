<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



/*主界面*/
Route::any('index','MessageController@index');

/*搜索界面*/
Route::any('sreach','MessageController@sreach');

/*主题->情侣*/
Route::any('love','ThemeController@love');

/*主题->北京美景*/
Route::any('meijing','ThemeController@meijing');

/*主题->北京欢乐谷*/
Route::any('hlg','ThemeController@hlg');

/*主题->北京房车*/
Route::any('carhome','ThemeController@carhome');

/*主题->北京精品*/
Route::any('jing','ThemeController@jing');




/*登录*/
//Route::get('login','LoginController@index');

//普通登陆
//Route::any('login/register','LoginController@register');
//手机登陆发送短信
//Route::any('login/phone','LoginController@phone');
//手机登陆接收表单
//Route::any('login/cellphone','LoginController@cellphone');
//退出登录
//Route::any('login/del','LoginController@del');


/*列表*/
Route::get('main','MainController@index');

/*商品详情页*/
Route::any('good','GoodController@index');



/*注册*/
Route::any('register','RegisterController@index');

//注册添加
Route::any('register/reg','RegisterController@register');
//邮件发送
Route::any('register/send','RegisterController@emailSend');
//邮件激活
Route::any('register/act?uid=1','RegisterController@emailActivation');
//手机验证
Route::any('register/phone','RegisterController@phoneVerification');



/*房源*/
//Route::any('room','RoomController@index');

//房源信息接收表单
//Route::any('room/store','RoomController@Store');

//登陆展示页面
Route::get('login','LoginController@index');
//普通登陆
Route::any('login/register','LoginController@register');
//手机登陆发送短信
Route::any('login/phone','LoginController@phone');
//手机登陆接收表单
Route::any('login/cellphone','LoginController@cellphone');
//推出登陆
Route::any('login/del','LoginController@del');

//房源展示页面
Route::any('room','RoomController@index');
//房源信息接收表单
Route::post('room/message','RoomController@room_message');
//房源照片
Route::any('room/photo','RoomController@room_photo');
//房源照片接收
Route::any('room/photos','RoomController@room_photos');
//房源价格页面
Route::any('room/price','RoomController@room_price');
//房源价格接收
Route::any('room/prices','RoomController@room_prices');
//房源个人信息页面
Route::any('room/personage','RoomController@room_personage');
//房源个人信息接收
Route::any('room/personages','RoomController@room_personages');
//房源发布成功页面
Route::any('room/success','RoomController@room_success');
//支付页面
Route::any('payment','PaymentController@index');


//用户个人中心

