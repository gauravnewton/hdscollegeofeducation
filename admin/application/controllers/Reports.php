<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

  public function index(){
      $data['page_title'] = 'Reports';
      if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
          $this->session->set_userdata(['menuSelected'=>REPORTS,'subMenu'=>REPORT_VIEW]);
          return  $this->load->view('reports',$data);
      }
      $this->session->set_flashdata("error","Login first to access keyword module.");
      //assign dynamically
      $this->load->view('authorization');
  }

  public function loadChartData(){
    $data['page_title'] = 'Reports';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
        $this->session->set_userdata(['menuSelected'=>REPORTS,'subMenu'=>REPORT_VIEW]);
        $this->load->model('queries');
        echo json_encode($this->queries->loadReportData());
    }else{
        $this->session->set_flashdata("error","Login first to access reports.");
        //assign dynamically
        return redirect ('reports');
    }
  }

  public function loadDataTableForBrand(){
    $brandId = $this->input->get('brandId');
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
      $this->session->set_userdata(['menuSelected'=>REPORTS,'subMenu'=>REPORT_VIEW]);
      $this->load->model('queries');
        echo json_encode($this->queries->loadDataTableForBrand($brandId));
    }else{
        return redirect ('reports');
    }
  }

  public function getAllBrands(){
    $data['page_title'] = 'Reports';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
        $this->session->set_userdata(['menuSelected'=>REPORTS,'subMenu'=>REPORT_VIEW]);
        $this->load->model('queries');
        echo json_encode($this->queries->getAllBrands());
    }else{
        return redirect ('reports');
    }
  }

  public function refreshDataTableRecords(){
    $startDate = $this->input->get('start');
    $endDate = $this->input->get('end');
    $brandId = $this->input->get('brandId');
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
      $this->session->set_userdata(['menuSelected'=>REPORTS,'subMenu'=>REPORT_VIEW]);
      $this->load->model('queries');
      echo json_encode($this->queries->loadImportStatsByDateRange($startDate,$endDate,$brandId));
    }else{
        return redirect ('reports');
    }
  }

  public function getDateRangeByBrandId(){
    $brandId = $this->input->get('brandId');
    $data['page_title'] = 'Reports';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
        $this->session->set_userdata(['menuSelected'=>REPORTS,'subMenu'=>REPORT_VIEW]);
        $this->load->model('queries');
        echo json_encode($this->queries->getDateRangeByBrandId($brandId));
    }else{
        return redirect ('reports');
    }
  }

  public function loadImportStatsByDateRange(){
    $startDate = $this->input->get('start');
    $endDate = $this->input->get('end');
    $brandId = $this->input->get('brandId');
    $data['page_title'] = 'Reports';
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
        $this->session->set_userdata(['menuSelected'=>REPORTS,'subMenu'=>REPORT_VIEW]);
        $this->load->model('queries');
        $result = $this->queries->loadImportStatsByDateRange($startDate,$endDate,$brandId);
        //echo "<pre>";
        //print_r($result);
        $totalDuplicate = 0;
        $totalBusiness = 0;
        $totalCommercial = 0;
        $totalHome = 0;
        $totalEdu = 0;
        $totalDiscarded = 0;
        $totalFreeMails = 0;
        
        foreach($result as $key=>$val){
          switch($val['category_id']){
            case DUPLICATE_CATEGORY:
                  $totalDuplicate++;
                  break;
            case BUSINESS_CATEGORY:
                  $totalBusiness++;
                  break;
            case PROBABLE_BUSINESS:
                  $totalCommercial++;
                  break;
            case HOME_CATEGORY:
                  $totalHome;
                  break;
            case EDU_CATEGORY:
                  $totalEdu++;
                  break;
            case DISCARDED_CATEGORY:
                  $totalDiscarded++;
                  break;
            case FREE_MAILS:
                  $totalFreeMails++;
                  break;

          }
        }

        $total = $totalBusiness + $totalCommercial + $totalDiscarded + $totalDuplicate + $totalEdu + $totalFreeMails + $totalHome;
        
        $res = array(
          array(
            
          "total_business" => $totalBusiness,
          "total_commercial" => $totalCommercial,
          "total_discard" => $totalDiscarded,
          "total_duplicates" => $totalDuplicate,
          "total_edu" => $totalEdu,
          "total_free_mails" => $totalFreeMails,
          "total_home" => $totalHome,
          "totalCount" => $total
          )
        );

        echo json_encode($res);
    }else{
        return redirect ('reports');
    }
  }


  public function getBrandDetailsWithDemplateById(){
    $brandId = $this->input->get('brandId');
    if($this->session->userdata('admin_id') || $this->session->userdata('user_id')){
      $this->session->set_userdata(['menuSelected'=>REPORTS,'subMenu'=>REPORT_VIEW]);
      $this->load->model('queries');
        $brandData = array(
            "brand_details" => $this->queries->getBrandById(array('id'=>$brandId)) ,
            "template_details" => $this->queries->getBrandTemplateById(array('id'=>$brandId))
        );
        echo json_encode($brandData);
    }else{
        return redirect ('reports');
    }
 }
}
?>