<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Home;
use App\Models\User;
use App\Models\About;
use App\Models\Scope;
use App\Models\Service;
use App\Models\ContactUs;
use App\Models\Subscribe;
use App\Models\SocialLink;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\SupportCenter;
use App\Notifications\SubscriptionNotification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['banner']        = Home::where('slug', 'banner')->first();
        $data['why_choose']    = Home::where('slug', 'why_choose')->first();
        $data['service_content'] = Home::where('slug', 'service_desc')->first();
        $data['services']      = Service::get();
        $data['about']         = About::first();
        $data['scopes']        = Scope::get();
        $data['testimonials']  = Testimonial::where('slug', 'testi')->get();
        $data['teams']         = Testimonial::where('slug', 'team')->get();
        $data['faq_content']   = Faq::where('slug', 'content')->first();
        $data['faqs']          = Faq::where('slug', 'query')->get();
        $data['address']       = ContactUs::where('slug', 'address')->first();
        $data['emails']        = ContactUs::where('slug', 'email')->get();
        $data['contacts']      = ContactUs::where('slug', 'contact')->get();
        $data['contact_info']  = User::where('type', 'admin')->first();
        $data['facebook_link']  = SocialLink::where('slug', 'facebook')->first();
        $data['twitter_link']   = SocialLink::where('slug', 'twitter')->first();
        $data['insta_link']     = SocialLink::where('slug', 'insta')->first();
        $data['linkedin_link']  = SocialLink::where('slug', 'linkedin')->first();
        return view('welcome', compact('data'));
    }


    /**
     * Subscribed Website
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function subscribe(Request $request)
    {
        $data = Subscribe::create(
            [
                'email' => $request->email
            ]
        );
        $user = User::where('type', 'admin')->first();
        $user->notify(New SubscriptionNotification());
       return 'Subscribed Successfully.';
    }
}
