var user = "";
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
	$("#Birthday").change(function(){
		var D1=new Date;
		var D2=new Date($("#Birthday").val());
		var Compare=Date.parse(D1.toString())-Date.parse(D2.toString()); //相差毫秒數
		var month=Compare/(1000*60*60*24*30); //相差月數
		var year = parseInt(month/12);
		var month = parseInt(month%12);
		$("#age").val(year+"歲"+month+"個月");
	})
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

    //DD處理
    $(".DD").click(function(){
        if($(this).val()=="有"){
            var input = '<select name="DD" required><option value=""></option><option value="走">走</option><option value="站">站</option><option value="坐">坐</option><option value="(bedridden)">(bed ridden)</option><option value="expired">expired</option></select>';
            // console.log(input);
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
            // console.log(input);
            var next = $(this).next().next();
            if($(!next[0]).get(0))
                $(this).next().after(input);
        }else{
            var next = $(this).next();
            $(next).remove();
        }
    });
    // $(".DD").click(function(){
    //     // console.log($(this));
    //     var next = $(this).next();
    //     $(next).remove();
    // });
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
    $("#dataform").submit(function(event){
    	event.preventDefault();
		var postdata = (objectifyForm($("#dataform").serializeArray(),"addCase"));
		var parity = postdata[1].parity;
		console.log(parity);
    	var str = parity.split("，");
    	postdata[1].parity = str[0]+"G"+str[1]+"P";

        var SeizureOnset = postdata[1].SeizureOnset;
        console.log(SeizureOnset);
        var str = SeizureOnset.split("，");
        postdata[1].SeizureOnset = str[0]+"歲"+str[1]+"個月"+str[2]+"天";

    	postdata[1].account = user;
    	// console.error(postdata);
    	// console.log(JSON.stringify(postdata));
        $.ajax({
            url:'../../model/question/controller.php',
            data:JSON.stringify(postdata),
            type: 'POST',
            async:false,
            success:function(r){
                    // console.log(r);
                    result=eval(r);
                    console.log(result);
                    alert(result[0].messege);
                    location.href = "user.php";
            },
            error:function(err){
                    console.log(err);
            }
        });
    });
    // $("input[type='radio'][value='無']").attr("checked",true);
    // $("input[type='text']").val("123");
    // $("input[type='number']").val("5");
    // $("input").val("test");
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