<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecordLogs extends CI_Controller {

	public function index()
	{
        $data['page_title'] = 'Logs';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>LOGS,'subMenu'=>LIST_LOGS]);
            return  $this->load->view('recordLogs',$data);
        }
        $this->session->set_flashdata("error","Login first to access logs.");
        //assign dynamically
        $this->load->view('authorization');
    }
    
    public function loadAllLogs(){
        $this->load->model('queries');
        echo json_encode($this->queries->loadAllLogs());
    }
}
