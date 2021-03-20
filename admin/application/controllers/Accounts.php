<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

   public function logout(){
      $this->session->sess_destroy();
      $this->session->set_flashdata("success","Logged out successfully.");
      $this->load->view('authorization');
  }

  public function login(){

      $data = $this->input->post(); 
      
      $userName = mysqli_real_escape_string($this->db->conn_id,$data['username']);
      $password = mysqli_real_escape_string($this->db->conn_id,$data['password']);

      $this->load->model('queries'); 
      
      if(isset($data['login-type']) || true){
          //admin login
          $adminExists = $this->queries->adminExists($userName,$password);
          if($adminExists){
              $sessionData = [
                  'admin_id' => $adminExists->id,
                  'name' => $adminExists->name,
                  'username' => $adminExists->username,
                  'menuSelected' => DASHBOARD,
                  'roleId' => SUPER_USER
              ];
              $this->session->set_userdata($sessionData);
              $this->session->set_flashdata("success","Logged in as admin");
              return redirect ('dashboard');
          }
          else{
              $this->session->set_flashdata("error","Invalid Admin Id or Password.");
              return redirect("");
          } 
      }else{
          //normal user login
          $userExists = $this->queries->userExists($userName,md5($password));
          if($userExists){
              $sessionData = [
                  'user_id' => $userExists->id,
                  'name' => $userExists->name,
                  'username' => $userExists->username,
                  'menuSelected' => DASHBOARD,
                  'roleId'  => $userExists->roleId
                  ];
              $this->session->set_userdata($sessionData);
              $this->session->set_flashdata("success","Logged in as user");
              return redirect ('dashboard');
          }
          else{
              $this->session->set_flashdata("error","Invalid User Id or Password.");
              return redirect("");
          }
      }
      
  }


}
?>