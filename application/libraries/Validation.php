<?php
class Validation{
	public function name($name=null){
			if (!preg_match("/^[a-zA-Z ]*$/",$name))
			{
		       return FALSE; 
		    }
		    else
		    {
		    	return TRUE;
		    }
    }

    public function email($email=null){
			if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
               return FALSE; 
            }
		    else
		    {
		    	return TRUE;
		    }
    }



    public function mobile($mobile=null){
    		if(!preg_match('/([0-9]{10})/', $mobile))
    		{
			    return FALSE; 
            }
		    else
		    {
		    	return TRUE;
		    }
    }



















}