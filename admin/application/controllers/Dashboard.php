<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function index(){
      $data['page_title'] = 'Dashboard';
      if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
        $this->session->set_userdata(['menuSelected'=>DASHBOARD,'subMenu'=>'']);
        return  $this->load->view('dashboard',$data);
      }
      $this->session->set_flashdata("error","Login first to access dashboard.");
        //assign dynamically
      $this->load->view('authorization');
  }

  public function loadChartData(){
    $data['page_title'] = 'Dashboard';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
      $this->session->set_userdata(['menuSelected'=>DASHBOARD,'subMenu'=>'']);
      $this->load->model('queries');
      echo json_encode($this->queries->loadChartData());
    }else{
      $this->session->set_flashdata("error","Login first to access dashboard.");
      //assign dynamically
      return redirect ('dashboard');
    }
  }

  public function loadTotalBrands(){
    $data['page_title'] = 'Dashboard';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
      $this->session->set_userdata(['menuSelected'=>DASHBOARD,'subMenu'=>'']);
      $this->load->model('queries');
      echo json_encode(count($this->queries->getAllBrands()));
    }else{
      $this->session->set_flashdata("error","Login first to access dashboard.");
      //assign dynamically
      return redirect ('dashboard');
    }
  }

  public function loadTotalKeywords(){
    $data['page_title'] = 'Dashboard';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
      $this->session->set_userdata(['menuSelected'=>DASHBOARD,'subMenu'=>'']);
      $this->load->model('queries');
      echo json_encode(count($this->queries->getAllCategoriesWithKeywords()));
    }else{
      $this->session->set_flashdata("error","Login first to access dashboard.");
      //assign dynamically
      return redirect ('dashboard');
    }
  }

  public function loadTotalBatchs(){
    $data['page_title'] = 'Dashboard';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
      $this->session->set_userdata(['menuSelected'=>DASHBOARD,'subMenu'=>'']);
      $this->load->model('queries');
      echo json_encode(count($this->queries->loadTotalBatchs()));
    }else{
      $this->session->set_flashdata("error","Login first to access dashboard.");
      //assign dynamically
      return redirect ('dashboard');
    }
  }

  public function loadTotalUsers(){
    $data['page_title'] = 'Dashboard';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
      $this->session->set_userdata(['menuSelected'=>DASHBOARD,'subMenu'=>'']);
      $this->load->model('queries');
      echo json_encode(count($this->queries->getAllUserList()));
    }else{
      $this->session->set_flashdata("error","Login first to access dashboard.");
      //assign dynamically
      return redirect ('dashboard');
    }
  }

  public function loadTotalRecords(){
    $data['page_title'] = 'Dashboard';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
      $this->session->set_userdata(['menuSelected'=>DASHBOARD,'subMenu'=>'']);
      $this->load->model('queries');
      echo json_encode(count($this->queries->loadTotalRecords()));
    }else{
      $this->session->set_flashdata("error","Login first to access dashboard.");
      //assign dynamically
      return redirect ('dashboard');
    }
  }

  public function gettAllEmailApiError(){
    $data['page_title'] = 'Dashboard';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
      $this->session->set_userdata(['menuSelected'=>DASHBOARD,'subMenu'=>'']);
      $this->load->model('queries');
      echo json_encode($this->queries->gettAllEmailApiError());
    }else{
      $this->session->set_flashdata("error","Login first to access dashboard.");
      //assign dynamically
      return redirect ('dashboard');
    }
  }

  public function gettAllPhoneApiError(){
    $data['page_title'] = 'Dashboard';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
      $this->session->set_userdata(['menuSelected'=>DASHBOARD,'subMenu'=>'']);
      $this->load->model('queries');
      echo json_encode($this->queries->gettAllPhoneApiError());
    }else{
      $this->session->set_flashdata("error","Login first to access dashboard.");
      //assign dynamically
      return redirect ('dashboard');
    }
  }
}
?>