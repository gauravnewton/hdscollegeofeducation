<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {


	public function index()
	{
		$data['page_title'] = 'H.D.S. College (Courses)';
        $this->session->set_userdata(['menuSelected'=>COURSES,'subMenu'=>'']);
		$this->load->view('courses',$data);
	}
}
