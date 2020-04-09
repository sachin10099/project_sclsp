<?php
namespace App\Http\Controllers\Concern;

use App\Models\User;
use App\Models\SiteConfig;
use App\Models\EmailTemplate;
use App\Exceptions\RedirectException;

Trait GlobalTrait 
{
	/**
    * Send Email 
    *
    * @param  \Illuminate\Http\Request  $request
    * @return instance of App\User
    **/
    protected function sendMail($email,$fullname,$template_code,$data,$file = null) {
        $template = EmailTemplate::where('variable_name',$template_code)->first();
        if(!empty($template)){
           $variables  = explode(',',$template->variable);
           $subject    = $template->title;
           $body       = $template->description;

           foreach ($variables as $item) {
               $subject = str_replace($item,$data[str_replace(array('{','}'),'', $item)],stripslashes(html_entity_decode($subject)));
               $body = str_replace($item,$data[str_replace(array('{','}'),'', $item)],stripslashes(html_entity_decode($body)));
           }
           $sender = [
             'subject' => $subject,
             'email' => $email,
             'name' => $fullname,
             'from' => ['name' => $data['site']]
           ];
           dd('drtfgyuhijo');
           if(!empty($body) && !empty($email)){
               \Mail::send('emails.default', ['body' => $body], function($message) use ($sender,$file){
                   $message->to(
                    $sender['email']
                   )
                   ->subject($sender['subject'])
                   ->from(
                    $sender['from']['name']
                   );
               });
           }
        }
    }

    protected function siteConfig($name) {
       $picked = SiteConfig::where('name', $name)->first();
       return $picked->data;
    }

    protected function imageUpload($data) {
        if($data->image) {
            $filename      = $data->image->getClientOriginalName();
            $fileExtension = $data->image->getClientOriginalExtension();
            $imageName     = base64_encode(str_replace(' ', '', $filename)).date('ymdhis').'.'.$fileExtension;
            $return        = $data->file('image')->move(
            base_path() . '/public/assets/img/uploaded/', $imageName
            );
            $image_path =asset('/public/assets/img/uploaded/'. $imageName);
        } else {
            $image_path = \Auth::user()->profile_pic;
        }
        return $image_path;
    }

    protected function filesUpload($data, $old_file) {
        if($data->image) {
            $file = basename($old_file);
            if($file) {
              if(file_exists(public_path('assets\img\uploaded/').$file)){
                unlink(public_path("assets\img\uploaded/").$file);
              }
            }
            $filename      = $data->image->getClientOriginalName();
            $fileExtension = $data->image->getClientOriginalExtension();
            $imageName     = base64_encode(str_replace(' ', '', $filename)).date('ymdhis').'.'.$fileExtension;
            $return        = $data->file('image')->move(
            base_path() . '/public/assets/img/uploaded/', $imageName
            );
            $image_path =asset('/public/assets/img/uploaded/'. $imageName);
        } else {
            $image_path = 'null';
        }
        return $image_path;
    }
}