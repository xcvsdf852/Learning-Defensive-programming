<?PHP
require_once('models/RegistSingleton.php');
class RegistController extends Controller{
     
     #報名活動頁
     function index($id = 0){
          // if($id == 0){
          //      $arry_result['mesg'] = "活動報名網址有誤";
          //      $this->view('error',$arry_result);
          // }
          $user=$this->model("check_action");
          #檢查該筆活動日期是否可以報名
          $arry_result = $user->check_date($id);
          // var_dump($arry_result);
          // exit;
          if($arry_result["isTrue"]){
               unset($arry_result["isTrue"]);
               $this->view('Regist',$arry_result);
               return;
          }else{
               $this->view('error',$arry_result);
               return;
          }
          
     }
     #檢查報名資格check_qualifications
     function Regist_qualifications(){
          // var_dump($_POST);
          // exit;
          $user=$this->model("Regist_participant");
          $user->POST_data = $_POST;
          $arry_result = $user->check_qualifications();
          // var_dump($arry_result);
          // exit;
          #當資料有誤時導至錯誤訊息顯示頁
          if(!$arry_result['isTrue']){
               $this->view('error',$arry_result);
               return;
          }
          #檢查該活動剩餘名額
          // $check_action = $this->model("check_action");
          // $limit_num = $check_action->get_now_num($user->rule_id);

          // if($user->list_num > $limit_num){
          //      $arry_result['mesg'] = "已超過報名人數";
          //      $this->view('error',$arry_result);
          //      return;
          // }
          #開始報名
          $RegistSingleton = $test1 = RegistSingleton::Sign_up();
          if(is_null($RegistSingleton)){
               $arry_result['mesg'] = "系統忙碌，請稍後嘗試!";
               $arry_result['id'] = $user->rule_id;
               $this->view('error',$arry_result);
               return;
          }
                                                       #編號        #名稱             #報名人數      #報名規則編號
          $arry_result = $RegistSingleton->Regist($user->list_pa_id,$user->list_name,$user->list_num,$user->rule_id);
          $RegistSingleton->return_qualifications($RegistSingleton); #歸還資格
          $this->view('error',$arry_result);

          
     }
     

     // 參與者列表
     // function participant_list($n){
     //      $this->view('Backstage_list',$n);
     // }
     
     #活動列表自動更新報名人數
     function get_num(){
          $check_action = $this->model("check_action");
          $limit_num['id'] = $check_action->get_now_num($_POST['id']);
          $this->view("show_json",json_encode($limit_num));
     }
}
?>