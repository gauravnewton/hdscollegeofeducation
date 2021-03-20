<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function index(){
        $data['page_title'] = 'API';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>API,'subMenu'=>API_MANAGEMENT]);
            return  $this->load->view('api',$data);
        }
        $this->session->set_flashdata("error","Login first to access API module.");
        //assign dynamically
        $this->load->view('authorization');
    }

    public function getHookDetails(){
        $hookType = $this->input->get('hookType');
        $this->load->model('queries');
        echo json_encode($this->queries->getHookDetails($hookType));             
    }

    public function submitForm(){
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>API,'subMenu'=>API_MANAGEMENT]);
            $this->load->model('queries');
            $data = array(
                "name" => $this->input->post('api-name'),
                "url" => $this->input->post('api-url'),
                "hookType" => $this->input->post('hook-type'),
                "authToken" => $this->input->post('auth-token'),
                "timeOut" => $this->input->post('time-out')
            );

            if($this->queries->submitForm($data)){
                echo json_encode(array("isSuccess"=>true));
            }else{
                echo json_encode(array("isSuccess"=>false));
            }
        }else{
            return redirect ('api');
        }
    }





}
?>