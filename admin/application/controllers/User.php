<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

 public function index(){
    $data['page_title'] = 'user signup';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
        $this->session->set_userdata(['menuSelected'=>USERS]);
        return  $this->load->view('user',$data);
    }
    $this->session->set_flashdata("error","Login first to access user pages.");
      //assign dynamically
    $this->load->view('authorization');
 }

/**
 * user signup view controller
 */
 public function signUp(){
    $data['page_title'] = 'user signup';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
        $this->session->set_userdata(['menuSelected'=>USERS,'subMenu'=>USER_SIGNUP]);
        return  $this->load->view('userSignup',$data);
    }else{
        return redirect ('user');
    }
 }

 /**
  * saving user registration data into db
  */
 public function savingUserData(){
    $data['page_title'] = 'user signup';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
        $this->session->set_userdata(['menuSelected'=>USERS,'subMenu'=>USER_SIGNUP]);
        $this->load->model('queries');
        $data = $this->input->post();  
        if(!$this->queries->checkDuplicateUserEmail($data['email'])){                      
            if($this->queries->userSignup($data)){
                $this->session->set_flashdata('success','User registered successfully!'); 
            }
            else{
                $this->session->set_flashdata('error','Failed to register user!');
            }
            $this->session->set_userdata(['menuSelected'=>USERS,'subMenu'=>USER_LIST]);
            return redirect ('user/userList');
        }else{
            $this->session->set_flashdata('error','Email already exists in our system!');
            return redirect ('user/signUp');
        }        
    }else{
        return redirect ('user');
    }
 }

 /**
  * User list view controller
  */
 public function userList(){
    $data['page_title'] = 'user list';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
        $this->session->set_userdata(['menuSelected'=>USERS,'subMenu'=>USER_LIST]);
        return  $this->load->view('userList',$data);
    }else{
        return redirect ('user');
    }
 }


 public function getAllUserList(){
    $this->load->model('queries');
    echo json_encode($this->queries->getAllUserList());
 }

 public function getUserById(){
    $userId = $this->input->get('id');
    $this->load->model('queries');
    echo json_encode($this->queries->getUserById($userId));
 }

  public function updateUser(){
    $data['page_title'] = 'user signup';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
        $this->session->set_userdata(['menuSelected'=>USERS,'subMenu'=>USER_SIGNUP]);
        $this->load->model('queries');
        $data = $this->input->post();  
        if(!$this->queries->forcedCheckDuplicateUserEmail($data['email_edit'],$data['userId_edit'])){                      
            if($this->queries->updateUser($data)){
                $this->session->set_flashdata('success','User updated successfully!'); 
            }
            else{
                $this->session->set_flashdata('error','Failed to update user!');
            }
            $this->session->set_userdata(['menuSelected'=>USERS,'subMenu'=>USER_LIST]);
            return redirect ('user/userList');
        }else{
            $this->session->set_userdata(['menuSelected'=>USERS,'subMenu'=>USER_LIST]);
            $this->session->set_flashdata('error','Email already exists in our system!');
            return redirect ('user/userList');
        }        
    }else{
        return redirect ('user');
    }
  }
}
?>