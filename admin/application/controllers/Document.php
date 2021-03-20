<?php
defined('BASEPATH') OR exit('No direct script access allowed');



use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class Document extends CI_Controller {

    private $rowData = array();
    private $totalRecords = 0;
    private $totalCommercial = 0;
    private $totalEdu = 0;
    private $totalDuplicate = 0;
    private $totalHome = 0;
    private $totalDiscared = 0;
    private $recordProcessed = 0;
    private $batch_id = 0;
    private $totalBusiness = 0;
    private $totalFreeMails = 0;

    private $canAttemptForMail = true;
    private $canAttemptForPhone = true;
    private $emailRetry = 0;
    private $phoneRetry = 0;

    private $emailApiError = 0;
    private $phoneApiError = 0;
    
    private $startDate = '';
    private $endDate = '';

    

     public function index(){
        $data['page_title'] = 'Upload Document';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>DOCUMENT]);
            return  $this->load->view('uploadDocument',$data);
        }
        $this->session->set_flashdata("error","Login first to access document pages.");
        //assign dynamically
        $this->load->view('authorization');
     }

     public function getAllImports(){
        $data['page_title'] = 'Batch list';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>DOCUMENT,'subMenu'=>DOCUMENT_LIST]);
            $this->load->model('queries');
            echo json_encode($this->queries->getAllImports());
        }else{
            $this->session->set_flashdata("error","Login first to batch iport list.");
            //assign dynamically
            return redirect ('document');
        }
     }


     public function loadDataTableForBatch(){
        $data['page_title'] = 'Batch list';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>DOCUMENT,'subMenu'=>DOCUMENT_LIST]);
            $this->load->model('queries');
            $batchId = $this->input->get('batchId');
            echo json_encode($this->queries->loadDataTableForBatch($batchId));
        }else{
            $this->session->set_flashdata("error","Login first to batch iport list.");
            //assign dynamically
            return redirect ('document');
        }
     }

     public function uploadDocument(){
        $data['page_title'] = 'Upload Document';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>DOCUMENT,'subMenu'=>DOCUMENT_UPLOAD]);
            return  $this->load->view('uploadDocument',$data);
        }
        $this->session->set_flashdata("error","Login first to access document pages.");
        //assign dynamically
        return redirect ('document');
     }

     

     public function listDocument(){
        $data['page_title'] = 'Batch List';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>DOCUMENT,'subMenu'=>DOCUMENT_LIST]);
            return  $this->load->view('listDocument',$data);
        }
        $this->session->set_flashdata("error","Login first to access document pages.");
        //assign dynamically
        return redirect ('document');
     }

     public function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
     }


     public function recordData($sheetData,$brandTemplate,$creationDataInNativeDate,$creationDatePosition,$countryPosition,$brandTag,$commercialCat,$eduCat,$homeCat){
         
        $rowData = array();
        foreach($brandTemplate as $template){
            if($template['position'] == $creationDatePosition){
                $creationDataInNativeDate = new DateTime($creationDataInNativeDate);
                $creationDataInNativeDate = $creationDataInNativeDate->format('Y-m-d');
                $rowData = $this->array_push_assoc($rowData,$template['header_title'],$creationDataInNativeDate);
            }else{
                $rowData = $this->array_push_assoc($rowData, $template['header_title'],$sheetData[$template['position']]);
            }
                $rowData = $this->array_push_Assoc($rowData,'Tags',$brandTag); 
                
                $rowData = $this->array_push_Assoc($rowData,'commercialCampaign',$commercialCat); 
                $rowData = $this->array_push_Assoc($rowData,'eduCampaign',$eduCat); 
                $rowData = $this->array_push_Assoc($rowData,'homeCampaign',$homeCat); 
        }
        return json_encode($rowData);
     }    

     /**
      * return true if email is .edu or any field in a particular row contains edu or home keyword
      */
     public function isBusinessEmail($apiResponse,$row){
        if($apiResponse['data']['free'] != 'yes' && !$this->isFreeMail($apiResponse['data']['email_address'])
                && !$this->isHome($row) && !$this->isEdu($row)){
            return true;
        }
        return false;
     }

     public function mockUp(){
        return array
        (
            "status" => "success",
            "data" => array
            (
                    "email_address" => "palomanesd@gmail.com",
                    "status" => "valid",
                    "verified_on" => "2020-08-14T14:01:39.767Z",
                    "time_taken" => 1062,
                    "sub_status" => array
                        (
                            "code" => 200,
                            "desc" => "Success"
                        ),
        
                    "detail_info" => array
                        (
                            "account" => "palomanesd",
                            "domain" => "gmail.com"
                        ),         
                    "disposable" => "no",
                    "free" => "no",
                    "role" => "no",
                    "suggested_email_address" => "",
                    "profile" => "",
                    "score" => 1,
                    "bounce_type" => "",
                    "safe_to_send" => "yes",
                    "deliverability_score" => 100
            ),
         
        );
        
     }

     public function phoneMockUp(){
        return array
        (
            "status" => "success",
            "data" => array
                (
                    "status" => "invalid",
                    "line_type" => "mobile",
                    "carrier" => "",
                    "location" => "Mendoza, Mendoza",
                    "country_name" => "Argentina",
                    "country_timezone" => "America/Buenos_Aires",
                    "country_code" => "AR",
                    "international_format" => "+54 9 261 525-7156",
                    "local_format" => "0261 15-525-7156",
                    "e164_format" => "+5492615257156",
                    "can_be_internationally_dialled" => "yes"
                )
        
        );
     }

     public function validatePhoneFormClearOutApi($phone){
        $url = $this->session->userData("HOOK_TYPE_CLEARPHONE")['url'];
        $apiKey = $this->session->userData("HOOK_TYPE_CLEARPHONE")['auth_token'];
        

        $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,//'https://api.clearoutphone.io/v1/phonenumber/validate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{ "number": "'.$phone.'" }',
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer:".$apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //api error
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
        }


     }

     public function validateEmailFormClearOutApi($mailId){
        $url = $this->session->userData("HOOK_TYPE_CLEAROUT")['url'];
        $apiKey = $this->session->userData("HOOK_TYPE_CLEAROUT")['auth_token'];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,//'https://api.clearout.io/v2/email_verify/instant',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"email": "'.$mailId.'"}',
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer:".$apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //api error
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response, true);
        }
     }

     public function validateFileAlongWithTemplate($sheetDataHeader,$brandTemplateHeader){
        
        if( sizeOf(array_filter($sheetDataHeader))  == sizeOf($brandTemplateHeader)){
            
            foreach($brandTemplateHeader as $position => $title) {  
                $titlePosition = $brandTemplateHeader[$position]['position'];
                $titleText = $brandTemplateHeader[$position]['header_title'];
                //issue in particular sheet
                if($sheetDataHeader[$titlePosition] == $titleText){
                    return true;
                }else{
                    return false;
                }

            }
        }else{
            //template mismatch
            return false;
        }
        
     }

     public function isFreeMail($mailId){
        $this->load->model('queries');
        return $this->queries->isFreeMail($mailId);
     }

     public function getBrandDetailsWithDemplateById($brandId){
        $data['page_title'] = 'Upload Document';
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id') || true){
            $this->session->set_userdata(['menuSelected'=>DOCUMENT,'subMenu'=>DOCUMENT_UPLOAD]);
            $this->load->model('queries');
            $brandData = array(
                "brand_details" => $this->queries->getBrandById(array('id'=>$brandId)),
                "template_details" => $this->queries->getBrandTemplateById(array('id'=>$brandId))
            );
            return $brandData;
        }else{
            return redirect ('document');
        }
     }

     public function isHome($row){
        $this->load->model('queries');
        return $this->queries->isHome($row);
     }

     public function isEdu($row){
        $this->load->model('queries');
        return $this->queries->isEdu($row);
     }

     public function isCommercialBusiness($row){
        $this->load->model('queries');
        return $this->queries->isCommercial($row);
    }

    public function zapierWebHook($url, $json, $headers) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($ch);
        //echo $output;
        curl_close($ch);
        return $output;
    }
    
    public function submitFileAndReturnJson(){
        if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
            $this->session->set_userdata(['menuSelected'=>DOCUMENT,'subMenu'=>DOCUMENT_UPLOAD]);
            $data = $this->input->post(); 
            
            $brandId = $data['brand'];            
            $fileEncoding = $data['fileEncoding'];

            $this->session->set_userdata(["brandId" => $brandId]);
            ini_set('max_execution_time', 0); 
                     
                        
            $sheetAsJson = array();

            //grabbing brand template data
            $brandData = $this->getBrandDetailsWithDemplateById($brandId);
            $brandTemplate = $brandData['template_details'];

            $expectedTemplateFileFormat = $brandData['brand_details'][0]['file_format'];
            $creationDateColumn = $brandData['brand_details'][0]['creation_date_in_position'];
            
            $fileName = $_FILES['brandFile']['name'];
            
            $actualFileExt = strtoupper(pathinfo($fileName, PATHINFO_EXTENSION));
            $tempFilePath = $_FILES['brandFile']['tmp_name'];

            //removing unwanted spaces from csv file
            if($expectedTemplateFileFormat == CSV_EXT){
                $str = file_get_contents($tempFilePath);
                $str = str_replace(", ",",",$str);
                file_put_contents($tempFilePath , $str);
            }
                
            if( in_array( $actualFileExt, array(CSV_EXT,XLS_EXT,XLSX_EXT) ) ){
                if( $expectedTemplateFileFormat ==  $actualFileExt){
                    $sheetCount = 0;
                    switch ( $actualFileExt ) {

                        case CSV_EXT:
                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                            // $encoding = mb_detect_encoding($tempFilePath, mb_detect_order(), true);
                            $reader->setInputEncoding($fileEncoding);
                            $reader->setDelimiter(',');
                            $reader->setEnclosure(' ');
                            $reader->setReadDataOnly(true);
                            $reader->setLoadAllSheets();
                            $spreadsheet = '';
                            try{
                                $spreadsheet = $reader->load($tempFilePath);
                            }catch(\Exception $e){
                                echo json_encode(["isSuccess"=> false,"errorCode"=>INVALID_SPREADSHEET]);
                                return;
                            }
    
                            $sheetCount = $spreadsheet->getSheetCount();


                            //calculating total records in whole documnet
                            for ($i = 0; $i < $sheetCount; $i++) {
                                $sheet = $spreadsheet->getSheet($i);
                                $sheetData = $sheet->toArray(null, true, true, true);
                                $sheetData = $this->sanatizeArray($sheetData);
                                if (sizeof($sheetData) > 0){

                                    $this->totalRecords = $this->totalRecords - 1;
                                    $this->totalRecords += sizeOf($sheetData);
                                    
                                }
                            }

                            
                            for ($i = 0; $i < $sheetCount; $i++) {
                                $sheet = $spreadsheet->getSheet($i);
                                $sheetData = $sheet->toArray(null, true, true, true);
                                $sheetData = $this->sanatizeArray($sheetData);
                                if($i == 0){
                                    if($sheetData[2][$creationDateColumn] != ""){
                                        //$creationDataInNativeDate = (array)\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheetData[2][$creationDateColumn]);
                                        $creationDataInNativeDate = new DateTime($sheetData[2][$creationDateColumn]);
                                        $creationDataInNativeDate = $creationDataInNativeDate->format('Y-m-d');
                                        
                                        $this->startDate = $creationDataInNativeDate;
                                        $this->endDate = $creationDataInNativeDate;
                                    }
                                    /** 
                                     * seeding import batch details 
                                     */
                                    // initializing batch data
                                    $this->load->model('queries');
                                    $batchData = array(
                                        "brand_id"  => $brandId,
                                        "date_start" => $this->startDate,
                                        "date_end" => $this->endDate,
                                        "total_commercial" => $this->totalCommercial,
                                        "total_edu" => $this->totalEdu,
                                        "total_duplicates" => $this->totalDuplicate,
                                        "total_home" => $this->totalHome,
                                        "total_discard" => $this->totalDiscared,
                                        "records_process" => $this->recordProcessed,
                                        "total_records" =>  $this->totalRecords,
                                        "total_business" => $this->totalBusiness,
                                        "total_email_error" => $this->emailApiError,
                                        "total_phone_error" => $this->phoneApiError,
                                        "total_free_mails"  => $this->totalFreeMails,
                                        "is_processed_by_cron"  => false
                                    );
                                    $this->batch_id = $this->queries->initializeBatchData($batchData);
                                    $this->session->set_userdata(["batchId" => $this->batch_id]);
                                }

                                if (sizeof($sheetData) > 0){
                                    //validating each sheet header
                                    if( !$this->validateFileAlongWithTemplate($sheetData[1],$brandTemplate) ){
                                        echo json_encode(["isSuccess"=> false,"errorCode"=>TEMPLATE_MISMATCH]);
                                        return;
                                    }

                                    /**
                                     * processing single record here
                                     */
                                    $sheetExtract = $this->processSingleSheetAndReturnJson($sheetData,$creationDateColumn,$brandTemplate,$actualFileExt);
                                    array_push($sheetAsJson,$sheetExtract);        

                                }                                
                            }   
                           
                            echo json_encode(
                                array(
                                    "isSuccess" => true,
                                    "data" => $sheetAsJson,
                                    "batchId" => $this->batch_id
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


                            //calculating total records in whole documnet
                            for ($i = 0; $i < $sheetCount; $i++) {
                                $sheet = $spreadsheet->getSheet($i);
                                $sheetData = $sheet->toArray(null, true, true, true);
                                if (sizeof($sheetData) > 0){

                                    $this->totalRecords = $this->totalRecords - 1;
                                    $this->totalRecords += sizeOf($sheetData);
                                    
                                }
                            }

                            
                            for ($i = 0; $i < $sheetCount; $i++) {
                                $sheet = $spreadsheet->getSheet($i);
                                $sheetData = $sheet->toArray(null, true, true, true);


                                if($i == 0){
                                    if($sheetData[2][$creationDateColumn] != ""){
                                        $creationDataInNativeDate = (array)\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheetData[2][$creationDateColumn]);
                                        $creationDataInNativeDate = new DateTime($creationDataInNativeDate['date']);
                                        $creationDataInNativeDate = $creationDataInNativeDate->format('Y-m-d');
                                        
                                        $this->startDate = $creationDataInNativeDate;
                                        $this->endDate = $creationDataInNativeDate;
                                    }
                                    /** 
                                     * seeding import batch details 
                                     */
                                    // initializing batch data
                                    $this->load->model('queries');
                                    $batchData = array(
                                        "brand_id"  => $brandId,
                                        "date_start" => $this->startDate,
                                        "date_end" => $this->endDate,
                                        "total_commercial" => $this->totalCommercial,
                                        "total_edu" => $this->totalEdu,
                                        "total_duplicates" => $this->totalDuplicate,
                                        "total_home" => $this->totalHome,
                                        "total_discard" => $this->totalDiscared,
                                        "records_process" => $this->recordProcessed,
                                        "total_records" =>  $this->totalRecords,
                                        "total_business" => $this->totalBusiness,
                                        "total_email_error" => $this->emailApiError,
                                        "total_phone_error" => $this->phoneApiError,
                                        "total_free_mails"  => $this->totalFreeMails,
                                        "is_processed_by_cron"  => false
                                    );
                                    $this->batch_id = $this->queries->initializeBatchData($batchData);
                                    $this->session->set_userdata(["batchId" => $this->batch_id]);
                                }

                                if (sizeof($sheetData) > 0){
                                    //validating each sheet header
                                    if( !$this->validateFileAlongWithTemplate($sheetData[1],$brandTemplate) ){
                                        echo json_encode(["isSuccess"=> false,"errorCode"=>TEMPLATE_MISMATCH]);
                                        return;
                                    }

                                    /**
                                     * processing single record here
                                     */
                                    $sheetExtract = $this->processSingleSheetAndReturnJson($sheetData,$creationDateColumn,$brandTemplate,$actualFileExt);
                                    array_push($sheetAsJson,$sheetExtract);        

                                }                                
                            }   
                           
                            echo json_encode(
                                array(
                                    "isSuccess" => true,
                                    "data" => $sheetAsJson,
                                    "batchId" => $this->batch_id
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


                            //calculating total records in whole documnet
                            for ($i = 0; $i < $sheetCount; $i++) {
                                $sheet = $spreadsheet->getSheet($i);
                                $sheetData = $sheet->toArray(null, true, true, true);
                                // $sheetData = sanatizeArray($sheetData);
                                if (sizeof($sheetData) > 0){
                                    $this->totalRecords = $this->totalRecords - 1;
                                    $this->totalRecords += sizeOf($sheetData);                                    
                                }
                            }

                            
                            for ($i = 0; $i < $sheetCount; $i++) {
                                $sheet = $spreadsheet->getSheet($i);
                                $sheetData = $sheet->toArray(null, true, true, true);


                                if($i == 0){
                                    if($sheetData[2][$creationDateColumn] != ""){
                                        $creationDataInNativeDate = (array)\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheetData[2][$creationDateColumn]);
                                        $creationDataInNativeDate = new DateTime($creationDataInNativeDate['date']);
                                        $creationDataInNativeDate = $creationDataInNativeDate->format('Y-m-d');
                                        
                                        $this->startDate = $creationDataInNativeDate;
                                        $this->endDate = $creationDataInNativeDate;
                                    }
                                    /** 
                                     * seeding import batch details 
                                     */
                                    // initializing batch data
                                    $this->load->model('queries');
                                    $batchData = array(
                                        "brand_id"  => $brandId,
                                        "date_start" => $this->startDate,
                                        "date_end" => $this->endDate,
                                        "total_commercial" => $this->totalCommercial,
                                        "total_edu" => $this->totalEdu,
                                        "total_duplicates" => $this->totalDuplicate,
                                        "total_home" => $this->totalHome,
                                        "total_discard" => $this->totalDiscared,
                                        "records_process" => $this->recordProcessed,
                                        "total_records" =>  $this->totalRecords,
                                        "total_business" => $this->totalBusiness,
                                        "total_email_error" => $this->emailApiError,
                                        "total_phone_error" => $this->phoneApiError,
                                        "total_free_mails"  => $this->totalFreeMails,
                                        "is_processed_by_cron"  => false
                                    );
                                    $this->batch_id = $this->queries->initializeBatchData($batchData);
                                    $this->session->set_userdata(["batchId" => $this->batch_id]);
                                }

                                if (sizeof($sheetData) > 0){
                                    //validating each sheet header
                                    if( !$this->validateFileAlongWithTemplate($sheetData[1],$brandTemplate) ){
                                        echo json_encode(["isSuccess"=> false,"errorCode"=>TEMPLATE_MISMATCH]);
                                        return;
                                    }

                                    /**
                                     * processing single record here
                                     */
                                    $sheetExtract = $this->processSingleSheetAndReturnJson($sheetData,$creationDateColumn,$brandTemplate,$actualFileExt);
                                    array_push($sheetAsJson,$sheetExtract);        

                                }                                
                            }   
                           
                            echo json_encode(
                                array(
                                    "isSuccess" => true,
                                    "data" => $sheetAsJson,
                                    "batchId" => $this->batch_id
                                )
                            );
                           
                            break;
                       
                      }     
                }else{
                    // file extension not matching with template 
                    echo json_encode(["isSuccess"=> false,"errorCode"=>MISMATCH_FILE_TYPE]);
    
                }
            }else{
                // file extension not allowed
                echo json_encode(["isSuccess"=> false,"errorCode"=>UNSUPPORTED_FILE_TYPE]);
            }
        }else{
            return redirect ('document');
        }
    }

    public function processSingleSheetAndReturnJson($sheetData,$creationDateColumn,$brandTemplate,$actualFileExt){
        $sheet = array();
        for ($i = 2; $i <= sizeOf($sheetData); $i++) {
            $row = array();
            foreach($brandTemplate as $template){
                if( $actualFileExt != "CSV"){
                    if($template['position'] == $creationDateColumn){
                        $creationDataInNativeDate = (array)\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheetData[$i][$template['position']]);
                        $creationDataInNativeDate = new DateTime($creationDataInNativeDate['date']);
                        $creationDataInNativeDate = $creationDataInNativeDate->format('Y-m-d');
                        $row = $this->array_push_assoc($row,$template['position'],$creationDataInNativeDate);           
                    }else{
                        $row = $this->array_push_assoc($row,$template['position'],$sheetData[$i][$template['position']]);
                    }
                    
                }else{
                    $row = $this->array_push_assoc($row,$template['position'],$sheetData[$i][$template['position']]);
                }
            }
            array_push($sheet,$row);
            $brandId = $this->session->userdata('brandId');
            $batchId = $this->session->userdata('batchId');
            $this->load->model('queries');
            $this->queries->insertRowForAsyncProcess($brandId,$batchId,json_encode($row));
        }
        return $sheet;
    }


    public function resendRecordWithDefinedCategory(){
        $_POST = json_decode(file_get_contents("php://input"), true);
		
		$recordId = $this->input->post('recordId');
        $category = $this->input->post('categoryId');
        $brandId = $this->input->post('categoryId');
        $this->initApiConfig();
        //processing category as directed...

        $this->load->model('queries');

        $recordData = $this->queries->getEntireRecordData($recordId);
        $currentCategory = $recordData[0]['category_id'];
        $async_record_id = $recordData[0]['async_record_id'];
        $row = $this->queries->readAsyncRowForReprocess($async_record_id)[0]['original_row'];
        $brandId = $recordData[0]['brand_id'];
        $batchId = $recordData[0]['batch_id'];
        $row = json_decode($row);
        $rowAsArray = (array)$row;

        $brandData = $this->getBrandDetailsWithDemplateById($brandId);
        $brandTemplate = $brandData['template_details'];

        $mailPosition = $brandData['brand_details'][0]['email_position_in_template'];
        $countryPosition = $brandData['brand_details'][0]['county_position_in_template'];
        $creationDatePosition = $brandData['brand_details'][0]['creation_date_in_position'];
        $phonePoition  = $brandData['brand_details'][0]['telephone_position_in_template'];
        $brandTags = $brandData['brand_details'][0]['brand_tag'];
        $commercialCat = $brandData['brand_details'][0]['commercial_category'];
        $eduCat = $brandData['brand_details'][0]['edu_category'];
        $homeCat = $brandData['brand_details'][0]['home_category'];

        $countryId = $this->queries->loadCountryIdByNameOrIso($rowAsArray[$countryPosition]);

        switch($category){

            case DUPLICATE_CATEGORY:
                $recordData = array(
                    "category_id" => DUPLICATE_CATEGORY
                );              

                if($this->queries->updateRecord($recordData,$recordId) > 0){
                    echo json_encode(array("isSuccess"=>true,"response"=>"Record persisted as Duplicate Category"));
                    $logData = array(
                        "record_id" => $recordId,
                        "event_type" => "Manual category changed to Duplicate Category",
                        "request_payload" => json_encode($recordData),
                        "response_payload" => 'Record persisted as Duplicate Category',
                        "timestamp" => date("Y-m-d h:i:s")
                    );
                    $this->queries->addLogs($logData);
                } 
            break;
            case PROBABLE_BUSINESS:
                
                $url = $this->session->userData("HOOK_TYPE_BUSINESS")['url'];
                // add your Zapier webhook url 

                $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                $headers = array('Accept: application/json', 'Content-Type: application/json');
                // call the zapier() function
                $json = (array)($json);
                $json = (array) json_decode($json[0]);
                $json = array_merge($json, array("category" => "BUSINESS"));
                $json = json_encode($json);
                $webHookResponse = $this->zapierWebHook($url, $json, $headers);

                $logData = array(
                    "record_id" => $recordId,
                    "event_type" => "Zapier Probable business webhook call during manual category changed",
                    "request_payload" => $json,
                    "response_payload" => json_encode($webHookResponse),
                    "timestamp" => date("Y-m-d h:i:s")
                );
                $this->queries->addLogs($logData);


    
                $this->totalCommercial++;
                /**
                * preserving row as probable business category
                */
                

                $recordData = array(
                    "category_id" => PROBABLE_BUSINESS
                );
                if($this->queries->updateRecord($recordData,$recordId) > 0){
                    $this->recordProcessed++;
                    $category = PROBABLE_BUSINESS;
                    echo json_encode(array("isSuccess"=>true,"response"=>"Record persisted as Probable Business Category"));
                    //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);

                    $logData = array(
                        "record_id" => $recordId,
                        "event_type" => "Zapier Probable business webhook call during manual category changed",
                        "request_payload" => $json,
                        "response_payload" => json_encode($webHookResponse),
                        "timestamp" => date("Y-m-d h:i:s")
                    );
                    $this->queries->addLogs($logData);
                }

                /**
                * adding research task
                */
                $researchData = array(
                    "record_id" => $recordId,
                    "comment" => "Probable business research task"
                );

                $this->queries->addResearchData($researchData);
                //echo json_encode(["isSuccess"=> true,"categoryCode"=> PROBABLE_BUSINESS]);




            break;
            case HOME_CATEGORY:
                $url = $this->session->userData("HOOK_TYPE_HOME")['url'];
                // add your Zapier webhook url 

                $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                $headers = array('Accept: application/json', 'Content-Type: application/json');
                // call the zapier() function
                $json = (array)($json);
                $json = (array) json_decode($json[0]);
                $json = array_merge($json, array("category" => "HOME"));
                $json = json_encode($json);
                $this->zapierWebHook($url, $json, $headers);


    
                // $this->totalCommercial++;
                /**
                * preserving row as probable business category
                */
                

                $recordData = array(
                    "category_id" => HOME_CATEGORY
                );
                if($this->queries->updateRecord($recordData,$recordId) > 0){
                    $this->recordProcessed++;
                    $category = HOME_CATEGORY;
                    echo json_encode(array("isSuccess"=>true,"response"=>"Record persisted as Home Category"));
                    //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                    $logData = array(
                        "record_id" => $recordId,
                        "event_type" => "Manual category changed to Home category",
                        "request_payload" => json_encode($recordData),
                        "response_payload" => 'Record persisted as Home Category',
                        "timestamp" => date("Y-m-d h:i:s")
                    );
                    $this->queries->addLogs($logData);
                }
            break;
            case EDU_CATEGORY:
                $url = $this->session->userData("HOOK_TYPE_EDU")['url'];
                // add your Zapier webhook url 

                $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                $headers = array('Accept: application/json', 'Content-Type: application/json');
                $json = (array)($json);
                $json = (array) json_decode($json[0]);
                $json = array_merge($json, array("category" => "EDU"));
                $json = json_encode($json);
                // call the zapier() function
                
                $webHookResponse = $this->zapierWebHook($url, $json, $headers);


                $logData = array(
                    "record_id" => $recordId,
                    "event_type" => "Zapier EDU category webhook API call during manual category change",
                    "request_payload" => $json,
                    "response_payload" => json_encode($webHookResponse),
                    "timestamp" => date("Y-m-d h:i:s")
                );
                $this->queries->addLogs($logData);
    
                // $this->totalCommercial++;
                /**
                * preserving row as probable business category
                */
                

                $recordData = array(
                    "category_id" => EDU_CATEGORY
                );
                if($this->queries->updateRecord($recordData,$recordId) > 0){
                    $this->recordProcessed++;
                    $category = EDU_CATEGORY;
                    echo json_encode(array("isSuccess"=>true,"response"=>"Recorded persisted as Edu Category"));
                    $logData = array(
                        "record_id" => $recordId,
                        "event_type" => "Manual category changed to EDU category",
                        "request_payload" => json_encode($recordData),
                        "response_payload" => 'Record persisted as EDU Category',
                        "timestamp" => date("Y-m-d h:i:s")
                    );
                    $this->queries->addLogs($logData);
                    //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                }
            break;
            case BUSINESS_CATEGORY:

                $apiResponse = array();
                do{
                    //TO-DO
                    //$apiResponse = $this->validateEmailFormClearOutApi($rowAsArray[$mailPosition]);
                    $apiResponse = $this->mockup();
                    if(sizeOf($apiResponse) > 0 && $apiResponse['status'] != 'failed'){
                        if( $apiResponse['data']['status'] == "valid"){
                            $this->canAttemptForMail = false;
                        }
                    }


                    $logData = array(
                        "record_id" => $recordId,
                        "event_type" => "Clear Out Email API call during Manual category change",
                        "request_payload" => json_encode($recordData),
                        "response_payload" => json_encode($apiResponse),
                        "timestamp" => date("Y-m-d h:i:s")
                    );
                    $this->queries->addLogs($logData);

                    $this->emailRetry++;
                }while( $this->emailRetry++ < 3 && $this->canAttemptForMail);

                if(sizeOf($apiResponse) > 0){
                    
                    if($apiResponse['status'] != 'failed'){
                        if($apiResponse['data']['status'] == 'valid'){                    
                            if($this->isBusinessEmail($apiResponse,$rowAsArray)){
                                $this->totalBusiness++;
                                
                                /*
                                **save record as business category
                                */
                                $recordData = array(
                                    "category_id" => BUSINESS_CATEGORY
                                );
                                if($this->queries->updateRecord($recordData,$recordId) > 0){
                                    $this->recordProcessed++;
                                    $category = BUSINESS_CATEGORY;

                                    $logData = array(
                                        "record_id" => $recordId,
                                        "event_type" => "Manual category changed to Business category",
                                        "request_payload" => json_encode($recordData),
                                        "response_payload" => 'Record persisted as Business Category',
                                        "timestamp" => date("Y-m-d h:i:s")
                                    );
                                    $this->queries->addLogs($logData);
                                    //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                                }




                                //now checking for safe status

                                if($apiResponse['data']['safe_to_send'] == 'yes'){
                                    
                                    /**
                                     * TO-Do Send to Zapier Business Send Campaign (add tags), send using webhooks
                                     */

                                    $url = $this->session->userData("HOOK_TYPE_BUSINESS")['url'];
                                        // add your Zapier webhook url 

                                    $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                                    $headers = array('Accept: application/json', 'Content-Type: application/json');
                                    // call the zapier() function
                                    $json = (array)($json);
                                    $json = (array) json_decode($json[0]);
                                    $json = array_merge($json, array("category" => "BUSINESS"));
                                    $json = json_encode($json);
                                    $webHookResponse = $this->zapierWebHook($url, $json, $headers);
                                    sleep($this->session->userData("HOOK_TYPE_BUSINESS")['timeOut']);

                                    $logData = array(
                                        "record_id" => $recordId,
                                        "event_type" => "Zapier Business Send Compagin webhook during Manual category change",
                                        "request_payload" => $json,
                                        "response_payload" => json_encode($webHookResponse),
                                        "timestamp" => date("Y-m-d h:i:s")
                                    );
                                    $this->queries->addLogs($logData);
                                    /*
                                    **  validating phone number
                                    */
                                    //TO-DO
                                    //$phoneApiResponse = $this->validatePhoneFormClearOutApi($sheetData[$i][$phonePoition]);
                                    //$phoneApiResponse =$this->phoneMockUp();


                                    $phoneApiResponse = array();
                                    do{
                                        //$phoneApiResponse = $this->validatePhoneFormClearOutApi($rowAsArray[$phonePoition]);
                                        $phoneApiResponse =$this->phoneMockUp();
                                        if(sizeOf($phoneApiResponse) > 0 && $phoneApiResponse['status'] != 'failed'){
                                            if($phoneApiResponse['data']['status'] == "valid"){
                                                $this->canAttemptForPhone = false;
                                            }
                                        }

                                        $logData = array(
                                            "record_id" => $recordId,
                                            "event_type" => "Clear out phone API call during manual category change",
                                            "request_payload" => json_encode($recordData),
                                            "response_payload" => json_encode($phoneApiResponse),
                                            "timestamp" => date("Y-m-d h:i:s")
                                        );
                                        $this->queries->addLogs($logData);
                                        $this->phoneRetry++;
                                    }while( $this->phoneRetry++ < 3 && $this->canAttemptForPhone);
                                    
                                    if(sizeOf($phoneApiResponse) > 0){
                                        if($phoneApiResponse['status'] != 'failed'){
                                            if($phoneApiResponse['data']['status'] == 'valid'){
                                                /**
                                                 * phone number validated
                                                 * TO-DO
                                                 * Add Call Followup Task in Agile
                                                 */
                
                
                
                                            }else{
                                                /**
                                                 * invalid phone number
                                                 * Add Research task: Find telephone and complete CRM data
                                                 */
                                                $researchData = array(
                                                    "record_id" => $recordId,
                                                    "comment" => "Find telephone and complete CRM data"
                                                );
                        

                                                $logData = array(
                                                    "record_id" => $recordId,
                                                    "event_type" => "Invalid phone number found during manual category change",
                                                    "request_payload" => json_encode($recordData),
                                                    "response_payload" => 'Invalid phone number ',
                                                    "timestamp" => date("Y-m-d h:i:s")
                                                );
                                                $this->queries->addLogs($logData);


                                                $this->queries->addResearchData($researchData);
                                            }
                                        }else{
                                            /**
                                             * preserving row as PHONE API Error
                                             */
                                            
                                            echo json_encode(["isSuccess"=> false,"categoryCode"=> PHONE_API_RESPONSE_ERROR]);

                                            $this->phoneApiError++;
                                            $recordData = array(
                                                "category_id" => PHONE_API_RESPONSE_ERROR
                                            );
                                            if($this->queries->updateRecord($recordData,$recordId) > 0){
                                                $this->recordProcessed++;
                                                $category = PHONE_API_RESPONSE_ERROR;


                                                $logData = array(
                                                    "record_id" => $recordId,
                                                    "event_type" => "Clear out phone API error during manual category change",
                                                    "request_payload" => json_encode($recordData),
                                                    "response_payload" => json_decode($phoneApiResponse),
                                                    "timestamp" => date("Y-m-d h:i:s")
                                                );
                                                $this->queries->addLogs($logData);
                                                //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                                            }
                                        }
                                    }else{
                                        /**
                                         * preserving row as PHONE API Error
                                         */
                                        $this->phoneApiError++;
                                        
                                        // echo json_encode(["isSuccess"=> false,"categoryCode"=> PHONE_API_RESPONSE_ERROR]);


                                        $recordData = array(
                                            "category_id" => PHONE_API_RESPONSE_ERROR
                                        );
                                        if($this->queries->updateRecord($recordData,$recordId) > 0){
                                            $this->recordProcessed++;
                                            $category = PHONE_API_RESPONSE_ERROR;

                                            $logData = array(
                                                "record_id" => $recordId,
                                                "event_type" => "Clear out phone API error during manual category change",
                                                "request_payload" => json_encode($recordData),
                                                "response_payload" => json_encode($phoneApiError),
                                                "timestamp" => date("Y-m-d h:i:s")
                                            );
                                            $this->queries->addLogs($logData);

                                            //echo json_encode(["isSuccess"=> true,"categoryCode"=> PHONE_API_RESPONSE_ERROR]);
                                        }
                                    }


                                }else{
                                    /**
                                     * mail is not safe to send adding research task for this record
                                     */ 
                                    $researchData = array(
                                        "record_id" => $recordId,
                                        "comment" => "Find telephone and complete CRM data"
                                    );

                                    $this->queries->addResearchData($researchData);

                                    $logData = array(
                                        "record_id" => $recordId,
                                        "event_type" => "Mail not safe to send during manual category change",
                                        "request_payload" => json_encode($recordData),
                                        "response_payload" => json_encode($apiResponse),
                                        "timestamp" => date("Y-m-d h:i:s")
                                    );
                                    $this->queries->addLogs($logData);

                                }

                                //echo json_encode(["isSuccess"=> true,"categoryCode"=> BUSINESS_CATEGORY]);
                                
                                
                            }else{
                                /**
                                 * not a business mail then flow comes here
                                 */
                                if($apiResponse['data']['safe_to_send'] == 'yes'){
                                    
                                    /**
                                     * mail is safe now validating edu category
                                     */
                                    if($this->isEdu($rowAsArray)){
                                        //edu category found
                                        $this->totalEdu++;

                                        /**
                                         * preserving row as edu
                                         */

                                        
                                    

                                        $recordData = array(
                                            "category_id" => EDU_DOMAIN
                                        );
                                        if($this->queries->updateRecord($recordData,$recordId) > 0){
                                            $this->recordProcessed++;
                                            $category = EDU_DOMAIN;

                                            $logData = array(
                                                "record_id" => $recordId,
                                                "event_type" => "Manual category changed to EDU category",
                                                "request_payload" => json_encode($recordData),
                                                "response_payload" => 'Record persisted as EDU Category',
                                                "timestamp" => date("Y-m-d h:i:s")
                                            );
                                            $this->queries->addLogs($logData);
                                            
                                            //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                                        }


                                        if($apiResponse['data']['free'] == "yes" && $this->isFreeMail($rowAsArray[$mailPosition])){

                                            $this->totalFreeMails++;
                                            /**
                                             * TO-DO
                                             * Send to Zapier EDU Send Campaign (add tags), connect with webhooks
                                             */                                        
                                            $url = $this->session->userData("HOOK_TYPE_EDU")['url'];
                                            // add your Zapier webhook url 
                                            $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                                            $headers = array('Accept: application/json', 'Content-Type: application/json');
                                            // call the zapier() function
                                            $json = (array)($json);
                                            $json = (array) json_decode($json[0]);
                                            $json = array_merge($json, array("category" => "EDU"));
                                            $json = json_encode($json);
                                            $webHookResponse = $this->zapierWebHook($url, $json, $headers);
                                            sleep($this->session->userData("HOOK_TYPE_EDU")['timeOut']);

                                            $logData = array(
                                                "record_id" => $recordId,
                                                "event_type" => "Zapier EDU send campagin webhook call during manual category change",
                                                "request_payload" => $json,
                                                "response_payload" => json_encode($webHookResponse),
                                                "timestamp" => date("Y-m-d h:i:s")
                                            );
                                            $this->queries->addLogs($logData);


                                        }else{

                                            /**
                                             * TO-DO 
                                             * Send to Zapier EDU free email Send Campaign (add tags), connect with webhooks
                                             */
                                            $url = $this->session->userData("HOOK_TYPE_EDU_FREE_MAIL")['url'];
                                            // add your Zapier webhook url 
                                            $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                                            $headers = array('Accept: application/json', 'Content-Type: application/json');
                                            // call the zapier() function
                                            $json = (array)($json);
                                            $json = (array) json_decode($json[0]);
                                            $json = array_merge($json, array("category" => "EDU FREE MAIL"));
                                            $json = json_encode($json);
                                            $webHookResponse = $this->zapierWebHook($url, $json, $headers);
                                            sleep($this->session->userData("HOOK_TYPE_EDU_FREE_MAIL")['timeOut']);

                                            $logData = array(
                                                "record_id" => $recordId,
                                                "event_type" => "Zapier EDU free email send campagin webhook call during manual category change",
                                                "request_payload" => $json,
                                                "response_payload" => json_encode($webHookResponse),
                                                "timestamp" => date("Y-m-d h:i:s")
                                            );
                                            $this->queries->addLogs($logData);

                                        }
                                        //echo json_encode(["isSuccess"=> true,"categoryCode"=> EDU_CATEGORY]);

                                    }else{
                                        /**
                                        * To-DO
                                        * Send to Zapier HOME Send Campaign (add tags), send using webhooks
                                        */

                                        $url = $this->session->userData("HOOK_TYPE_HOME")['url'];
                                        // add your Zapier webhook url 
                                        $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                                        $headers = array('Accept: application/json', 'Content-Type: application/json');
                                        // call the zapier() function
                                        $json = (array)($json);
                                        $json = (array) json_decode($json[0]);
                                        $json = array_merge($json, array("category" => "HOME"));
                                        $json = json_encode($json);
                                        $webHookResponse = $this->zapierWebHook($url, $json, $headers);
                                        sleep($this->session->userData("HOOK_TYPE_HOME")['timeOut']);

                                        $logData = array(
                                            "record_id" => $recordId,
                                            "event_type" => "Zapier Home send campagin webhook call during manual category change",
                                            "request_payload" => $json,
                                            "response_payload" => json_encode($webHookResponse),
                                            "timestamp" => date("Y-m-d h:i:s")
                                        );
                                        $this->queries->addLogs($logData);

                                        if($this->isCommercialBusiness($rowAsArray)){
                                            $this->totalCommercial++;
                                            /**
                                            * preserving row as probable business category
                                            */
                                            

                                            $recordData = array(
                                                "category_id" => PROBABLE_BUSINESS
                                            );
                                            if($this->queries->updateRecord($recordData,$recordId) > 0){
                                                $this->recordProcessed++;
                                                $category = PROBABLE_BUSINESS;

                                                $logData = array(
                                                    "record_id" => $recordId,
                                                    "event_type" => "Manual category changed to probable business",
                                                    "request_payload" => json_encode($recordData),
                                                    "response_payload" => 'Record Preserved as Probable Business',
                                                    "timestamp" => date("Y-m-d h:i:s")
                                                );
                                                $this->queries->addLogs($logData);
                                                //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                                            }

                                            /**
                                            * adding research task
                                            */
                                            $researchData = array(
                                                "record_id" => $recordId,
                                                "comment" => "Probable business research task"
                                            );
                    
                                            $this->queries->addResearchData($researchData);
                                            //echo json_encode(["isSuccess"=> true,"categoryCode"=> PROBABLE_BUSINESS]);


                                        }else{
                                            $this->totalHome++;
                                            /**
                                            * preserving row as home  category
                                            */

                                        
                                                            
                                            $recordData = array(
                                                "category_id" => HOME_CATEGORY
                                            );
                                            if($this->queries->updateRecord($recordData,$recordId) > 0){
                                                $this->recordProcessed++;
                                                $category = HOME_CATEGORY;

                                                $logData = array(
                                                    "record_id" => $recordId,
                                                    "event_type" => "Manual category changed to home category",
                                                    "request_payload" => json_encode($recordData),
                                                    "response_payload" => 'Record Preserved as home category',
                                                    "timestamp" => date("Y-m-d h:i:s")
                                                );
                                                $this->queries->addLogs($logData);
                                                
                                                //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                                            }
                                        }
                                    }


                                }else{
                                    $this->totalDiscared++;
                                    /**
                                    * not safe to send, preserving row as discarded
                                    */
                            


                                    $recordData = array(
                                        "category_id" => DISCARDED_CATEGORY
                                    );
                                    if($this->queries->updateRecord($recordData,$recordId) > 0){
                                        $this->recordProcessed++;
                                        $category = DISCARDED_CATEGORY;

                                        $logData = array(
                                            "record_id" => $recordId,
                                            "event_type" => "Manual category changed to Discarded category",
                                            "request_payload" => json_encode($recordData),
                                            "response_payload" => 'Record Preserved as Discarded category',
                                            "timestamp" => date("Y-m-d h:i:s")
                                        );
                                        $this->queries->addLogs($logData);
                                        //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                                    } 
                                    //echo json_encode(["isSuccess"=> true,"categoryCode"=> DISCARDED_CATEGORY]);

                                }                   

                            }
                        }else{
                            if($apiResponse['data']['status'] == 'failed'){
                                /*
                                **save record as EMAIL API RESPONSE ERROR category
                                */
                                $this->emailApiError++;

                        

                                $recordData = array(
                                    "category_id" => EMAIL_API_RESPONSE_ERROR
                                );
                                if($this->queries->updateRecord($recordData,$recordId) > 0){
                                    $this->recordProcessed++;
                                    $category = EMAIL_API_RESPONSE_ERROR;
                                    
                                    $logData = array(
                                        "record_id" => $recordId,
                                        "event_type" => "Clear out Email API error during manual category change",
                                        "request_payload" => json_encode($recordData),
                                        "response_payload" => json_encode($apiResponse),
                                        "timestamp" => date("Y-m-d h:i:s")
                                    );
                                    $this->queries->addLogs($logData);
                                    //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                                }
                                //echo json_encode(["isSuccess"=> false,"categoryCode"=> EMAIL_API_RESPONSE_ERROR]);

                            }else{
                                /*
                                **invalid email address format found
                                **save record as discard category
                                */
                                $this->totalDiscared++;
                                

                            
                        
                                
                                $recordData = array(
                                    "category_id" => DISCARDED_CATEGORY
                                );
                                if($this->queries->updateRecord($recordData,$recordId) > 0){
                                    $this->recordProcessed++;
                                    $category = DISCARDED_CATEGORY;


                                    $logData = array(
                                        "record_id" => $recordId,
                                        "event_type" => "Manual category changed to discarded category",
                                        "request_payload" => json_encode($recordData),
                                        "response_payload" => 'Record presisted as Discarded category',
                                        "timestamp" => date("Y-m-d h:i:s")
                                    );
                                    $this->queries->addLogs($logData);
                                    //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                                }

                                // echo json_encode(["isSuccess"=> true,"categoryCode"=> DISCARDED_CATEGORY]);

                            }
                            
                        }
                    }else{
                        /*
                        **save record as EMAIL API RESPONSE ERROR category
                        */
                        $this->emailApiError++;

                
                    

                        $recordData = array(
                            "category_id" => EMAIL_API_RESPONSE_ERROR
                        );
                        if($this->queries->updateRecord($recordData,$recordId) > 0){
                            $this->recordProcessed++;
                            $category = EMAIL_API_RESPONSE_ERROR;

                            $logData = array(
                                "record_id" => $recordId,
                                "event_type" => "Clear out Email API error during manual category change",
                                "request_payload" => json_encode($recordData),
                                "response_payload" => json_encode($apiResponse),
                                "timestamp" => date("Y-m-d h:i:s")
                            );
                            $this->queries->addLogs($logData);
                            //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                        }

                        //echo json_encode(["isSuccess"=> false,"categoryCode"=> EMAIL_API_RESPONSE_ERROR]);

                    }
                }else{
                    /*
                    **save record as EMAIL API RESPONSE ERROR category
                    */
                    $this->emailApiError++;

                
                
                    $recordData = array(
                        "category_id" => EMAIL_API_RESPONSE_ERROR
                    );
                    if($this->queries->updateRecord($recordData,$recordId) > 0){
                        $this->recordProcessed++;
                        $category = EMAIL_API_RESPONSE_ERROR;

                        $logData = array(
                            "record_id" => $recordId,
                            "event_type" => "Clear out Email API error during manual category change",
                            "request_payload" => json_encode($recordData),
                            "response_payload" => json_encode($apiResponse),
                            "timestamp" => date("Y-m-d h:i:s")
                        );
                        $this->queries->addLogs($logData);
                        //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                    }

                    //echo json_encode(["isSuccess"=> false,"categoryCode"=> EMAIL_API_RESPONSE_ERROR]);

                }
            break;
            case DISCARDED_CATEGORY:
                

                $recordData = array(
                    "category_id" => DISCARDED_CATEGORY
                );
                if($this->queries->updateRecord($recordData,$recordId) > 0){
                    $this->recordProcessed++;
                    $category = DISCARDED_CATEGORY;
                    echo json_encode(array("isSuccess"=>true,"response"=>"Recorded persisted as Discarded Category"));

                    $logData = array(
                        "record_id" => $recordId,
                        "event_type" => "Manual category changed to Discarded category",
                        "request_payload" => json_encode($recordData),
                        "response_payload" => 'Record persisted as Discarded Category',
                        "timestamp" => date("Y-m-d h:i:s")
                    );
                    $this->queries->addLogs($logData);
                    //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                }
            break;
            case PHONE_API_RESPONSE_ERROR:
            break;
            case EMAIL_API_RESPONSE_ERROR :
            break;
            case FREE_MAILS:
            break;
            case EDU_DOMAIN :
            break;
        }

        //maintaining the batch import table count...
        $this->updateCategoryCount($batchId,$currentCategory,$category);

        


    }

    public function asyncProcessingofRecord(){
        log_message('debug', 'asyncProcessingofRecordCron started at... '.date("l jS \of F Y h:i:s A"));
        $this->initApiConfig();
        
        /**
         * 
         */
        ini_set('max_execution_time', 0);
        //$batchId = $this->session->userdata('batchId');
        $this->load->model('queries');
        $data = $this->queries->readAllRecordsForAsyncProcess();
        foreach($data as $key=>$value){
            $brandId = $value['brand_id'];
            
            $batchId = $value['batch_id'];
            $row = json_decode($value['original_row']);
            $asyncRowId = $value['id'];
            $this->processSingleRow($row,$brandId,$batchId,$asyncRowId);
            $this->queries->updateAsyncProcess($asyncRowId);
            // $row = (array)$row;
            //updating import batch data here as well
            $batchData = array(
                "batch_id" => $batchId,
                "total_commercial" => $this->totalCommercial,
                "total_edu" => $this->totalEdu,
                "total_duplicates" => $this->totalDuplicate,
                "total_home" => $this->totalHome,
                "total_discard" => $this->totalDiscared,
                "total_business" => $this->totalBusiness,
                "records_process"  => $this->recordProcessed,
                "total_email_error" => $this->emailApiError,
                "total_phone_error" => $this->phoneApiError,
                "total_free_mails"  => $this->totalFreeMails
            );
            $this->queries->updatingBatchDataNow($batchData);
        }

        log_message('debug', 'asyncProcessingofRecordCron ends at... '.date("l jS \of F Y h:i:s A"));


    }

    public function initApiConfig(){
            /**
             * read all api's configuration first 
             */
            $this->load->model('queries');
            $apiConfigs = $this->queries->loadingApiConfig();            

            if(sizeOf($apiConfigs) > 0){
                foreach($apiConfigs as $config){
                    switch($config['hook_type']){
                        case HOOK_TYPE_CLEAROUT:
                            $this->session->set_userdata(
                                [
                                    "HOOK_TYPE_CLEAROUT" => array(
                                        'timeOut'=>$config['delay_between_posts'],
                                        'url'=>$config['url'],
                                        'auth_token'=>$config['auth_token']
                                     )
                                ]);
                            break;
                        case HOOK_TYPE_CLEARPHONE:
                            $this->session->set_userdata(
                                [
                                    "HOOK_TYPE_CLEARPHONE" => array(
                                        'timeOut'=>$config['delay_between_posts'],
                                        'url'=>$config['url'],
                                        'auth_token'=>$config['auth_token']
                                     )
                                ]);
                            break;
                        case HOOK_TYPE_BUSINESS:
                            $this->session->set_userdata(
                                [
                                    "HOOK_TYPE_BUSINESS" => array(
                                        'timeOut'=>$config['delay_between_posts'],
                                        'url'=>$config['url'],
                                        'auth_token'=>$config['auth_token']
                                     )
                                ]);
                            break;
                        case HOOK_TYPE_EDU_FREE_MAIL:
                            $this->session->set_userdata(
                                [
                                    "HOOK_TYPE_EDU_FREE_MAIL" => array(
                                        'timeOut'=>$config['delay_between_posts'],
                                        'url'=>$config['url'],
                                        'auth_token'=>$config['auth_token']
                                     )
                                ]);
                            break;
                        case HOOK_TYPE_EDU:
                            $this->session->set_userdata(
                                [
                                    "HOOK_TYPE_EDU" => array(
                                        'timeOut'=>$config['delay_between_posts'],
                                        'url'=>$config['url'],
                                        'auth_token'=>$config['auth_token']
                                     )
                                ]);
                            break;
                        case HOOK_TYPE_HOME:
                            $this->session->set_userdata(
                                [
                                    "HOOK_TYPE_HOME" => array(
                                        'timeOut'=>$config['delay_between_posts'],
                                        'url'=>$config['url'],
                                        'auth_token'=>$config['auth_token']
                                     )
                                ]);
                            break;
                    }
                }
            }
    }


    public function reProcessSingleRow(){
        $this->initApiConfig();

        $recordId = $this->input->get('recordId');
        $this->load->model('queries');
        $category = "";
        
        $recordData = $this->queries->getEntireRecordData($recordId);
        $currentCategory = $recordData[0]['category_id'];
        $async_record_id = $recordData[0]['async_record_id'];

        $row = $this->queries->readAsyncRowForReprocess($async_record_id)[0]['original_row'];
        $brandId = $recordData[0]['brand_id'];
        $batchId = $recordData[0]['batch_id'];
        

        $row = json_decode($row);
        $rowAsArray = (array)$row;
    
        $brandData = $this->getBrandDetailsWithDemplateById($brandId);
        $brandTemplate = $brandData['template_details'];



        $mailPosition = $brandData['brand_details'][0]['email_position_in_template'];
        $countryPosition = $brandData['brand_details'][0]['county_position_in_template'];
        $creationDatePosition = $brandData['brand_details'][0]['creation_date_in_position'];
        $phonePoition  = $brandData['brand_details'][0]['telephone_position_in_template'];
        $brandTags = $brandData['brand_details'][0]['brand_tag'];
        $commercialCat = $brandData['brand_details'][0]['commercial_category'];
        $eduCat = $brandData['brand_details'][0]['edu_category'];
        $homeCat = $brandData['brand_details'][0]['home_category'];

        $countryId = $this->queries->loadCountryIdByNameOrIso($rowAsArray[$countryPosition]);


        //processing creation date in php native date format
        $creationDataInNativeDate = new DateTime($rowAsArray[$creationDatePosition]);
        $creationDataInNativeDate = $creationDataInNativeDate->format('Y-m-d');
        
        /**
         * check email is duplicate or not
         */
        $this->load->model('queries');
        
        
        $apiResponse = array();
        do{
            //TO-DO
            //$apiResponse = $this->validateEmailFormClearOutApi($rowAsArray[$mailPosition]);
            $apiResponse = $this->mockup();
            if(sizeOf($apiResponse) > 0 && $apiResponse['status'] != 'failed'){
                if( $apiResponse['data']['status'] == "valid"){
                    $this->canAttemptForMail = false;
                }
            }

            $logData = array(
                "record_id" => "N/A",
                "event_type" => "Clear Out Email API Call",
                "request_payload" => $rowAsArray[$mailPosition],
                "response_payload" => json_encode($apiResponse),
                "timestamp" => date("Y-m-d h:i:s")
            );
            $this->queries->addLogs($logData);


            $this->emailRetry++;
        }while( $this->emailRetry++ < 3 && $this->canAttemptForMail);

        if(sizeOf($apiResponse) > 0){
            
            if($apiResponse['status'] != 'failed'){
                if($apiResponse['data']['status'] == 'valid'){                    
                    if($this->isBusinessEmail($apiResponse,$rowAsArray)){
                        $this->totalBusiness++;
                        
                        /*
                        **save record as business category
                        */
                        $recordData = array(
                            "category_id" => BUSINESS_CATEGORY
                        );

                        if($this->queries->updateRecord($recordData,$recordId) > 0){
                            $this->recordProcessed++;
                            $category = BUSINESS_CATEGORY;

                            $logData = array(
                                "record_id" => $recordId,
                                "event_type" => "Business category",
                                "request_payload" => json_encode($recordData),
                                "response_payload" => 'Preserved as Business Category',
                                "timestamp" => date("Y-m-d h:i:s")
                            );
                            $this->queries->addLogs($logData);


                            //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                        }




                        //now checking for safe status

                        if($apiResponse['data']['safe_to_send'] == 'yes'){
                            
                            /**
                             * TO-Do Send to Zapier Business Send Campaign (add tags), send using webhooks
                             */

                            $url = $this->session->userData("HOOK_TYPE_BUSINESS")['url'];
                                // add your Zapier webhook url 

                            $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                            $headers = array('Accept: application/json', 'Content-Type: application/json');
                            // call the zapier() function
                            $json = (array)($json);
                            $json = (array) json_decode($json[0]);
                            $json = array_merge($json, array("category" => "BUSINESS"));
                            $json = json_encode($json);
                            $webHookResponse = $this->zapierWebHook($url, $json, $headers);
                            sleep($this->session->userData("HOOK_TYPE_BUSINESS")['timeOut']);


                            $logData = array(
                                "record_id" => 'N/A',
                                "event_type" => "Zapier Business Send Campaign webhook",
                                "request_payload" => $json,
                                "response_payload" => json_encode($webHookResponse),
                                "timestamp" => date("Y-m-d h:i:s")
                            );
                            $this->queries->addLogs($logData);

                            /*
                            **  validating phone number
                            */
                            //TO-DO
                            //$phoneApiResponse = $this->validatePhoneFormClearOutApi($sheetData[$i][$phonePoition]);
                            //$phoneApiResponse =$this->phoneMockUp();


                            $phoneApiResponse = array();
                            do{
                                //$phoneApiResponse = $this->validatePhoneFormClearOutApi($rowAsArray[$phonePoition]);
                                $phoneApiResponse =$this->phoneMockUp();
                                if(sizeOf($phoneApiResponse) > 0 && $phoneApiResponse['status'] != 'failed'){
                                    if($phoneApiResponse['data']['status'] == "valid"){
                                        $this->canAttemptForPhone = false;
                                    }
                                }

                                $logData = array(
                                    "record_id" => 'N/A',
                                    "event_type" => "Clear out phone API call",
                                    "request_payload" => $rowAsArray[$phonePoition],
                                    "response_payload" => json_encode($phoneApiResponse),
                                    "timestamp" => date("Y-m-d h:i:s")
                                );
                                $this->queries->addLogs($logData);

                                $this->phoneRetry++;
                            }while( $this->phoneRetry++ < 3 && $this->canAttemptForPhone);
                            
                            if(sizeOf($phoneApiResponse) > 0){
                                if($phoneApiResponse['status'] != 'failed'){
                                    if($phoneApiResponse['data']['status'] == 'valid'){
                                        /**
                                         * phone number validated
                                         * TO-DO
                                         * Add Call Followup Task in Agile
                                         */
        
        
        
                                    }else{
                                        /**
                                         * invalid phone number
                                         * Add Research task: Find telephone and complete CRM data
                                         */
                                        $researchData = array(
                                            "record_id" => $recordId,
                                            "comment" => "Find telephone and complete CRM data"
                                        );
                
                                        $this->queries->addResearchData($researchData);

                                        $logData = array(
                                            "record_id" => $recordId,
                                            "event_type" => "Invalid phone number",
                                            "request_payload" => $rowAsArray[$phonePoition],
                                            "response_payload" => json_encode($phoneApiResponse),
                                            "timestamp" => date("Y-m-d h:i:s")
                                        );
                                        $this->queries->addLogs($logData);
                                    }
                                }else{
                                    /**
                                     * preserving row as PHONE API Error
                                     */
                                    
                                    echo json_encode(["isSuccess"=> false,"categoryCode"=> PHONE_API_RESPONSE_ERROR]);

                                    $this->phoneApiError++;
                                    $recordData = array(
                                        "category_id" => PHONE_API_RESPONSE_ERROR
                                    );
                                    if($this->queries->updateRecord($recordData,$recordId) > 0){
                                        $this->recordProcessed++;
                                        $category = PHONE_API_RESPONSE_ERROR;

                                        $logData = array(
                                            "record_id" => $recordId,
                                            "event_type" => "Clear out phone Error",
                                            "request_payload" => $rowAsArray[$phonePoition],
                                            "response_payload" => json_encode($phoneApiResponse),
                                            "timestamp" => date("Y-m-d h:i:s")
                                        );
                                        $this->queries->addLogs($logData);
                                        //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                                    }
                                }
                            }else{
                                /**
                                 * preserving row as PHONE API Error
                                 */
                                $this->phoneApiError++;
                                
                                // echo json_encode(["isSuccess"=> false,"categoryCode"=> PHONE_API_RESPONSE_ERROR]);


                                $recordData = array(
                                    "category_id" => PHONE_API_RESPONSE_ERROR
                                );
                                if($this->queries->updateRecord($recordData,$recordId) > 0){
                                    $this->recordProcessed++;
                                    $category = PHONE_API_RESPONSE_ERROR;

                                    $logData = array(
                                        "record_id" => $recordId,
                                        "event_type" => "Clear out phone Error",
                                        "request_payload" => $rowAsArray[$phonePoition],
                                        "response_payload" => json_encode($phoneApiResponse),
                                        "timestamp" => date("Y-m-d h:i:s")
                                    );
                                    $this->queries->addLogs($logData);
                                    //echo json_encode(["isSuccess"=> true,"categoryCode"=> PHONE_API_RESPONSE_ERROR]);
                                }
                            }


                        }else{
                            /**
                             * mail is not safe to send adding research task for this record
                             */ 
                            $researchData = array(
                                "record_id" => $recordId,
                                "comment" => "Find telephone and complete CRM data"
                            );

                            $logData = array(
                                "record_id" => $recordId,
                                "event_type" => "Unsafe mail",
                                "request_payload" => $rowAsArray[$mailPosition],
                                "response_payload" => json_encode($apiResponse),
                                "timestamp" => date("Y-m-d h:i:s")
                            );
                            $this->queries->addLogs($logData);
                            $this->queries->addResearchData($researchData);

                        }

                        //echo json_encode(["isSuccess"=> true,"categoryCode"=> BUSINESS_CATEGORY]);
                        
                        
                    }else{
                        /**
                         * not a business mail then flow comes here
                         */
                        if($apiResponse['data']['safe_to_send'] == 'yes'){
                            
                            /**
                             * mail is safe now validating edu category
                             */
                            if($this->isEdu($rowAsArray)){
                                //edu category found
                                $this->totalEdu++;

                                /**
                                 * preserving row as edu
                                 */

                                
                            

                                $recordData = array(
                                    "category_id" => EDU_DOMAIN
                                );
                                if($this->queries->updateRecord($recordData,$recordId) > 0){
                                    $this->recordProcessed++;
                                    $category = EDU_DOMAIN;
                                    $logData = array(
                                        "record_id" => $recordId,
                                        "event_type" => "Edu Category",
                                        "request_payload" => json_encode($recordData),
                                        "response_payload" => "Preserved as Edu category",
                                        "timestamp" => date("Y-m-d h:i:s")
                                    );
                                    $this->queries->addLogs($logData);
                                    //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                                }


                                if($apiResponse['data']['free'] == "yes" && $this->isFreeMail($rowAsArray[$mailPosition])){

                                    $this->totalFreeMails++;
                                    /**
                                     * TO-DO
                                     * Send to Zapier EDU Send Campaign (add tags), connect with webhooks
                                     */                                        
                                    $url = $this->session->userData("HOOK_TYPE_EDU")['url'];
                                    // add your Zapier webhook url 
                                    $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                                    $headers = array('Accept: application/json', 'Content-Type: application/json');
                                    // call the zapier() function
                                    $json = (array)($json);
                                    $json = (array) json_decode($json[0]);
                                    $json = array_merge($json, array("category" => "EDU"));
                                    $json = json_encode($json);
                                    $webHookResponse = $this->zapierWebHook($url, $json, $headers);
                                    sleep($this->session->userData("HOOK_TYPE_EDU")['timeOut']);
                                    
                                    $logData = array(
                                        "record_id" => $recordId,
                                        "event_type" => "Zapier EDU Send Campaign webhook",
                                        "request_payload" => $json,
                                        "response_payload" => $webHookResponse,
                                        "timestamp" => date("Y-m-d h:i:s")
                                    );
                                    $this->queries->addLogs($logData);

                                }else{

                                    /**
                                     * TO-DO 
                                     * Send to Zapier EDU free email Send Campaign (add tags), connect with webhooks
                                     */
                                    $url = $this->session->userData("HOOK_TYPE_EDU_FREE_MAIL")['url'];
                                    // add your Zapier webhook url 
                                    $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                                    $headers = array('Accept: application/json', 'Content-Type: application/json');
                                    // call the zapier() function
                                    $json = (array)($json);
                                    $json = (array) json_decode($json[0]);
                                    $json = array_merge($json, array("category" => "EDU FREE MAIL"));
                                    $json = json_encode($json);
                                    $webHookResponse = $this->zapierWebHook($url, $json, $headers);
                                    sleep($this->session->userData("HOOK_TYPE_EDU_FREE_MAIL")['timeOut']);

                                    $logData = array(
                                        "record_id" => $recordId,
                                        "event_type" => "Zapier EDU free email Send Campaign webhook",
                                        "request_payload" => $json,
                                        "response_payload" => $webHookResponse,
                                        "timestamp" => date("Y-m-d h:i:s")
                                    );
                                    $this->queries->addLogs($logData);
                                }
                                //echo json_encode(["isSuccess"=> true,"categoryCode"=> EDU_CATEGORY]);

                            }else{
                                /**
                                 * To-DO
                                 * Send to Zapier HOME Send Campaign (add tags), send using webhooks
                                 */

                                $url = $this->session->userData("HOOK_TYPE_HOME")['url'];
                                // add your Zapier webhook url 
                                $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                                $headers = array('Accept: application/json', 'Content-Type: application/json');
                                // call the zapier() function
                                $json = (array)($json);
                                $json = (array) json_decode($json[0]);
                                $json = array_merge($json, array("category" => "HOME"));
                                $json = json_encode($json);
                                $webHookResponse = $this->zapierWebHook($url, $json, $headers);
                                sleep($this->session->userData("HOOK_TYPE_HOME")['timeOut']);

                                $logData = array(
                                    "record_id" => $recordId,
                                    "event_type" => "Zapier HOME Send Campaign webhook",
                                    "request_payload" => $json,
                                    "response_payload" => $webHookResponse,
                                    "timestamp" => date("Y-m-d h:i:s")
                                );
                                $this->queries->addLogs($logData);


                                if($this->isCommercialBusiness($rowAsArray)){
                                    $this->totalCommercial++;
                                    /**
                                     * preserving row as probable business category
                                     */
                                    

                                    $recordData = array(
                                        "category_id" => PROBABLE_BUSINESS
                                    );
                                    if($this->queries->updateRecord($recordData,$recordId) > 0){
                                        $this->recordProcessed++;
                                        $category = PROBABLE_BUSINESS;
                                        $logData = array(
                                            "record_id" => $recordId,
                                            "event_type" => "PROBABLE BUSINESS",
                                            "request_payload" => $recordData,
                                            "response_payload" => "Preserved as probable business",
                                            "timestamp" => date("Y-m-d h:i:s")
                                        );
                                        $this->queries->addLogs($logData);
                                        //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                                    }

                                    /**
                                     * adding research task
                                     */
                                    $researchData = array(
                                        "record_id" => $recordId,
                                        "comment" => "Probable business research task"
                                    );
            
                                    $this->queries->addResearchData($researchData);
                                    //echo json_encode(["isSuccess"=> true,"categoryCode"=> PROBABLE_BUSINESS]);


                                }else{
                                    $this->totalHome++;
                                    /**
                                     * preserving row as home  category
                                     */

                                
                                                    
                                    $recordData = array(
                                        "category_id" => HOME_CATEGORY
                                    );
                                    if($this->queries->updateRecord($recordData,$recordId) > 0){
                                        $this->recordProcessed++;
                                        $category = HOME_CATEGORY;

                                        $logData = array(
                                            "record_id" => $recordId,
                                            "event_type" => "Home Category",
                                            "request_payload" => $recordData,
                                            "response_payload" => "Preserved as home category",
                                            "timestamp" => date("Y-m-d h:i:s")
                                        );
                                        $this->queries->addLogs($logData);
                                        //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                                    }
                                }
                            }


                        }else{
                            $this->totalDiscared++;
                            /**
                             * not safe to send, preserving row as discarded
                             */
                    


                            $recordData = array(
                                "category_id" => DISCARDED_CATEGORY
                            );
                            if($this->queries->updateRecord($recordData,$recordId) > 0){
                                $this->recordProcessed++;
                                $category = DISCARDED_CATEGORY;

                                $logData = array(
                                    "record_id" => $recordId,
                                    "event_type" => "Discarded Category",
                                    "request_payload" => $recordData,
                                    "response_payload" => "Preserved as discarded category",
                                    "timestamp" => date("Y-m-d h:i:s")
                                );
                                $this->queries->addLogs($logData);
                                //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                            } 
                            //echo json_encode(["isSuccess"=> true,"categoryCode"=> DISCARDED_CATEGORY]);

                        }                   

                    }
                }else{
                    if($apiResponse['data']['status'] == 'failed'){
                        /*
                        **save record as EMAIL API RESPONSE ERROR category
                        */
                        $this->emailApiError++;

                

                        $recordData = array(
                            "category_id" => EMAIL_API_RESPONSE_ERROR
                        );
                        if($this->queries->updateRecord($recordData,$recordId) > 0){
                            $this->recordProcessed++;
                            $category = EMAIL_API_RESPONSE_ERROR;

                            $logData = array(
                                "record_id" => $recordId,
                                "event_type" => "Clear out mail API error",
                                "request_payload" => $recordData,
                                "response_payload" => json_encode($apiResponse),
                                "timestamp" => date("Y-m-d h:i:s")
                            );
                            $this->queries->addLogs($logData);
                            //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                        }
                        //echo json_encode(["isSuccess"=> false,"categoryCode"=> EMAIL_API_RESPONSE_ERROR]);

                    }else{
                        /*
                        **invalid email address format found
                        **save record as discard category
                        */
                        $this->totalDiscared++;
                        

                    
                
                        
                        $recordData = array(
                            "category_id" => DISCARDED_CATEGORY
                        );
                        if($this->queries->updateRecord($recordData,$recordId) > 0){
                            $this->recordProcessed++;
                            $category = DISCARDED_CATEGORY;


                            $logData = array(
                                "record_id" => $recordId,
                                "event_type" => "Discarded category",
                                "request_payload" => $recordData,
                                "response_payload" => 'Preserved as discarded category',
                                "timestamp" => date("Y-m-d h:i:s")
                            );
                            $this->queries->addLogs($logData);
                            //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                        }

                        // echo json_encode(["isSuccess"=> true,"categoryCode"=> DISCARDED_CATEGORY]);

                    }
                    
                }
            }else{
                /*
                **save record as EMAIL API RESPONSE ERROR category
                */
                $this->emailApiError++;

        
            

                $recordData = array(
                    "category_id" => EMAIL_API_RESPONSE_ERROR
                );
                if($this->queries->updateRecord($recordData,$recordId) > 0){
                    $this->recordProcessed++;
                    $category = EMAIL_API_RESPONSE_ERROR;

                    $logData = array(
                        "record_id" => $recordId,
                        "event_type" => "CLear out mail API error",
                        "request_payload" => $recordData,
                        "response_payload" => json_encode($apiResponse),
                        "timestamp" => date("Y-m-d h:i:s")
                    );
                    $this->queries->addLogs($logData);
                    //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
                }

                //echo json_encode(["isSuccess"=> false,"categoryCode"=> EMAIL_API_RESPONSE_ERROR]);

            }
        }else{
            /*
            **save record as EMAIL API RESPONSE ERROR category
            */
            $this->emailApiError++;

        
        
            $recordData = array(
                "category_id" => EMAIL_API_RESPONSE_ERROR
            );
            if($this->queries->updateRecord($recordData,$recordId) > 0){
                $this->recordProcessed++;
                $category = EMAIL_API_RESPONSE_ERROR;

                $logData = array(
                    "record_id" => $recordId,
                    "event_type" => "Clear out mail API error",
                    "request_payload" => $recordData,
                    "response_payload" => json_decode($apiResponse),
                    "timestamp" => date("Y-m-d h:i:s")
                );
                $this->queries->addLogs($logData);
                //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
            }

            //echo json_encode(["isSuccess"=> false,"categoryCode"=> EMAIL_API_RESPONSE_ERROR]);

        }
        

        $this->updateCategoryCount($batchId,$currentCategory,$category);
    }

    public function updateCategoryCount($batchId,$currentCategory,$category){
        $this->load->model('queries');
        $batchData = $this->queries->getImportById($batchId);

        $currentCategoryValue = $batchData[0][$this->convertCategoryIdToTtext($currentCategory)];
        $categoryToApplyValue =  $batchData[0][$this->convertCategoryIdToTtext($category)];

        $categoryToApplyData = array(
            $this->convertCategoryIdToTtext($currentCategory) => $currentCategoryValue - 1,
            $this->convertCategoryIdToTtext($category) => $categoryToApplyValue + 1
        );

        $this->queries->updateBatchAfterReProcessSinngleRow($categoryToApplyData,$batchId);        

    }

    public function convertCategoryIdToTtext($categoryId){
        if( $categoryId ==  DUPLICATE_CATEGORY){
          return 'total_duplicates';
        }else if( $categoryId == PROBABLE_BUSINESS){
          return 'total_business';
        }else if( $categoryId ==  HOME_CATEGORY ){
          return 'total_home';
        }else if( $categoryId ==  EDU_CATEGORY ){
          return 'total_edu';
        }else if( $categoryId ==  BUSINESS_CATEGORY ){
          return 'total_business';
        }else if( $categoryId == DISCARDED_CATEGORY ){
          return 'total_discard';
        }else if( $categoryId == PHONE_API_RESPONSE_ERROR ){
          return 'total_phone_error';
        }else if( $categoryId ==  EMAIL_API_RESPONSE_ERROR ){
          return 'total_email_error';
        }else if( $categoryId == FREE_MAILS){
          return 'total_free_mails';
        }
    }

    public function processSingleRow($row,$brandId,$batchId,$asyncRowId){
        $this->totalRecords = 0;
        $this->totalCommercial = 0;
        $this->totalEdu = 0;
        $this->totalDuplicate = 0;
        $this->totalHome = 0;
        $this->totalDiscared = 0;
        $this->recordProcessed = 0;
        $this->totalBusiness = 0;
        $this->totalFreeMails = 0;
    
        $this->emailApiError = 0;
        $this->phoneApiError = 0;

        $this->emailRetry = 0;
        $this->phoneRetry = 0;

        $safeToSend = false;
        $freeMail = false;
        $validPhone = false;
        $zapierPayload = "";
        $quickLogData = array();
        $category = "";
        $recId = "";

        //$singleRecord = file_get_contents('php://input');
        //echo $singleRecord;
        
        //$rowAsArray = (array) json_decode($singleRecord);
        $rowAsArray = (array)$row;
        
        // $brandId = $rowAsArray['brand_id'];//$this->session->userdata('brandId');
        // $batchId = $rowAsArray['batch_id'];//$this->session->userdata('batchId');
        $brandData = $this->getBrandDetailsWithDemplateById($brandId);
        $brandTemplate = $brandData['template_details'];



        $mailPosition = $brandData['brand_details'][0]['email_position_in_template'];
        $countryPosition = $brandData['brand_details'][0]['county_position_in_template'];
        $creationDatePosition = $brandData['brand_details'][0]['creation_date_in_position'];
        $phonePoition  = $brandData['brand_details'][0]['telephone_position_in_template'];
        $brandTags = $brandData['brand_details'][0]['brand_tag'];
        $commercialCat = $brandData['brand_details'][0]['commercial_category'];
        $eduCat = $brandData['brand_details'][0]['edu_category'];
        $homeCat = $brandData['brand_details'][0]['home_category'];

        $countryId = $this->queries->loadCountryIdByNameOrIso($rowAsArray[$countryPosition]);


        //processing creation date in php native date format
        $creationDataInNativeDate = new DateTime($rowAsArray[$creationDatePosition]);
        $creationDataInNativeDate = $creationDataInNativeDate->format('Y-m-d');
        
        /**
         * check email is duplicate or not
         */
        $this->load->model('queries');
        if($this->queries->isDuplicateMailForBrand($brandId, $rowAsArray[$mailPosition])){
            $this->totalDuplicate++;
            //saving row data here only as duplicate and continue to next iteration
            
            $recordData = array(
                "date" => $creationDataInNativeDate,
                "country" => $countryId > 0 ? $countryId : 0, //0 means unknown country
                "email" => $rowAsArray[$mailPosition],
                "telephone" => $rowAsArray[$phonePoition] == "" ? "N/A" : $rowAsArray[$phonePoition],
                "category_id" => DUPLICATE_CATEGORY,
                "brand_id"=> $brandId,
                "batch_id"=> $batchId,
                "original_row"=> $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat),
                "async_record_id"=>$asyncRowId
            );

            $record_id = $this->queries->saveRecord($recordData);
            if($record_id > 0){
                $this->recordProcessed++;
                $logData = array(
                    "record_id" => $record_id,
                    "event_type" => "Duplicate Category",
                    "request_payload" => json_encode($recordData),
                    "response_payload" => "saved as duplicate category",
                    "timestamp" => date("Y-m-d h:i:s")
                );
                $this->queries->addLogs($logData);
                //echo json_encode(["isSuccess"=> true,"categoryCode"=> DUPLICATE_CATEGORY]);
            }

            $safeToSend = "N/A";
            $freeMail = "N/A";
            $validPhone = "N/A";
            $zapierPayload = "N/A";
            $category = DUPLICATE_CATEGORY;

            $quickLogData = array(
                "record_id" => $record_id,
                "safe_to_send" => $safeToSend,
                "free_mail" => $freeMail,
                "valid_phone" => $validPhone,
                "zapier_payload" => $zapierPayload,
                "category" => $category
            );

            $this->queries->quickLog($quickLogData);
        }
        else{
            $apiResponse = array();
            do{
                //TO-DO
                //$apiResponse = $this->validateEmailFormClearOutApi($rowAsArray[$mailPosition]);
                $apiResponse = $this->mockup();
                if(sizeOf($apiResponse) > 0 && $apiResponse['status'] != 'failed'){
                    if( $apiResponse['data']['status'] == "valid"){
                        $this->canAttemptForMail = false;
                    }
                }

                $logData = array(
                    "record_id" => "N/A",
                    "event_type" => "Clear Out Email API Call",
                    "request_payload" => $rowAsArray[$mailPosition],
                    "response_payload" => json_encode($apiResponse),
                    "timestamp" => date("Y-m-d h:i:s")
                );
                $this->queries->addLogs($logData);

                $this->emailRetry++;
            }while( $this->emailRetry++ < 3 && $this->canAttemptForMail);

            if(sizeOf($apiResponse) > 0){
                
                if($apiResponse['status'] != 'failed'){
                    if($apiResponse['data']['status'] == 'valid'){  

                        if($this->isBusinessEmail($apiResponse,$rowAsArray)){
                            $this->totalBusiness++;
                            
                            /*
                            **save record as business category
                            */
                            $recordData = array(
                                "date" => $creationDataInNativeDate,
                                "country" => $countryId > 0 ? $countryId : 0, //0 means unknown country
                                "email" => $rowAsArray[$mailPosition],
                                "telephone" => $rowAsArray[$phonePoition] == "" ? "N/A" : $rowAsArray[$phonePoition],
                                "category_id" => BUSINESS_CATEGORY,
                                "brand_id"=> $brandId,
                                "batch_id"=> $batchId,
                                "original_row"=> $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat),
                                "async_record_id"=>$asyncRowId
                            );
                            $recordId = $this->queries->saveRecord($recordData);
                            if( $recordId > 0){
                                $this->recordProcessed++;

                                $logData = array(
                                    "record_id" => $recordId,
                                    "event_type" => "Business Category",
                                    "request_payload" => json_encode($recordData),
                                    "response_payload" => "Preserved as Business Category",
                                    "timestamp" => date("Y-m-d h:i:s")
                                );
                                $this->queries->addLogs($logData);
                            }
    
    
    
    
                            //now checking for safe status
    
                            if($apiResponse['data']['safe_to_send'] == 'yes'){
                                
                                /**
                                 * TO-Do Send to Zapier Business Send Campaign (add tags), send using webhooks
                                 */
    
                                $url = $this->session->userData("HOOK_TYPE_BUSINESS")['url'];
                                 // add your Zapier webhook url 

                                $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                                $headers = array('Accept: application/json', 'Content-Type: application/json');
                                // call the zapier() function
                                $json = (array)($json);
                                $json = (array) json_decode($json[0]);
                                $json = array_merge($json, array("category" => "BUSINESS"));
                                $json = json_encode($json);
                                $webHookResponse = $this->zapierWebHook($url, $json, $headers);
                                sleep($this->session->userData("HOOK_TYPE_BUSINESS")['timeOut']);
    

                                $logData = array(
                                    "record_id" => "N/A",
                                    "event_type" => "Zapier Business Send Campaign webhook",
                                    "request_payload" => $json,
                                    "response_payload" => json_encode($webHookResponse),
                                    "timestamp" => date("Y-m-d h:i:s")
                                );
                                $this->queries->addLogs($logData);
    
                                /*
                                **  validating phone number
                                */
                                //TO-DO
                                //$phoneApiResponse = $this->validatePhoneFormClearOutApi($sheetData[$i][$phonePoition]);
                                //$phoneApiResponse =$this->phoneMockUp();
    
    
                                $phoneApiResponse = array();
                                do{
                                    //$phoneApiResponse = $this->validatePhoneFormClearOutApi($rowAsArray[$phonePoition]);
                                    $phoneApiResponse =$this->phoneMockUp();
                                    if(sizeOf($phoneApiResponse) > 0 && $phoneApiResponse['status'] != 'failed'){
                                        if($phoneApiResponse['data']['status'] == "valid"){
                                            $this->canAttemptForPhone = false;
                                        }
                                    }
                                    $this->phoneRetry++;
                                }while( $this->phoneRetry++ < 3 && $this->canAttemptForPhone);
                                
                                if(sizeOf($phoneApiResponse) > 0){
                                    
                                    if($phoneApiResponse['status'] != 'failed'){
                                        if($phoneApiResponse['data']['status'] == 'valid'){
                                            /**
                                             * phone number validated
                                             * TO-DO
                                             * Add Call Followup Task in Agile
                                             */
                                            $logData = array(
                                                "record_id" => "N/A",
                                                "event_type" => "Clear out phone API call",
                                                "request_payload" => $rowAsArray[$phonePoition],
                                                "response_payload" => json_encode($phoneApiResponse),
                                                "timestamp" => date("Y-m-d h:i:s")
                                            );
                                            $this->queries->addLogs($logData);
                                            $validPhone = true;
            
                                        }else{
                                            /**
                                             * invalid phone number
                                             * Add Research task: Find telephone and complete CRM data
                                             */
                                            $researchData = array(
                                                "record_id" => $recordId,
                                                "comment" => "Find telephone and complete CRM data"
                                            );
                                            $validPhone = false;
                                            $logData = array(
                                                "record_id" => $recordId,
                                                "event_type" => "Invalid phone number",
                                                "request_payload" => $rowAsArray[$phonePoition],
                                                "response_payload" => json_encode($phoneApiResponse),
                                                "timestamp" => date("Y-m-d h:i:s")
                                            );
                                            $this->queries->addLogs($logData);
                    
                                            $this->queries->addResearchData($researchData);
                                        }
                                    }else{
                                        /**
                                         * preserving row as PHONE API Error
                                         */
                                        
                                        //echo json_encode(["isSuccess"=> false,"categoryCode"=> PHONE_API_RESPONSE_ERROR]);
                                        $validPhone = false;
                                        $this->phoneApiError++;
                                        $recordData = array(
                                            "date" => $creationDataInNativeDate,
                                            "country" => $countryId > 0 ? $countryId : 0, //0 means unknown country
                                            "email" =>  $rowAsArray[$mailPosition],
                                            "telephone" => $rowAsArray[$phonePoition] == "" ? "N/A" : $rowAsArray[$phonePoition],
                                            "category_id" => PHONE_API_RESPONSE_ERROR,
                                            "brand_id"=> $brandId,
                                            "batch_id"=> $batchId,
                                            "original_row"=> $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat),
                                            "async_record_id"=>$asyncRowId
                                        );
                                        $recordId = $this->queries->saveRecord($recordData);
                                        if($recordId > 0){
                                            $this->recordProcessed++;
                                            $recId = $recordId;
                                            $category = PHONE_API_RESPONSE_ERROR;
                                            $logData = array(
                                                "record_id" => $recordId,
                                                "event_type" => "Clear Phone API Error",
                                                "request_payload" => $rowAsArray[$phonePoition],
                                                "response_payload" => json_encode($phoneApiResponse),
                                                "timestamp" => date("Y-m-d h:i:s")
                                            );
                                            $this->queries->addLogs($logData);
                                        }
                                    }


                                }else{
                                    /**
                                     * preserving row as PHONE API Error
                                     */
                                    $this->phoneApiError++;
                                    $validPhone = false;
                                   // echo json_encode(["isSuccess"=> false,"categoryCode"=> PHONE_API_RESPONSE_ERROR]);


                                    $recordData = array(
                                        "date" => $creationDataInNativeDate,
                                        "country" => $countryId > 0 ? $countryId : 0, //0 means unknown country
                                        "email" => $rowAsArray[$mailPosition],
                                        "telephone" => $rowAsArray[$phonePoition] == "" ? "N/A" : $rowAsArray[$phonePoition],
                                        "category_id" => PHONE_API_RESPONSE_ERROR,
                                        "brand_id"=> $brandId,
                                        "batch_id"=> $batchId,
                                        "original_row"=> $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat),
                                        "async_record_id"=>$asyncRowId
                                    );
                                    $recordId = $this->queries->saveRecord($recordData);
                                    if( $recordId > 0){
                                        $this->recordProcessed++;
                                        $recId = $recordId;
                                        $category = PHONE_API_RESPONSE_ERROR;
                                        $logData = array(
                                            "record_id" => $recordId,
                                            "event_type" => "Clear Phone API Error",
                                            "request_payload" => $rowAsArray[$phonePoition],
                                            "response_payload" => json_encode($phoneApiResponse),
                                            "timestamp" => date("Y-m-d h:i:s")
                                        );
                                        $this->queries->addLogs($logData);
                                    }
                                }
    
    
                            }else{
                                /**
                                 * mail is not safe to send adding research task for this record
                                 */ 
                                $researchData = array(
                                    "record_id" => $recordId,
                                    "comment" => "Find telephone and complete CRM data"
                                );

                                $safeToSend = false;
    
                                $this->queries->addResearchData($researchData);
    
                            }
    
                            //echo json_encode(["isSuccess"=> true,"categoryCode"=> BUSINESS_CATEGORY]);

                            $quickLogData = array(
                                "record_id" => $recId,
                                "safe_to_send" => $safeToSend,
                                "free_mail" => $freeMail,
                                "valid_phone" => $validPhone,
                                "zapier_payload" => $zapierPayload,
                                "category" => $category
                            );

                            $this->queries->quickLog($quickLogData);
    


                            
                        }else{
                            /**
                             * not a business mail then flow comes here
                             */
                            if($apiResponse['data']['safe_to_send'] == 'yes'){
                                
                                $safeToSend = true;
                                /**
                                 * mail is safe now validating edu category
                                 */
                                if($this->isEdu($rowAsArray)){
                                    //edu category found
                                    $this->totalEdu++;
    
                                    /**
                                     * preserving row as edu
                                     */

                                  


                                    $recordData = array(
                                        "date" => $creationDataInNativeDate,
                                        "country" => $countryId > 0 ? $countryId : 0, //0 means unknown country
                                        "email" => $rowAsArray[$mailPosition],
                                        "telephone" => $rowAsArray[$phonePoition] == "" ? "N/A" : $rowAsArray[$phonePoition],
                                        "category_id" => EDU_CATEGORY,
                                        "brand_id"=> $brandId,
                                        "batch_id"=> $batchId,
                                        "original_row"=> $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat),
                                        "async_record_id"=>$asyncRowId
                                    );
    
                                    $recordId = $this->queries->saveRecord($recordData);
                                    if($recordId > 0){
                                        $this->recordProcessed++;
                                        $recId = $recordId;
                                        $logData = array(
                                            "record_id" => $recordId,
                                            "event_type" => "EDU Category",
                                            "request_payload" => json_encode($recordData),
                                            "response_payload" => "Preserving as EDU Category",
                                            "timestamp" => date("Y-m-d h:i:s")
                                        );
                                        $this->queries->addLogs($logData);
                                    }
    
    
                                    if($apiResponse['data']['free'] == "yes" && $this->isFreeMail($rowAsArray[$mailPosition])){
                                        $freeMail = true;
                                        $this->totalFreeMails++;
                                        /**
                                         * TO-DO
                                         * Send to Zapier EDU Send Campaign (add tags), connect with webhooks
                                         */                                        
                                        $url = $this->session->userData("HOOK_TYPE_EDU")['url'];
                                        // add your Zapier webhook url 
                                        $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                                        $headers = array('Accept: application/json', 'Content-Type: application/json');
                                        // call the zapier() function
                                        $json = (array)($json);
                                        $json = (array) json_decode($json[0]);
                                        $json = array_merge($json, array("category" => "EDU"));
                                        $json = json_encode($json);
                                        $webHookResponse = $this->zapierWebHook($url, $json, $headers);
                                        sleep($this->session->userData("HOOK_TYPE_EDU")['timeOut']);
                                        $zapierPayload = json_encode($webHookResponse);
                                        $logData = array(
                                            "record_id" => $recordId,
                                            "event_type" => "Zapier EDU Send Campaign Webhook",
                                            "request_payload" => $json,
                                            "response_payload" => json_encode($webHookResponse),
                                            "timestamp" => date("Y-m-d h:i:s")
                                        );
                                        $this->queries->addLogs($logData);
    
                                    }else{
    
                                        /**
                                         * TO-DO 
                                         * Send to Zapier EDU free email Send Campaign (add tags), connect with webhooks
                                         */
                                        $url = $this->session->userData("HOOK_TYPE_EDU_FREE_MAIL")['url'];
                                        // add your Zapier webhook url 
                                        $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                                        $headers = array('Accept: application/json', 'Content-Type: application/json');
                                        // call the zapier() function
                                        $json = (array)($json);
                                        $json = (array) json_decode($json[0]);
                                        $json = array_merge($json, array("category" => "EDU FREE MAIL"));
                                        $json = json_encode($json);
                                        $webHookResponse = $this->zapierWebHook($url, $json, $headers);
                                        $zapierPayload = json_encode($webHookResponse);
                                        sleep($this->session->userData("HOOK_TYPE_EDU_FREE_MAIL")['timeOut']);
    
                                        $logData = array(
                                            "record_id" => $recordId,
                                            "event_type" => "Zapier EDU free email Send Campaign Webhook",
                                            "request_payload" => $json,
                                            "response_payload" => json_encode($webHookResponse),
                                            "timestamp" => date("Y-m-d h:i:s")
                                        );
                                        $this->queries->addLogs($logData);
                                    }
                                    //echo json_encode(["isSuccess"=> true,"categoryCode"=> EDU_CATEGORY]);



                                }else{
                                    /**
                                     * To-DO
                                     * Send to Zapier HOME Send Campaign (add tags), send using webhooks
                                     */

                                    $url = $this->session->userData("HOOK_TYPE_HOME")['url'];
                                    // add your Zapier webhook url 
                                    $json = $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat);
                                    $headers = array('Accept: application/json', 'Content-Type: application/json');
                                    // call the zapier() function
                                    $json = (array)($json);
                                    $json = (array) json_decode($json[0]);
                                    $json = array_merge($json, array("category" => "HOME"));
                                    $json = json_encode($json);
                                    $webHookResponse = $this->zapierWebHook($url, $json, $headers);
                                    sleep($this->session->userData("HOOK_TYPE_HOME")['timeOut']);

                                    $logData = array(
                                        "record_id" => 'N/A',
                                        "event_type" => "Zapier HOME Send Campaign Webhook",
                                        "request_payload" => $json,
                                        "response_payload" => json_encode($webHookResponse),
                                        "timestamp" => date("Y-m-d h:i:s")
                                    );
                                    $this->queries->addLogs($logData);
    
                                    if($this->isCommercialBusiness($rowAsArray)){
                                        $this->totalCommercial++;
                                        /**
                                         * preserving row as probable business category
                                         */

                                

                                        $recordData = array(
                                            "date" => $creationDataInNativeDate,
                                            "country" => $countryId > 0 ? $countryId : 0, //0 means unknown country
                                            "email" => $rowAsArray[$mailPosition],
                                            "telephone" => $rowAsArray[$phonePoition] == "" ? "N/A" : $rowAsArray[$phonePoition],
                                            "category_id" => PROBABLE_BUSINESS,
                                            "brand_id"=> $brandId,
                                            "batch_id"=> $batchId,
                                            "original_row"=> $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat),
                                            "async_record_id"=>$asyncRowId
                                        );
            
                                        $recordId = $this->queries->saveRecord($recordData);
                                        if($recordId > 0){
                                            $this->recordProcessed++;

                                            $logData = array(
                                                "record_id" => $recordId,
                                                "event_type" => "Probable Business",
                                                "request_payload" => json_encode($recordData),
                                                "response_payload" => "Preserved as Probable Business category",
                                                "timestamp" => date("Y-m-d h:i:s")
                                            );
                                            $this->queries->addLogs($logData);
                                        }
    
                                        /**
                                         * adding research task
                                         */
                                        $researchData = array(
                                            "record_id" => $recordId,
                                            "comment" => "Probable business research task"
                                        );
                
                                        $this->queries->addResearchData($researchData);
                                        //echo json_encode(["isSuccess"=> true,"categoryCode"=> PROBABLE_BUSINESS]);

    
                                    }else{
                                        $this->totalHome++;
                                        /**
                                         * preserving row as home  category
                                         */

                                        $recordData = array(
                                            "date" => $creationDataInNativeDate,
                                            "country" => $countryId > 0 ? $countryId : 0, //0 means unknown country
                                            "email" => $rowAsArray[$mailPosition],
                                            "telephone" => $rowAsArray[$phonePoition] == "" ? "N/A" : $rowAsArray[$phonePoition],
                                            "category_id" => HOME_CATEGORY,
                                            "brand_id"=> $brandId,
                                            "batch_id"=> $batchId,
                                            "original_row"=> $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat),
                                            "async_record_id"=>$asyncRowId
                                        );
            
                                        $recordId = $this->queries->saveRecord($recordData);
                                        if( $recordId > 0){
                                            $this->recordProcessed++;

                                            $logData = array(
                                                "record_id" => $recordId,
                                                "event_type" => "Home Category",
                                                "request_payload" => json_encode($recordData),
                                                "response_payload" => "Preserved as Probable Home category",
                                                "timestamp" => date("Y-m-d h:i:s")
                                            );
                                            $this->queries->addLogs($logData);
                                        }
                                        //echo json_encode(["isSuccess"=> true,"categoryCode"=> HOME_CATEGORY]);

                                    }
                                }
    
    
                            }else{
                                $this->totalDiscared++;
                                /**
                                 * not safe to send, preserving row as discarded
                                 */
                                $recordData = array(
                                    "date" => $creationDataInNativeDate,
                                    "country" => $countryId > 0 ? $countryId : 0, //0 means unknown country
                                    "email" => $rowAsArray[$mailPosition],
                                    "telephone" => $rowAsArray[$phonePoition] == "" ? "N/A" : $rowAsArray[$phonePoition],
                                    "category_id" => DISCARDED_CATEGORY,
                                    "brand_id"=> $brandId,
                                    "batch_id"=> $batchId,
                                    "original_row"=> $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat),
                                    "async_record_id"=>$asyncRowId
                                );
                                $recordId = $this->queries->saveRecord($recordData);
                                if( $recordId > 0){
                                    $this->recordProcessed++;
                                    $recId = $recordId;
                                    $logData = array(
                                        "record_id" => $recordId,
                                        "event_type" => "Discarded Category",
                                        "request_payload" => json_encode($recordData),
                                        "response_payload" => "Preserved as Probable Discarded category",
                                        "timestamp" => date("Y-m-d h:i:s")
                                    );
                                    $this->queries->addLogs($logData);
                                }    
                                //echo json_encode(["isSuccess"=> true,"categoryCode"=> DISCARDED_CATEGORY]);
                            }      
                            

                            $validPhone = "N/A";
                            $category = DISCARDED_CATEGORY;

                            $quickLogData = array(
                                "record_id" => $recId,
                                "safe_to_send" => $safeToSend,
                                "free_mail" => $freeMail,
                                "valid_phone" => $validPhone,
                                "zapier_payload" => $zapierPayload,
                                "category" => $category
                            );

                            $this->queries->quickLog($quickLogData);
    
                        }

                    }else{
                        if($apiResponse['data']['status'] == 'failed'){
                            /*
                            **save record as EMAIL API RESPONSE ERROR category
                            */
                            $this->emailApiError++;

                            

                            $recordData = array(
                                "date" => $creationDataInNativeDate,
                                "country" => $countryId > 0 ? $countryId : 0, //0 means unknown country
                                "email" => $rowAsArray[$mailPosition],
                                "telephone" => $rowAsArray[$phonePoition] == "" ? "N/A" : $rowAsArray[$phonePoition],
                                "category_id" => EMAIL_API_RESPONSE_ERROR,
                                "brand_id"=> $brandId,
                                "batch_id"=> $batchId,
                                "original_row"=> $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat),
                                "async_record_id"=>$asyncRowId
                            );
                            $recordId = $this->queries->saveRecord($recordData);
                            if( $recordId > 0){
                                $this->recordProcessed++;
                                $logData = array(
                                    "record_id" => $recordId,
                                    "event_type" => "Clear Out Email API Call",
                                    "request_payload" => json_encode($recordData),
                                    "response_payload" => json_encode($apiResponse),
                                    "timestamp" => date("Y-m-d h:i:s")
                                );
                                $this->queries->addLogs($logData);
                            }

                            $safeToSend = "N/A";
                            $freeMail = "N/A";
                            $validPhone = "N/A";
                            $zapierPayload = "N/A";
                            $category = EMAIL_API_RESPONSE_ERROR;

                            $quickLogData = array(
                                "record_id" => $recordId,
                                "safe_to_send" => $safeToSend,
                                "free_mail" => $freeMail,
                                "valid_phone" => $validPhone,
                                "zapier_payload" => $zapierPayload,
                                "category" => $category
                            );

                            $this->queries->quickLog($quickLogData);
                            //echo json_encode(["isSuccess"=> false,"categoryCode"=> EMAIL_API_RESPONSE_ERROR]);

                        }else{
                            /*
                            **invalid email address format found
                            **save record as discard category
                            */
                            $this->totalDiscared++;

                            $recordData = array(
                                "date" => $creationDataInNativeDate,
                                "country" => $countryId > 0 ? $countryId : 0, //0 means unknown country
                                "email" => $rowAsArray[$mailPosition],
                                "telephone" => $rowAsArray[$phonePoition] == "" ? "N/A" : $rowAsArray[$phonePoition],
                                "category_id" => DISCARDED_CATEGORY,
                                "brand_id"=> $brandId,
                                "batch_id"=> $batchId,
                                "original_row"=> $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat),
                                "async_record_id"=>$asyncRowId
                            );
                            $recordId = $this->queries->saveRecord($recordData);
                            if( $recordId > 0){
                                $this->recordProcessed++;

                                $logData = array(
                                    "record_id" => $recordId,
                                    "event_type" => "Discarded Category",
                                    "request_payload" => json_encode($recordData),
                                    "response_payload" => "Preserved as Discarded Category",
                                    "timestamp" => date("Y-m-d h:i:s")
                                );
                                $this->queries->addLogs($logData);
                            }


                            $safeToSend = "N/A";
                            $freeMail = "N/A";
                            $validPhone = "N/A";
                            $zapierPayload = "N/A";
                            $category = DISCARDED_CATEGORY;

                            $quickLogData = array(
                                "record_id" => $recordId,
                                "safe_to_send" => $safeToSend,
                                "free_mail" => $freeMail,
                                "valid_phone" => $validPhone,
                                "zapier_payload" => $zapierPayload,
                                "category" => $category
                            );

                            $this->queries->quickLog($quickLogData);
                           // echo json_encode(["isSuccess"=> true,"categoryCode"=> DISCARDED_CATEGORY]);

                        }
                        
                    }
                }else{
                    /*
                    **save record as EMAIL API RESPONSE ERROR category
                    */
                    $this->emailApiError++;

                    $recordData = array(
                        "date" => $creationDataInNativeDate,
                        "country" => $countryId > 0 ? $countryId : 0, //0 means unknown country
                        "email" => $rowAsArray[$mailPosition],
                        "telephone" => $rowAsArray[$phonePoition] == "" ? "N/A" : $rowAsArray[$phonePoition],
                        "category_id" => EMAIL_API_RESPONSE_ERROR,
                        "brand_id"=> $brandId,
                        "batch_id"=> $batchId,
                        "original_row"=> $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat),
                        "async_record_id"=>$asyncRowId
                    );
                    $recordId = $this->queries->saveRecord($recordData);
                    if( $recordId > 0){
                        $this->recordProcessed++;
                        $logData = array(
                            "record_id" => $recordId,
                            "event_type" => "Clear Out Email API Call",
                            "request_payload" => json_encode($recordData),
                            "response_payload" => json_encode($apiResponse),
                            "timestamp" => date("Y-m-d h:i:s")
                        );
                        $this->queries->addLogs($logData);
                    }


                    $safeToSend = "N/A";
                    $freeMail = "N/A";
                    $validPhone = "N/A";
                    $zapierPayload = "N/A";
                    $category = EMAIL_API_RESPONSE_ERROR;

                    $quickLogData = array(
                        "record_id" => $recordId,
                        "safe_to_send" => $safeToSend,
                        "free_mail" => $freeMail,
                        "valid_phone" => $validPhone,
                        "zapier_payload" => $zapierPayload,
                        "category" => $category
                    );

                    $this->queries->quickLog($quickLogData);
                    //echo json_encode(["isSuccess"=> false,"categoryCode"=> EMAIL_API_RESPONSE_ERROR]);

                }
            }else{
                /*
                **save record as EMAIL API RESPONSE ERROR category
                */
                $this->emailApiError++;

         

                $recordData = array(
                    "date" => $creationDataInNativeDate,
                    "country" => $countryId > 0 ? $countryId : 0, //0 means unknown country
                    "email" => $rowAsArray[$mailPosition],
                    "telephone" => $rowAsArray[$phonePoition] == "" ? "N/A" : $rowAsArray[$phonePoition],
                    "category_id" => EMAIL_API_RESPONSE_ERROR,
                    "brand_id"=> $brandId,
                    "batch_id"=> $batchId,
                    "original_row"=> $this->recordData($rowAsArray,$brandTemplate,$rowAsArray[$creationDatePosition],$creationDatePosition,$countryPosition,$brandTags,$commercialCat,$eduCat,$homeCat),
                    "async_record_id"=>$asyncRowId
                );
                $recordId = $this->queries->saveRecord($recordData);
                if( $recordId > 0){
                    $this->recordProcessed++;

                    $logData = array(
                        "record_id" => $recordId,
                        "event_type" => "Clear Out Email API Call",
                        "request_payload" => json_encode($recordData),
                        "response_payload" => json_encode($apiResponse),
                        "timestamp" => date("Y-m-d h:i:s")
                    );
                    $this->queries->addLogs($logData);
                }


                $safeToSend = "N/A";
                $freeMail = "N/A";
                $validPhone = "N/A";
                $zapierPayload = "N/A";
                $category = EMAIL_API_RESPONSE_ERROR;

                $quickLogData = array(
                    "record_id" => $recordId,
                    "safe_to_send" => $safeToSend,
                    "free_mail" => $freeMail,
                    "valid_phone" => $validPhone,
                    "zapier_payload" => $zapierPayload,
                    "category" => $category
                );

                $this->queries->quickLog($quickLogData);

                //echo json_encode(["isSuccess"=> false,"categoryCode"=> EMAIL_API_RESPONSE_ERROR]);

            }
        }


        
    }


    public function sanatizeArray($sheetData){
        foreach($sheetData as $index => $data) {
            $blankCount = 0;
            foreach($sheetData[$index] as $key => $value){
                $sheetData[$index][$key] = str_replace(array("\n\r", "\n", "\r", "\""), "", $sheetData[$index][$key]);
                if($sheetData[$index][$key] == ""){
                    $blankCount++;
                }
            } 
            
            if(sizeof($sheetData[$index]) == $blankCount){
                unset($sheetData[$index]); 
                //array_splice($sheetData, $index, 1);
            }           
        }
        return $sheetData;
    }
}
?>