<?php
class Queries extends CI_Model{

    /**
     * checking admin exists or not in db
     */
    public function adminExists($username,$password){
        $chkAdmin = $this->db->where(['username' => $username, 'password' => $password])->get('admin');
        if($chkAdmin->num_rows()>0){
            return $chkAdmin->row();
        }
        return 0;
    }

    /**
     * checking staff exists or not in db
     */
    public function userExists($username,$password){
        $chkUser = $this->db->where(['username' => $username, 'password' => $password])->get('users');
        if($chkUser->num_rows()>0){
            return $chkUser->row();
        }
        return 0;
    }

    public function userSignup($userData){

        $userDataToPreserve = array(
            'username' => $userData['email'],
            'apikey' => $userData['apiKey'] ,
            'password' => md5($userData['password']),
            'name' => $userData['fullName'],
            'status' => 1,
            'roleId' => $userData['role']
        );

        $this->db->insert('users',$userDataToPreserve);
        return true;
    }

    public function checkDuplicateUserEmail($email){
        $chkDuplicateUsr = $this->db->where(['username' =>  $email])->get('users');
        if($chkDuplicateUsr->num_rows()>0){
            return true;
        }
        return false;
    }
    
    public function forcedCheckDuplicateUserEmail($email,$id){
        $sql = "select count(*) as count from users where username='".$email."' and id!=".$id.";";
        $result = $this->db->query($sql)->result_array();
        
        if( $result[0]['count'] > 0){
            return true;
        }
        return false;
    }

    function registerBrand($data){
        if($this->db->insert('brands',$data)){
            return $this->db->insert_id();
        }
        return 0;
    }

    function insertTemplateData($data){
        if($this->db->insert('brand_template',$data)){
            return true;
        }
        return false;
    }

    function updateBrand($data){
        try{
            $sql = "update brands set brand_name = '".$data['brand_name']."',brand_tag = '".$data['brand_tag'].
                    "' , first_name_position_in_template = '".$data['first_name']."', last_name_position_in_template = '".$data['last_name']."',
                    organization_position_in_template = '".$data['organization']."',
                    county_position_in_template = '".$data['country']."', email_position_in_template = '".$data['email']."',
                    telephone_position_in_template ='".$data['telephone']."', creation_date_in_position ='".$data['creationDate']."',
                    commercial_category = '".$data['commercialCategory']."', edu_category = '".$data['eduCategory']."',
                    home_category = '".$data['homeCategory']."',  template_url ='".$data['uploaded_file_name']."', file_format = '".$data['file_type']."',
                    has_sheets = '".$data['hassheets']."', added_by = '".$data['added_by']."', hide ='".$data['hide']."'  where id = '".$data['brand_id']."';";
            $this->db->query($sql);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    function hideOldTemplate($brandId){
        try{
            $sql = "update brand_template set hide ='1'  where brand_id = '".$brandId."';";
            $this->db->query($sql);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    function removeOldBatchImportsAndRecords($brandId){
        try{
            $sql = "delete from import_batch where brand_id = '".$brandId."';";
            $this->db->query($sql);

            $sql = "delete from record where brand_id = '".$brandId."';";
            $this->db->query($sql);
            return true;
        }catch(Exception $e){
            return false;
        }
    }
    
    public function getAllUserList(){
        $this->db->select("*");
                    $this->db->from('users');
        $users = $this->db->get();
        return $users->result();
    }

    public function getUserById($id){
        $this->db->select("*");
                    $this->db->from('users');
                    $this->db->where('users.id',$id);
                    
        $users = $this->db->get();
        return $users->result();
    }

    public function getKeywordById($id){
        $this->db->select("*");
                    $this->db->from('keyword');
                    $this->db->where('keyword.id',$id);
                    
        $users = $this->db->get();
        return $users->result();
    }

    public function getHookDetails($hookType){
        $this->db->select("*");
                    $this->db->from('api_service');
                    $this->db->where('api_service.hook_type',$hookType);
                    
        $users = $this->db->get();
        return $users->result();
    }

    public function updateUser($userData){
        
        $status = 0;
        if(isset($userData['status_edit'])){
            $status = 1;
        }
        $dataToUpdate = array(
            "name" => $userData['fullName_edit'],
            "username" => $userData['email_edit'],
            "roleId" => $userData['role_edit'],
            "apikey" => $userData['apiKey_edit'],
            "status" => $status
        );
        return $this->db->update('users',$dataToUpdate,array('id' => $userData['userId_edit']));
    }

    public function submitForm($data){
        
        try{
            $sql = "update api_service set name ='".$data['name']."', delay_between_posts = ".$data['timeOut'].", auth_token = '".$data['authToken']."', url = '".$data['url']."' where hook_type = ".$data['hookType'].";";
            $this->db->query($sql);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    function getAllBrands(){
        $this->db->select("*");
                    $this->db->from('brands');
        $brands = $this->db->get();
        return $brands->result();
    }

    function getAllImports(){
        $sql = "SELECT * FROM import_batch;";
        return $this->db->query($sql)->result_array(); 
    }

    function getImportById($batchId){
        $sql = "SELECT * FROM import_batch where id=".$batchId.";";
        return $this->db->query($sql)->result_array(); 
    }

    function loadDataTableForBatch($batchId){
        $sql = "SELECT * FROM record where batch_id=".$batchId.";";
        return $this->db->query($sql)->result_array();
    }

    function loadTotalBatchs(){
        $this->db->select("*");
                    $this->db->from('import_batch');
        $brands = $this->db->get();
        return $brands->result();
    }

    function getBrandById($data){
        $brandId = $data['id'];
        $sql = "SELECT * FROM brands where id in (".$brandId.");";
        return $this->db->query($sql)->result_array(); 
    }

    function getBrandTemplateById($data){
        $brandId = $data['id'];
        $sql = "SELECT * FROM brand_template where brand_id in (".$brandId.") and hide = 0;";
        return $this->db->query($sql)->result_array(); 
    }

    function getUserNameById($id){
        $sql = "SELECT * FROM users where id  = '".$id."';";
        return $this->db->query($sql)->result_array(); 
    }

    function isDuplicateMailForBrand($brandId, $email){
        $sql = "select count(*) as count from record where email='".$email."' and brand_id=".$brandId.";";
        $result = $this->db->query($sql)->result_array();
        
        if( $result[0]['count'] > 0){
            return true;
        }
        return false;
    }

    function initializeBatchData($batchData){
        if($this->db->insert('import_batch',$batchData)){
            return $this->db->insert_id();
        }
        return 0;
    }

    
    function addNewKeyword($data){
        $kaeyWordData = array(
            "category_id" => $data['category'],
            "name" => $data['keyword'],
            "status" => 1
        );

        if($this->db->insert('keyword',$kaeyWordData)){
            return $this->db->insert_id();
        }
        return 0;
    }

    function postNotification($data){
        $this->db->insert('notifications',$data);
    }

    function getAllNotifications(){
        $this->db->select("*");
                    $this->db->from('notifications');
        $notifications = $this->db->get();
        return $notifications->result();
    }

    function updateNotificationStatus($productStatus, $productId){
        $productData = array(
            "status" => $productStatus
        );
        return $this->db->update('notifications',$productData,array('id' => $productId));
    }

    function insertRowForAsyncProcess($brandId,$batchId,$row){
        $data = array(
            "brand_id" => $brandId,
            "batch_id" => $batchId,
            "original_row" => $row,
            "processed" => false
        );
        if($this->db->insert('async_record_processor_data',$data)){
            return $this->db->insert_id();
        }
        return 0;
    }

    function quickLog($quickLogData){
        if($this->db->insert('quick_record_logs',$quickLogData)){
            return $this->db->insert_id();
        }
        return 0;
    }

    function updateAsyncProcess($asyncId){
        return $this->db->update('async_record_processor_data',array('processed' => 1),array('id' => $asyncId));
    }

    function updateKeyword($data){
        $id = $data['keyword-edit-id'];
        $status = 0;
        if(isset($data['status_edit'])){
            $status = 1;
        }else{
            $status = 0;
        }

        $keywordData = array(
            "category_id" => $data['brand_edit'],
            "name" => $data['keyword_edit'],
            "status" => $status
        );
        return $this->db->update('keyword',$keywordData,array('id' => $id));   
    }

    function updateBatchAfterReProcessSinngleRow($categoryToApplyData,$batchId){
        return $this->db->update('import_batch',$categoryToApplyData,array('id' => $batchId));
    }

    function saveRecord($recordData){
        if($this->db->insert('record',$recordData)){
            return $this->db->insert_id();
        }
        return 0;
    }

    public function updateRecord($recordData,$recordId){
        return $this->db->update('record',$recordData,array('id' => $recordId));
    }
    

    function loadCountryIdByNameOrIso($country){
        $sql = "select * from country where ISO3166_1_alpha_2='".$country."' OR ISO3166_1_alpha_3='".$country."' OR country_name='".$country."';";
        $result = $this->db->query($sql)->result_array();
        return $result[0]['id']; 
    }

    function addResearchData($recordData){
        if($this->db->insert('research_task',$recordData)){
            return $this->db->insert_id();
        }
        return 0;
    }

    function updateBatchByBatchId($batchData,$batch_id){        
        return $this->db->update('import_batch',$batchData,array('id' => $batch_id));
    }

    function loadChartData(){
        $sql = "select SUM(total_commercial) as total_commercial,SUM(total_edu) as total_edu, SUM(total_business) as total_business,  SUM(total_home) as total_home from import_batch;";
        return $this->db->query($sql)->result_array();
    }

    function loadReportData(){
        $sql = "select SUM(total_commercial) as total_commercial,SUM(total_edu) as total_edu,
             SUM(total_business) as total_business,  SUM(total_home) as total_home,
             SUM(total_duplicates) as  total_duplicates, SUM(total_discard) as total_discard,
             SUM(total_free_mails) as total_free_mails        
             from import_batch;";
        return $this->db->query($sql)->result_array();
    }

    function isFreeMail($email){
        $sql = "select name from keyword where category_id ='0' ";//0 means category NONE
        $keywords = $this->db->query($sql)->result_array();
        $flag = false;


        foreach($keywords as $key){
          $subSql = "SELECT POSITION('".$key['name']."' IN '".$email."') AS count;";
          $result = $this->db->query($subSql)->result_array();
          if($result[0]['count'] > 0){
                $flag = true;
                break;
           }
        }
        return $flag;
    }

    function isHome($row){
        $sql = "select name from keyword where category_id ='3' ";//3 means category HOME
        $keywords = $this->db->query($sql)->result_array();
        $flag = false;
        
        foreach($keywords as $key){
            foreach($row as $column){
                $subSql = "SELECT POSITION('".$key['name']."' IN '".$column."') AS count;";
               
                $result = $this->db->query($subSql)->result_array();
                if($result[0]['count'] > 0){
                    $flag = true;
                    break;
                }
            }    
        }
        return $flag;
    }

    function isEdu($row){
        $sql = "select name from keyword where category_id ='4' ";//4 means category EDU
        $keywords = $this->db->query($sql)->result_array();
        $flag = false;
        
        foreach($keywords as $key){
            foreach($row as $column){
                $subSql = "SELECT POSITION('".$key['name']."' IN '".$column."') AS count;";
               
                $result = $this->db->query($subSql)->result_array();
                if($result[0]['count'] > 0){
                    $flag = true;
                    break;
                }
            }    
        }
        return $flag;
    }

    function isCommercial($row){
        $sql = "select name from keyword where category_id ='2' ";//2 means category PROBABLE BUSINESS OR COMMERCIAL
        $keywords = $this->db->query($sql)->result_array();
        $flag = false;
        
        foreach($keywords as $key){
            foreach($row as $column){
                $subSql = "SELECT POSITION('".$key['name']."' IN '".$column."') AS count;";
               
                $result = $this->db->query($subSql)->result_array();
                if($result[0]['count'] > 0){
                    $flag = true;
                    break;
                }
            }    
        }
        return $flag;
    }

    function getAllCategories(){
        $this->db->select("*");
                    $this->db->from('category');
        $brands = $this->db->get();
        return $brands->result();
    }
    
    function loadAllRecords(){
        $sql = "SELECT r.id as recordId,r.date as recordDate,r.country as countryId,r.email as recordEmail,
                r.telephone as recordPhone, r.category_id as recordCategory,r.brand_id as brandId,r.batch_id as recordBatchId,
                r.original_row as originalRow,r.async_record_id as asyncId,c.country_name as countryName, b.brand_name as brandName, 
                cat.name as categoryName from record as r 
                join country as c on c.id = r.country inner join brands as b on r.brand_id = b.id join category as cat on r.category_id = cat.id  order by r.id desc;";
        return $this->db->query($sql)->result_array();
    }
    

    function getAllCategoriesWithKeywords(){
        $sql = "select k.id as id,k.category_id as category_id,k.name as keyword,c.name as category_name,k.status as status from keyword as k join category as c on k.category_id = c.id";
        return $this->db->query($sql)->result_array();
    }

    function getDateRangeByBrandId($brandId){
        $sql = "SELECT MIN(date_start) as startDate,MAx(date_end) as endDate from import_batch where brand_id = ". $brandId.";";
        return $this->db->query($sql)->result_array();
    }

    function loadImportStatsByDateRange($start,$end,$brandId){
        $sql = "select *  from record where date >= '".$start."' and date <= '".$end."' and brand_id = ".$brandId." ;";
        return $this->db->query($sql)->result_array();
    }

    public function loadTotalRecords(){
        $sql = "select * from record;";
        return $this->db->query($sql)->result_array();
    }

    public function gettAllEmailApiError(){
        $sql = "select SUM(total_email_error) as mail_error from import_batch;";
        return $this->db->query($sql)->result_array();
    }

    public function gettAllPhoneApiError(){
        $sql = "select SUM(total_phone_error) as mail_error from import_batch;";
        return $this->db->query($sql)->result_array();
    }
    public function loadDataTableForBrand($brandId){
        $sql = "select * from record where brand_id=".$brandId.";";
        return $this->db->query($sql)->result_array();
    }


    
    public function loadingApiConfig(){
        $sql = "select * from api_service";
        return $this->db->query($sql)->result_array();
    }

    public function readAllRecordsForAsyncProcess(){
        $sql = "select * from async_record_processor_data where processed= 0 limit 5;";
        return $this->db->query($sql)->result_array();
    }
    public function readAsyncRowForReprocess($asyncRowId){
        $sql = "select * from async_record_processor_data where id=".$asyncRowId.";";
        return $this->db->query($sql)->result_array();
    }

    public function updatingBatchDataNow($batchData){
        //getting current counters from db for this batch
        $sql = "select * from import_batch where id='".$batchData['batch_id']."';";
        $result = $this->db->query($sql)->result_array();

        $isProcessedByCron = false;
        $totalCommercial =  $result[0]['total_commercial'] + $batchData['total_commercial'];
        $totalEdu   =   $result[0]['total_edu'] + $batchData['total_edu'];
        $total_duplicates = $result[0]['total_duplicates'] + $batchData['total_duplicates'];
        $totalHome = $result[0]['total_home'] + $batchData['total_home'];
        $totalDiscard = $result[0]['total_discard'] + $batchData['total_discard'];
        $totalBusiness  =   $result[0]['total_business'] + $batchData['total_business'];
        $recordsProcess  =  $result[0]['records_process'] + $batchData['records_process'];
        $totalEmailError =  $result[0]['total_email_error'] + $batchData['total_email_error'];
        $totalPhoneError =  $result[0]['total_phone_error'] + $batchData['total_phone_error'];
        $totalFreeMails =   $result[0]['total_free_mails'] + $batchData['total_free_mails'];
        

        if($result[0]['total_records'] == $recordsProcess){
            $isProcessedByCron = true;
        }

        return $this->db->update('import_batch',
        array(
                'total_commercial' => $totalCommercial,
                'total_edu' =>  $totalEdu,
                'total_duplicates'  =>  $total_duplicates,
                'total_home'  =>    $totalHome,
                'total_discard' =>  $totalDiscard,
                'total_business'  =>    $totalBusiness,
                'records_process'  =>   $recordsProcess,
                'total_email_error' =>  $totalFreeMails,
                'total_phone_error' =>  $totalPhoneError,
                'total_free_mails'  =>  $totalFreeMails,
                'is_processed_by_cron'  => $isProcessedByCron

            ),
        array('id' => $batchData['batch_id']));

    }

    public function getEntireRecordData($recordId){
        $sql = "select * from record where id=".$recordId.";";
        return $this->db->query($sql)->result_array();
    }

    public function deleteBrand($brandId){
        try{
            $sql = "delete from brands where id = '".$brandId."';";
            $this->db->query($sql);

            $sql = "delete from async_record_processor_data where brand_id = '".$brandId."';";
            $this->db->query($sql);

            $sql = "delete from import_batch where brand_id = '".$brandId."';";
            $this->db->query($sql);

            $sql = "delete from record where brand_id = '".$brandId."';";
            $this->db->query($sql);
            return true;
        }catch(Exception $e){
            return false;
        }
    }


    public function addLogs($logData){
        if($this->db->insert('logs',$logData)){
            return $this->db->insert_id();
        }
        return 0;
    }
    

    public function loadAllLogs(){
        $sql = "SELECT * from logs;";
        return $this->db->query($sql)->result_array();
    }

    public function persistsImage($fileName){
        $data = array(
            "path" => $fileName,
            "status" => "active"
        );
        if($this->db->insert('gallery',$data)){
            return $this->db->insert_id();
        }
    }

    public function getGalleryImages(){
        $sql = "select * from gallery where status = 'active' ";
        return $this->db->query($sql)->result_array();
    }
}
?>
