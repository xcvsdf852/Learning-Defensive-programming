<?PHP
require_once("package/Database.php");
require_once("package/str_sql_replace.php");

class new_people{

    public $pa_id; #員工編號
    public $pa_name; #員工名稱

    function insert_people(){
        // echo $this->rule_accompany;
        // exit;

        if (!is_string($this->pa_name)){
            $arry_result["isTrue"] = false;
            $arry_result["errorCod"] = 6;
            $arry_result["mesg"] = "新增人員失敗，資料格式有誤!";
            $arry_result['error'] = $arry_result;
            return $arry_result;
        }

        // 這個檢查比較鬆一點，只要是數字都可以過，不一定要 int 型態
        if (!is_numeric($this->pa_id)){
            $arry_result["isTrue"] = false;
            $arry_result["errorCod"] = 7;
            $arry_result["mesg"] = "新增人員失敗，資料格式有誤!";
            $arry_result['error'] = $arry_result;
            return $arry_result;
        }

        if(!isset($this->pa_id) || empty($this->pa_id)){
            $arry_result["isTrue"] = false;
            $arry_result["errorCod"] = 2;
            $arry_result["mesg"] = "新增人員失敗，資料傳輸失敗!";
            $arry_result['error'] = $arry_result;
            return $arry_result;
        }
        $pa_id = str_SQL_replace($this->pa_id);
        if(!filter_var($pa_id,  FILTER_VALIDATE_INT)){
            $arry_result["isTrue"] = false;
            $arry_result["errorCod"] = 3;
            $arry_result["mesg"] = "新增人員失敗，資料格式有誤!";
            $arry_result['error'] = $arry_result;
            return $arry_result;
        }
        #活動名稱
        if(!isset($this->pa_name) || empty($this->pa_name)){
            $arry_result["isTrue"] = false;
            $arry_result["errorCod"] = 4;
            $arry_result["mesg"] = "新增人員失敗，資料傳輸失敗!";
            $arry_result['error'] = $arry_result;
            return $arry_result;
        }
        $pa_name = str_SQL_replace($this->pa_name);
        if(!filter_var($pa_name,  FILTER_SANITIZE_STRING)){
            $arry_result["isTrue"] = false;
            $arry_result["errorCod"] = 5;
            $arry_result["mesg"] = "新增人員失敗，資料格式有誤!";
            $arry_result['error'] = $arry_result;
            return $arry_result;
        }


        #連結資料庫
        $db = new Database();
        $sql = "INSERT INTO `sign_participant`(`pa_id`,`pa_name`)
                VALUES ('$pa_id','$pa_name')";
        // echo $sql;
        // exit;
        if($db->insert($sql)){
            $arry_result['isTrue'] = true;
            $arry_result['mesg'] = "新增人員成功!";
            $arry_result["errorCod"] = 1;
            $arry_result['error'] = $arry_result;
            return $arry_result;
        }else{
            $arry_result['isTrue'] = false;
            $arry_result['mesg'] = "新增人員失敗，資料庫有誤";
            $arry_result["errorCod"] = 16;
            $arry_result['error'] = $arry_result;
            return $arry_result;
        }
    }

}
?>