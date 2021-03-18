<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use \PhpOffice\PhpSpreadsheet\Shared\Date;

class Brand extends CI_Controller {

    public function index(){
        $data['page_title'] = 'Create Brand';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>BRAND,'subMenu'=>CREATE_BRAND]);
            return  $this->load->view('createBrand',$data);
        }
        $this->session->set_flashdata("error","Login first to access brand pages.");
        //assign dynamically
        $this->load->view('authorization');
     }

    public function create(){
        $data['page_title'] = 'Create Brand';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>BRAND,'subMenu'=>CREATE_BRAND]);
            return  $this->load->view('createBrand',$data);
        }else{
            return redirect ('brand');
        }
    }


    public function listBrand(){
        $data['page_title'] = 'Brand List';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>BRAND,'subMenu'=>BRAND_LIST]);
            return  $this->load->view('listBrand',$data);
        }else{
            return redirect ('brand');
        }
    }

    
 

    public function populateDropDownsForMapping(){
        $data['page_title'] = 'Create Brand';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>BRAND,'subMenu'=>CREATE_BRAND]);
            $data = $this->input->post(); 
            $fileEncoding = $data['fileEncoding'];
            $fileExtChoosed = $data['fileFormat'];
            $choosedExt;
            switch($fileExtChoosed){
                case FILE_CSV: 
                    $choosedExt = CSV_EXT;
                    break;
                case FILE_XLS:
                    $choosedExt = XLS_EXT;
                    break;
                case FILE_XLSX:
                    $choosedExt = XLSX_EXT;
                    break;

            }
            $fileName = $_FILES['template']['name'];
            
            $actualFileExt = strtoupper(pathinfo($fileName, PATHINFO_EXTENSION));
            $tempFilePath = $_FILES['template']['tmp_name'];
            
            if( in_array( $actualFileExt, array(CSV_EXT,XLS_EXT,XLSX_EXT) ) ){
                if( $choosedExt ==  $actualFileExt){

                    $config['upload_path']      = 'uploads/';
                    $config['allowed_types']    = '*';


                    //file format validated now upload template file
                    $this->load->library('upload', $config);
                    
                    if($choosedExt == CSV_EXT){
                        $str = file_get_contents($tempFilePath);
                        $str = str_replace(", ",",",$str);
                        file_put_contents($tempFilePath , $str);
                    }

                    $templateName = '';
                    if ( !$this->upload->do_upload('template')){
                        $this->session->set_flashdata('error',str_replace("'","",$this->upload->display_errors() ));
                        echo json_encode(["isSuccess"=> false,"errorCode"=>FILE_UPLOADING_ERROR]);
                        return; 
                    }
                    else{
                        $templateName = $this->upload->data('file_name');
                    }  
                
                    $sheetCount = 0;
                    switch ( $actualFileExt ) {
                        case CSV_EXT:

                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                            // $encoding = mb_detect_encoding($tempFilePath, mb_detect_order(), true);
                            $reader->setInputEncoding($fileEncoding);
                            $reader->setDelimiter(',');
                            $reader->setEnclosure(' ');
                            $reader->setReadDataOnly(false);
                            $reader->setLoadAllSheets();
                            try{
                                $spreadsheet = $reader->load($tempFilePath);
                            }catch(\Exception $e){
                                echo json_encode(["isSuccess"=> false,"errorCode"=>INVALID_SPREADSHEET]);
                                return;
                            }
    
                            $sheetCount = $spreadsheet->getSheetCount();
                            for ($i = 0; $i < $sheetCount; $i++) {
                                $sheet = $spreadsheet->getSheet($i);
                                $sheetData = $sheet->toArray(null, true, true, true);
                                $sheetData = $this->sanatizeArray($sheetData);
                                break;
                            }
                            echo json_encode(
                                array(
                                    "isSuccess" => true,
                                    "data"=>$sheetData,
                                    "templateExt" => $actualFileExt,
                                    "templateName" =>$templateName,
                                    "hasSheets" => $sheetCount
                                )
                            );
                            break;
                        case XLS_EXT:
                            $inputFileType = PhpOffice\PhpSpreadsheet\IOFactory::identify($tempFilePath);
                            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                            $reader->setReadDataOnly(true);
                            $reader->setLoadAllSheets();
                            $spreadsheet = $reader->load($tempFilePath);
    
                            $sheetCount = $spreadsheet->getSheetCount();
                            for ($i = 0; $i < $sheetCount; $i++) {
                                $sheet = $spreadsheet->getSheet($i);
                                $sheetData = $sheet->toArray(null, true, true, true);
                                break;
                            }                            
                            echo json_encode(
                                array(
                                    "isSuccess" => true,
                                    "data"=>$sheetData,
                                    "templateExt" => $actualFileExt,
                                    "templateName" =>$templateName,
                                    "hasSheets" => $sheetCount
                                )
                            );
                            break;
                        case XLSX_EXT:
                            $inputFileType = PhpOffice\PhpSpreadsheet\IOFactory::identify($tempFilePath);
                            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                            $reader->setReadDataOnly(true);
                            $reader->setLoadAllSheets();
                            $spreadsheet = $reader->load($tempFilePath);
    
                            $sheetCount = $spreadsheet->getSheetCount();
                            for ($i = 0; $i < $sheetCount; $i++) {
                                $sheet = $spreadsheet->getSheet($i);
                                $sheetData = $sheet->toArray(null, true, true, true);
                                
                                break;
                            }
                            echo json_encode(
                                array(
                                    "isSuccess" => true,
                                    "data"=>$sheetData,
                                    "templateExt" => $actualFileExt,
                                    "templateName" =>$templateName,
                                    "hasSheets" => $sheetCount
                                )
                            );
                            break;
                      }

                      $templateHeader = array();
                      //storing template details into session
                      foreach($sheetData[1] as $position => $title) {  
                            $title = str_replace('"', '', $title);
                            $temp = array( $position => $title);
                            $templateHeader = array_merge( $templateHeader, $temp );
                      }
                      $this->session->set_userdata("templateData",array_filter($templateHeader));       
                }else{
                    $this->session->set_flashdata("error","Select template extension doesn't matched with uploaded template file");
                    $this->session->set_userdata(['menuSelected'=>BRAND,'subMenu'=>BRAND_LIST]);
                    echo json_encode(["isSuccess"=> false,"errorCode"=>MISMATCH_FILE_TYPE]);
    
                }
            }else{
                $this->session->set_flashdata("error","Select template extension doesn't matched with uploaded template file");
                $this->session->set_userdata(['menuSelected'=>BRAND,'subMenu'=>BRAND_LIST]);
                echo json_encode(["isSuccess"=> false,"errorCode"=>UNSUPPORTED_FILE_TYPE]);
            }
        }else{
            return redirect ('brand');
        }
    }

    public function registerBrand(){
        $data['page_title'] = 'Create Brand';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>BRAND,'subMenu'=>BRAND_LIST]);
            $this->load->model('queries');
            $data = $this->input->post();  

            //preserving brand details first then create brand data.
            $brandData = array(
                "brand_name" => $data['brandName'],
                "brand_tag" => $data['tags'],
                "first_name_position_in_template" => $data['firstName'],
                "last_name_position_in_template" => $data['lastName'],
                "organization_position_in_template" => $data['organization'],
                "county_position_in_template" => $data['country'],
                "email_position_in_template" => $data['email'],
                "telephone_position_in_template" => $data['telephone'],
                "creation_date_in_position" => $data['creationDate'],
                "commercial_category" => $data['commercialCategory'],
                "edu_category" => $data['eduCategory'],
                "home_category" => $data['homeCategory'],
                "template_url" => $data['uploaded_file_name'],
                "file_format" => $data['file_type'],
                "has_sheets" => $data['hassheets'],
                "added_by" =>  $this->session->userdata('admin_id') ? '(admin)' : $this->queries->getUserNameById($this->session->userdata('user_id'))[0]['name'],
                "hide" => 0

            );

            $insertedBrandId = $this->queries->registerBrand($brandData);
            if($insertedBrandId > 0){
                $this->session->set_flashdata('success','Brand registered successfully!'); 
                foreach($this->session->userdata('templateData') as $position => $title) { 
                    if($title == null){
                        continue;
                    } 
                    $templateData = array(
                        "brand_id" => $insertedBrandId, 
                        "position" => $position,
                        "header_title" => $title,
                        "hide" => 0
                    );
                    if(!$this->queries->insertTemplateData($templateData)){
                        echo json_encode(["isSuccess"=> false,"errorCode"=>"Something went wrong! Unable to create brand right now."]);
                        return;
                    }
                }
                echo json_encode(["isSuccess"=> true]);
            }
            else{
                $this->session->set_flashdata('error','Failed to register brand!');
                echo json_encode(["isSuccess"=> false,"errorCode"=>"Something went wrong! Unable to create brand right now."]);
                return;
            }
        }else{
            return redirect ('brand');
        }
    }

    public function getAllBrands(){
        $data['page_title'] = 'Brand List';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>BRAND,'subMenu'=>BRAND_LIST]);
            $this->load->model('queries');
            echo json_encode($this->queries->getAllBrands());
        }else{
            return redirect ('brand');
        }
    }
    

    

    public function getBrandById(){
        $data['page_title'] = 'Brand List';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>BRAND,'subMenu'=>BRAND_LIST]);
            $this->load->model('queries');
            $brandData = array(
                "brand_details" => $this->queries->getBrandById($this->input->get()) ,
                "template_details" => $this->queries->getBrandTemplateById($this->input->get())
            );
            echo json_encode($brandData);
        }else{
            return redirect ('brand');
        }
    }


    public function updateBrand(){
        
        $data['page_title'] = 'updating Brand';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>BRAND,'subMenu'=>BRAND_LIST]);
            $this->load->model('queries');
            $data = $this->input->post();  
            //preserving brand details first then create brand data.
            $brandData = array(
                "brand_name" => $data['brandName'],
                "brand_tag" => $data['tags'],
                "first_name" => $data['firstName'],
                "last_name" => $data['lastName'],
                "organization" => $data['organization'],
                "country" => $data['country'],
                "email" => $data['email'],
                "telephone" => $data['telephone'],
                "creationDate" => $data['creationDate'],
                "commercialCategory" => $data['commercialCategory'],
                "eduCategory" => $data['eduCategory'],
                "homeCategory" => $data['homeCategory'],
                "uploaded_file_name" => $data['uploaded_file_name'],
                "file_type" => $data['file_type'],
                "hassheets" => $data['hassheets'],
                "added_by" =>  $this->session->userdata('admin_id') ? '(admin)' : $this->queries->getUserNameById($this->session->userdata('user_id'))[0]['name'],                "hide" => 0,
                "brand_id" => $data['brand_id']

            );

            $updateStatus = $this->queries->updateBrand($brandData);
            if($updateStatus){
                //hiding old template records..
                if( $data['isTemplateChanged'] == true){
                    $this->queries->hideOldTemplate($data['brand_id']);
                    $this->queries->removeOldBatchImportsAndRecords($data['brand_id']);

                    $this->session->set_flashdata('success','Brand updated successfully!'); 
                    foreach($this->session->userdata('templateData') as $position => $title) {  
                        $title = str_replace('"', '', $title);                        
                        $templateData = array(
                            "brand_id" => $data['brand_id'], 
                            "position" => $position,
                            "header_title" => $title,
                            "hide" => 0
                        );
                        if(!$this->queries->insertTemplateData($templateData)){
                            echo json_encode(["isSuccess"=> false,"errorCode"=>"Something went wrong! Unable to create brand right now."]);
                            return;
                        }
                    }
                }

                echo json_encode(["isSuccess"=> true]);
            }
            else{
                $this->session->set_flashdata('error','Failed to register brand!');
                echo json_encode(["isSuccess"=> false,"errorCode"=>"Something went wrong! Unable to create brand right now."]);
                return;
            }
        }else{
            return redirect ('brand');
        }
    
    }

    public function deleteBrand(){
        $brandId = $this->input->get('brandId');
        $this->load->model('queries');
        echo json_encode(array("isSuccess" => $this->queries->deleteBrand($brandId)));
    }

    public function getBrandTemplateFileName(){
        $brandId = $this->input->get('brandId');
        $this->load->model('queries');
        $brandData = $this->queries->getAllBrands($brandId);
        echo json_encode($brandData);
    }

    public function sanatizeArray($sheetData){

        foreach($sheetData as $index => $data) {  
            foreach($sheetData[$index] as $key => $value){
                $sheetData[$index][$key] = str_replace(array("\n\r", "\n", "\r", "\""), "", $sheetData[$index][$key]);
            }            
        }
        return $sheetData;
    }

}
?>