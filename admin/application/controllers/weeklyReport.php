<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WeeklyReport extends CI_Controller {

	public function index(){
        $data['page_title'] = 'Weekly Report';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>WEEKLY_ATTENDANCE_REPORTS,'subMenu'=>ATTENDANCE_REPORTS]);
            return  $this->load->view('weeklyReport',$data);
        }
        $this->session->set_flashdata("error","Login first to access weekly report.");
        //assign dynamically
        $this->load->view('authorization');
    }

    public function postNotification(){
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>WEEKLY_ATTENDANCE_REPORTS,'subMenu'=>ATTENDANCE_REPORTS]);
            $data = $this->input->post(); 
            $fileName = $_FILES['attached']['name'];

            $actualFileExt = strtoupper(pathinfo($fileName, PATHINFO_EXTENSION));
            $tempFilePath = $_FILES['attached']['tmp_name'];
            if( in_array( $actualFileExt, array(PDF) ) ){
                
                $config['upload_path']      = 'weeklyReports/';
                $config['allowed_types']    = '*';

                //file format validated now upload template file
                $this->load->library('upload', $config);
                
                $fileName = '';
                if ( !$this->upload->do_upload('attached')){
                    $this->session->set_flashdata('error',str_replace("'","",$this->upload->display_errors() ));
                    echo json_encode(["isSuccess"=> false,"errorCode"=>FILE_UPLOADING_ERROR]);
                    return; 
                }
                else{
                    $fileName = $this->upload->data('file_name');
                }
            }else{
                echo json_encode(["isSuccess"=> false,"errorCode"=>FILE_UPLOADING_ERROR]);
                return;
            }

            //preserving notification data..
            $notificationData = array(
                "attendance_for" => $data['attendanceFor'],
                "course" => $data['hiddenCourse'],
                "course_year" => $data['hiddenCourseYear'],
                "year" => $data['attendanceYear'],
                "attendance_month" => $data['attendanceMonth'],
                "attendance_week" => $data['attendanceWeek'],
                "attached_file" => $fileName,
                "status" => 1,
                "uploaded_on" => date("Y-m-d h:i:s")
            );

            $this->load->model('queries');
            $this->queries->postWeeklyReport($notificationData);
            echo json_encode(["isSuccess"=> true,"message"=> "Report posted !"]);

        }
    }
    
    public function getAllReport(){
        $data['page_title'] = 'Brand List';
        
        $this->session->set_userdata(['menuSelected'=>WEEKLY_ATTENDANCE_REPORTS,'subMenu'=>ATTENDANCE_REPORTS]);
        $this->load->model('queries');            
        $allNotification = $this->queries->getAllReport();
        echo json_encode($allNotification);
       
    }

    public function updateReportStatus(){
        $_POST = json_decode(file_get_contents("php://input"), true);
        $productId = $this->input->post('productId');
        $productStatus = $this->input->post('status');
        $this->load->model('queries');
        echo json_encode(array("isSuccess" => true, "data" => $this->queries->updateReportStatus($productStatus, $productId)));
    }

    public function renderPage(){
        $index = $this->input->get('index');
        $this->load->model('queries');
        echo json_encode(array("isSuccess" => true, "data" => $this->queries->getReportByLimit($index- 10, $index)));
    }
    
}
