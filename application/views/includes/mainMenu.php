<?php
    $currentContext = $this->session->userdata('menuSelected');
    $subMenu = $this->session->userdata('subMenu');
   
    /**
     * top level menus
     */
    $dashBoard = false;
    $api = false;
    $users = false;
    $brand = false;
    $document = false;
    $report = false;
    $keywords = false;
    $reports = false;
    $api = false;
    $records = false;
    $logs = false;
    

    /**
     * first level sub menus
     */
    $userSignUp = false;
    $userList = false;
    $addBrand = false;
    $brandList = false;
    $documentUpload = false;
    $documentList = false;
    $keywordAio = false;
    $viewReport = false;
    $apiManagement = false;
    $listRecords = false;
    $recordLogs = false;


    switch ($currentContext) {
        case DASHBOARD:
            $dashBoard = true;
            break;
        case USERS:
            $users = true;
            break;
        case BRAND:
            $brand = true;
            break;
        case DOCUMENT:
            $document = true;
            break;
        case KEYWORDS:
            $keywords = true;
            break;
        case REPORTS:
            $reports = true;
            break;
        case API:
            $api = true;
            break;
        case RECORDS:
            $records = true;
            break;
        case LOGS:
            $logs = true;
        default:

    }


    switch ($subMenu) {
        case USER_SIGNUP:
            $userSignUp = true;
            break;
        case USER_LIST:   
            $userList = true;
            break;
        case CREATE_BRAND:
            $addBrand =  true;
            break;
        case BRAND_LIST:
            $brandList = true;
            break;
        case DOCUMENT_UPLOAD:
            $documentUpload = true;
            break;
        case DOCUMENT_LIST:
            $documentList = true;
            break;
        case KEYWORDS_AIO:
            $keywordAio = true;
            break;
        case REPORT_VIEW:
            $viewReport = true;
            break;
        case API_MANAGEMENT:
            $apiManagement = true;
            break;
        case LIST_RECORDS:
            $listRecords = true;
            break;
        case LIST_LOGS:
            $recordLogs = true;
        default:
    } 
?>