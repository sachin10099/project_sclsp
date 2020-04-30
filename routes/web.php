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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('admin/login', 'Admin\AuthController@index')->name('admin.loginView');
Route::post('admin/login', 'Admin\AuthController@login')->name('admin.login');
Route::get('forgot/password', 'Admin\AuthController@forgot')->name('forgot.password');
Route::post('forgot/password', 'Admin\AuthController@sendRestLink')->name('resetPasswordLink');
Route::get('reset/password/{token}', 'Admin\AuthController@resetPassView')->name('resetPassView');
Route::post('reset/password', 'Admin\AuthController@resetPass')->name('resetPass');

Route::post('global/login', 'HomeController@userLogin')->name('userLogin');

// Email Verify Route  
Route::get('verify/email/{token}', 'HomeController@emailVerify')->name('emailVerify');

// Form Filler Routes
Route::get('form-filler/index', 'FormFiller\FormFillerController@index')->name('formfiller.index');
Route::get('form-filler/signup', 'FormFiller\FormFillerController@signUpForm')->name('formfiller.signUpForm');
Route::get('form-filler/login', 'FormFiller\FormFillerController@loginView')->name('formfiller.loginView');
Route::post('form-filler/user/signup', 'FormFiller\FormFillerController@userSignUp')->name('formfiller.userSignUp');

Route::post('user/send-query', 'Admin\SupportCenterController@sendQuery')->name('sendQuery');

Route::post('subscribe', 'HomeController@subscribe')->name('subscribe');

Route::group(['middleware' => ['auth', 'adminCheck']], function () {
	Route::get('admin/logout', 'Admin\AuthController@logout')->name('admin.logout');
	Route::get('admin/dashboard', 'Admin\AuthController@dashboard')->name('admin.dashboard');
	Route::get('admin/profile', 'Admin\AuthController@profile')->name('admin.profile');
	Route::get('admin/profile/edit', 'Admin\AuthController@editProfile')->name('admin.editProfile');
	Route::post('admin/profile/update', 'Admin\AuthController@updateProfile')->name('admin.updateProfile');

	Route::get('admin/change/password', 'Admin\AuthController@changePasswordView')->name('admin.changePasswordView');
	Route::post('admin/change/password', 'Admin\AuthController@changePassword')->name('admin.changePassword');

	// Banner Management
	Route::get('admin/banner/list', 'Admin\HomeController@bannerList')->name('admin.bannerList');
	Route::get('admin/banner/edit/{id}', 'Admin\HomeController@banneredit')->name('admin.banneredit');
	Route::post('admin/banner/update', 'Admin\HomeController@bannerUpdate')->name('admin.bannerUpdate');

	// Why choose content
	Route::get('admin/why-choose/list', 'Admin\HomeController@whyChooseList')->name('admin.whyChooseList');
	Route::get('admin/why-choose/{id}', 'Admin\HomeController@whyChooseEdit')->name('admin.whyChooseEdit');
	Route::post('admin/why-choose/update', 'Admin\HomeController@whyChooseUpdate')->name('admin.whyChooseUpdate');

	// Manage Services
	Route::get('admin/service/list', 'Admin\HomeController@serviceList')->name('admin.serviceList');
	Route::get('admin/service/{id}', 'Admin\HomeController@serviceEdit')->name('admin.serviceEdit');
	Route::post('admin/service/update', 'Admin\HomeController@serviceUpdate')->name('admin.serviceUpdate');

	// Manage About Us Content
	Route::get('admin/about/list', 'Admin\HomeController@aboutList')->name('admin.aboutList');
	Route::get('admin/about/{id}', 'Admin\HomeController@aboutEdit')->name('admin.aboutEdit');
	Route::post('admin/about/update', 'Admin\HomeController@aboutUpdate')->name('admin.aboutUpdate');

	// Manage Scopes
	Route::get('admin/scopes/list', 'Admin\HomeController@scopeList')->name('admin.scopeList');
	Route::get('admin/scopes/{id}', 'Admin\HomeController@scopeEdit')->name('admin.scopeEdit');
	Route::post('admin/scopes/update', 'Admin\HomeController@scopeUpdate')->name('admin.scopeUpdate');

	// Manage Testimonial
	Route::get('admin/testimonial/list', 'Admin\HomeController@testimonialList')->name('admin.testimonialList');
	Route::get('admin/testimonial/{id}', 'Admin\HomeController@testimonialEdit')->name('admin.testimonialEdit');
	Route::post('admin/testimonial/update', 'Admin\HomeController@testimonialUpdate')->name('admin.testimonialUpdate');
	Route::post('admin/testimonial/delete', 'Admin\HomeController@testimonialDelete')->name('admin.testimonialDelete');
	Route::post('admin/testimonial/add', 'Admin\HomeController@testimonialAdd')->name('admin.testimonialAdd');

	// Manage Team
	Route::get('admin/team/list', 'Admin\HomeController@teamList')->name('admin.teamList');
	Route::get('admin/team/{id}', 'Admin\HomeController@teamEdit')->name('admin.teamEdit');
	Route::post('admin/team/update', 'Admin\HomeController@teamUpdate')->name('admin.teamUpdate');
	Route::post('admin/team/add', 'Admin\HomeController@teamAdd')->name('admin.teamAdd');
	Route::post('admin/team/delete', 'Admin\HomeController@teamDelete')->name('admin.teamDelete');

	// Manage Faqs
	Route::get('admin/faq/list', 'Admin\HomeController@faqList')->name('admin.faqList');
	Route::get('admin/faq/{id}', 'Admin\HomeController@faqEdit')->name('admin.faqEdit');
	Route::post('admin/faq/update', 'Admin\HomeController@faqUpdate')->name('admin.faqUpdate');
	Route::post('admin/faq/add', 'Admin\HomeController@faqAdd')->name('admin.faqAdd');
	Route::post('admin/faq/delete', 'Admin\HomeController@faqDelete')->name('admin.faqDelete');

	// Manage Contacts
	Route::get('admin/contact/list', 'Admin\HomeController@contactList')->name('admin.contactList');
	Route::get('admin/contact/{id}', 'Admin\HomeController@contactEdit')->name('admin.contactEdit');
	Route::post('admin/contact/update', 'Admin\HomeController@contactUpdate')->name('admin.contactUpdate');
	Route::post('admin/contact/add', 'Admin\HomeController@contactAdd')->name('admin.contactAdd');
	Route::post('admin/contact/delete', 'Admin\HomeController@contactDelete')->name('admin.contactDelete');

	// Manage Support Center
	Route::get('admin/query/list', 'Admin\SupportCenterController@querylistView')->name('admin.querylistView');
	Route::get('admin/query/data', 'Admin\SupportCenterController@querylist')->name('admin.querylist');
	Route::post('admin/reply', 'Admin\SupportCenterController@queryReply')->name('admin.queryReply');

	// Manage Social Links
	Route::get('admin/social/link', 'Admin\HomeController@socialLinks')->name('admin.socialLinks');
	Route::get('admin/social/link-edit/{id}', 'Admin\HomeController@socialLinkEdit')->name('admin.socialLinkEdit');
	Route::post('admin/social/link-update', 'Admin\HomeController@socialLinkUpdate')->name('admin.socialLinkUpdate');

	// Admin Notification List
	Route::get('admin/notification/list', 'Admin\NotificationController@index')->name('admin.linkList');	
	Route::post('admin/notification/delete', 'Admin\NotificationController@deleteNotification')->name('admin.deleteNotification');	
	Route::post('admin/notification/read', 'Admin\NotificationController@readNotification')->name('admin.readNotification');	

	// Manage Jobs
	Route::get('admin/jobs/list', 'Jobs\JobsController@index')->name('admin.jobs-list');
	Route::post('admin/jobs/list', 'Jobs\JobsController@jobList')->name('admin.jobList');
	Route::get('admin/jobs/edit/{id}', 'Jobs\JobsController@jobEdit')->name('admin.jobEdit');
	Route::get('admin/jobs/list-view', 'Jobs\JobsController@listView')->name('admin.listView');
	Route::get('admin/jobs/post', 'Jobs\JobsController@postJobView')->name('admin.postJobView');
	Route::post('admin/jobs/post', 'Jobs\JobsController@postJob')->name('admin.postJob');
	Route::post('admin/jobs/update', 'Jobs\JobsController@jobUpdate')->name('admin.jobUpdate');
	Route::post('admin/jobs/change-status', 'Jobs\JobsController@changeStatus')->name('admin.changeStatus');
	Route::post('admin/jobs/unpublish-job', 'Jobs\JobsController@unPublish')->name('admin.unPublish');
	Route::post('admin/jobs/delete', 'Jobs\JobsController@deleteJob')->name('admin.deleteJob');
});

Route::group(['middleware' => ['auth', 'formFiller']], function () {
	Route::get('global/logout', 'HomeController@logout')->name('logout');
	Route::get('form-filler/dashboard', 'FormFiller\FormFillerController@dashboard')->name('formfiller.dashboard');
	Route::get('form-filler/profile', 'FormFiller\FormFillerController@profile')->name('formfiller.profile');
	Route::post('form-filler/profile/update', 'FormFiller\FormFillerController@completeProfile')->name('formfiller.completeProfile');
	Route::post('form-filler/profile/update-info', 'FormFiller\FormFillerController@updateProfile')->name('formfiller.updateProfile');
	Route::post('form-filler/profile/profile-pic', 'FormFiller\FormFillerController@profilePic')->name('formfiller.profilePic');
	Route::get('form-filler/notifications', 'FormFiller\FormFillerController@notifications')->name('formfiller.notifications');
	Route::get('form-filler/notifications', 'FormFiller\FormFillerController@notifications')->name('formfiller.notifications');
	Route::get('form-filler/notifications/read/{id}/{job_id}', 'FormFiller\FormFillerController@readNotification')->name('formfiller.readNotification');
	Route::get('form-filler/job/list', 'FormFiller\FormFillerController@jobList')->name('formfiller.jobList');
	Route::get('form-filler/job/list-view', 'FormFiller\FormFillerController@listView')->name('formfiller.listView');
	Route::post('form-filler/jobs/data-more', 'Jobs\JobsController@jobList')->name('admin.data-more');
	Route::get('form-filler/job/profile/{id}', 'FormFiller\FormFillerController@jobProfile')->name('admin.jobProfile');

	// Job Management
	Route::post('form-filler/job/apply', 'FormFiller\JobController@apply')->name('job.apply');
	Route::get('form-filler/job/checkout/{amount}', 'FormFiller\JobController@checkout')->name('job.checkout');
	Route::post('form-filler/job/checkout/success', 'FormFiller\JobController@success')->name('job.success');
	Route::get('form-filler/user/jobs-view', 'FormFiller\JobController@listView')->name('job.listView');
	Route::get('form-filler/user/jobs', 'FormFiller\JobController@jobList')->name('job.jobList');
	Route::get('form-filler/user/details/{id}', 'FormFiller\JobController@jobDetails')->name('job.jobDetails');
});

// Operator User Routes
Route::post('operator/signup', 'Operator\OperatorController@signup')->name('operator.signup');




