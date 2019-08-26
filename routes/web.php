<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 后台登录和退出,路由组结合中间件
Route::resource('/adminlogin','Admin\AdminLoginControler');
// 后台路由组
Route::group(['middleware'=>'adminlogin'],function(){
	// 后台首页
	Route::resource('/admin','Admin\AdminController');
	// 分类菜单
	Route::resource('/admincates','Admin\CateController');
	// 会员模型模块
	Route::resource('/users1','Admin\Users1Controller');
	// // 获取会员详情信息
	Route::get('/userinfo/{id}','Admin\Users1Controller@userinfo');
	// 获取收货地址
	Route::get('/useraddress/{id}','Admin\Users1Controller@useraddress');
	// 后台管理员管理
	Route::resource('/adminusers','Admin\AdminusersController');
	// 分配角色
	Route::get('/adminusesrrole/{id}','Admin\AdminusersController@adminuserrole');
	// 保存角色
	Route::post('/saverole','Admin\AdminusersController@severole');
	//角色管理
	Route::resource('/role','Admin\RoleController');
	// 分配权限
	Route::get('/adminauth/{id}','Admin\RoleController@adminauth');
	// 保存权限
	Route::post('/saveauth','Admin\RoleController@saveauth');
	// 权限管理
	Route::resource('/auth','Admin\AuthController');
	// 公告模块
	Route::resource('/adminarticles','Admin\ArticlesController');
	// Ajax 删除
	Route::get('/articledel','Admin\ArticlesController@del');
	// 商城
	Route::resource('/adminshop','Admin\ShopController');
	// 订单管理
	Route::resource('/orderforms','Admin\OrderformsController');
	// 评论管理
	Route::resource('/comments','Admin\CommentController');
	// 轮播图管理
	Route::resource('/banner','Admin\BannerController');


});

// 前台的邮件测试 原始字符串
Route::get('/sendmail','Home\RegisterController@sendmail');
// 前台的邮件测试2 发送视图
Route::get('/sendmail1','Home\RegisterController@sendmail1');
// 激活用户
Route::get('/jihuo','Home\RegisterController@jihuo');
// 前台注册 邮箱
Route::resource('/homeregister','Home\RegisterController');
// 手机号注册
Route::post('/registerphone','Home\RegisterController@registerphone');
// 检测手机号是否唯一
Route::get('/checkphone','Home\RegisterController@checkphone');
// 测试生成校验码
Route::get('/code','Home\RegisterController@code');
// 发送短信校验码
Route::get('/registersendphone','Home\RegisterController@registersendphone');
// 检测校验码
Route::get('/checkcode','Home\RegisterController@checkcode');

// 前台登录
Route::resource('/homelogin','Home\HomeLoginController');
// 忘记密码
Route::get('/forget','Home\HomeLoginController@forget');
// 发送邮件找回密码
Route::post('/doforget','Home\HomeLoginController@doforget');
// 邮件视图 重置密码 加载密码重置模板
Route::get('/reset','Home\HomeLoginController@reset');
// 重置密码 密码修改
Route::post('/doreset','Home\HomeLoginController@doreset');
// 前台首页
Route::resource('/homeindex','Home\IndexController');
// 退出
Route::get('/homelogout','Home\IndexController@logout');

// 密保问题找回密码
Route::get('/encrypted/mibao',"Home\IndexController@mibao");
Route::post('/mibaos','Home\IndexController@mibaos');
// 密保问题判断
Route::post('/mibaowenti/{id}','Home\IndexController@mibaowenti');
// 密保修改密码
Route::post('/editmibao/{id}','Home\IndexController@editmibao');




Route::group(['middleware'=>'login'],function(){
	// 购物车
Route::resource('/homecart','Home\CartController');
// 全部删除
Route::get('alldelete','Home\CartController@alldelete');
	// ajax的减操作
	Route::get('/cartupdatee','Home\CartController@updatee');
	// ajax的加操作
	Route::get('/cartupdate','Home\CartController@cartupdate');

	// 勾选当前购买的商品
	Route::get('/homecarttot','Home\CartController@homecarttot');
	// 结算操作
	Route::get('/jiesuan','Home\OrderController@jiesuan');

	Route::get('/homeorder/insert','Home\OrderController@insert');
	// 获取城市级联数据
	Route::get('/address','Home\AddressController@address');
	// 插入收货地址
	Route::post('/addressinsert','Home\AddressController@insert');
	// 选择收货地址
	Route::get('/choose','Home\AddressController@choose');

	// 下单请求
	Route::any('/order/create','Home\OrderController@ordercreate');
	// 支付完毕后跳转路由
	Route::get('/returnurl','Home\OrderController@returnurl');
	// 个人中心
	Route::get('/personal','Home\PersonalController@personal');
	Route::get('/personals','Home\PersonalController@personals');

	// 订单管理
	Route::get('/orderform','Home\PersonalController@orderform');
	// 评价管理
	Route::resource('/evaluate','Home\EvaluateController');
	// 个人中心支付操作
	Route::get('/orderpays/{id}','Home\PersonalController@orderpays');
	// 个人中心取消订单
	Route::get('/quxiao/{id}','Home\PersonalController@quxiao');
	// 确认收货
	Route::get('/querenhuoshou/{id}','Home\PersonalController@querenhuoshou');
	// 个人评价
	Route::get('/pingjia/{id}','Home\EvaluateController@pingjia');
	Route::post('/Ecreates/{id}','Home\EvaluateController@Ecreates');

	// 地址管理
	Route::resource('/Address','Home\AddressController');
	// 设置默认地址
	Route::get('/moaddress/{id}','Home\AddressController@moaddress');

	// 多级分类
	// Route::get();
	// 我的账户
	Route::get('/account','Home\PersonalController@account');
	// 设置密保
	Route::get('/encrypted','Home\PersonalController@encrypted');
	// 保存密保问题
	Route::post('/encrypted/{id}','Home\PersonalController@encrypteds');

});

// 测试redis
Route::get('/rediss','Home\IndexController@rediss');
