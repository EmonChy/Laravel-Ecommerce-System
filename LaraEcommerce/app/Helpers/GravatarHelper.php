<?php
namespace App\Helpers;

/*
validate gravator

check if the email has any gravatar image or not


*/

class GravatarHelper
{
    public static function validate_gravatar($email){
        $hash = md5($email);
        $uri = 'http://www.gravatar.com/avatar/'.$hash.'?d=404';
        
        $headers = @get_headers($uri);

        if(!preg_match("|200|",$headers[0])){
            $has_valid_avatar = false;
        }else{
            $has_valid_avatar = true;
        }

        return $has_valid_avatar;

    }

   /*
   gravatar image

   get the gravatar image from that email address
   
   */

    public static function gravatar_image($email,$size=0,$d=""){
        $hash = md5($email);
        $image_url = 'http://www.gravatar.com/avatar/'.$hash.'?s='.$size.'&d='.$d;
        return $image_url;
    }
}
