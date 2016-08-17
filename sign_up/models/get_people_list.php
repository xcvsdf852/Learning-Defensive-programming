<?php
require_once("package/Database.php");

class get_people_list{
    function get_people_list_json(){
            $sql = "SELECT  * 
                    FROM  `sign_participant` 
                    WHERE  1 
                    ";
            $db = new Database();
            $row = $db->select($sql);
            // var_dump($row);
            $arry_return["isTrue"] = true;
            $arry_return["date"]  = $row;
            // echo json_encode($arry_return);
            // exit;
            return json_encode($arry_return);
    }
}

// $a = new get_people_list;
// $a->get_now_num();
?>