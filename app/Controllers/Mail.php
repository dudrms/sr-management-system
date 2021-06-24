<?php namespace App\Controllers;

class Mail extends BaseController
{

   public function index() {

        $session = session();
        $logged_in = $session->get('logged_in');
        if ($logged_in != 1) {
            return view('login');
        } 

        $to      = 'dudrms81@poscoict.com'; 

        $subject = '테스트메일.'; 
        $subject_c = "=?UTF-8?B?".base64_encode($subject)."?="; 
        $message = '내용입니다.'; 

        // 보내는 사람 
        $from = 'SR_Manager@poscoict.com';

        $headers = 'MIME-Version: 1.0'. "\r\n";
        $headers .= 'Content-Type: text/html; charset=utf-8'. "\r\n";
        $headers .= 'From: ' . $from . "\r\n" . 
            'Reply-To: dudrms81@poscoict.com' . "\r\n" . 
            'X-Mailer: PHP/' . phpversion(); 

        mail($to, $subject_c, $message, $headers);

   }

   //--------------------------------------------------------------------

}