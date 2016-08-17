<?PHP
// var_dump($data);
// echo $data['mesg']['rule_id'];
?>
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
                               message: '".$data['mesg']."'
                            }).setType(BootstrapDialog.TYPE_DANGER);
                         });
                       </script>
                       ";
             }
        }
     ?>
     <script type="text/javascript">
          $(document).ready(function(){
               // refreshCount();
               setInterval(refreshCount, 5000);
          });
          function refreshCount(){
               var id = $("#rule_id").val();
               $.post("/sign_up/Regist/get_num",{'id':id},function(d){
                    $("#num_limit").text(d.id);
               })
          }
     </script>
</head>
<body>
     
     <div class = "row">
          <div class="col-md-3">
          </div>
          <div class="col-md-6">
          <!----------內容位置-------------->
               
               <h2 class="form-signin-heading" style= "text-align : center;font-family: DFKai-sb;">活動報名</h2>
               <form class="form-horizontal" role="form" action="<?= Config::$root ?>Regist/Regist_qualifications" method="post">
                    <div class="form-group">
                         <label for="rule_title" class="col-sm-2 control-label">活動名稱</label>
                         <div class="col-sm-10">
                              <?php echo $data['mesg']['rule_title']; ?>
                         </div>
                    </div>
                    <div class="form-group">
                         <label for="rule_limit" class="col-sm-2 control-label">剩餘名額</label>
                         <div class="col-sm-10">
                              <div id="num_limit">
                                   <?php echo $data['mesg']['rule_limit']; ?>
                              </div>
                         </div>
                    </div>
                    <?php if($data['mesg']['rule_accompany'] == 1){?>
                         <div class="form-group">
                              <label for="list_num" class="col-sm-2 control-label">攜伴人數</label>
                              <div class="col-sm-10">
                                   <input type="number" name = "list_num" class="form-control" id="list_num" >
                              </div>
                         </div>
                    <?php } ?>
                    <div class="form-group">
                         <label for="list_pa_id" class="col-sm-2 control-label">員工編號</label>
                         <div class="col-sm-10">
                              <input type="number" name = "list_pa_id" class="form-control" id="list_pa_id" placeholder="請輸入員工編號">
                         </div>
                    </div>
                    <div class="form-group">
                         <label for="list_name" class="col-sm-2 control-label">員工名稱</label>
                         <div class="col-sm-10">
                              <input type="text" name = "list_name" class="form-control" id="list_name" placeholder="請輸入員工名稱">
                         </div>
                    </div>
                    
                    <div class="form-group">
                         <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-info">送出</button>
                         </div>
                    </div>
                    <input type="hidden" name="rule_id"  id ="rule_id" value = "<?php echo $data['mesg']['rule_id'];?>">
               </form>
                

<!----------內容位置結束-------------->
          </div>
          <div class="col-md-3">
          </div>
     </div>

</body>
</html>