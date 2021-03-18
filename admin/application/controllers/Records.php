<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Records extends CI_Controller {

    public function index(){
        $data['page_title'] = 'Records';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>RECORDS,'subMenu'=>LIST_RECORDS]);
            return  $this->load->view('records',$data);
        }
        $this->session->set_flashdata("error","Login first to access keyword module.");
        //assign dynamically
        $this->load->view('authorization');
    }

    public function loadAllRecords(){
        $this->load->model('queries');
        echo json_encode($this->queries->loadAllRecords());
    }

    public function loadAllCategories(){
        $this->load->model('queries');
        echo json_encode($this->queries->getAllCategories());
    }

    

   
}
?>