<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" NAME="ROBOTS" CONTENT="NOARCHIVE"/>
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<title>所有回覆資料</title>
<script type="text/javascript" src="../../import/jQuery-3.2.1/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../../import/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../import/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../../import/JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="../../import/Buttons-1.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="../../import/Select-1.2.3/js/dataTables.select.min.js"></script>

<script src="../../js/allresponsebyfront.js"></script>
<link rel="stylesheet" type="text/css" href="../../import/DataTables-1.10.16/css/jquery.dataTables.min.css">
<style type="text/css">
	table { 
  border: 0; 
  font-family: arial; 
  font-size:14px;
} 
.mainquestion{
	background-color: #F5F5DC;
}
.mainquestion2{
	background-color: #C1F5FC;
}
.mainquestion3{
	background-color: #B1A5DC;
}
.mainquestion4{
	background-color: #C8F5DC;
}
.mainquestion5{
	background-color: #D1F51C;
}
.mainquestion6{
	background-color: #486CFC;
}
/*th{
	min-width:100px;
}*/
.long{
	min-width:300px;
}
#table_paginate{
  position: fixed;
  bottom: 0;
  right: 0;
  background-color: white
}
#table_filter{
	position: fixed;
  top: 5%;
  right: 0;
  background-color: white
}
input[type=checkbox]{
	height: 50px;
	width: 50px;
}
tfoot {
    display: table-header-group;
}
</style>
</head>
<body>

	<h1>所有回覆資料 <button class="index">首頁</button></h1>
	<!-- 開始日<input type="date" id="startday">
	結束日<input type="date" id="endday">
	<button id="filter">篩選</button>
	<button id="reset">重新設置篩選條件</button>
	<button id="button">刪除</button> -->
	<!-- <button id="update">修改</button> -->
	<button id="detail">手機版查看</button>
	<form id="which">
		<input type="radio" name="type" value="all" checked="true">全部
		<input type="radio" name="type" value="process">尚未回覆
		<input type="radio" name="type" value="complete">已回覆
	</form>
	<br>
	<br>
	<table border="1" id="table" class="display">
		<thead id="thead">
			<tr>
				<th><input id ="selectall" type="checkbox"></th>
				<th class="mainquestion">id</th>
				<th class="mainquestion">Name</th>
				<th class="mainquestion">性別</th>
				<th class="mainquestion">出生(年/月/日)</th>
				<th class="mainquestion">懷孕週數</th>
				<th class="mainquestion">胎次</th>
				<th class="mainquestion">出生體重</th>
				<th class="mainquestion">出生頭圍</th>
				<th class="mainquestion">現在頭圍</th>
				<th class="mainquestion">perinatal insult</th>
				<th class="mainquestion">目前年齡</th>
				<th class="mainquestion">家族是否有癲癇</th>
				<th class="mainquestion">診斷</th>
				<th class="mainquestion2">第一次癲癇發作年齡</th>
				<th class="mainquestion2">點頭癲癇</th>
				<th class="mainquestion2">熱性痙攣</th>
				<th class="mainquestion2">seizure status with fever</th>
				<th class="mainquestion2">seizure cluster during fever </th>
				<th class="mainquestion2">GTC</th>
				<th class="mainquestion2">partial seizure</th>
				<th class="mainquestion2">tonic spasms</th>
				<th class="mainquestion2">absence seizure</th>
				<th class="mainquestion3">burst supression</th>
				<th class="mainquestion3">hypsarrythmia</th>
				<th class="mainquestion3">3-6Hz Spike Waves</th>
				<th class="mainquestion3">3Hz spike-waves</th>
				<th class="mainquestion3">slow spike-waves</th>
				<th class="mainquestion3">generalized spikes-waves</th>
				<th class="mainquestion3">cerebral dysfunction</th>
				<th class="mainquestion3">曾使用抗癲癇無效藥物</th>
				<th class="mainquestion3">目前使用抗癲癇藥物</th>
				<th class="mainquestion3">intractable epilepsy</th>
				<th class="mainquestion4">autistic feature</th>
				<th class="mainquestion4">ADHD</th>
				<th class="mainquestion4">hand stereotype</th>
				<th class="mainquestion4">acquired microcephaly</th>
				<th class="mainquestion4">hypotonia</th>
				<th class="mainquestion4">dysmorphysim</th>
				<th class="mainquestion4">MR</th>
				<th class="mainquestion4">DD</th>
				<th class="mainquestion5">brain CT</th>
				<th class="mainquestion5">brain MRI</th>
				<th class="mainquestion5">SPECT</th>
				<th class="mainquestion5">代謝性檢查</th>
				<th class="mainquestion5">CSF 檢查</th>
				<th class="mainquestion6">病變基因</th>
				<th class="mainquestion6">Mutation</th>
				<th class="mainquestion6">AA change</th>
				<th class="mainquestion6">Novel/ reported</th>
				<th class="mainquestion6">Exon</th>
				<th class="mainquestion6">de novo</th>
				<th class="mainquestion6">回覆</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</tfoot>
		<tbody id="tbody"></tbody>
	</table>
	<div id="progressbar"></div>
	<!-- 下載檔案用 隱藏
	<iframe name="DownLoadiFrame" width="0" height="0"></iframe>
	<form target="DownLoadiFrame" id="DownLoadForm" action="../../Excel/output.xlsx" method="post">
	    <input type="hidden" name="type" />
	</form>
	下載檔案用 隱藏
	<button id="export">匯出EXCEL</button> -->
	<!-- <a href="http://nancytest.esy.es/Ptt/contacts.csv" download="contacts.csv">Download file</a> -->
</body>
</html>
