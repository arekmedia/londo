<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Uploadify{

    private $ci;
    private $_tmp_path;
    private $_field_name        = 'Filedata';
    private $_allowed_types     = 'gif|png|jpg|jpeg';
    private $_use_upload_token  = TRUE;
    private $_max_size          = 0;
    private $_max_width         = 0;
    private $_max_height        = 0;
    private $_encrypt_name      = TRUE ;
    private $_only_logged_in    = TRUE ;
    private $_only_admin        = TRUE ;
    private $errors             = array(); 
    
    public function __construct($config = array())
    {
        $this->ci =& get_instance();
        
        if( ! empty($config))
        {
            $this->initialize($config);
        }
        
        if(empty($this->_tmp_path))
        {
            $this->set('tmp_path',FCPATH.'tmp/');
        }    

        log_message('debug','Uploadify Class Initialized');
        
        $this->_set_error_messages();
    }
    
    public function initialize($config)
    {
        if(is_array($config) && count($config) > 0)
        {
            foreach($config AS $key=>$value)
            {
                $this->set($key,$value);
            }    
        }
        return $this;
    }
       
    public function set($key,$value='')
    {
        if(is_array($key))
        {
            foreach($key AS $k=>$v)
            {
                $this->set($k,$v);
            }
        }
        else
        {
            $this->{'_'.$key} = $value ;
        }
        return $this;
    }
    
    public function get($key)
    {
        return $this->{'_'.$key};
    }

    /**
    * This is the method used for the most of the uploads, 
    * If something special is needed, a new method will be created .
    **/
    public function do_upload()
    {
        $config                     = array();
        $config['upload_path']      = $this->_tmp_path ; 
        $config['allowed_types']    = $this->_allowed_types ;
        $config['max_size']         = $this->_max_size;
        $config['max_width']        = $this->_max_width;
        $config['max_height']       = $this->_max_height;
        $config['encrypt_name']     = $this->_encrypt_name ;
        
        $this->ci->load->library('upload');
        $this->ci->upload->initialize($config);
        
        $this->ci->upload->ignore_mime = TRUE ;//skip mime check

        if ( ! $this->ci->upload->do_upload($this->_field_name))
        {
            return $this->ci->upload->display_errors();
        }

        $data = $this->ci->upload->data();
        
        $ext = strtolower(ltrim($data['file_ext'], '.'));

        $data['is_image'] = FALSE ;

        if($info = getimagesize($data['full_path']))
        {
            $data['file_type']      = $info['mime'];
            $data['image_width']    = $info[0];
            $data['image_height']   = $info[1];
            $data['image_size_str'] = $info[3];
            $data['is_image']       = TRUE ;
        }

        if( ! $mimes = $this->ci->upload->mimes_types($ext) )
        {
            @unlink($data['full_path']);
            return $this->set_error('invalid_mime_type');
        }
        
        if( ! empty($mimes[$ext]) && ! is_array($mimes[$ext]) && $data['file_type'] != $mimes[$ext])
        {
            @unlink($data['full_path']);
            return $this->set_error('invalid_mime_type');
        }
        elseif( ! empty($mimes[$ext]) && is_array($mimes[$ext]) && ! in_array($data['file_type'],$mimes[$ext]))
        {
            @unlink($data['full_path']);
            return $this->set_error('invalid_mime_type');
        }
        
        /**
        * THIS IS THE WAY THE DATA IS ENCRYPTED,USE THIS LOGIC TO DECRYPT.
        * $userdata = json_encode($this->session->userdata);
        * $userdata = $this->encrypt->encode($userdata);
        * $userdata = base64_encode($userdata);
        **/
        if( ! $userdata = $this->ci->input->post('userdata',TRUE) )
        {
            @unlink($data['full_path']);
            return $this->set_error('invalid_userdata');
        }
        $userdata = base64_decode($userdata);
        $userdata = $this->ci->encrypt->decode($userdata);
        $userdata = json_decode($userdata);//userdata is an object...
        
        if($userdata == NULL || ! is_object($userdata))
        {
            @unlink($data['full_path']);
            if(function_exists('json_last_error'))
            {
                switch(json_last_error())
                {
                    case JSON_ERROR_DEPTH:
                        $error = $this->set_error('json_error_depth');
                    break;
                    case JSON_ERROR_CTRL_CHAR:
                        $error = $this->set_error('json_error_ctrl_char');
                    break;
                    case JSON_ERROR_SYNTAX:
                        $error = $this->set_error('json_error_syntax');
                    break;
                    case JSON_ERROR_NONE:
                        $error = $this->set_error('json_error_none');
                    break;
                }
                return $error ;                
            }
            else
            {
                return $this->set_error('json_error_syntax');
            }
        }
        //We have a valid $userdata object now. do extra checks.
        //We need to check for a token ? 
        if($this->_use_upload_token)
        {
            $session_token = $userdata->token ;
            $post_token    = $this->ci->input->post('token',TRUE);
            if($session_token != $post_token)
            {
                @unlink($data['full_path']);
                return $this->set_error('invalid_token');
            }
        }
        //So if we need to check the token, the data has pass the filter.
        //The user needs to be logged in to upload, right ?
        // 0 = FALSE = EMPTY.
        if($this->_only_logged_in && empty($userdata->logged_in))
        {
            @unlink($data['full_path']);
            return $this->set_error('not_logged_in');
        }
        if($this->_only_admin && empty($userdata->is_admin))
        {
            @unlink($data['full_path']);
            return $this->set_error('only_admin');
        }
        
        return (array)$data ;
    }
    
    
    /**
    * This method will initialize some messages that can be used in case an error occurs .
    **/
    private function _set_error_messages()
    {
        $errors = array(
            'invalid_file_type' =>  'Invalid file type ',
            'invalid_mime_type' =>  'Invalid mime type ',
            'invalid_token'     =>  'Invalid security token.Please try again',
            'invalid_userdata'  =>  'The required userdata is missing.',
            'json_error_depth'  =>  'Maximum stack depth exceeded',
            'json_error_ctrl_char'  =>  'Unexpected control character found',
            'json_error_syntax' =>  'Syntax error, malformed JSON',
            'json_error_none'   =>  'No errors',
            'not_logged_in'     =>  'You are not logged in .',
            'only_admin'        =>  'This action can be made only by admins.',
        );
        $this->errors = $errors ;
    }
    /**
    * This method can be used to send the error messages to the user .
    **/
    private function set_error($key='')
    {
        if(array_key_exists($key,$this->errors))
        {
            return $this->errors[$key];
        }
        return FALSE ;
    }
    



/**
* Uploadify Class End
**/    
}