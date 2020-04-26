<?php
namespace App\Http\Controllers\Concern;

use App\Models\User;
use App\Models\SiteConfig;
use App\Models\EmailTemplate;
use App\Models\UserVerification;
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
            $image_path = $old_file;
        }
        return $image_path;
    }

    protected function formFillerUserDocumentUpload($data, $key) {
        if($data->$key) {
            $filename      = $data->$key->getClientOriginalName();
            $fileExtension = $data->$key->getClientOriginalExtension();
            $imageName     = base64_encode(str_replace(' ', '', $filename)).date('ymdhis').'.'.$fileExtension;
            $return        = $data->file($key)->move(
            base_path() . '/public/assets3/img/documents/', $imageName
            );
            $image_path =asset('/public/assets3/img/documents/'. $imageName);
        } else {
            $image_path = 'null';
        }
        return $image_path;
    }

    protected function formFillerUserDocumentUpdate($data, $key, $old_file) {
        if($data->$key) {
            $file = basename($old_file);
            if($file) {
              if(file_exists(public_path('/public/assets3/img/documents/').$file)){
                unlink(public_path("/public/assets3/img/documents/").$file);
              }
            }
            $filename      = $data->$key->getClientOriginalName();
            $fileExtension = $data->$key->getClientOriginalExtension();
            $imageName     = base64_encode(str_replace(' ', '', $filename)).date('ymdhis').'.'.$fileExtension;
            $return        = $data->file($key)->move(
            base_path() . '/public/assets3/img/documents/', $imageName
            );
            $image_path =asset('/public/assets3/img/documents/'. $imageName);
        } else {
            $image_path = $old_file;
        }
        return $image_path;
    }

    protected function userVerificationProcess($user) {
        $token = \Str::random(8);
        UserVerification::create(
            [
                'email'   => $user->email,
                'token'   => $token,
                'user_id' => $user->id
            ]
        );
        return $token;
    }


    protected function verifyEmail($token) {
      $now_reduce_mins =  \Carbon\Carbon::now()->addMinutes(-1440)->toDateTimeString();
      $find = UserVerification::where('token', $token)
          ->where('created_at', '>=', $now_reduce_mins)
          ->first();
      if(!$find) {
          return 'expired';
      }
      User::where('id', $find->user_id)->update(
        [
          'email_verify' => 'Yes'
        ]
      );
      $find->delete();
      return 'Yes';
    }
}