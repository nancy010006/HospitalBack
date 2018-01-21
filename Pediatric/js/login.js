$(document).ready(function(){
	$("#form").submit(function(event){
		event.preventDefault();
        var postdata = (objectifyForm($("#form").serializeArray(),"login"));
        console.log(postdata);

		$.ajax({
            url:'../../model/user/controller.php',
            data:JSON.stringify(postdata),
            type: 'POST',
            async:false,
            success:function(r){
                    result=JSON.parse(r);
                    console.log(result);
                    if(result.status==200){
                        location.href = "user.php";
                    }else{
                        alert(result.query);
                    }
                    // alert(result[0].messege);
            },
            error:function(err){
                    console.log(err);
            }
        });

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