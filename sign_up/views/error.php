<?PHP

// var_dump($data);

// echo $data['mesg'];

?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        body { background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAxMC8yOS8xMiKqq3kAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzVxteM2AAABHklEQVRIib2Vyw6EIAxFW5idr///Qx9sfG3pLEyJ3tAwi5EmBqRo7vHawiEEERHS6x7MTMxMVv6+z3tPMUYSkfTM/R0fEaG2bbMv+Gc4nZzn+dN4HAcREa3r+hi3bcuu68jLskhVIlW073tWaYlQ9+F9IpqmSfq+fwskhdO/AwmUTJXrOuaRQNeRkOd5lq7rXmS5InmERKoER/QMvUAPlZDHcZRhGN4CSeGY+aHMqgcks5RrHv/eeh455x5KrMq2yHQdibDO6ncG/KZWL7M8xDyS1/MIO0NJqdULLS81X6/X6aR0nqBSJcPeZnlZrzN477NKURn2Nus8sjzmEII0TfMiyxUuxphVWjpJkbx0btUnshRihVv70Bv8ItXq6Asoi/ZiCbU6YgAAAABJRU5ErkJggg==);}
        .error-template {padding: 40px 15px;text-align: center;}
        .error-actions {margin-top:15px;margin-bottom:15px;}
        .error-actions .btn { margin-right:10px; }
    </style>
</head>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <?php if($data["isTrue"]){?>
                    <h1>SUCCESS</h1>
                    <h2><?php echo $data['mesg'];?></h2>
                <?PHP }else{ ?>
                    <h1>Oops!</h1>
                    <h2><?php echo $data['mesg'];?></h2>
                    <div class="error-details">
                        Sorry, an error has occured!
                    </div>
                <?PHP } ?>
                
                <?PHP if(isset($data['id'])){ ?>
                    <div class="error-actions">
                        <a href="https://lab-eric3998.c9users.io/sign_up/Regist/index/<?php echo $data['id']?>"  class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                            點我重回報名頁 </a>
                    </div>
                <?PHP } ?>
            </div>
        </div>
    </div>
</div>

</html>