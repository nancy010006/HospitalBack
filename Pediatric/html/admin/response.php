<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" NAME="ROBOTS" CONTENT="NOARCHIVE"/>
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<title>問卷頁面</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../../js/response.js"></script>
<style type="text/css">
/*#chpartarea{
  position: fixed;
  bottom: 85%;
  left: 50%;
  background-color: white;
}*/
#response{
	height: 20%;
	width: 35%;
	position: fixed;
  	bottom: 50px;
  	right: 50px;
  	background-color: white
}
.area{
	height: 100px;
	width: 200px;
  	background-color: white
}
#submit{
	position: fixed;
  	bottom: 20px;
  	right: 50px;
}
</style>
</head>
<body>
	<form id="dataform">
			<table>
				<tr>
					<td>Name:</td>
					<td><input type="text" name="Name" required/></td>
				</tr>
				<tr>
					<td>性別</td>
					<td>
						男<input type="radio" name="Gender" value="男" required/>
						女<input type="radio" name="Gender" value="女" required/>
					</td>
				</tr>
				<tr>
					<td>出生年月日:</td>
					<td>
						<input id="Birthday" type="date" name="Birthday" required/>
					</td>
				</tr>
				<tr>
					<td>懷孕週數:</td>
					<td><input type="number" name="week" required/></td>
				</tr>
				<tr>
					<td>胎次:</td>
					<td>
						<input type="text" name="Parity" required/>
					</td>
				</tr>
				<tr>
					<td>出生體重:</td>
					<td><input type="number" name="weight" required/>公克</td>
				</tr>
				<tr>
					<td>出生頭圍:</td>
					<td><input type="number" name="BirthHeadWidth" required/>公分</td>
				</tr>
				<tr>
					<td>現在頭圍:</td>
					<td><input type="number" name="NowHeadWidth" required/>公分</td>
				</tr>
				<tr>
					<td>PerinatalInsult</td>
					<td>
						有<input type="radio" name="PerinatalInsult" class="mark" value="有" required/>
						無<input type="radio" name="PerinatalInsult" class="mark" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>目前年齡:</td>
					<td><input id="age" type="text" name="Age" required/></td>
				</tr>
				<tr>
					<td>家長是否有癲癇</td>
					<td>
						有<input type="radio" name="Hasepilepsy" class="mark" value="有" required/>
						無<input type="radio" name="Hasepilepsy" class="mark" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>診斷</td>
					<td>
						<select id="Diagnosis" name="Diagnosis" multiple="multiple" size="15" required/>
							<option value="無">無</option>
							<option value="EIEE">EIEE</option>
							<option value="EME">EME</option>
							<option value="IS">IS</option>
							<option value="West Syndrome">West Syndrome</option>
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
						(壓著鍵盤左下角ctrl鍵+滑鼠點擊即可多選)
					</td>
				</tr>
				<tr>
					<td>第一次癲癇發作年齡:</td>
					<td><input type="text" name="SeizureOnset" required/></td>
				</tr>
				<tr>
					<td>點頭癲癇</td>
					<td>
						有<input type="radio" name="InfantileSpasms" value="有" required/>
						無<input type="radio" name="InfantileSpasms" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>熱性痙攣</td>
					<td>
						有<input type="radio" name="HeatSpasm" value="有" required/>
						無<input type="radio" name="HeatSpasm" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>seizure cluster during fever </td>
					<td>
						有<input type="radio" name="SeizureClusterDuringFever" value="有" required/>
						無<input type="radio" name="SeizureClusterDuringFever" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>seizure status with fever</td>
					<td>
						有<input type="radio" name="SeizureStatusWithFever" class="mark" value="有" required/>
						無<input type="radio" name="SeizureStatusWithFever" class="mark" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>GTC</td>
					<td>
						有<input type="radio" name="GTC" value="有" required/>
						無<input type="radio" name="GTC" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>partial seizure</td>
					<td>
						有<input type="radio" name="PartialSeizure" value="有" required/>
						無<input type="radio" name="PartialSeizure" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>tonic spasms</td>
					<td>
						有<input type="radio" name="TonicSpasms" value="有" required/>
						無<input type="radio" name="TonicSpasms" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>absence seizure</td>
					<td>
						有<input type="radio" name="AbsenceSeizure" value="有" required/>
						無<input type="radio" name="AbsenceSeizure" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>burst supression:</td>
					<td>
						有<input type="radio" name="BurstSupression" value="有" required/>
						無<input type="radio" name="BurstSupression" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>hypsarrythmia</td>
					<td>
						有<input type="radio" name="Hypsarrythmia" value="有" required/>
						無<input type="radio" name="Hypsarrythmia" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>3-6Hz spike-waves:</td>
					<td>
						有<input type="radio" name="3_6HzSpikeWaves" value="有" required/>
						無<input type="radio" name="3_6HzSpikeWaves" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>3Hz spike-waves:</td>
					<td>
						有<input type="radio" name="3HzSpikeWaves" value="有" required/>
						無<input type="radio" name="3HzSpikeWaves" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>slow spike-waves (<3HZ):</td>
					<td>
						有<input type="radio" name="SlowSpikeWaves" value="有" required/>
						無<input type="radio" name="SlowSpikeWaves" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>generalized spikes-waves</td>
					<td>
						有<input type="radio" name="GeneralizedSeizure" value="有" required/>
						無<input type="radio" name="GeneralizedSeizure" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>focal spikes:</td>
					<td>
						<select id="FocalSpikes" name="FocalSpikes" multiple="multiple" size="9" required/>
							<option value="無">無</option>
							<option value="Lt frontal">Lt frontal</option>
							<option value="Lt temporal">Lt temporal</option>
							<option value="Lt parietal">Lt parietal</option>
							<option value="Lt occipital">Lt occipital</option>
							<option value="Rt frontal">Rt frontal</option>
							<option value="Rt temporal">Rt temporal</option>
							<option value="Rt parietal">Rt parietal</option>
							<option value="Rt occipital">Rt occipital</option>
						</select>
						(壓著鍵盤左下角ctrl鍵+滑鼠點擊即可多選)
					</td>
				</tr>
				<tr>
					<td>cerebral dysfunction</td>
					<td>
						有<input type="radio" name="CerebralDysfunction" value="有" required/>
						無<input type="radio" name="CerebralDysfunction" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>曾使用抗癲癇無效藥物</td>
					<td>
						<select id="UsedAntiepilepticDrugs" name="UsedAntiepilepticDrugs" multiple="multiple" size="17" required/>
							<option value="無">無</option>
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
							<option value="生酮飲食">生酮飲食</option>
							<option value="其他">其他</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>目前使用抗癲癇藥物:</td>
					<td>
						<select id="NowAntiepilepticDrugs" name="NowAntiepilepticDrugs" multiple="multiple" size="17" required/>
							<option value="無">無</option>
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
							<option value="生酮飲食">生酮飲食</option>
							<option value="其他">其他</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>intractable epilepsy</td>
					<td>
						有<input type="radio" name="IntractableEpilepsy" value="有" required/>
						無<input type="radio" name="IntractableEpilepsy" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>autistic feature:</td>
					<td>
						有<input type="radio" name="AutisticFeature" value="有" required/>
						無<input type="radio" name="AutisticFeature" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>ADHD:</td>
					<td>
						有<input type="radio" name="ADHD" value="有" required/>
						無<input type="radio" name="ADHD" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>hand stereotype:</td>
					<td>
						有<input type="radio" name="HandStereotype" value="有" required/>
						無<input type="radio" name="HandStereotype" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>acquired microcephaly:</td>
					<td>
						有<input type="radio" name="AcquiredMicrocephaly" value="有" required/>
						無<input type="radio" name="AcquiredMicrocephaly" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>hypotonia:</td>
					<td>
						有<input type="radio" name="Hypotonia" value="有" required/>
						無<input type="radio" name="Hypotonia" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>dysmorphysim epilepsy</td>
					<td>
						有<input type="radio" name="Dysmorphysim" class="mark" value="有" required/>
						無<input type="radio" name="Dysmorphysim" class="mark" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>MR</td>
					<td>
						有<input type="radio" name="MR" class="MR" value="有" required/>
						無<input type="radio" name="MR" class="MR" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>DD</td>
					<td>
						有<input type="radio" name="DD" class="DD" value="有" required/>
						無<input type="radio" name="DD" class="DD" value="無" required/>
					</td>
				</tr>
				<tr>
					<td>brain CT:</td>
					<td><input type="text" name="BrainCT" required/></td>
				</tr>
				<tr>
					<td>brain MRI :</td>
					<td><input type="text" name="BrainMRI" required/></td>
				</tr>
				<tr>
					<td>SPECT:</td>
					<td><input type="text" name="SPECT" required/></td>
				</tr>
				<tr>
					<td>代謝性檢查:</td>
					<td><input type="text" name="MetabolicExamination" required/></td>
				</tr>
				<tr>
					<td>CSF 檢查:</td>
					<td><input type="text" name="CSF" required/></td>
				</tr>
				<tr>
					<td>病變基因 Gene :</td>
					<td><input type="text" name="LesionGene"></td>
				</tr>
				<tr>
					<td>Mutation:</td>
					<td><input type="text" name="Mutation"></td>
				</tr>
				<tr>
					<td>AA change:</td>
					<td><input type="text" name="AAChange"></td>
				</tr>
				<tr>
					<td>Novel/ reported:</td>
					<td><input type="text" name="NovelReported"></td>
				</tr>
				<tr>
					<td>Exon:</td>
					<td><input type="text" name="Exon"></td>
				</tr>
				<tr>
					<td>de novo:</td>
					<td><input type="text" name="DeNovo"></td>
				</tr>
				<textarea id="response" name="Response" placeholder="回覆"></textarea>
			</table>
		</form>
		<button id="submit">送出回覆</button>
	<br>
</body>
</html>
