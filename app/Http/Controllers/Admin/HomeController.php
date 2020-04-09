<?php

namespace App\Http\Controllers\Admin;

use App\Models\Home;
use App\Models\About;
use App\Models\Scope;
use App\Models\Faq;
use App\Models\Service;
use App\Models\ContactUs;
use App\Models\SocialLink;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Concern\GlobalTrait;

class HomeController extends Controller
{
	use GlobalTrait;

     /**
     * Banner List 
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function bannerList() {
        $banner = Home::where('slug', 'banner')->first();
        return view('admin.banner', compact('banner'));
    }

     /**
     * Banner List Edit 
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function banneredit($id) {
    	$banner = Home::find($id);
    	return view('admin.edit_banner', compact('banner'));
    }

     /**
     * Banner Update Data
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function bannerUpdate(Request $request) {
    	$request->validate(
    		[
    			'image'   => 'dimensions:width=1920,height=808',
    			'heading' => 'max:200',
    			'tagline' => 'max:200'
    		],
    		[
    			'image.dimensions' => 'Image dimensions must be 1920 * 808.'
    		]
    	);
    	$picked = Home::find($request->id);
    	$url = $this->filesUpload($request, $picked->image);
    	$new_url = $url == 'null' ? $picked->image : $url;
    	$picked->update(
    		[
    			'image'   => $new_url,
    			'heading' => $request->heading,
    			'tagline' => $request->tagline,
    		]
    	);
    	return redirect('admin/banner/list')->with('success', 'Content Updated Successfully.');
    }

     /**
     * Why choose content List
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function whyChooseList() {
    	$why_choose = Home::where('slug', 'why_choose')->first();
    	return view('admin.why_choose', compact('why_choose'));
    }

     /**
     * Why choose content Edit
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function whyChooseEdit($id) {
    	$why_choose = Home::find($id);
    	return view('admin.edit_why_choose', compact('why_choose'));
    }

     /**
     * Why choose content Update
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function whyChooseUpdate(Request $request) {
    	$request->validate(
    		[
    			'heading' => 'max:150'
    		]
    	);
    	$picked = Home::find($request->id);
    	$picked->update(
    		[
    			'heading' => $request->heading,
    			'desc'    => $request->desc
    		]
    	);
    	return redirect('admin/why-choose/list')->with('success', 'Content Updated Successfully.');
    }

     /**
     * Manage Services
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function serviceList() {
        $services = Service::get();
        return view('admin.services', compact('services'));
    }

      /**
     * Edit Services
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function serviceEdit($id) {
        $service_content = Home::where('slug', 'service_desc')->first();
        $service = Service::find($id);
        return view('admin.edit_service', compact(['service', 'service_content']));
    }

     /**
     * Update Services
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function serviceUpdate(Request $request) {
        $request->validate(
            [
                'heading' => 'max:150'
            ]
        );
        $service = Service::find($request->id);
        $service->update(
            [
                'heading' => $request->heading,
                'desc'    => $request->desc
            ]
        );
        Home::find($request->content_id)->update(
            [
                'desc' => $request->content
            ]
        );
        return redirect('admin/service/list')->with('success', 'Service updated successfully.');
    }

     /**
     * Manage About Us
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function aboutList() {
        $about = About::first();
        return view('admin.about', compact('about'));
    }

    /**
     * Edit About Us Content
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function aboutEdit($id) {
        $about = About::find($id);
        return view('admin.edit_about', compact('about'));
    }

    /**
     * Update About Us Content
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function aboutUpdate(Request $request) {
        $request->validate(
            [
                'heading'   => 'max:200',
                'image'     => 'mimes:jpg,jpeg,png|dimensions:width=655,height=762|max:2048'
            ],
            [
                'image.dimensions' => 'Image dimensions must be 655 * 762 pixels'
            ]
        );
        $video_url = $request->url;
        if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $video_url)) {
            $about = About::find($request->id);
            $url = $this->filesUpload($request, $about->image);
            $new_url = $url == 'null' ? $about->image : $url;
            $about->update(
                [
                    'heading'   => $request->heading,
                    'desc'      => $request->desc,
                    'image'     => $new_url,
                    'video_url' => $request->url,
                ]
            );
            return redirect('admin/about/list')->with('success', 'Content updated successfully.');
        }
        else {
          return redirect()->back()->with('error', 'Invalid URL Formate.');
        }
        
    }

      /**
     * Manage Scopes
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function scopeList() {
        $scopes = Scope::get();
        return view('admin.scope', compact('scopes'));
    }

    /**
     * Edit About Us Content
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function scopeEdit($id) {
        $scope = Scope::find($id);
        return view('admin.edit_scope', compact('scope'));
    }

    /**
     * Update Scope Content
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function scopeUpdate(Request $request) {
        $request->validate(
            [
                'heading'   => 'max:200',
                'image'     => 'mimes:jpg,jpeg,png|max:512'
            ]
        );
        $scope = Scope::find($request->id);
        $url = $this->filesUpload($request, $scope->image);
        $new_url = $url == 'null' ? $scope->image : $url;
        $scope->update(
            [
                'heading'   => $request->heading,
                'desc'      => $request->desc,
                'image'     => $new_url
            ]
        );
        return redirect('admin/scopes/list')->with('success', 'Content updated successfully.');
    }

     /**
     * Manage Testimonial
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function testimonialList() {
        $testimonials = Testimonial::where('slug', 'testi')->orderBy('created_at', 'DESC')->get();
        return view('admin.testimonials', compact('testimonials'));
    }

    /**
     * edit Testimonial
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function testimonialEdit($id) {
        $testimonial = Testimonial::find($id);
        return view('admin.edit_testimonial', compact('testimonial'));
    }

    /**
     * Update Testimonial
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function testimonialUpdate(Request $request) {
        $request->validate(
            [
                'name'        => 'max:100',
                'designation' => 'max:150',
                'image'       => 'mimes:jpg,jpeg,png|max:512|dimensions:width=400,height=400'
            ],
            [
                'image.dimensions' => 'Image dimensions must be 400 * 400 pixels.'
            ]
        );
        $picked = Testimonial::find($request->id);
        $url = $this->filesUpload($request, $picked->image);
        $new_url = $url == 'null' ? $picked->image : $url;
        $picked->update(
            [
                'name'        => $request->name,
                'designation' => $request->designation,
                'desc'        => $request->desc,
                'image'       => $new_url,
            ]
        );
        return redirect('admin/testimonial/list')->with('success', 'Content updated successfully.');
    }

    /**
     * Add Testimonial
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function testimonialAdd(Request $request) {
        $request->validate(
            [
                'name'        => 'requied|max:100',
                'designation' => 'required|max:150',
                'image'       => 'required|mimes:jpg,jpeg,png|max:512|dimensions:width=400,height=400',
                'desc'        => 'required'
            ]
        );
        $url = $this->filesUpload($request, null);
        $picked = Testimonial::create(
             [
                'slug'        => 'testi',
                'name'        => $request->name,
                'designation' => $request->designation,
                'desc'        => $request->desc,
                'image'       => $url,
            ]
        );
        return redirect('admin/testimonial/list')->with('success', 'Added successfully.');
    }

     /**
     * Delete Testimonial
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function testimonialDelete(Request $request) {
        $testimonial = Testimonial::find($request->id);
        $testimonial->delete();
        return redirect('admin/testimonial/list')->with('success', 'Testimonial deleted successfully.');
    }

      /**
     * Manage Team
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function teamList() {
        $teams = Testimonial::where('slug', 'team')->orderBy('created_at', 'DESC')->get();
        return view('admin.team', compact('teams'));
    }

    /**
     * Edit Testimonial
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function teamEdit($id) {
        $testimonial = Testimonial::find($id);
        return view('admin.edit_team', compact('testimonial'));
    }

    /**
     * Update Team
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function teamUpdate(Request $request) {
        $request->validate(
            [
                'name'        => 'max:150',
                'designation' => 'max:200',
                'facebook'    => 'max:200',
                'twitter'     => 'max:200',
                'insta'       => 'max:200',
                'LinkedIn'    => 'max:200',
                'image'       => 'mimes:jpg,jpeg,png|max:512|dimensions:width=600,height=600'
            ]
        );
        $picked = Testimonial::find($request->id);
        $url = $this->filesUpload($request, $picked->image);
        $new_url = $url == 'null' ? $picked->image : $url;
        $picked->update(
             [
                'slug'          => 'team',
                'name'          => $request->name,
                'designation'   => $request->designation,
                'facebook_link' => $request->facebook,
                'twitter_link'  => $request->twitter,
                'insta_link'    => $request->insta,
                'linkedin_link' => $request->LinkedIn,
                'image'         => $new_url
            ]
        );
        return redirect('admin/team/list')->with('success', 'Updated successfully.');
    }

    /**
     * Add Testimonial
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function teamAdd(Request $request) {
        $request->validate(
            [
                'name'        => 'required|max:150',
                'designation' => 'required|max:200',
                'facebook'    => 'required|max:200',
                'twitter'     => 'required|max:200',
                'insta'       => 'required|max:200',
                'LinkedIn'    => 'required|max:200',
                'image'       => 'required|mimes:jpg,jpeg,png|max:512|dimensions:width=600,height=600'
            ]
        );
        $url = $this->filesUpload($request, null);
        $picked = Testimonial::create(
             [
                'slug'          => 'team',
                'name'          => $request->name,
                'designation'   => $request->designation,
                'facebook_link' => $request->facebook,
                'twitter_link'  => $request->twitter,
                'insta_link'    => $request->insta,
                'linkedin_link' => $request->LinkedIn,
                'image'         => $url,
                'desc'          => 'N/A'
            ]
        );
        return redirect('admin/team/list')->with('success', 'Added successfully.');
    }

    /**
     * Delete team
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function teamDelete(Request $request) {
        $testimonial = Testimonial::find($request->id);
        $testimonial->delete();
        return 'Testimonial deleted successfully.';
    }

      /**
     * Manage Faq's
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function faqList() {
        $queries = Faq::where('slug', 'query')->orderBy('created_at', 'DESC')->get();
        return view('admin.faq', compact('queries'));
    }

    /**
     * Edit Faq
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function faqEdit($id) {
        $desc = Faq::where('slug', 'content')->first();
        $faq = Faq::find($id);
        return view('admin.edit_faq', compact(['faq', 'desc']));
    }

    /**
     * Update Faq content 
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function faqUpdate(Request $request) {
        $request->validate(
            ['question' => 'max:200']
        );
        $faq = Faq::find($request->id);
        $desc = Faq::where('slug', 'content')->first();
        $desc->update(
            [
                'desc' => $request->desc_new
            ]
        );
        $faq->update(
            [
                'question' => $request->question,
                'answer'   => $request->desc
            ]
        );
        return redirect('admin/faq/list')->with('success', 'Updated successfully.');
    }

     /**
     * Delete Faq
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function faqDelete(Request $request) {
        $Faq = Faq::find($request->id);
        $Faq->delete();
        return 'Faq deleted successfully.';
    }

     /**
     * Add Faq
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function faqAdd(Request $request) {
        $request->validate(
            [
                'question' => 'max:200'
            ]
        );
        Faq::create(
            [
                'slug'     => 'query',
                'question' => $request->question,
                'answer'   => $request->desc
            ]
        );
        return redirect('admin/faq/list')->with('success', 'Faq Added successfully.');
    }

     /**
     * Manage Contact
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function contactList() {
        $data['address'] = ContactUs::where('slug', 'address')->first();
        $data['emails']  = ContactUs::where('slug', 'email')->get();
        $data['contacts'] = ContactUs::where('slug', 'contact')->get();
        return view('admin.contact', compact('data'));
    }

    /**
     * Edit Faq
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function contactEdit($id)
    {
        $contact = ContactUs::find($id);
        return view('admin.edit_contact', compact('contact'));
    }

    /**
     *  Update Contact
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function contactUpdate(Request $request)
    {
        $request->validate(
            [
                'contact' => 'required|max:150'
            ],
            [
                'contact.required' => 'Data field is required.'
            ]
        );
        $contact = ContactUs::find($request->id);
        $contact->update(
            [
                'data' => $request->contact
            ]
        );
        return redirect('admin/contact/list')->with('success', 'Content updated successfully.');
    }

    /**
     * Manage Social Links
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function socialLinks()
    {
        $links = SocialLink::get();
        return view('admin.social_links', compact('links'));
    }

    public function socialLinkEdit($id) {
        $link = SocialLink::find($id);
         return view('admin.edit_social_link', compact('link'));
    }

    public function socialLinkUpdate(Request $request) {
        $request->validate(
            [
                'link' => 'required',
            ]
        );
        $url = $request->link;
        if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url)) {
            $picked = SocialLink::find($request->id);
            $picked->update(
                [
                    'link' => $request->link
                ]
            );
            return redirect('admin/social/link')->with('success', 'URL updated successfully.');
        }
        else {
          return redirect()->back()->with('error', 'Invalid URL Formate.');
        }
    }

}
