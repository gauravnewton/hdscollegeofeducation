<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function index()
	{
        $data['page_title'] = 'Gallery';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>GALLERY,'subMenu'=>GALLERYVIEUPLOAD]);
            return  $this->load->view('gallery',$data);
        }
        $this->session->set_flashdata("error","Login first to access gallery.");
        //assign dynamically
        $this->load->view('authorization');
    }

    public function upload(){
        $fileExt = explode('.', $_FILES['file']['name']);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('gif','jpg','png','jpeg');  
        $newfilename = round(microtime(true)) . '-' .$_FILES['file']['name'];
        $tempFile = $_FILES['file']['tmp_name'];    
        $targetPath = UPLOAD_PATH;     
        $targetFile =  $targetPath. $newfilename;  
        if (in_array($fileActualExt, $allowed)) {
            move_uploaded_file($tempFile,'"'.$targetFile); 
            $this->load->model('queries');
            $this->queries->persistsImage($newfilename);
        }
        echo json_encode(array("isSuccess" => true, "data" => $newfilename));
    }

    public function getGalleryImages(){
        $this->load->model('queries');
        echo json_encode($this->queries->getGalleryImages());
    }
    
    
}
