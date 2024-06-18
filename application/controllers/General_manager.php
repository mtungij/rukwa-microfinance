<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class General_manager extends CI_Controller {
	public function index()
	{
		$this->load->view('general/index');
	}
}