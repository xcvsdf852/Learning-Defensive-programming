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


$x = "5";
$number = (int)$x;
echo $number; //輸出 5

$x = "foo";
$arr = (array)$x;
echo $arr[0]; //輸出 "foo"

$x = "foo";
$obj = (object)$x;//public $scalar => string(3) "foo"
echo $obj->scalar."<br>"; //輸出 "foo"
var_dump($obj);
echo '<hr>';

function foo($array)
{
    if (is_object($array))
    {
        // 用正確的方法取得 properties(屬性) 轉陣列
        $array = get_object_vars($array);
        // 或者也可以轉成第一個元素，行為不一樣
        $array = array($array);
    }
    foreach ((array) $array as $val)
    {
        echo $val;
    }
    print_r($array);
}

class TestProperties
{
    private $a;
    public $b = 1;
    public $c;
    private $d;
    static $e;

    public function test() {
        var_dump(get_object_vars($this));
    }
}

$testProperties = new TestProperties;
foo($testProperties);
//Array ( [0] => Array ( [b] => 1 [c] => ) )
foo('string');
//string
echo "<hr>";

class a {
  var $name = 'fillano';
  function show() {
    echo $this->name."\n";
  }
}
class b {
  var $name = 'hildegard';
  function show() {
    echo $this->name."\n";
  }
}
function testa(a $a) {
  $a->show();
}
testa(new a);
// testa(new b); //會錯誤

function testarr(array $a) {
  echo $a[0]."\n";
}
testarr(array('fillano'));
// testarr(array('k'=>'v'));
// testarr('string');
echo "<hr>";

class c {
  var $name = "fillano\n";
  function show() {
    echo $this->name;
  }
}
function testcb(callable $f) {
  $f();
}
function show() {
    echo "fillano\n";
}
function functionName() {
    echo "Name";
}

testcb(function(){echo "fillano\n";}); //fillano
testcb(array(new c, 'show')); //fillano
testcb('show');//fillano
testcb('functionName');//fillano
call_user_func('functionName');
call_user_func(array(new c, 'show'));
// testcb('string');//傳入的字串，PHP找不到同名的函數，就會出錯

echo "<hr>";

class d {
}
function testnull(d $d=NULL) {
  var_dump($d);
}
testnull(new d);// class d#6 (0) { }
testnull(NULL);//NULL

echo "<hr>";

interface e {
  function show();
}
class f implements e {
  var $name = "fillano\n";
  function show() {
    echo $this->name;
  }
}
class g {
  function show(e $g) {
    $g->show();
  }
}
$f = new f;
$g = new g;
$g->show($f);

echo "<hr>";

