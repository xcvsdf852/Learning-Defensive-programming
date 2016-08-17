<?php
require_once("package/Database.php");
require_once("package/str_sql_replace.php");
class check_people_num{
    public $pa_id;
    function check_num(){

        if (!is_numeric($this->pa_id)){
            return '{"callback":1}';
        }

        #檢查id 資料格式
        if(!isset($this->pa_id) || empty($this->pa_id)){
            return '{"callback":1}';
        }
        $pa_id = str_SQL_replace($this->pa_id);
        if(!filter_var($pa_id,  FILTER_VALIDATE_INT)){
            return '{"callback":1}';
        }
        $sql = "SELECT  COUNT(*)  as C
                FROM  `sign_participant`
                WHERE  `pa_id` = '$pa_id'
                ";
        // echo $sql;
        // exit;
        $db = new Database();
        $row = $db->select($sql);
        // var_dump($row);
        // exit;
        if($row[0]['C'] > 0 ){
            return '{"callback":0}';

        }else{
            return '{"callback":1}';

    	}
    }
}


?>