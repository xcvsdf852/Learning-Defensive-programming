<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Config::$projectName ?></title>

    <link href="<?= Config::$cssRoot ?>jquery-ui.min.css" rel="stylesheet" />

    <link href="<?= Config::$cssRoot ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?= Config::$cssRoot ?>bootstrap-dialog.min.css" rel="stylesheet">

    <script src="<?= Config::$jsRoot ?>jquery.js"></script>
    <script src="<?= Config::$jsRoot ?>jquery-ui.min.js"></script>
    <script src="<?= Config::$jsRoot ?>bootstrap.min.js"></script>
    <script src="<?= Config::$jsRoot ?>bootstrap-dialog.min.js"></script>
    <script>
        $(document).ready(function(){
            get_people();
        });
        function get_people(){
            $.post("get_people",function(d){
        		  // console.log(d);
          		  if(d.isTrue){
                    i=0;
                    $("#content").html("");
                    $.each(d.date,function(){
                        $("#content").append(
                            '<tr id = "row_'+d.date[i].pa_id+'">'
                                  +'<th scope="row"></th>'
                                  +'<td id = "pa_id_'+d.date[i].pa_id+'">'+d.date[i].pa_id+'</td>'
                                  +'<td id = "pa_name_'+d.date[i].pa_id+'">'+d.date[i].pa_name+'</td>'
                             +'</tr>'
                        );
                        i++;
                    });
          		  }else{
          		    BootstrapDialog.show({
                        title: 'Oops 系統發生錯誤!',
                        message: d.mesg
                    }).setType(BootstrapDialog.TYPE_DANGER);;
                  return false;
          		  }

          		//   $("#P").val(P);
          		//   $("#P_number").val(P_number);
          		//   var c=d.page_num;
          		//   $("#tage").load('/homework0721_MVC/models/package/Tage.php?P='+P+'&P_number='+P_number+'&count_num='+c+'&function=list_load');
        	  },"json");
    	  }
        function check_num(){
                $.ajax({
        			    type: 'POST',
        		    	url: 'check_num',
        		    	data:{
        		    	  pa_id:$("#pa_id").val()
        		    	},
        			    dataType: "json",
        			    success: function(data){
                        //console.log(data);
        				    if(data.callback==1){
                                $("#check").val(1);
                              }else{
                                BootstrapDialog.show({
                                  title: 'Oops 系統發生錯誤!',
                                  message: '員工編號有誤，請再次確認!'
                                }).setType(BootstrapDialog.TYPE_DANGER);
                                $("#check").val(0);
                              }
                        }
                });

        }
        var istrue=false;
        function ch_submit(){
            // alert('123');
        	istrue=ch_val();
        	if(istrue){
                document.getElementById("form").submit();
             }
        }
        function ch_val(){
        	if($("#check").val() != 1){
                BootstrapDialog.show({
    				title: 'Oops 系統發生錯誤!',
    				message: '員工編號有誤，請再次確認!'
				}).setType(BootstrapDialog.TYPE_DANGER);
        		$("#txtUserName").focus();
        		istrue=false;
        		return false;
        	}
        	if($("#pa_id").val()==""){
                BootstrapDialog.show({
    				title: 'Oops 系統發生錯誤!',
    				message: '請填寫員工編號!'
				}).setType(BootstrapDialog.TYPE_DANGER);
                $("#pa_id").focus();
                istrue=false;
                return false;
            }

        	if($("#pa_name").val()==""){
                BootstrapDialog.show({
    				title: 'Oops 系統發生錯誤!',
    				message: '請確實填寫資料！'
				}).setType(BootstrapDialog.TYPE_DANGER);
                $("#pa_name").focus();
        		istrue=false;
        		return false;
    	    }else{
    	        istrue=true;
        		return istrue;
    	    }
		}

    </script>
    <style>
        .form-control{
                display: inline;
                width: 40%;
        }
    </style>
    <?php
        if(isset($data['isTrue'])){
             if($data['isTrue']){
                 echo "<script>
                         $(document).ready(function(){
                           BootstrapDialog.show({
                            title: '執行操作成功!',
                            message: '".$data['mesg']."'
                           }).setType(BootstrapDialog.TYPE_SUCCESS);
                         });
                       </script>
                       ";
             }else{
                 echo "<script>
                         $(document).ready(function(){
                            BootstrapDialog.show({
                               title: 'Oops 系統發生錯誤!',
                               message: '".$data['mesg'].$data["errorCod"]."'
                            }).setType(BootstrapDialog.TYPE_DANGER);
                         });
                       </script>
                       ";
             }
        }
     ?>
</head>
<body>
     <div class="header"><?php require_once('views/header.html');?></div>
     <div class = "row">
          <div class="col-md-2">
          </div>
          <div class="col-md-8">
          <!----------內容位置-------------->
               <form role="form" action="create_people" method="post" id="form">
                   <!--<div id="account_set">-->
                       <!--<span id='account_message'></span>-->
                       <input type="number" name = "pa_id"  id="pa_id" class="form-control" size ="10" placeholder="請輸入員工編號" onBlur = "check_num()">
                    <!--</div>-->
                   <input type="text" name = "pa_name" id="pa_name" class="form-control" size ="10" placeholder="請輸入員工名稱">
                   <button type="button" class="btn btn-info" onclick="ch_submit();">送出</button>
               </form>
               <ht>
               <table class="table table-hover">
                  <thead class="thead-inverse">
                    <tr>
                      <th>#</th>
                      <th>員工編號</th>
                      <th>員工名稱</th>
                      <!--<th>修改</th>-->
                      <!--<th>刪除</th>-->
                    </tr>
                  </thead>
                  <tbody id="content">


                  </tbody>
                </table>
                <input type="hidden" id="check" value="0">
                <div class="pagination" id="tage" align="center" style="width:100%;">

                </div>

<!----------內容位置結束-------------->
          </div>
          <div class="col-md-2">
          </div>
     </div>

</body>
</html>