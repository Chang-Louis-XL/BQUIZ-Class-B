<?php

class DB
{

    protected $table;

    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db11";

    protected $pdo;


    public function __construct($table)
    {

        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
    }

    protected function a2s($array)
    {
        $tmp = [];
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }
        return $tmp;
    }

    public function save($arg)
    {
        if (isset($arg)) {
            $tmp = $this->a2s($arg);
            $sql = "update `$this->table` " . join(",", $tmp);
            $sql .= "where `id`='{$arg['id']}'";
        } else {
            $key = array_keys($arg);
            $sql = "insert into `$this->table`(`" . join("`,`", $key) . "`)values('" . join("','", $arg) . "')";
        }
        return $this->pdo->exec($arg);
    }

    public function all(...$arg)
    {

        $sql = "select * from `$this->table`";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->a2s($arg[0]);
                $sql .= "where" . join("&&", $tmp);
            } else {
                $sql .= $arg[0];
            }
        }
        if (isset($arg[1])) {
            $sql .= $arg[1];
        }
        return $this->pdo->query($arg)->fetchALL(2);
    }

    public function count(...$arg)
    {

        $sql = "select count(*) from `$this->table`";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->a2s($arg[0]);
                $sql .= "where" . join("&&", $tmp);
            } else {
                $sql .= $arg[0];
            }
        }
        if (isset($arg[1])) {
            $sql .= $arg[1];
        }
        return $this->pdo->query($arg)->fetchColumn();
    }

    public function find($arg)
    {

        $sql = "select * from `$this->table`";
        if (is_array($arg)) {
            $tmp = $this->a2s($arg);
            $sql .= "where" . join("&&", $tmp);
        } else {
            $sql .= "where `id`='$arg'";
        }
        return $this->pdo->query($arg)->fetch(2);
    }

    public function del($arg)
    {

        $sql = "select * from `$this->table`";
        if (is_array($arg)) {
            $tmp = $this->a2s($arg);
            $sql .= "where" . join("&&", $tmp);
        } else {
            $sql .= "where `id`='$arg'";
        }
        return $this->pdo->exec($sql);
    }
}

function q($sql){
    $dsn="mysql:host=localhost;charset=utf8;dbname=db11";
    $pdo= new PDO($dsn,'root','');
    return $pdo->query($sql)->fetchALL(2);
}

function to($url){
    header("location:" .$url);
}

function dd($arg){
    echo  "<pre>";
   print_r($arg);
    echo "</pre>";
}

