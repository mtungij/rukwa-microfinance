<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Super_admin extends CI_Controller {
	public function index()
	{
		$this->load->view('super_admin/comapany');
	}


	
	public function register_company(){
	           
		
		     $data = $this->input->post();

			//  print_r($data);
			//  exit();
			
		     $data['password'] = sha1($this->input->post('password'));
		     //$data['comp_phone'] = ('255'.$this->input->post('comp_phone'));
		      //   echo "<pre>";
		      // print_r($data);
		      // echo "</pre>";
		      //      exit();
		        $this->load->model('queries');
		       $this->queries->insert_company_data($data);
		           
		      
		      return redirect('super_admin/comapany');
		}
		
}

