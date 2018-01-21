<?php
 // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
//data table做表格的ajax處理
$requestData= $_REQUEST;
// print_r($requestData);
require("question.php");
if(!($json=file_get_contents("php://input")) && !isset($_GET["act"])) {
        exit(0);
}
//將json解開
$data=json_decode($json,true);
//如果有的話就是post傳json 沒有就是get
if(file_get_contents("php://input")){
        $act =$data[0]["act"];
        if(@$requestData['data']){
            $data=$requestData['data'];
            // print_r($data);
            $act=$requestData['data'][0]['act'];
        }
}
else{
        $act=$_GET["act"];
}
//wrong拿來看一口氣處理大量資料有沒有錯 >0就是有錯
$wrong=0;
switch($act) {
        case "addCase":
                $result = array();
                if($_SESSION["user"]==""){
                    $status["status"] = 400;
                    $status["messege"] = "您的登入異常 請重新登入或聯絡管理員";
                    array_push($result, $status);
                    echo json_encode($result, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
                    break;
                }
                $alldata = @$data[1];
                $status["status"]= addCase($alldata);
                switch ($status["status"]) {
                    case '200':
                        $status["messege"] = "新增成功";
                        break;
                    case '500':
                        $status["messege"] = "帳號重複";
                        break;
                    case '501':
                        $status["messege"] = "發生未預期的錯誤 請聯絡管理員";
                        break;
                }
                array_push($result, $status);
                echo (json_encode($result, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT));
                break;
        case "response":
                $result = array();
                // if($_SESSION["user"]==""){
                //     $status["status"] = 400;
                //     $status["messege"] = "您的登入異常 請重新登入或聯絡管理員";
                //     array_push($result, $status);
                //     echo json_encode($result, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
                //     break;
                // }
                $alldata = @$data[1];
                $status["status"]= response($alldata);
                switch ($status["status"]) {
                    case '200':
                        $status["messege"] = "回覆完成";
                        break;
                    case '501':
                        $status["messege"] = "發生未預期的錯誤 請聯絡管理員";
                        break;
                }
                array_push($result, $status);
                echo (json_encode($result, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT));
                break;
        case "updateCase":
                $result = array();
                // if($_SESSION["user"]==""){
                //     $status["status"] = 400;
                //     $status["messege"] = "您的登入異常 請重新登入或聯絡管理員";
                //     array_push($result, $status);
                //     echo json_encode($result, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
                //     break;
                // }
                $alldata = @$data[1];
                $status["status"]= updateCase($alldata);
                switch ($status["status"]) {
                    case '200':
                        $status["messege"] = "修改完成";
                        break;
                    case '501':
                        $status["messege"] = "發生未預期的錯誤 請聯絡管理員";
                        break;
                }
                array_push($result, $status);
                echo (json_encode($result, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT));
                break;
        case "getcontent":
                $alldata = @$data[1];
                $result= getcontent($alldata);
                echo (json_encode($result, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT));
                // echo (json_encode($result, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT));
                break;
        case "DataTablegetData":
                if ($table=DataTablegetData($requestData)) {
                    if(count($table['data'])==0){
                            array_unshift($table,array('status' => 204));
                            echo json_encode($table, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
                    }else{
                        array_unshift($table,array('status' => 200));
                        echo json_encode($table, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
                    }
                } else {
                        $table=['status' => 500];
                        echo json_encode($table, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
                }
                break;
        case "DataTablegetDatabyfront":
                if ($table=DataTablegetDatabyfront($requestData)) {
                    if(count($table['data'])==0){
                            array_unshift($table,array('status' => 204));
                            echo json_encode($table, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
                    }else{
                        array_unshift($table,array('status' => 200));
                        echo json_encode($table, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
                    }
                } else {
                        $table=['status' => 500];
                        echo json_encode($table, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
                }
                break;
        case "DataTablegetDatabyadmin":
                if ($table=DataTablegetDatabyadmin($requestData)) {
                    if(count($table['data'])==0){
                            array_unshift($table,array('status' => 204));
                            echo json_encode($table, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
                    }else{
                        array_unshift($table,array('status' => 200));
                        echo json_encode($table, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
                    }
                } else {
                        $table=['status' => 500];
                        echo json_encode($table, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
                }
                break;
        default:
}
?>
