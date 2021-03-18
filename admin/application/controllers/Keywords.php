<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keywords extends CI_Controller {

    public function index(){
        $data['page_title'] = 'Keyword';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>KEYWORDS,'subMenu'=>KEYWORDS_AIO]);
            return  $this->load->view('keywords',$data);
        }
        $this->session->set_flashdata("error","Login first to access keyword module.");
        //assign dynamically
        $this->load->view('authorization');
    }

    public function getAllCategories(){
        $this->load->model('queries');
        echo json_encode($this->queries->getAllCategories());
    }

    public function getAllCategoriesWithKeywords(){
        $this->load->model('queries');
        echo json_encode($this->queries->getAllCategoriesWithKeywords());
    }

    public function getKeywordById(){
        $keywordId = $this->input->get('id');
        $this->load->model('queries');
        echo json_encode($this->queries->getKeywordById($keywordId));         
    }

    public function addNewKeyword(){
        $this->load->model('queries');
        echo json_encode($this->queries->addNewKeyword($this->input->post()));
    }

    public function updateKeyword(){
        $this->load->model('queries');
        echo json_encode($this->queries->updateKeyword($this->input->post()));
    }
}
?>