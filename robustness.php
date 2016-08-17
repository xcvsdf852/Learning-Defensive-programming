<?php
//Type Hint 類別檢查
class check
{
    public $someObj;

    public function __construct(array $bar, SomeObject $object = null)
    {
        $object = $object ?  : new SomeObject;
        $object->bar = $bar;
        $this->someObj = $object;
    }

    public function getSomeObject()
    {
        return $this->someObj;
    }

}

class SomeObject
{
    public $bar;
    public function each()
    {
        foreach ($this->bar as $value) {
            echo $value."<br>";
        }
    }
}
//主程式
$arr_test = array(1,2,3);
$test = new check($arr_test);
$test->getSomeObject()->each();

echo "<hr>";

//內部檢查
class CheckStringIntArray
{
    public function __construct($string, $int, $array)
    {
        try {
            // 最基本的檢查，型別不對就丟錯
            if (!is_string($string)){
                throw new Exception('Argument 1 should be string.');
            }

            // 這個檢查比較鬆一點，只要是數字都可以過，不一定要 int 型態
            if (!is_numeric($int)){
                throw new Exception('Argument 2 should be a number.');
            }

            // 這個檢查比較特別，如果是 Iterator 物件也能夠接受，因為同樣可以 foreach
            //Traversable检测一个類別是否可以使用 foreach 进行遍历的接口。
            if (!is_array($array) && !($array instanceof Traversable)) {
                throw new Exception('Argument 3 should be Traversable.');
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return;
        }
        $this->show($string, $int, $array);

        // Do some stuff
    }

    public function show($string, $int, $array)
    {
        echo "字串部分 : ".$string."<br>";
        echo "字串部分 : ".$int."<br>";
        echo "以下陣列 : <br>";
        foreach ($array as $value) {
            echo $value."<br>";
        }
        echo "陣列結束 <br>";
    }
}

//測試主程式
$testCheckStringIntArray = new CheckStringIntArray('string',"123",1);

echo '<hr>';
