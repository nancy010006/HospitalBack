<?php
function insert($table,$name,$insertvalue){
	global $conn;
	// print_r($table);
	// print_r($name);
	// print_r($insertvalue);
	$sql = "insert into $table ";
	$count = count($name);
	if($name){
		$sql .="(";
		foreach ($name as $key => $value) {
			$sql.=$value;
			if($key+1!=$count)
				$sql.=",";
			else
				$sql.=") values (";
		}
	}
	$count = count($insertvalue);
	if($insertvalue){
		foreach ($insertvalue as $key => $value) {
			$value = mysqli_real_escape_string($conn,$value);
			$sql.="'$value'";
			if($key+1!=$count)
				$sql.=",";
			else
				$sql.=");";
		}
	}
	// echo $sql;
	if(mysqli_query($conn,$sql)){
		return 200;
	}else{
		$str = explode(" ",mysqli_error($conn));
		if($str[0]=="Duplicate"&&$str[1]=="entry"){
			return 500;
		}else
			return 501;
	}
}
function select($table,$option,$and,$andvalue,$or,$orvalue){
	global $conn;
	$result = array();
	if($option==1){
		$sql = "select *";
	}else{
		$count = count($option);
		$sql = "select ";
		foreach ($option as $key => $value) {
			$value = mysqli_real_escape_string($conn,$value);
			$sql.="$value";
			if($key+1!=$count){
				$sql.=",";
			}
		}
	}
	$sql.=" from $table where 1=1";
	if($and){
		for ($i=0; $i < count($and); $i++) { 
			$and[$i] = mysqli_real_escape_string($conn,$and[$i]);
			$andvalue[$i] = mysqli_real_escape_string($conn,$andvalue[$i]);
			$sql.=" and $and[$i] = '$andvalue[$i]'";
		}
	}
	if($or){
		for ($i=0; $i < count($or); $i++) { 
			$or[$i] = mysqli_real_escape_string($conn,$or[$i]);
			$andvalue[$i] = mysqli_real_escape_string($conn,$andvalue[$i]);
			$sql.=" or $or[$i] = '$andvalue[$i]'";
		}
	}
	// echo $sql;
	$query = mysqli_query($conn,$sql);
	while ($row = mysqli_fetch_assoc($query)){
		array_push($result, $row);
	}
    return $result;
}
function update($table,$name,$updatevalue,$and,$andvalue,$or,$orvalue){
	global $conn;
	$sql = "update $table set ";
	// print_r($name);
	// print_r($updatevalue);
	for ($i=0; $i <count($name) ; $i++) { 
		$value = $updatevalue[$i];
		$sql .= $name[$i]." = '$value'";
		if($i+1!=count($name))
			$sql.=" , ";
	}
	$sql.= " where 1 = 1 ";
	if($and){
		for ($i=0; $i <count($and) ; $i++) { 
			$sql.="and $and[$i] = '$andvalue'";
		}
	}
	// echo $sql;
	//or還沒寫
	if(mysqli_query($conn,$sql)){
		return 200;
	}else{
		return 501;
	}
}
function delete($table,$and,$andvalue,$or,$orvalue){
	global $conn;
	$sql = "delete from $table where 1=0 ";
	if($or){
		for ($i=0; $i <count($or) ; $i++) { 
			$sql.="or $or[$i] = '$orvalue'";
		}
	}
	echo $sql;
}
?>