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

