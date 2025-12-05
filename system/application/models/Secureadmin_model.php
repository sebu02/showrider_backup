<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Secureadmin_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	$this->output->enable_profiler(FALSE);
		$this->tree = array();
		$this->parent = '';
		$this->arrow = '|';
                
        date_default_timezone_set('Asia/Calcutta');
	}
    
	function login() {			
								
		}
	
		function setSession($data,$obj_vars,$custom_vars) {
			
			foreach($obj_vars as $obj_var)
				{
				$session_data[$obj_var] =  $data->$obj_var;
				}
			
			if($custom_vars)
				{
				foreach($custom_vars as $key=>$var)
					{
					$session_data[$key] = $var;
					}
				}
			
			$this->session->set_userdata($session_data);
			}				
		
		function isLogged()	{
			
			}
		
	
}

?>