<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

	public function index()
	{
        $data['page_title'] = 'Notifications';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>NOTIFICATIONS,'subMenu'=>NOTIFICATION_MANAGEMENT]);
            return  $this->load->view('notifications',$data);
        }
        $this->session->set_flashdata("error","Login first to access notiication.");
        //assign dynamically
        $this->load->view('authorization');
    }

    public function postNotification(){
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>NOTIFICATIONS,'subMenu'=>NOTIFICATION_MANAGEMENT]);
            $data = $this->input->post(); 
            $fileName = $_FILES['notification-file']['name'];

            $actualFileExt = strtoupper(pathinfo($fileName, PATHINFO_EXTENSION));
            $tempFilePath = $_FILES['notification-file']['tmp_name'];
            if( in_array( $actualFileExt, array(JPG,JPEG,PDF,PNG) ) ){
                
                $config['upload_path']      = 'uploads/';
                $config['allowed_types']    = '*';

                //file format validated now upload template file
                $this->load->library('upload', $config);
                
                $fileName = '';
                if ( !$this->upload->do_upload('notification-file')){
                    $this->session->set_flashdata('error',str_replace("'","",$this->upload->display_errors() ));
                    echo json_encode(["isSuccess"=> false,"errorCode"=>FILE_UPLOADING_ERROR]);
                    return; 
                }
                else{
                    $fileName = $this->upload->data('file_name');
                }
            }

            //preserving notification data..
            $notificationData = array(
                "notification_title" => $data['title'],
                "notification_file" => $fileName,
                "is_file_attached" => $fileName == "" ? 0 : 1,
                "uploaded_on" => date("Y-m-d h:i:s"),
                "status" => 1
            );

            $this->load->model('queries');
            $this->queries->postNotification($notificationData);
            echo json_encode(["isSuccess"=> true,"message"=> "Notification posted !"]);

        }
    }

    public function getAllNotifications(){
        $data['page_title'] = 'Brand List';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>NOTIFICATIONS,'subMenu'=>NOTIFICATION_MANAGEMENT]);
            $this->load->model('queries');            
            $allNotification = $this->queries->getAllNotifications();
            echo json_encode($allNotification);
        }else{
            return redirect ('notifications');
        }
    }

    public function updateNotificationStatus(){
        $_POST = json_decode(file_get_contents("php://input"), true);
        $productId = $this->input->post('productId');
        $productStatus = $this->input->post('status');
        $this->load->model('queries');
        echo json_encode(array("isSuccess" => true, "data" => $this->queries->updateNotificationStatus($productStatus, $productId)));
    }

   
    
    
}
