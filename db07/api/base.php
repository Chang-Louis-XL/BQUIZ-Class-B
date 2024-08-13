<?php
session_start();

class DB
{
    protected $table ;
    
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db07";

    protected $pdo;

    public function __construct($table)
    {
        $this->table-$table;
        $this->pdo = new PDO($this->dsn,'root','');
    }
  
    protected function a2s($array)
    {
        $tmp=[];
        foreach ($array as $key => $value){
            $tmp[]="`$key`=`$value`";
        }
        return $tmp;
    }

    public function all(...$arg)
    {
        $sql="select * from `$this->table`";
        if(isset($arg[0])){
            $tmp = $this->a2s($arg[0]);
            $sql .= "where" .join("&&",$tmp);
        }else{
            $sql .=$arg[0];
        }
        if(isset($arg[1])){
            $sql.=$sql[1];
        }

        return $this->pdo->query($sql)->fetchAll(2);
    }

    public function count(...$arg)
    {
        $sql = "select count(*)from `$this->table`";

        if(isset($arg[0])){
            if(is_array($arg[0])){
                $tmp= $this->a2s($arg[0]);
                $sql .="where ".join("&&",$tmp);
            }else {
                $sql .=$arg[0];
            }
        }
        if (isset($arg[1])){
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn();
    }

    public function find ($arg)
    {
        $sql = "select * from `$this->table`";
        if(is_array($arg)){
            $tmp = $this->a2s($arg);
            $sql .= "where" . join("&&",$tmp);
        }else{
            $sql.="where `id`='$arg'";
        }
        return $this->pdo->query($sql)->fetch(2);
    }

    public function del($arg)
    {
        $sql= "delete from `$this->table`";
        if(is)
    }

}

