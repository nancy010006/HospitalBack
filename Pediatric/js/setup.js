$(document).ready(function(){
	$("#form").submit(function(event){
		event.preventDefault();
		var postdata = (objectifyForm($("#form").serializeArray(),"adduser"));
		if(postdata[1].pwd!=postdata[1].pwdconfirm){
			alert("兩次密碼輸入不一致，請重新輸入");
		}else{
			delete postdata[1].pwdconfirm;
			console.log(JSON.stringify(postdata));
			$.ajax({
                url:'../../model/user/controller.php',
                data:JSON.stringify(postdata),
                type: 'POST',
                async:false,
                success:function(r){
                        // console.log(r);
                        result=eval(r);
                        console.log(result);
                        alert(result[0].messege);
                        location.href="index.html";
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