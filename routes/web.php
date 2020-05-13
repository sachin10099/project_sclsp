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
Route::get('form-filler/results', 'FormFiller\FormFillerController@result')->name('formfiller.result');
Route::get('form-filler/admitcards', 'FormFiller\FormFillerController@admitCards')->name('formfiller.admitCards');
Route::get('form-filler/answerkeys', 'FormFiller\FormFillerController@answerKeys')->name('formfiller.answerKeys');
Route::get('form-filler/answerkeys/{id}', 'FormFiller\FormFillerController@answerKeyDetail')->name('formfiller.answerKeyDetail');

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
	Route::get('admin/notification/read/{id}/{job_id}', 'Admin\NotificationController@readNotification')->name('admin.readNotification');	
	Route::get('admin/notification/read/{id}', 'Admin\NotificationController@readByAdmin')->name('admin.readByAdmin');	

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
	Route::get('admin/applied/jobs', 'Jobs\JobsController@appliedJobsList')->name('admin.appliedJobsList');

	// Manage Admit Card And Answers Keys
	Route::get('form-filler/admit-card/list', 'AdminCard\AdmitCardController@index')->name('admitcard.list');
	Route::get('form-filler/admit-card/data', 'AdminCard\AdmitCardController@getAdminCards')->name('admitcard.getAdminCards');
	Route::get('form-filler/admit-card/add', 'AdminCard\AdmitCardController@addView')->name('admitcard.addView');
	Route::post('form-filler/admit-card/add', 'AdminCard\AdmitCardController@addAdmitCard')->name('admitcard.addAdmitCard');
	Route::get('form-filler/admit-card/list/edit/{id}', 'AdminCard\AdmitCardController@addView')->name('admitcard.addAdmitCardEdit');
	Route::post('form-filler/admit-card/list/edit/', 'AdminCard\AdmitCardController@editAdmitCardDetail')->name('admitcard.editAdmitCardDetail');
	Route::post('form-filler/admit-card/change-status', 'AdminCard\AdmitCardController@changeStatus')->name('admitcard.changeStatus');
	Route::post('form-filler/admit-card/delete', 'AdminCard\AdmitCardController@deleteRecord')->name('admitcard.deleteRecord');

	// Manage Amswers Keys
	Route::get('form-filler/answer-key/list', 'AnswerKey\AnswerkeyController@index')->name('answerkey.list');
	Route::get('form-filler/answer-key/data', 'AnswerKey\AnswerkeyController@getAnswerKeys')->name('answerkey.getAnswerKeys');
	Route::get('form-filler/answer-key/add', 'AnswerKey\AnswerkeyController@addView')->name('answerkey.addView');
	Route::post('form-filler/answer-key/add', 'AnswerKey\AnswerkeyController@addAnsweKey')->name('answerkey.addAnsweKey');
	Route::get('form-filler/answer-key/edit/{id}', 'AnswerKey\AnswerkeyController@addView')->name('answerkey.addAnswerKeyEdit');
	Route::post('form-filler/answer-key/edit/', 'AnswerKey\AnswerkeyController@editAdmitCardDetail')->name('answerkey.editAdmitCardDetail');
	Route::post('form-filler/answer-key/change-status', 'AnswerKey\AnswerkeyController@changeStatus')->name('answerkey.changeStatus');
	Route::post('form-filler/answer-key/upload-file', 'AnswerKey\AnswerkeyController@uploadFile')->name('answerkey.uploadFile');
	Route::get('form-filler/answer-key/files/{id}', 'AnswerKey\AnswerkeyController@viewFiles')->name('answerkey.getFiles');
	Route::get('form-filler/answer-key/files-data', 'AnswerKey\AnswerkeyController@getFiles')->name('answerkey.getFiles');
	Route::post('form-filler/answer-key/delete/file', 'AnswerKey\AnswerkeyController@deleteFile')->name('answerkey.deleteFile');

	// Manage Results
	Route::get('form-filler/results/list', 'Results\ResultsController@index')->name('results.list');
	Route::get('form-filler/results/list-data', 'Results\ResultsController@getResultData')->name('results.getResultData');
	Route::get('form-filler/results/add', 'Results\ResultsController@addView')->name('results.addView');
	Route::post('form-filler/results/add', 'Results\ResultsController@addResult')->name('results.addResult');
	Route::post('form-filler/results/change-status', 'Results\ResultsController@changeStatus')->name('results.changeStatus');
	Route::post('form-filler/results/status/delete', 'Results\ResultsController@deleteResult')->name('results.deleteResult');

	// Manage Job Requests
	Route::get('admin/manage/job/view', 'Jobs\JobsController@jobRequestView')->name('admin.jobRequestView');
	Route::get('admin/manage/job/list', 'Jobs\JobsController@jobRequestList')->name('admin.jobRequestList');
	Route::get('admin/manage/job/own-list', 'Jobs\JobsController@ownList')->name('admin.ownList');
	Route::get('admin/manage/own/job/list', 'Jobs\JobsController@jobAcceptedRequestList')->name('admin.jobAcceptedRequestList');
	Route::get('admin/manage/job/detail/{id}', 'Jobs\JobsController@jobRequestDetail')->name('admin.jobRequestDetail');
	Route::post('admin/manage/job/accept-request', 'Jobs\JobsController@acceptRequest')->name('admin.acceptRequest');
	Route::post('admin/manage/job/mark-as-pay', 'Jobs\JobsController@markAsPay')->name('admin.markAsPay');
	Route::post('admin/manage/job/upload-file', 'Jobs\JobsController@afterCompleteUploadDoc')->name('admin.afterCompleteUploadDoc');
	Route::post('admin/manage/job/reject-request', 'Jobs\JobsController@rejectRequest')->name('admin.rejectRequest');
	Route::post('admin/manage/job/delete-doc', 'Jobs\JobsController@deleteDoc')->name('admin.deleteDoc');

	// Manage Terms And Conditions
	Route::get('admin/manage/terms', 'Admin\HomeController@termsData')->name('admin.termsData');
	Route::post('admin/manage/terms', 'Admin\HomeController@termsDataUpdate')->name('admin.termsDataUpdate');
	Route::get('admin/manage/privecy-policy', 'Admin\HomeController@privecyPolicy')->name('admin.privecyPolicy');
	Route::post('admin/manage/privecy-policy', 'Admin\HomeController@privecyPolicyUpdate')->name('admin.privecyPolicyUpdate');
	Route::get('admin/manage/applied/job/list', 'Jobs\JobsController@appliedRequestList')->name('admin.appliedRequestList');
	Route::get('admin/applied/job-detail/{id}', 'Jobs\JobsController@appliedRequestJobDetail')->name('admin.appliedRequestJobDetail');

	// Admission Controller
	Route::get('admin/admission/list', 'Admission\AdmissionController@index')->name('admin.admission.index');
	Route::get('admin/admission/list-view', 'Admission\AdmissionController@admissionListView')->name('admin.admission.admissionListView');
	Route::get('admin/admission/create', 'Admission\AdmissionController@postAdmissionView')->name('admin.admission.postAdmissionView');
	Route::post('admin/admission/create', 'Admission\AdmissionController@createNewAdmission')->name('admin.admission.createNewAdmission');

	// Notice Management
	Route::get('admin/notice/list-view', 'Admission\AdmissionController@noticeView')->name('admin.noticeView');

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
	Route::post('form-filler/user/send-confirmation', 'FormFiller\JobController@sendConfirmation')->name('job.sendConfirmation');
	Route::post('form-filler/user/send-issue', 'FormFiller\JobController@sendIssue')->name('job.sendIssue');

	// Magnage Admissions
	Route::get('form-filler/admissions', 'FormFiller\FormFillerController@admissionListView')->name('job.admissionListView');
	Route::get('form-filler/admissions/list', 'FormFiller\FormFillerController@admissionList')->name('job.admissionList');
});

// Operator User Routes
Route::get('operator/signup', 'Operator\OperatorController@operatorSignUpView')->name('operator.operatorSignUpView');
Route::post('operator/signup', 'Operator\OperatorController@signup')->name('operator.signup');
// Terms And Condition Url And Term Policies
Route::get('term-condition', 'HomeController@terms')->name('terms');
Route::get('policies', 'HomeController@policy')->name('policy');




