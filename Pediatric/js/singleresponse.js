var dataTable;
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
var account= Request['account'];
console.log(account);
$(document).ready(function() {
    $('#table tfoot th').each( function (index) {
        if(index!=0){
            var title = $(this).text();
            $(this).html( '<input class="search" type="text" placeholder="Search '+title+'" />' );
        }
    });
    filter();
    $(".index").click(function(event){
        event.preventDefault();
        window.location.href = "index.html";
    })
    $("#selectall").click(function(event){
        // event.preventDefault();
        if($("#selectall").prop("checked")==true){
            $("input").prop("checked",true);
            $("tr").toggleClass('selected',true);
        }else{
            $("input").prop("checked",false);
            $("tr").toggleClass('selected',false);
        }
    });
    $("input[name='type']").click(function(){
        dataTable.destroy();
        filter();
    })
    $('#table tbody').on( 'dblclick', 'tr', function () {      
        var id = dataTable.rows(this).data()[0][0];  
        location.href = "response.php?id="+id;
    });
    $("#detail").on("click", function(){
        var length = dataTable.rows('.selected').data().length;
        if(length>1){
            alert("一次只能查看一項");
        }else if(length<1){
            alert("請選擇要查看的項目");
        }else{
            var id = dataTable.rows('.selected').data()[0][0];
            location.href = "response.php?id="+id;
        }
    });
});
function filter(){
    var i=0;
    // $("#filter").attr("style","display:none");
    // $("#reset").attr("style","display:block");
    $("#tbody").empty();
    var which = $("#which").serialize().split("=");
    var startday=$("#startday").val();
    var endday=$("#endday").val();
    var data ={"data": [{"act":"DataTablegetDatabyadmin"},{"type":which[1],"account":account}]};
    // console.log('../Question/controller.php?act=getQuestionListbydate&startday='+startday+'&endday='+endday);
    dataTable = $('#table').DataTable( {
        "drawCallback": function( settings ) {
            $('input').on( 'click', function () {
                $(this.closest("tr")).toggleClass('selected');
            });
        },
        "processing": true,
        "serverSide": true,
        "ajax":{
            url :"../../model/question/controller.php", // json datasource
            // url :"../ptt_online/question/test.php", // json datasource
            data: data,
            type: "post",  // method  , by default get
            // success:function(r){
            //  console.log(r);
            // },
            dataSrc: function ( json ) {
                //Make your callback here.
                console.log(json);
                if(json[0].status==204){
                    // $(".employee-grid-error").html("");
                    // $("#table").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#employee-grid_processing").css("display","none");
                    return false;
                }
                else
                    return json.data;
            },
            error: function(r){  // error handling
                console.log(r);
                $(".employee-grid-error").html("");
                $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#employee-grid_processing").css("display","none");
                
            }
        },
        "order": [[ 2, 'asc' ]],
        'aoColumnDefs' : [
            {
                "aTargets" :　[0],  
                "orderable": false,
                "mRender" : function(data, type, full){  
                    var EditLinkText = "<input type='checkbox'/>";
                       return EditLinkText;
                }
            },
            {
                "aTargets" :　[1],  
                "visible" :false
            },
            {
                "aTargets" :　["_all"],  
                "mRender" : function(data, type, full,a){
                    return full[a.col-1];
                }  
            }
        ],
        "bProcessing" : true,
        "lengthMenu": [[10, 25, 50, 100,500,1000, -1], [10, 25, 50, 100,500,1000, "All"]],
        dom: 'lfrtpB<"bottom"i>',
        buttons: [{
                extend: 'excelHtml5',
                text: '匯出全部',
                exportOptions: {
                    columns: ':visible:not(.not-exported)'
                },
                title: 'Data export'
            }, {
                extend: 'excelHtml5',
                text: '匯出勾選項目',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    modifier: {
                        selected: true
                    }
                },
                title: '回覆資料'
            }
        ],
        select: {
            style: 'multi',
            selector: 'td:first-child input'
        }
        // initComplete: function () {
        //     this.api().columns().every( function () {
        //         var column = this;
        //         var select = $('<select><option value=""></option></select>')
        //             .appendTo( $(column.footer()).empty() )
        //             .on( 'change', function () {
        //                 var val = $.fn.dataTable.util.escapeRegex(
        //                     $(this).val()
        //                 );
 
        //                 column
        //                     .search( val ? '^'+val+'$' : '', true, false )
        //                     .draw();
        //             } );
 
        //         column.data().unique().sort().each( function ( d, j ) {
        //             select.append( '<option value="'+d+'">'+d+'</option>' )
        //         } );
        //     } );
        // }
    });
    dataTable.columns().every( function () {
        var that = this;
        $( 'input[class="search"]', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
                    $("input").prop("checked",false);
            }
        });
    });
}