<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

    public function kiswahili(){
		$this->session->unset_userdata('lang');
		$this->session->set_userdata('lang','kiswahili');
		redirect('/','reflesh');
	}
	
	public function english(){
		$this->session->unset_userdata('lang');
		$this->session->set_userdata('lang','english');
		redirect('/','reflesh');
	}

}