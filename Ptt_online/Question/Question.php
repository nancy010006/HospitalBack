<?php
require("../dbconnect.php");
// 抓問題清單
function getQuestionList() {
        global $conn;
        $sql = "select * from data,midcase where data.caseid=midcase.id order by midcase.id;";
        // echo json_encode(mysqli_fetch_assoc(mysqli_query($conn,$sql)), JSON_UNESCAPED_UNICODE);
        // echo "<br>";
        $result = mysqli_query($conn,$sql);
        $table = array();
        // 將搜尋到的資料一筆一筆放進陣列再轉json
        while($rs = mysqli_fetch_assoc($result)){
                array_push($table,$rs);
        }
        return $table;
        // return json_encode($table, JSON_FORCE_OBJECT);
}
function getQuestionDetail($id) {
        global $conn;
        $id = mysqli_real_escape_string($conn,$id);
        $sql = "select * from data where id='$id';";
        // echo json_encode(mysqli_fetch_assoc(mysqli_query($conn,$sql)), JSON_UNESCAPED_UNICODE);
        // echo "<br>";
        $result = mysqli_query($conn,$sql);
        $table = array();
        // 將搜尋到的資料一筆一筆放進陣列再轉json
        while($rs = mysqli_fetch_assoc($result)){
                array_push($table,$rs);
        }
        return $table;
        // return json_encode($table, JSON_FORCE_OBJECT);
}
// function getMidCaseList() {
//         global $conn;
//         $sql = "select * from midcase order by midcase.id;";
//         // echo json_encode(mysqli_fetch_assoc(mysqli_query($conn,$sql)), JSON_UNESCAPED_UNICODE);
//         // echo "<br>";
//         $result = mysqli_query($conn,$sql);
//         $table = array();
//         // 將搜尋到的資料一筆一筆放進陣列再轉json
//         while($rs = mysqli_fetch_assoc($result)){
//                 array_push($table,$rs);
//         }
//         return $table;
//         // return json_encode($table, JSON_FORCE_OBJECT);
// }
function getQuestionListbydate($startday,$endday) {
        // SELECT * from data where writetime BETWEEN '2017-09-04' and DATE_ADD("2017-09-05", INTERVAL 1 DAY);
        global $conn;
        $startday = mysqli_real_escape_string($conn,$startday);
        $endday = mysqli_real_escape_string($conn,$endday);
        if(empty($startday)&&empty($endday)){
               $sql = "select * from data,midcase where data.caseid=midcase.id order by midcase.id,data.writetime;";
        }else if(!empty($startday)&&!empty($endday)){
               $sql = "select * from data,midcase where data.caseid=midcase.id and writetime BETWEEN '$startday' and DATE_ADD('$endday', INTERVAL 1 DAY) order by midcase.id,data.writetime;";
        }else if(!empty($startday)&&empty($endday)){
                $sql="select * from data,midcase where data.caseid=midcase.id and writetime > '$startday' order by midcase.id,data.writetime;";
        }else if(empty($startday)&&!empty($endday)){
                $sql="select * from data,midcase where data.caseid=midcase.id and writetime < DATE_ADD('$endday', INTERVAL 1 DAY) order by midcase.id,data.writetime;";
        }else{
                return 500;
        }
        // echo $sql;
        $result = mysqli_query($conn,$sql);
        $table = array();
        if(count($result)==0)
                return $table;
        // 將搜尋到的資料一筆一筆放進陣列再轉json
        while($rs = mysqli_fetch_assoc($result)){
                array_push($table,$rs);
        }
        return $table;
        // return json_encode($table, JSON_FORCE_OBJECT);
}
function deleteData($alldata) {
        global $conn;
        // echo count($alldata);
        $sql = "delete from data where 1=0 ";
        for ($i=0; $i <count($alldata) ; $i++) { 
            // echo $alldata[$i];
            $sql.="or id = '$alldata[$i]' ";
        }
        // echo json_encode(mysqli_fetch_assoc(mysqli_query($conn,$sql)), JSON_UNESCAPED_UNICODE);
        // echo "<br>";
        $result = mysqli_query($conn,$sql);
        if(!mysqli_error($conn))
            return 200;
        else
            return 500;
        // return $table;
        // return json_encode($table, JSON_FORCE_OBJECT);
}
function getMidCaseData($startday,$endday,$caseid) {
        global $conn;
        $startday = mysqli_real_escape_string($conn,$startday);
        $endday = mysqli_real_escape_string($conn,$endday);
        $caseid = mysqli_real_escape_string($conn,$caseid);
        if(empty($startday)&&empty($endday)){
               $sql = "select * from data,midcase where data.caseid=midcase.id and data.caseid='$caseid' order by midcase.id;";
        }else if(!empty($startday)&&empty($endday)){
               $sql = "select * from data,midcase where data.caseid=midcase.id and data.caseid='$caseid' order by midcase.id;";
        }else if(empty($startday)&&!empty($endday)){
               $sql = "select * from data,midcase where data.caseid=midcase.id and data.caseid='$caseid' order by midcase.id;";
        }else if(!empty($startday)&&!empty($endday)){
               $sql = "select * from data,midcase where data.caseid=midcase.id and data.caseid='$caseid' order by midcase.id;";
        }else{
                return 500;
        }
        // echo $sql;
        $result = mysqli_query($conn,$sql);
        $table = array();
        if(count($result)==0)
                return $table;
        // 將搜尋到的資料一筆一筆放進陣列再轉json
        while($rs = mysqli_fetch_assoc($result)){
                array_push($table,$rs);
        }
        return $table;
        // return json_encode($table, JSON_FORCE_OBJECT);
}
function getMidCaseListbydate($startday,$endday) {
        global $conn;
        $startday = mysqli_real_escape_string($conn,$startday);
        $endday = mysqli_real_escape_string($conn,$endday);
        if(empty($startday)&&empty($endday)){
               $sql = "select * from midcase order by midcase.id;";
        }else if(!empty($startday)&&empty($endday)){
               $sql = "select * from midcase where date > DATE_SUB('$startday', INTERVAL 1 DAY) order by id;";
        }else if(empty($startday)&&!empty($endday)){
               $sql = "select * from midcase where date < DATE_ADD('$endday', INTERVAL 1 DAY) order by id;";
        }else if(!empty($startday)&&!empty($endday)){
               $sql = "select * from midcase where date BETWEEN '$startday' and DATE_ADD('$endday', INTERVAL 1 DAY) order by id;";
        }else{
                return 500;
        }
        // echo $sql;
        $result = mysqli_query($conn,$sql);
        $table = array();
        if(count($result)==0)
                return $table;
        // 將搜尋到的資料一筆一筆放進陣列再轉json
        while($rs = mysqli_fetch_assoc($result)){
                array_push($table,$rs);
        }
        return $table;
        // return json_encode($table, JSON_FORCE_OBJECT);
}
function addQuestion($alldata) {
        global $conn;
        date_default_timezone_set('Asia/Taipei');
        // echo date("Y-m-d H:i:s");
        $asiatime = date("Y-m-d H:i:s");
        $caseid = mysqli_real_escape_string($conn,@$alldata['caseid']);
        $height = mysqli_real_escape_string($conn,@$alldata['height']);
        $weight = mysqli_real_escape_string($conn,@$alldata['weight']);
        $head_circumference = mysqli_real_escape_string($conn,@$alldata['head_circumference']);
        $caregiver = mysqli_real_escape_string($conn,@$alldata['caregiver']);
        $history = mysqli_real_escape_string($conn,@$alldata['history']);
        $day = mysqli_real_escape_string($conn,@$alldata['day']);
        $question_language = mysqli_real_escape_string($conn,@$alldata['question_language']);
        $question_action = mysqli_real_escape_string($conn,@$alldata['question_action']);
        $question_learn = mysqli_real_escape_string($conn,@$alldata['question_learn']);
        $question_relationship = mysqli_real_escape_string($conn,@$alldata['question_relationship']);
        $question_mood = mysqli_real_escape_string($conn,@$alldata['question_mood']);
        $question_attention = mysqli_real_escape_string($conn,@$alldata['question_attention']);
        $question_perception = mysqli_real_escape_string($conn,@$alldata['question_perception']);
        $question_lifestyle = mysqli_real_escape_string($conn,@$alldata['question_lifestyle']);
        $question_strangestyle = mysqli_real_escape_string($conn,@$alldata['question_strangestyle']);
        $question_selfmutilation = mysqli_real_escape_string($conn,@$alldata['question_selfmutilation']);
        $question_helpkid = mysqli_real_escape_string($conn,@$alldata['question_helpkid']);
        $target = mysqli_real_escape_string($conn,@$alldata['target']);
        $family_married = mysqli_real_escape_string($conn,@$alldata['family_married']);
        $family_brother = mysqli_real_escape_string($conn,@$alldata['family_brother']);
        $family_fname = mysqli_real_escape_string($conn,@$alldata['family_fname']);
        $family_fage = mysqli_real_escape_string($conn,@$alldata['family_fage']);
        $family_feducation = mysqli_real_escape_string($conn,@$alldata['family_feducation']);
        $family_fcareer = mysqli_real_escape_string($conn,@$alldata['family_fcareer']);
        $family_fcountry = mysqli_real_escape_string($conn,@$alldata['family_fcountry']);
        $family_mname = mysqli_real_escape_string($conn,@$alldata['family_mname']);
        $family_mage = mysqli_real_escape_string($conn,@$alldata['family_mage']);
        $family_meducation = mysqli_real_escape_string($conn,@$alldata['family_meducation']);
        $family_mcareer = mysqli_real_escape_string($conn,@$alldata['family_mcareer']);
        $family_mcountry = mysqli_real_escape_string($conn,@$alldata['family_mcountry']);
        $family_family = mysqli_real_escape_string($conn,@$alldata['family_family']);
        $treat_status = mysqli_real_escape_string($conn,@$alldata['treat_status']);
        $treat_type = mysqli_real_escape_string($conn,@$alldata['treat_type']);
        $treat_location = mysqli_real_escape_string($conn,@$alldata['treat_location']);
        $treat_hz = mysqli_real_escape_string($conn,@$alldata['treat_hz']);
        $history_family = mysqli_real_escape_string($conn,@$alldata['history_family']);
        $history_nutrition = mysqli_real_escape_string($conn,@$alldata['history_nutrition']);
        $history_disease = mysqli_real_escape_string($conn,@$alldata['history_disease']);
        $history_medication = mysqli_real_escape_string($conn,@$alldata['history_medication']);
        $history_abuse = mysqli_real_escape_string($conn,@$alldata['history_abuse']);
        $history_pregcount = mysqli_real_escape_string($conn,@$alldata['history_pregcount']);
        $history_birthcount = mysqli_real_escape_string($conn,@$alldata['history_birthcount']);
        $history_abortion = mysqli_real_escape_string($conn,@$alldata['history_abortion']);
        $history_pregweek = mysqli_real_escape_string($conn,@$alldata['history_pregweek']);
        $history_pregprocess = mysqli_real_escape_string($conn,@$alldata['history_pregprocess']);
        $neonatal_screening = mysqli_real_escape_string($conn,@$alldata['neonatal_screening']);
        $abnormal_neonatal = mysqli_real_escape_string($conn,@$alldata['abnormal_neonatal']);
        $abnormal_disease = mysqli_real_escape_string($conn,@$alldata['abnormal_disease']);
        $abnormal_develop = mysqli_real_escape_string($conn,@$alldata['abnormal_develop']);

        if(empty($family_married))
            $family_married="無資料";
        if(empty($family_brother))
            $family_brother="無資料";
        if(empty($family_fname))
            $family_fname="無資料";
        if(empty($family_fage))
            $family_fage="無資料";
        if(empty($family_feducation))
            $family_feducation="無資料";
        if(empty($family_fcareer))
            $family_fcareer="無資料";
        if(empty($family_fcountry))
            $family_fcountry="無資料";
        if(empty($family_mname))
            $family_mname="無資料";
        if(empty($family_mage))
            $family_mage="無資料";
        if(empty($family_meducation))
            $family_meducation="無資料";
        if(empty($family_mcareer))
            $family_mcareer="無資料";
        if(empty($family_mcountry))
            $family_mcountry="無資料";
        if(empty($history_nutrition))
            $history_nutrition="無資料";
        if(empty($history_disease))
            $history_disease="無資料";
        if(empty($history_medication))
            $history_medication="無資料";
        if(empty($history_abuse))
            $history_abuse="無資料";
        if(empty($history_pregcount))
            $history_pregcount="無資料";
        if(empty($history_birthcount))
            $history_birthcount="無資料";
        if(empty($history_abortion))
            $history_abortion="無資料";
        if(empty($history_pregweek))
            $history_pregweek="無資料";
        if(empty($history_pregprocess))
            $history_pregprocess="無資料";

        if ($caseid) { //if item is not empty
                $sql = "select caseid from midcasehistory where caseid='$caseid';";
                $result = mysqli_query($conn,$sql);
                // $table = array();
                // print_r($result);
                if($result->num_rows==0)
                    return 422;
                $sql = "insert into data 
                (caseid,height, weight,head_circumference, caregiver,history,day,question_language,question_action,question_learn,question_relationship,question_mood,question_attention,question_perception,question_lifestyle,question_strangestyle,question_selfmutilation,question_helpkid,target,family_married,family_brother,family_fname,family_fage,family_feducation,family_fcareer,family_fcountry,family_mname,family_mage,family_meducation,family_mcareer,family_mcountry,family_family,treat_status,treat_type,treat_location,treat_hz,history_family,history_nutrition,history_disease,history_medication,history_abuse,history_pregcount,history_birthcount,history_abortion,history_pregweek,history_pregprocess,neonatal_screening,abnormal_neonatal,abnormal_disease,abnormal_develop,writetime)
                 values 
                 ('$caseid','$height','$weight','$head_circumference','$caregiver','$history','$day','$question_language','$question_action','$question_learn','$question_relationship','$question_mood','$question_attention','$question_perception','$question_lifestyle','$question_strangestyle','$question_selfmutilation','$question_helpkid','$target','$family_married','$family_brother','$family_fname','$family_fage','$family_feducation','$family_fcareer','$family_fcountry','$family_mname','$family_mage','$family_meducation','$family_mcareer','$family_mcountry','$family_family','$treat_status','$treat_type','$treat_location','$treat_hz','$history_family','$history_nutrition','$history_disease','$history_medication','$history_abuse','$history_pregcount','$history_birthcount','$history_abortion','$history_pregweek','$history_pregprocess','$neonatal_screening','$abnormal_neonatal','$abnormal_disease','$abnormal_develop','$asiatime');";
                // echo $sql;
                if(mysqli_query($conn, $sql))
                        return 200;
                else if(mysqli_error($conn)=="Cannot add or update a child row: a foreign key constraint fails (`hospital`.`data`, CONSTRAINT `data_ibfk_1` FOREIGN KEY (`caseid`) REFERENCES `midcase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE)")
                        return 422;
                else
                        return 500;
        }else{
                return 400;
        }
        // return 123;
}
function updateQuestion($alldata) {
        global $conn;
        // echo date("Y-m-d H:i:s");
        $id = mysqli_real_escape_string($conn,@$alldata['id']);
        $caseid = mysqli_real_escape_string($conn,@$alldata['caseid']);
        $height = mysqli_real_escape_string($conn,@$alldata['height']);
        $weight = mysqli_real_escape_string($conn,@$alldata['weight']);
        $head_circumference = mysqli_real_escape_string($conn,@$alldata['head_circumference']);
        $caregiver = mysqli_real_escape_string($conn,@$alldata['caregiver']);
        $history = mysqli_real_escape_string($conn,@$alldata['history']);
        $day = mysqli_real_escape_string($conn,@$alldata['day']);
        $question_language = mysqli_real_escape_string($conn,@$alldata['question_language']);
        $question_action = mysqli_real_escape_string($conn,@$alldata['question_action']);
        $question_learn = mysqli_real_escape_string($conn,@$alldata['question_learn']);
        $question_relationship = mysqli_real_escape_string($conn,@$alldata['question_relationship']);
        $question_mood = mysqli_real_escape_string($conn,@$alldata['question_mood']);
        $question_attention = mysqli_real_escape_string($conn,@$alldata['question_attention']);
        $question_perception = mysqli_real_escape_string($conn,@$alldata['question_perception']);
        $question_lifestyle = mysqli_real_escape_string($conn,@$alldata['question_lifestyle']);
        $question_strangestyle = mysqli_real_escape_string($conn,@$alldata['question_strangestyle']);
        $question_selfmutilation = mysqli_real_escape_string($conn,@$alldata['question_selfmutilation']);
        $question_helpkid = mysqli_real_escape_string($conn,@$alldata['question_helpkid']);
        $target = mysqli_real_escape_string($conn,@$alldata['target']);
        $family_married = mysqli_real_escape_string($conn,@$alldata['family_married']);
        $family_brother = mysqli_real_escape_string($conn,@$alldata['family_brother']);
        $family_fname = mysqli_real_escape_string($conn,@$alldata['family_fname']);
        $family_fage = mysqli_real_escape_string($conn,@$alldata['family_fage']);
        $family_feducation = mysqli_real_escape_string($conn,@$alldata['family_feducation']);
        $family_fcareer = mysqli_real_escape_string($conn,@$alldata['family_fcareer']);
        $family_fcountry = mysqli_real_escape_string($conn,@$alldata['family_fcountry']);
        $family_mname = mysqli_real_escape_string($conn,@$alldata['family_mname']);
        $family_mage = mysqli_real_escape_string($conn,@$alldata['family_mage']);
        $family_meducation = mysqli_real_escape_string($conn,@$alldata['family_meducation']);
        $family_mcareer = mysqli_real_escape_string($conn,@$alldata['family_mcareer']);
        $family_mcountry = mysqli_real_escape_string($conn,@$alldata['family_mcountry']);
        $family_family = mysqli_real_escape_string($conn,@$alldata['family_family']);
        $treat_status = mysqli_real_escape_string($conn,@$alldata['treat_status']);
        $treat_type = mysqli_real_escape_string($conn,@$alldata['treat_type']);
        $treat_location = mysqli_real_escape_string($conn,@$alldata['treat_location']);
        $treat_hz = mysqli_real_escape_string($conn,@$alldata['treat_hz']);
        $history_family = mysqli_real_escape_string($conn,@$alldata['history_family']);
        $history_nutrition = mysqli_real_escape_string($conn,@$alldata['history_nutrition']);
        $history_disease = mysqli_real_escape_string($conn,@$alldata['history_disease']);
        $history_medication = mysqli_real_escape_string($conn,@$alldata['history_medication']);
        $history_abuse = mysqli_real_escape_string($conn,@$alldata['history_abuse']);
        $history_pregcount = mysqli_real_escape_string($conn,@$alldata['history_pregcount']);
        $history_birthcount = mysqli_real_escape_string($conn,@$alldata['history_birthcount']);
        $history_abortion = mysqli_real_escape_string($conn,@$alldata['history_abortion']);
        $history_pregweek = mysqli_real_escape_string($conn,@$alldata['history_pregweek']);
        $history_pregprocess = mysqli_real_escape_string($conn,@$alldata['history_pregprocess']);
        $neonatal_screening = mysqli_real_escape_string($conn,@$alldata['neonatal_screening']);
        $abnormal_neonatal = mysqli_real_escape_string($conn,@$alldata['abnormal_neonatal']);
        $abnormal_disease = mysqli_real_escape_string($conn,@$alldata['abnormal_disease']);
        $abnormal_develop = mysqli_real_escape_string($conn,@$alldata['abnormal_develop']);
        if ($height) { //if item is not empty
                $sql = "select id from midcase where id='$caseid';";
                $result = mysqli_query($conn,$sql);
                // $table = array();
                // print_r($result);
                if($result->num_rows==0)
                    return 422;
                $sql = "update data set 
                caseid='$caseid',height='$height', weight='$weight',head_circumference='$head_circumference', caregiver='$caregiver',history='$history',day='$day',question_language='$question_language',question_action='$question_action',question_learn='$question_learn',question_relationship='$question_relationship',question_mood='$question_mood',question_attention='$question_attention',question_perception='$question_perception',question_lifestyle='$question_lifestyle',question_strangestyle='$question_strangestyle',question_selfmutilation='$question_selfmutilation',question_helpkid='$question_helpkid',target='$target',family_married='$family_married',family_brother='$family_brother',family_feducation='$family_feducation',family_fname='$family_fname',family_fage='$family_fage',family_fcareer='$family_fcareer',family_fcountry='$family_fcountry',family_mname='$family_mname',family_mage='$family_mage',family_meducation='$family_meducation',family_mcareer='$family_mcareer',family_mcountry='$family_mcountry',family_family='$family_family',treat_status='$treat_status',treat_type='$treat_type',treat_location='$treat_location',treat_hz='$treat_hz',history_family='$history_family',history_nutrition='$history_nutrition',history_disease='$history_disease',history_medication='$history_medication',history_abuse='$history_abuse',history_pregcount='$history_pregcount',history_birthcount='$history_birthcount',history_abortion='$history_abortion',history_pregweek='$history_pregweek',history_pregprocess='$history_pregprocess',neonatal_screening='$neonatal_screening',abnormal_neonatal='$abnormal_neonatal',abnormal_disease='$abnormal_disease',abnormal_develop='$abnormal_develop' where id='$id';";
                // echo $sql;
                if(mysqli_query($conn, $sql))
                        return 200;
                else if(mysqli_error($conn)=="Cannot add or update a child row: a foreign key constraint fails (`hospital`.`data`, CONSTRAINT `data_ibfk_1` FOREIGN KEY (`caseid`) REFERENCES `midcase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE)")
                        return 422;
                else
                        return 500;
        }else{
                return 400;
        }
        return 123;
}
function testadd($alldata) {
        global $conn;

        date_default_timezone_set('Asia/Taipei');
        // echo date("Y-m-d H:i:s");
        $asiatime = date("Y-m-d H:i:s");
        $caseid = mysqli_real_escape_string($conn,@$alldata['caseid']);
        $height = mysqli_real_escape_string($conn,@$alldata['height']);
        $weight = mysqli_real_escape_string($conn,@$alldata['weight']);
        $caregiver = mysqli_real_escape_string($conn,@$alldata['caregiver']);
        $history = mysqli_real_escape_string($conn,@$alldata['history']);
        $day = mysqli_real_escape_string($conn,@$alldata['day']);
        $question_language = mysqli_real_escape_string($conn,@$alldata['question_language']);
        $question_action = mysqli_real_escape_string($conn,@$alldata['question_action']);
        $question_learn = mysqli_real_escape_string($conn,@$alldata['question_learn']);
        $question_relationship = mysqli_real_escape_string($conn,@$alldata['question_relationship']);
        $question_mood = mysqli_real_escape_string($conn,@$alldata['question_mood']);
        $question_attention = mysqli_real_escape_string($conn,@$alldata['question_attention']);
        $question_perception = mysqli_real_escape_string($conn,@$alldata['question_perception']);
        $question_lifestyle = mysqli_real_escape_string($conn,@$alldata['question_lifestyle']);
        $question_strangestyle = mysqli_real_escape_string($conn,@$alldata['question_strangestyle']);
        $question_selfmutilation = mysqli_real_escape_string($conn,@$alldata['question_selfmutilation']);
        $question_helpkid = mysqli_real_escape_string($conn,@$alldata['question_helpkid']);
        $target = mysqli_real_escape_string($conn,@$alldata['target']);
        $family_married = mysqli_real_escape_string($conn,@$alldata['family_married']);
        $family_brother = mysqli_real_escape_string($conn,@$alldata['family_brother']);
        $family_feducation = mysqli_real_escape_string($conn,@$alldata['family_feducation']);
        $family_fcareer = mysqli_real_escape_string($conn,@$alldata['family_fcareer']);
        $family_fcountry = mysqli_real_escape_string($conn,@$alldata['family_fcountry']);
        $family_meducation = mysqli_real_escape_string($conn,@$alldata['family_meducation']);
        $family_mcareer = mysqli_real_escape_string($conn,@$alldata['family_mcareer']);
        $family_mcountry = mysqli_real_escape_string($conn,@$alldata['family_mcountry']);
        $family_family = mysqli_real_escape_string($conn,@$alldata['family_family']);
        $treat_status = mysqli_real_escape_string($conn,@$alldata['treat_status']);
        $treat_type = mysqli_real_escape_string($conn,@$alldata['treat_type']);
        $treat_location = mysqli_real_escape_string($conn,@$alldata['treat_location']);
        $treat_hz = mysqli_real_escape_string($conn,@$alldata['treat_hz']);
        $history_family = mysqli_real_escape_string($conn,@$alldata['history_family']);
        $history_nutrition = mysqli_real_escape_string($conn,@$alldata['history_nutrition']);
        $history_disease = mysqli_real_escape_string($conn,@$alldata['history_disease']);
        $history_medication = mysqli_real_escape_string($conn,@$alldata['history_medication']);
        $history_abuse = mysqli_real_escape_string($conn,@$alldata['history_abuse']);
        $history_pregcount = mysqli_real_escape_string($conn,@$alldata['history_pregcount']);
        $history_birthcount = mysqli_real_escape_string($conn,@$alldata['history_birthcount']);
        $history_abortion = mysqli_real_escape_string($conn,@$alldata['history_abortion']);
        $history_pregweek = mysqli_real_escape_string($conn,@$alldata['history_pregweek']);
        $history_pregprocess = mysqli_real_escape_string($conn,@$alldata['history_pregprocess']);
        $neonatal_screening = mysqli_real_escape_string($conn,@$alldata['neonatal_screening']);
        $abnormal_neonatal = mysqli_real_escape_string($conn,@$alldata['abnormal_neonatal']);
        $abnormal_disease = mysqli_real_escape_string($conn,@$alldata['abnormal_disease']);
        $abnormal_develop = mysqli_real_escape_string($conn,@$alldata['abnormal_develop']);
        if ($height) { //if item is not empty
                for($i=0; $i<1000; $i++){
                    $sql = "insert into data 
                    (caseid,height, weight, caregiver,history,day,question_language,question_action,question_learn,question_relationship,question_mood,question_attention,question_perception,question_lifestyle,question_strangestyle,question_selfmutilation,question_helpkid,target,family_married,family_brother,family_feducation,family_fcareer,family_fcountry,family_meducation,family_mcareer,family_mcountry,family_family,treat_status,treat_type,treat_location,treat_hz,history_family,history_nutrition,history_disease,history_medication,history_abuse,history_pregcount,history_birthcount,history_abortion,history_pregweek,history_pregprocess,neonatal_screening,abnormal_neonatal,abnormal_disease,abnormal_develop,writetime)
                     values 
                     ('$caseid','$height".$i."','$weight','$caregiver','$history','$day','$question_language','$question_action','$question_learn','$question_relationship','$question_mood','$question_attention','$question_perception','$question_lifestyle','$question_strangestyle','$question_selfmutilation','$question_helpkid','$target','$family_married','$family_brother','$family_feducation','$family_fcareer','$family_fcountry','$family_meducation','$family_mcareer','$family_mcountry','$family_family','$treat_status','$treat_type','$treat_location','$treat_hz','$history_family','$history_nutrition','$history_disease','$history_medication','$history_abuse','$history_pregcount','$history_birthcount','$history_abortion','$history_pregweek','$history_pregprocess','$neonatal_screening','$abnormal_neonatal','$abnormal_disease','$abnormal_develop','$asiatime');";
                    // echo $sql;
                    mysqli_query($conn, $sql);
                }
                if(mysqli_query($conn, $sql))
                        return 200;
                else if(mysqli_error($conn)=="Cannot add or update a child row: a foreign key constraint fails (`hospital`.`data`, CONSTRAINT `data_ibfk_1` FOREIGN KEY (`caseid`) REFERENCES `midcase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE)")
                        return 422;
                else
                        return 500;
        }else{
                return 400;
        }
        // return 123;
}
function DataTablegetDataListbydate($requestData) {
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
        ("id","caseid","writetime","height","weight","head_circumference","caregiver","history","question_language","question_action","question_learn","question_relationship","question_mood","question_attention","question_perception","question_lifestyle","question_strangestyle","question_selfmutilation","question_helpkid","target","family_married","family_brother","family_fname","family_fage","family_feducation","family_fcareer","family_fcountry","family_mname","family_mage","family_meducation","family_mcareer","family_mcountry","family_family","treat_status","treat_type","treat_location","treat_hz","history_family","history_nutrition","history_disease","history_medication","history_abuse","history_pregcount","history_birthcount","history_abortion","history_pregweek","history_pregprocess","neonatal_screening","abnormal_neonatal","abnormal_disease","abnormal_develop"
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
        $startday = $requestData['data'][1]['startday'];
        $endday = $requestData['data'][1]['endday'];
                if(!empty($startday)&&empty($endday)){
                       $sql .= "and writetime >= '$startday' ";
                }else if(empty($startday)&&!empty($endday)){
                       $sql .= "and writetime <= '$endday' ";
                }else if(!empty($startday)&&!empty($endday)){
                       $sql .= "and writetime >= '$startday' and writetime <= '$endday' ";
                }else{
                }
                // print_r($requestData['search']);
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
function DataTablegetMidCaseDataListbydate($requestData) {
        global $conn;
        $tablename='data';
        // $columns = array();
        // //取欄位名稱
        // $sql = "SELECT COLUMN_NAME,ORDINAL_POSITION,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$tablename."'";
        // $query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        // //id不排
        // // $row = mysqli_fetch_array($query);
        // while($row = mysqli_fetch_array($query)){
        //     if($row[0]!="day")
        //     $columns[] =$row[0];
        // }
        $columns =Array
        ("id","caseid","writetime","height","weight","head_circumference","caregiver","history","question_language","question_action","question_learn","question_relationship","question_mood","question_attention","question_perception","question_lifestyle","question_strangestyle","question_selfmutilation","question_helpkid","target","family_married","family_brother","family_fname","family_fage","family_feducation","family_fcareer","family_fcountry","family_mname","family_mage","family_meducation","family_mcareer","family_mcountry","family_family","treat_status","treat_type","treat_location","treat_hz","history_family","history_nutrition","history_disease","history_medication","history_abuse","history_pregcount","history_birthcount","history_abortion","history_pregweek","history_pregprocess","neonatal_screening","abnormal_neonatal","abnormal_disease","abnormal_develop"
        );
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
        $startday = $requestData['data'][1]['startday'];
        $endday = $requestData['data'][1]['endday'];
        $sql .="and caseid='".$requestData['data'][1]['caseid']."'";
        if(!empty($startday)&&empty($endday)){
               $sql .= "and writetime >= '$startday' ";
        }else if(empty($startday)&&!empty($endday)){
               $sql .= "and writetime <= '$endday' ";
        }else if(!empty($startday)&&!empty($endday)){
               $sql .= "and writetime >= '$startday' <= '$endday'";
        }else{
        }
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
            $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];
        // echo $sql;
        /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */    
        $query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");

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
