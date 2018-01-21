<?php
session_start();
require("../../dbconnect.php");
require("../function.php");
// 抓問題清單
function addCase($alldata) {
	$table = "data";
        $name = array("name","Gender","Birthday","week","Parity","weight","BirthHeadWidth","NowHeadWidth","PerinatalInsult","Age","Hasepilepsy","Diagnosis","SeizureOnset","InfantileSpasms","HeatSpasm","SeizureStatusWithFever","SeizureClusterDuringFever","GTC","PartialSeizure","TonicSpasms","AbsenceSeizure","BurstSupression","Hypsarrythmia","3_6HzSpikeWaves","3HzSpikeWaves","SlowSpikeWaves","GeneralizedSeizure","FocalSpikes","CerebralDysfunction","UsedAntiepilepticDrugs","NowAntiepilepticDrugs","IntractableEpilepsy","AutisticFeature","ADHD","HandStereotype","AcquiredMicrocephaly","Hypotonia","Dysmorphysim","MR","DD","BrainCT","BrainMRI","SPECT","MetabolicExamination","CSF","LesionGene","Mutation","AAChange","NovelReported","Exon","DeNovo","Useraccount","username");
        $insertvalue = array();
        // $alldata["pwd"]=md5($alldata["pwd"]);
        // print_r($alldata);
		foreach ($alldata as $key => $value) {
			array_push($insertvalue, $value);
		}
        $username = array("name");
        $who = array("account");
        $whovalue = array($alldata["account"]);
        $result = select("user",$username,$who,$whovalue,0,0);
        array_push($insertvalue, $result[0]['name']);
        $result = insert($table,$name,$insertvalue); 
        return $result;
        // return json_encode($table, JSON_FORCE_OBJECT);
}
function response($alldata) {
        $table = "data";
        $name = array("response");
        $updatevalue = array($alldata["response"]);
        // $alldata["pwd"]=md5($alldata["pwd"]);
        $and = array("id");
        $id = $alldata["id"];
        $result = update($table,$name,$updatevalue,$and,$id,0,0); 
        return $result;
        // return json_encode($table, JSON_FORCE_OBJECT);
}
function updateCase($alldata) {
        $table = "data";
        $name = array("name","Gender","Birthday","week","Parity","weight","BirthHeadWidth","NowHeadWidth","PerinatalInsult","Age","Hasepilepsy","Diagnosis","SeizureOnset","InfantileSpasms","HeatSpasm","SeizureStatusWithFever","SeizureClusterDuringFever","GTC","PartialSeizure","TonicSpasms","AbsenceSeizure","BurstSupression","Hypsarrythmia","3_6HzSpikeWaves","3HzSpikeWaves","SlowSpikeWaves","GeneralizedSeizure","FocalSpikes","CerebralDysfunction","UsedAntiepilepticDrugs","NowAntiepilepticDrugs","IntractableEpilepsy","AutisticFeature","ADHD","HandStereotype","AcquiredMicrocephaly","Hypotonia","Dysmorphysim","MR","DD","BrainCT","BrainMRI","SPECT","MetabolicExamination","CSF","LesionGene","Mutation","AAChange","NovelReported","Exon","DeNovo");
        $updatevalue = array();
        foreach ($alldata as $key => $value) {
            array_push($updatevalue, $value);
        }
        // print_r($updatevalue);
        $and = array("id");
        $id = $alldata["id"];
        // echo $id;
        $result = update($table,$name,$updatevalue,$and,$id,0,0); 
        return $result;
        // return json_encode($table, JSON_FORCE_OBJECT);
}
function getcontent($alldata){
        $table = "data";
        $option = 1;
        $and = array("id");
        $value = array($alldata["id"]);
        $result = select($table,$option,$and,$value,0,0);
        $count = count($result);
        $json=array();
        if($count>0){
                $json["status"]=200;
                $json["query"]=$result;
        }else if($count==0){
                $json["status"]=500;
                $json["query"]="無資料";
        }else{
                $json["status"]=501;
                $json["query"]="發生未預期的錯誤";
        }
        return $json;
}
function DataTablegetData($requestData) {
        global $conn;
        $tablename='data';
        /***本方法有資料庫權限可使用****/
        // $columns = array();
        //取欄位名稱
        // $sql = "SELECT COLUMN_NAME,ORDINAL_POSITION,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$tablename."'";
        // $query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        // //id不排
        // // $row = mysqli_fetch_array($query);
        // while($row = mysqli_fetch_array($query)){
        //     if($row[0]!="day")
        //     $columns[] =$row[0];
        // }
        /******************************/
        // print_r($columns);
        /***無資料庫權限使用**********/
        $columns =Array
        ("id","username","Useraccount","name","Gender","Birthday","week","parity","weight","BirthHeadWidth","NowHeadWidth","PerinatalInsult","Age","Hasepilepsy","Diagnosis","SeizureOnset","InfantileSpasms","HeatSpasm","SeizureStatusWithFever","SeizureClusterDuringFever","GTC","PartialSeizure","TonicSpasms","AbsenceSeizure","BurstSupression","Hypsarrythmia","3_6HzSpikeWaves","3HzSpikeWaves","SlowSpikeWaves","GeneralizedSeizure","FocalSpikes","CerebralDysfunction","UsedAntiepilepticDrugs","NowAntiepilepticDrugs","IntractableEpilepsy","AutisticFeature","ADHD","HandStereotype","AcquiredMicrocephaly","Hypotonia","Dysmorphysim","MR","DD","BrainCT","BrainMRI","SPECT","MetabolicExamination","CSF","LesionGene","Mutation","AAChange","NovelReported","Exon","DeNovo","response"
        );
        /*******************************/
        $sql = "SELECT * ";
        $sql.=" FROM ".$tablename."";
        $query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
        $sql = "SELECT ".$columns[0];
        for ($i=1; $i <count($columns); $i++) { 
            $sql.=", ".$columns[$i];
        }
        $sql.=" FROM ".$tablename." WHERE 1=1 ";
        // echo $sql;
        // $startday = $requestData['data'][1]['startday'];
        // $endday = $requestData['data'][1]['endday'];
        //         if(!empty($startday)&&empty($endday)){
        //                $sql .= "and writetime >= '$startday' ";
        //         }else if(empty($startday)&&!empty($endday)){
        //                $sql .= "and writetime <= '$endday' ";
        //         }else if(!empty($startday)&&!empty($endday)){
        //                $sql .= "and writetime >= '$startday' and writetime <= '$endday' ";
        //         }else{
        //         }
        //         // print_r($requestData['search']);
        if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( ".$columns[0]." LIKE '%".$requestData['search']['value']."%' ";
            for ($i=1; $i <count($columns)-1; $i++) { 
                $sql.=" OR ".$columns[$i]." LIKE '%".$requestData['search']['value']."%' ";
            }
            $sql.=" OR ".$columns[$i]." LIKE '%".$requestData['search']['value']."%' )";
            // $sql.=" OR writetime LIKE '".$requestData['search']['value']."%' ";

            // $sql.=" OR height LIKE '".$requestData['search']['value']."%' )";
            // $sql.=" OR weight LIKE '".$requestData['search']['value']."%' )";
        }
        if(!empty($requestData['columns'][2]['search']['value']) )
                $sql.=" AND ".$columns[1]." = '".$requestData['columns'][2]['search']['value']."' ";
        for ($i=3; $i <count($columns)+1 ; $i++) { 
            if( isset($requestData['columns'][$i]['search']['value']) ){   //name
                $sql.=" AND ".$columns[$i-1]." LIKE '%".$requestData['columns'][$i]['search']['value']."%' ";
            }
        }
        // echo $sql;
        switch ($requestData['data'][1]['type']) {
            case 'all':
                break;
            case 'complete':
                $sql .= " and response != ''";
                break;
            case 'process':
                $sql .= " and response = ''";
                break;            
            default:
                # code...
                break;
        }
        $query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
        // $sql.=" ORDER BY ". $columns[0]."   asc  LIMIT 0 ,10   ";
        // echo $sql;
        if($requestData['length']!=-1){
            if($requestData['order'][0]['column']==0)
                $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
            else{
                $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']-1]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
            }
        }
        else
            $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']-1]."   ".$requestData['order'][0]['dir'];
        // echo $columns[$requestData['order'][0]['column']-1];
        // echo $sql;
        // print_r($requestData);
        // echo $columns[$requestData['order'][0]['column']-1];
        /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */    
        $query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        mysqli_close($conn);
        $data = array();
        while( $row=mysqli_fetch_array($query) ) {  // preparing an array
            $nestedData=array(); 
            for ($i=0; $i <count($columns); $i++) { 
                $nestedData[] = $row[$columns[$i]];
            }
            $data[] = $nestedData;
        }
        $json_data = array(
                    "draw"            => intval( $requestData['draw'] ),

                    // "draw"            => intval( 2 ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "recordsTotal"    => intval( $totalData ),  // total number of records
                    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data"            => $data   // total data array
                    );
        return $json_data;
        // return json_encode($table, JSON_FORCE_OBJECT);
}

function DataTablegetDataByfront($requestData) {
        global $conn;
        $tablename='data';
        /***本方法有資料庫權限可使用****/
        // $columns = array();
        //取欄位名稱
        // $sql = "SELECT COLUMN_NAME,ORDINAL_POSITION,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$tablename."'";
        // $query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        // //id不排
        // // $row = mysqli_fetch_array($query);
        // while($row = mysqli_fetch_array($query)){
        //     if($row[0]!="day")
        //     $columns[] =$row[0];
        // }
        /******************************/
        // print_r($columns);
        /***無資料庫權限使用**********/
        $columns =Array
        ("id","name","Gender","Birthday","week","parity","weight","BirthHeadWidth","NowHeadWidth","PerinatalInsult","Age","Hasepilepsy","Diagnosis","SeizureOnset","InfantileSpasms","HeatSpasm","SeizureStatusWithFever","SeizureClusterDuringFever","GTC","PartialSeizure","TonicSpasms","AbsenceSeizure","BurstSupression","Hypsarrythmia","3_6HzSpikeWaves","3HzSpikeWaves","SlowSpikeWaves","GeneralizedSeizure","FocalSpikes","CerebralDysfunction","UsedAntiepilepticDrugs","NowAntiepilepticDrugs","IntractableEpilepsy","AutisticFeature","ADHD","HandStereotype","AcquiredMicrocephaly","Hypotonia","Dysmorphysim","MR","DD","BrainCT","BrainMRI","SPECT","MetabolicExamination","CSF","LesionGene","Mutation","AAChange","NovelReported","Exon","DeNovo","response"
        );
        /*******************************/
        $sql = "SELECT * ";
        $sql.=" FROM ".$tablename."";
        $query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
        $sql = "SELECT ".$columns[0];
        for ($i=1; $i <count($columns); $i++) { 
            $sql.=", ".$columns[$i];
        }
        $sql.=" FROM ".$tablename." WHERE 1=1 ";
        // echo $sql;
        // $startday = $requestData['data'][1]['startday'];
        // $endday = $requestData['data'][1]['endday'];
        //         if(!empty($startday)&&empty($endday)){
        //                $sql .= "and writetime >= '$startday' ";
        //         }else if(empty($startday)&&!empty($endday)){
        //                $sql .= "and writetime <= '$endday' ";
        //         }else if(!empty($startday)&&!empty($endday)){
        //                $sql .= "and writetime >= '$startday' and writetime <= '$endday' ";
        //         }else{
        //         }
        //         // print_r($requestData['search']);
        if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( ".$columns[0]." LIKE '%".$requestData['search']['value']."%' ";
            for ($i=1; $i <count($columns)-1; $i++) { 
                $sql.=" OR ".$columns[$i]." LIKE '%".$requestData['search']['value']."%' ";
            }
            $sql.=" OR ".$columns[$i]." LIKE '%".$requestData['search']['value']."%' )";
            // $sql.=" OR writetime LIKE '".$requestData['search']['value']."%' ";

            // $sql.=" OR height LIKE '".$requestData['search']['value']."%' )";
            // $sql.=" OR weight LIKE '".$requestData['search']['value']."%' )";
        }
        if(!empty($requestData['columns'][2]['search']['value']) )
                $sql.=" AND ".$columns[1]." = '".$requestData['columns'][2]['search']['value']."' ";
        for ($i=3; $i <count($columns)+1 ; $i++) { 
            if( isset($requestData['columns'][$i]['search']['value']) ){   //name
                $sql.=" AND ".$columns[$i-1]." LIKE '%".$requestData['columns'][$i]['search']['value']."%' ";
            }
        }
        switch ($requestData['data'][1]['type']) {
            case 'all':
                break;
            case 'complete':
                $sql .= " and response != ''";
                break;
            case 'process':
                $sql .= " and response = ''";
                break;            
            default:
                # code...
                break;
        }
        // echo $sql;
        $query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
        // $sql.=" ORDER BY ". $columns[0]."   asc  LIMIT 0 ,10   ";
        // echo $sql;
        $user = $_SESSION['user'];
        $sql.="and Useraccount = "."'$user'";
        if($requestData['length']!=-1){
            if($requestData['order'][0]['column']==0)
                $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
            else{
                $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']-1]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
            }
        }
        else
            $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']-1]."   ".$requestData['order'][0]['dir'];
        // echo $columns[$requestData['order'][0]['column']-1];
        // echo $sql;
        // print_r($requestData);
        // echo $columns[$requestData['order'][0]['column']-1];
        /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
        $query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        mysqli_close($conn);
        $data = array();
        while( $row=mysqli_fetch_array($query) ) {  // preparing an array
            $nestedData=array(); 
            for ($i=0; $i <count($columns); $i++) { 
                $nestedData[] = $row[$columns[$i]];
            }
            $data[] = $nestedData;
        }
        $json_data = array(
                    "draw"            => intval( $requestData['draw'] ),

                    // "draw"            => intval( 2 ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "recordsTotal"    => intval( $totalData ),  // total number of records
                    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data"            => $data   // total data array
                    );
        return $json_data;
        // return json_encode($table, JSON_FORCE_OBJECT);
}
function DataTablegetDataByadmin($requestData) {
        global $conn;
        $tablename='data';
        /***本方法有資料庫權限可使用****/
        // $columns = array();
        //取欄位名稱
        // $sql = "SELECT COLUMN_NAME,ORDINAL_POSITION,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$tablename."'";
        // $query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        // //id不排
        // // $row = mysqli_fetch_array($query);
        // while($row = mysqli_fetch_array($query)){
        //     if($row[0]!="day")
        //     $columns[] =$row[0];
        // }
        /******************************/
        // print_r($columns);
        /***無資料庫權限使用**********/
        $columns =Array
        ("id","name","Gender","Birthday","week","parity","weight","BirthHeadWidth","NowHeadWidth","PerinatalInsult","Age","Hasepilepsy","Diagnosis","SeizureOnset","InfantileSpasms","HeatSpasm","SeizureStatusWithFever","SeizureClusterDuringFever","GTC","PartialSeizure","TonicSpasms","AbsenceSeizure","BurstSupression","Hypsarrythmia","3_6HzSpikeWaves","3HzSpikeWaves","SlowSpikeWaves","GeneralizedSeizure","FocalSpikes","CerebralDysfunction","UsedAntiepilepticDrugs","NowAntiepilepticDrugs","IntractableEpilepsy","AutisticFeature","ADHD","HandStereotype","AcquiredMicrocephaly","Hypotonia","Dysmorphysim","MR","DD","BrainCT","BrainMRI","SPECT","MetabolicExamination","CSF","LesionGene","Mutation","AAChange","NovelReported","Exon","DeNovo","response"
        );
        /*******************************/
        $sql = "SELECT * ";
        $sql.=" FROM ".$tablename."";
        $query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        $totalData = mysqli_num_rows($query);
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
        $sql = "SELECT ".$columns[0];
        for ($i=1; $i <count($columns); $i++) { 
            $sql.=", ".$columns[$i];
        }
        $sql.=" FROM ".$tablename." WHERE 1=1 ";
        // echo $sql;
        // $startday = $requestData['data'][1]['startday'];
        // $endday = $requestData['data'][1]['endday'];
        //         if(!empty($startday)&&empty($endday)){
        //                $sql .= "and writetime >= '$startday' ";
        //         }else if(empty($startday)&&!empty($endday)){
        //                $sql .= "and writetime <= '$endday' ";
        //         }else if(!empty($startday)&&!empty($endday)){
        //                $sql .= "and writetime >= '$startday' and writetime <= '$endday' ";
        //         }else{
        //         }
        //         // print_r($requestData['search']);
        if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( ".$columns[0]." LIKE '%".$requestData['search']['value']."%' ";
            for ($i=1; $i <count($columns)-1; $i++) { 
                $sql.=" OR ".$columns[$i]." LIKE '%".$requestData['search']['value']."%' ";
            }
            $sql.=" OR ".$columns[$i]." LIKE '%".$requestData['search']['value']."%' )";
            // $sql.=" OR writetime LIKE '".$requestData['search']['value']."%' ";

            // $sql.=" OR height LIKE '".$requestData['search']['value']."%' )";
            // $sql.=" OR weight LIKE '".$requestData['search']['value']."%' )";
        }
        if(!empty($requestData['columns'][2]['search']['value']) )
                $sql.=" AND ".$columns[1]." = '".$requestData['columns'][2]['search']['value']."' ";
        for ($i=3; $i <count($columns)+1 ; $i++) { 
            if( isset($requestData['columns'][$i]['search']['value']) ){   //name
                $sql.=" AND ".$columns[$i-1]." LIKE '%".$requestData['columns'][$i]['search']['value']."%' ";
            }
        }
        switch ($requestData['data'][1]['type']) {
            case 'all':
                break;
            case 'complete':
                $sql .= " and response != ''";
                break;
            case 'process':
                $sql .= " and response = ''";
                break;            
            default:
                # code...
                break;
        }
        // echo $sql;
        $query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
        // $sql.=" ORDER BY ". $columns[0]."   asc  LIMIT 0 ,10   ";
        // echo $sql;
        $user = $requestData['data'][1]['account'];
        $sql.="and Useraccount = "."'$user'";
        if($requestData['length']!=-1){
            if($requestData['order'][0]['column']==0)
                $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
            else{
                $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']-1]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
            }
        }
        else
            $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']-1]."   ".$requestData['order'][0]['dir'];
        // echo $columns[$requestData['order'][0]['column']-1];
        // echo $sql;
        // print_r($requestData);
        // echo $columns[$requestData['order'][0]['column']-1];
        /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
        $query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        mysqli_close($conn);
        $data = array();
        while( $row=mysqli_fetch_array($query) ) {  // preparing an array
            $nestedData=array(); 
            for ($i=0; $i <count($columns); $i++) { 
                $nestedData[] = $row[$columns[$i]];
            }
            $data[] = $nestedData;
        }
        $json_data = array(
                    "draw"            => intval( $requestData['draw'] ),

                    // "draw"            => intval( 2 ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "recordsTotal"    => intval( $totalData ),  // total number of records
                    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data"            => $data   // total data array
                    );
        return $json_data;
        // return json_encode($table, JSON_FORCE_OBJECT);
}
?>
