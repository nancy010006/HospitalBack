var user = "";
var Request = new Object();    
Request = GetRequest();  
function GetRequest() {        
     var url = location.search;   
     var theRequest = new Object();        
     if (url.indexOf("?") != -1) {         
        var str = url.substr(1);           
        strs = str.split("&");         
        for(var i = 0; i < strs.length; i++) {          
           theRequest[strs[i].split("=")[0]]=decodeURI(strs[i].split("=")[1]);         
        }          
     }         
     return theRequest;
} 
var id= Request['id'];
console.log(id);
$(document).ready(function(){
    $.ajax({
        url:'../../model/user/controller.php?act=getfrontuser',
        type: 'GET',
        async:false,
        success:function(r){
                user = r;
        },
        error:function(err){
                console.log(err);
        }
    });
    var getdata = [
        {
            "act":"getcontent"
        },
        {
            "id":id
        }
    ];
    $.ajax({
        url:'../../model/question/controller.php?',
        type: 'POST',
        data:JSON.stringify(getdata),
        async:false,
        success:function(r){
                result=JSON.parse(r);
                console.log(result);
                var key = Object.keys(result['query'][0]);
                console.log(key);
                for(var i=0; i<key.length; i++){
                    var test = result['query'][0][key[i]].split("，");
                    // console.error(result['query'][0][key[i]]);
                    $("select[name='"+key[i]+"']").val(result['query'][0][key[i]]);
                    $("input[name='"+key[i]+"'][type='number']").val(result['query'][0][key[i]]);
                    $("input[name='"+key[i]+"'][type='radio'][value='"+test[0]+"']").attr("checked",true);
                    $("input[name='"+key[i]+"'][type='text']").val(result['query'][0][key[i]]);
                    $("input[name='"+key[i]+"'][type='date']").val(result['query'][0][key[i]]);
                    $("textarea[name='"+key[i]+"']").val(result['query'][0][key[i]]);
                }
                tmp = result['query'][0]["PerinatalInsult"].split("，");
                if(tmp[1])
                    $("input[name='PerinatalInsult'][value='無']").after("<input type='text' name='PerinatalInsult' placeholder='註明' value="+tmp[1]+">");
                tmp = result['query'][0]["Hasepilepsy"].split("，");
                if(tmp[1])
                    $("input[name='Hasepilepsy'][value='無']").after("<input type='text' name='Hasepilepsy' placeholder='註明' value="+tmp[1]+">");
                tmp = result['query'][0]["Dysmorphysim"].split("，");
                if(tmp[1])
                    $("input[name='Dysmorphysim'][value='無']").after("<input type='text' nmae='Dysmorphysim' placeholder='註明' value="+tmp[1]+">");
                tmp = result['query'][0]["MR"].split("，");
                if(tmp[1]){
                    $("input[name='MR'][value='無']").after('<select id="MR" name="MR" required><option value=""></option><option value="mild">mild</option><option value="modereate">modereate</option><option value="severe">severe</option><option value="profound">profound</option></select>');
                    $('#MR').val(tmp[1]);
                }
                tmp = result['query'][0]["DD"].split("，");
                if(tmp[1]){
                    $("input[name='DD'][value='無']").after('<select id="DD" name="DD" required><option value=""></option><option value="走">走</option><option value="站">站</option><option value="坐">坐</option><option value="(bedridden)">(bed ridden)</option><option value="expired">expired</option></select>');
                    $('#DD').val(tmp[1]);
                }
                tmp = result['query'][0]["UsedAntiepilepticDrugs"].split("，");
                pos = tmp.indexOf("其他");
                if(pos!=-1){
                    var input = "<input type='text' placeholder='註明' name='UsedAntiepilepticDrugs' value='"+tmp[pos+1]+"' required>"
                    var next = $("#UsedAntiepilepticDrugs").next().next();
                    if($(!next[0]).get(0)){
                        $("#UsedAntiepilepticDrugs").after(input);
                    }
                }
                $("#UsedAntiepilepticDrugs").val(tmp);
                tmp = result['query'][0]["NowAntiepilepticDrugs"].split("，");
                pos = tmp.indexOf("其他");
                if(pos!=-1){
                    var input = "<input type='text' placeholder='註明' name='NowAntiepilepticDrugs' value='"+tmp[pos+1]+"' required>"
                    var next = $("#NowAntiepilepticDrugs").next().next();
                    if($(!next[0]).get(0)){
                        $("#NowAntiepilepticDrugs").after(input);
                    }
                }
                $("#NowAntiepilepticDrugs").val(tmp);

                tmp = result['query'][0]["Diagnosis"].split("，");
                pos = tmp.indexOf("其他");
                if(pos!=-1){
                    var input = "<input type='text' placeholder='註明' name='Diagnosis' value='"+tmp[pos+1]+"' required>"
                    var next = $("#Diagnosis").next().next();
                    if($(!next[0]).get(0)){
                        $("#Diagnosis").after(input);
                    }
                }
                $("#Diagnosis").val(tmp);

                tmp = result['query'][0]["FocalSpikes"].split("，");
                pos = tmp.indexOf("其他");
                if(pos!=-1){
                    var input = "<input type='text' placeholder='註明' name='FocalSpikes' value='"+tmp[pos+1]+"' required>"
                    var next = $("#FocalSpikes").next().next();
                    if($(!next[0]).get(0)){
                        $("#FocalSpikes").after(input);
                    }
                }
                $("#FocalSpikes").val(tmp);
        },
        error:function(err){
                console.log(err);
        }
    });
    $("input").attr("disabled",true);
    $("select").attr("disabled",true);
    // $("textarea").attr("disabled",true);
    // $("#response").attr("disabled",true);

    //編輯用
    $("input[type='radio'][value='有'][class='mark']").click(function(){
        var input = "<input type='text' placeholder='註明' name='"+this.name+"' required/>"
        var next = $(this).next().next();
        if($(!next[0]).get(0))
            $(this).next().after(input);
    });
    $("input[type='radio'][value='無'][class='mark']").click(function(){
        // console.log($(this));
        var next = $(this).next();
        $(next).remove();
    });
    $("#Birthday").change(function(){
        var D1=new Date;
        var D2=new Date($("#Birthday").val());
        var Compare=Date.parse(D1.toString())-Date.parse(D2.toString()); //相差毫秒數
        var month=Compare/(1000*60*60*24*30); //相差月數
        var year = parseInt(month/12);
        var month = parseInt(month%12);
        $("#age").val(year+"歲"+month+"個月");
    });
    $(".DD").click(function(){
        if($(this).val()=="有"){
            var input = '<select name="DD" required><option value=""></option><option value="走">走</option><option value="站">站</option><option value="坐">坐</option><option value="(bedridden)">(bed ridden)</option><option value="expired">expired</option></select>';
            console.log(input);
            var next = $(this).next().next();
            if($(!next[0]).get(0))
                $(this).next().after(input);
        }else{
            var next = $(this).next();
            $(next).remove();
        }
    });
    //MR處理
    $(".MR").click(function(){
        if($(this).val()=="有"){
            var input = '<select name="MR" required><option value=""></option><option value="mild">mild</option><option value="modereate">modereate</option><option value="severe">severe</option><option value="profound">profound</option></select>';
            console.log(input);
            var next = $(this).next().next();
            if($(!next[0]).get(0))
                $(this).next().after(input);
        }else{
            var next = $(this).next();
            $(next).remove();
        }
    });
    $("select").change(function(){
        console.log($(this).val());
        console.log();
        if($(this).val().indexOf("其他")!=-1){
            var next = $(this).next();
            $(next).remove();
            var input = "<input type='text' placeholder='註明' name='"+this.name+"' required/>"
            var next = $(this).next().next();
            if($(!next[0]).get(0)){
                $(this).after(input);
            }
        }else{
            var next = $(this).next();
            $(next).remove();
        }
        if($(this).val().indexOf("無")!=-1){
            $(this).val("無");
        }
    });
    $("#submit").click(function(){
        var r = confirm("要送出回覆嗎?");
        if(r){
            var response = $("#response").val();
            var postdata = [
                {
                    "act":"response"
                },
                {
                    "id":id,
                    "response":response
                }
            ];
            $.ajax({
                url:'../../model/question/controller.php',
                type: 'POST',
                data: JSON.stringify(postdata),
                async:false,
                success:function(r){
                        var result = JSON.parse(r);
                        alert(result[0].messege);
                        location.href="allresponse.html";
                },
                error:function(err){
                        console.log(err);
                }
            });
        }
    })
})
function objectifyForm(formArray,actvalue) {//serialize data function
        var returnArray=[];
        var actObject = {};
        actObject.act=actvalue;
        var formObject = {};
        for (var i = 0; i < formArray.length; i++){
                if(formArray[i]['name']!=tmp)
                    formObject[formArray[i]['name']] = formArray[i]['value'];
                else
                    formObject[formArray[i]['name']] += "，"+formArray[i]['value'];
                var tmp =formArray[i]['name'];
        }
        returnArray.push(actObject);
        returnArray.push(formObject);
        return returnArray;
}