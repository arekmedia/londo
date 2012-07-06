<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


class MY_Upload extends CI_Upload{

    private $ci;
    public $ignore_mime ;
    
    public function __construct()
    {
        parent::CI_Upload();
        $this->ci =& get_instance();
    }


    /**
     * Verify that the filetype is allowed
     * 
     * @access    public
     * @return    bool
         */    
    function is_allowed_filetype($ignore_mime = FALSE)
    {
        if (count($this->allowed_types) == 0 OR ! is_array($this->allowed_types))
        {
            $this->set_error('upload_no_file_types');
            return FALSE;
        }
        
        $ext = strtolower(ltrim($this->file_ext, '.'));
        
        if ( ! in_array($ext, $this->allowed_types))
        {
            return FALSE;
        }

        // Images get some additional checks
        $image_types = array('gif', 'jpg', 'jpeg', 'png', 'jpe');

        if (in_array($ext, $image_types))
        {
            if (getimagesize($this->file_temp) === FALSE)
            {
                return FALSE;
            }            
        }

        if ($this->ignore_mime === TRUE)
        {
            return TRUE;
        }
        
        $mime = $this->mimes_types($ext);
                
        if (is_array($mime))
        {
            if (in_array($this->file_type, $mime, TRUE))
            {
                return TRUE;
            }            
        }
        elseif ($mime == $this->file_type)
        {
                return TRUE;
        }
        
        return FALSE;
    }  
}  