<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MY_Form_validation extends CI_Form_validation {

    
    public function validate_captcha($word)
    {
         $CI = & get_instance(); 
         if(empty($word) || strtoupper($word) != strtoupper($CI->session->userdata['captchaWord'])){
            $CI->form_validation->set_message('validate_captcha', 'Las letras no coinciden con la imagen');
            return FALSE; 
         }else{
             return TRUE; 
         }
    }
    
    
    //strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0
}