<?php

class RegisterController extends BaseController {
    
    public function showRegister()
    {
        return View::make('register');
    }
    
    public function doRegister()
    {
        $user = new User;
        $user->email = Input::get('email');
        $user->username = Input::get('username');
        $user->password = Hash::make(Input::get('password'));
        $user->save();
        $theEmail = Input::get('email');
        
        ///
        
      $confirmation_code = str_random(30);
      
      Mail::send('emails.verify', ['confirmation_code' => $confirmation_code], function($message) {
            $message->to(Input::get('email'), Input::get('username'))
                ->subject('Verify your email address');
        });

        // Flash::message('Thanks for signing up! Please check your email.');
        
        ///
        
        return View::make('thanks')->with('theEmailPassed', $theEmail);
    }
}

?>