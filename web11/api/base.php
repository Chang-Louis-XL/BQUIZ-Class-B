<?php
session_start();

class DB
{

protected $table;

protected $dsn="mysql:host=localhost;charset=utf8;dbname=db11";

protected $pdo;

public function __construct($table)
{
    $this->table =$table;
    $this->pdo = new PDO($this->dsn,'root','');
}

protected function a2s($array){
    $tmp=[];
    foreach($array as  $key =>$value){
        $tmp[]= "`$key`='$value'";
    }
    return $tmp ;
}

public function save($arg){

    if(isset(($arg)['id'])){
        $tmp = $this->a2s($arg);
        $sql = "update `$this->table set" .join(",",$tmp);
        $sql .="where `id`='{$arg['id']}'";
    }else{
        $keys = array_keys($arg);
        $sql = "insert into `$this->table` (`".join("`,`",$keys)."`) values('".join("','",$arg)."')";
    }
return $this->pdo->exec($sql);
}

public function all(...$arg){
    $sql ="select * from `$this->table`";
    if(isset($arg[0])){
        if(is_array($arg[0])){
            $tmp = $this->a2s($arg[0]);
            $sql .= "where" .join("&&",$tmp);
        }else {
            $sql .= $sql[0];
        }
    }
    if(isset($arg[1])){
        $sql .=$arg[1];
    }
    // echo $sql;
    return $this->pdo->query($sql)->fetchALL(2);
}

public function count(...$arg){
    $sql ="select count(*) from `$this->table`";
    if(isset($arg[0])){
        if(is_array($arg[0])){
            $tmp = $this->a2s($arg[0]);
            $sql .= "where" .join("&&",$tmp);
        }else {
            $sql .= $sql[0];
        }
    }
    if(isset($arg[1])){
        $sql .=$arg[1];
    }

    return $this->pdo->query($sql)->fetchColumn();
}

public function find($arg){
    $sql = "select * from `$this->table`";
    if(is_array($arg)){
        $tmp = $this->a2s($arg);
        $sql .="where".join("&&",$tmp);
    }else{
        $sql .= "where `id`='$arg'";
    }
    return $this->pdo->query($sql)->fetch(2);
}

public function del($arg){
    $sql = "select from `$this->table`";
    if(is_array($arg)){
        $tmp = $this->a2s($arg);
        $sql ="where".join("&&",$tmp);
    }else{
        $sql .= "where `id`='$arg'";
    }
    return $this->pdo->exec($sql);
}


}

function q($arg)
{
    $dsn="mysql:host=localhost;charset=utf8;dbname=db11";
    $pdo = new PDO($dsn,'root','');
    // echo $arg;
    return $pdo->query($arg)->fetchALL(2);
}

function dd($arg){
    echo "<pre>";
    print_r($arg);
    echo "</pre>";
}

function to ($arg){
    header("location".$arg);
}

$User =new DB('users');
$Test =new DB('test');
$News =new DB('news');
$Total =new DB('total');

if(!isset($_SESSION['total'])){
    if($Total->count(['date'=>date("Y-m-d")])>0){
        $total = $Total->find(['date'=>date("Y-m-d")]);
        $total['total']++;
        $Total->save($total);
    }else{
        $Total->save(['date'=>date("Y-m-d") , 'total'=>1]);
    }
    $_SESSION['total'] = $Total->find(['date' => date("Y-m-d")])['total'];

}