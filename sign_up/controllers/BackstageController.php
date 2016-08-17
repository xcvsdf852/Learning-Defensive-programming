<?PHP

class BackstageController extends Controller{

     #新增報名活動頁
     function index(){
          $this->view('Backstage_index');
     }
     #活動報名列表頁
     function sign_list(){
          $this->view('Backstage_list');
     }
     #取得所有活動資料列表
     function get_all_sign_rule(){
          $user=$this->model("sign_rule_list");
          $this->view("show_json",$user->get_all_rule_list());
     }

     //參與者列表 用bouuton 連接
     function get_participant_list($n = 0){

          if (!is_numeric($n) || $n == 0) {
               $ary_return['error'] = "資料型態有誤";
               $this->view("Backstage_participant_list",$ary_return);
          }

          $user=$this->model('participant_list');
          $ary_return = $user->now_participant_list($n);
          // var_dump($ary_return);
          // exit;
          $this->view("Backstage_participant_list",$ary_return);
     }

     #要勾選參予者名單
     function get_account_list(){
          $user=$this->model("account_list");
          $this->view("show_json",$user->get_list());
     }

     #新增報名規則
     function create_sign(){
          // var_dump($_POST);
          // exit;
          $user=$this->model("new_sign");
          $user->rule_title = $_POST['rule_title']; #活動名稱
          $user->rule_limit = $_POST['rule_limit']; #限制人數
          $user->rule_accompany = $_POST['rule_accompany']; #是否可以攜伴 1:是 0:否
          $user->rule_start_time = $_POST['rule_start_time']; #報名開始時間
          $user->rule_end_time = $_POST['rule_end_time'];  #報名截止時間
          $user->rule_content = $_POST['rule_content']; #活動內容
          $user->account = $_POST['account']; #人員 陣列

          $ary_return = $user->insert_sign();
          // var_dump($ary_return);
          // exit;
          if($ary_return['isTrue']){
               $this->view('Backstage_list',$ary_return);
          }else{
               $this->view('Backstage_index',$ary_return);
          }
     }

     #新增人員頁
     function people(){
          $this->view('Backstage_people');
     }

     #取得人員清單
     function get_people(){
          $user=$this->model('get_people_list');
          $this->view("show_json",$user->get_people_list_json());
     }
     #檢查員工編號是否已有註冊
     function check_num(){
          $user=$this->model('check_people_num');
          $user->pa_id = $_POST['pa_id'];
          $this->view("show_json",$user->check_num());
     }

     #新增人
     function create_people(){
          $user=$this->model('new_people');
          $user->pa_id = $_POST['pa_id'];
          $user->pa_name =$_POST['pa_name'];
          $arry_result = $user->insert_people();
          $this->view('Backstage_people',$arry_result );
     }

}
?>