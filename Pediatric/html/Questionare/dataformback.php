<?php
session_start();
if (! isset($_SESSION["user"]))
        $_SESSION["company"] = "";
if ( $_SESSION["user"] < " ") {
		// echo "乾";
		header("Location: index.html");
        exit(0);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" NAME="ROBOTS" CONTENT="NOARCHIVE"/>
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<title>問卷頁面</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../../js/user.js"></script>
<style type="text/css">
/*#chpartarea{
  position: fixed;
  bottom: 85%;
  left: 50%;
  background-color: white;
}*/
</style>
</head>
<body>
	<form id="dataform">
			<p>
				Name:<input type="text" name="name" required/>
			</p>
			<p>
				性別
				男<input type="radio" name="Gender" value="男" required/>
				女<input type="radio" name="Gender" value="女" required/>
			</p>
			<p>
				出生年月日:<input id="Birthday" type="date" name="Birthday" required/>
			</p>
			<p>
				懷孕週數:<input type="number" name="week" required/>
			</p>
			<p>
				胎次:
				<input type="number" name="parity" required/>G
				<input type="number" name="parity" required/>P
			</p>
			<p>
				出生體重:<input type="number" name="weight" required/>公克
			</p>
			<p>
				出生頭圍:<input type="number" name="BirthHeadWidth" required/>公分
			</p>
			<p>
				現在頭圍:<input type="number" name="NowHeadWidth" required/>公分
			</p>
			<p>
				PerinatalInsult
				有<input type="radio" name="PerinatalInsult" class="mark" value="有" required/>
				無<input type="radio" name="PerinatalInsult" class="mark" value="無" required/>
			</p>
			<p>
				目前年齡:<input id="age" type="text" name="Age" required/>
			</p>
			<p>
				家長是否有癲癇
				有<input type="radio" name="Hasepilepsy" class="mark" value="有" required/>
				無<input type="radio" name="Hasepilepsy" class="mark" value="無" required/>
			</p>
			<p>
				 診斷
				<select name="Diagnosis" required/>
					<option value=""></option>
					<option value="EIEE">EIEE</option>
					<option value="EME">EME</option>
					<option value="IS">IS</option>
					<option value="West">West</option>
					<option value="Syndrome">Syndrome</option>
					<option value="EoEE">EoEE</option>
					<option value="EE">EE</option>
					<option value="Lennox-Gastaut syndome">Lennox-Gastaut syndome</option>
					<option value="Rolandic seizure">Rolandic seizure</option>
					<option value="Autism">Autism</option>
					<option value="FS">FS</option>
					<option value="MMFSI">MMFSI</option>
					<option value="mental retardation">mental retardation</option>
					<option value="ADHD">ADHD</option>
					<option value="Developemental delay">Developemental delay</option>
					<option value="其他">其他</option>
				</select>
			</p>
			<p>
				第一次癲癇發作年齡:<input type="number" name="SeizureOnset" required/>歲
			</p>
			<p>
				點頭癲癇
				有<input type="radio" name="InfantileSpasms" value="有" required/>
				無<input type="radio" name="InfantileSpasms" value="無" required/>
			</p>
			<p>
				熱性痙攣
				有<input type="radio" name="HeatSpasm" value="有" required/>
				無<input type="radio" name="HeatSpasm" value="無" required/>
			</p>
			<p>
				seizure cluster during fever 
				有<input type="radio" name="SeizureClusterDuringFever" value="有" required/>
				無<input type="radio" name="SeizureClusterDuringFever" value="無" required/>
			</p>
			<p>
				GTC
				有<input type="radio" name="GTC" value="有" required/>
				無<input type="radio" name="GTC" value="無" required/>
			</p>
			<p>
				partial seizure 
				有<input type="radio" name="PartialSeizure" value="有" required/>
				無<input type="radio" name="PartialSeizure" value="無" required/>
			</p>
			<p>
				tonic spasms
				有<input type="radio" name="TonicSpasms" value="有" required/>
				無<input type="radio" name="TonicSpasms" value="無" required/>
			</p>
			<p>
				absence seizure
				有<input type="radio" name="AbsenceSeizure" value="有" required/>
				無<input type="radio" name="AbsenceSeizure" value="無" required/>
			</p>
			<p>
				burst supression:<input type="text" name="BurstSupression" required/>
			</p>
			<p>
				hypsarrythmia
				有<input type="radio" name="Hypsarrythmia" value="有" required/>
				無<input type="radio" name="Hypsarrythmia" value="無" required/>
			</p>
			<p>
				3Hz spike-waves:<input type="text" name="3HzSpikeWaves" required/>
			</p>
			<p>
				slow spike-waves (<3HZ):<input type="text" name="SlowSpikeWaves" required/>
			</p>
			<p>
				generalized seizure 
				有<input type="radio" name="GeneralizedSeizure" value="有" required/>
				無<input type="radio" name="GeneralizedSeizure" value="無" required/>
			</p>
			<p>
				cerebral dysfunction  
				有<input type="radio" name="CerebralDysfunction" value="有" required/>
				無<input type="radio" name="CerebralDysfunction" value="無" required/>
			</p>
			<p>
				 曾使用抗癲癇藥物
				<select name="UsedAntiepilepticDrugs" required/>
					<option value=""></option>
					<option value="Dilantin">Dilantin</option>
					<option value="Phenobarbital">Phenobarbital</option>
					<option value="Tegretol">Tegretol</option>
					<option value="Depakine">Depakine</option>
					<option value="Trileptal">Trileptal</option>
					<option value="topamax">topamax</option>
					<option value="Lamictal">Lamictal</option>
					<option value="Sabril">Sabril</option>
					<option value="Lyrica">Lyrica</option>
					<option value="Neurontin">Neurontin</option>
					<option value="Keppra">Keppra</option>
					<option value="Frisium">Frisium</option>
					<option value="Fyconpa">Fyconpa</option>
					<option value="zonisamide">zonisamide</option>
					<option value="lacosamide">lacosamide</option>
				</select>
			</p>
			<p>
				目前使用抗癲癇藥物:<input type="text" name="NowAntiepilepticDrugs" required/>
			</p>
			<p>
				intractable epilepsy
				有<input type="radio" name="IntractableEpilepsy" value="有" required/>
				無<input type="radio" name="IntractableEpilepsy" value="無" required/>
			</p>
			<p>
				autistic feature:<input type="text" name="AutisticFeature" required/>
			</p>
			<p>
				hand stereotype:<input type="text" name="HandStereotype" required/>
			</p>
			<p>
				acquired microcephaly:<input type="text" name="AcquiredMicrocephaly" required/>
			</p>
			<p>
				hypotonia:<input type="text" name="Hypotonia" required/>
			</p>
			<p>
				dysmorphysim epilepsy
				有<input type="radio" name="Dysmorphysim" class="mark" value="有" required/>
				無<input type="radio" name="Dysmorphysim" class="mark" value="無" required/>
			</p>
			<p>
				 MR
				<select name="MR" required/>
					<option value=""></option>
					<option value="mild">mild</option>
					<option value="modereate">modereate</option>
					<option value="severe">severe</option>
					<option value="profound">profound</option>
				</select>
			</p>
			<p>
				 DD
				<select name="DD" required/>
					<option value=""></option>
					<option value="走">走</option>
					<option value="站">站</option>
					<option value="坐">坐</option>
					<option value="(bed ridden)">(bed ridden)</option>
					<option value="expired">expired</option>
				</select>
			</p>
			<p>
				brain CT:<input type="text" name="BrainCT" required/>
			</p>
			<p>
				brain MRI :<input type="text" name="BrainMRI" required/>
			</p>
			<p>
				SPECT:<input type="text" name="SPECT" required/>
			</p>
			<p>
				代謝性檢查:<input type="text" name="MetabolicExamination" required/>
			</p>
			<p>
				CSF 檢查:<input type="text" name="CSF" required/>
			</p>
			<p>
				病變基因 Gene :<input type="text" name="LesionGene" required/>
			</p>
			<p>
				Mutation:<input type="text" name="Mutation" required/>
			</p>
			<p>
				AA change:<input type="text" name="AAChange" required/>
			</p>
			<p>
				Novel/ reported:<input type="text" name="NovelReported" required/>
			</p>
			<p>
				Exon:<input type="text" name="Exon" required/>
			</p>
			<p>
				de novo:<input type="text" name="DeNovo" required/>
			</p>
			<input type="submit" value="送出">
		</form>
	<br>
	<!-- <button id="formsubmit">送出</button> -->
</body>
</html>
