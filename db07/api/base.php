<?php
session_start();

class DB
{

    protected $table;

    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db08";

    protected $pdo;


    public function __construct($table)
    {
        $this->table = $table;
        // PDO 代表 **PHP Data Objects**，是 PHP 中用來訪問資料庫的擴展
        $this->pdo = new PDO($this->dsn, 'root', '');
    }

    protected function a2s($array)
    {
        $tmp = [];
        // 創建一個空數組
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value`";
        }
        return $tmp;
    }

    public function all(...$arg)
    {
        $sql = "select * form `$this->table`";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->a2s($arg[0]);
                $sql .= " where " . join(" && ", $tmp);
            } else {
                $sql .= $arg[0];
            }
        }
        if (isset($arg[1])) {
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchAll(2);
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
        return $this->pdo->query($sql)->fetchColumn();
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
        $sql = "delete from `$this->table`";
        if (is_array($arg)) {
            $tmp = $this->a2s($arg);
            $sql .= "where" . join("&&", $tmp);
        } else {
            $sql .= "where `id`='$arg'";
        }
        return $this->pdo->exec($sql);
    }

    public function save($arg)
    {
        if (isset($arg['id'])) {
            $tmp = $this -> a2s($arg);
            $sql = "update `$this->table` set" . join(",", $tmp);
            $sql .= "where `id`='{$arg['id']}'";
        } else {
            $keys = array_keys($arg);
            $sql = "insert into`$this->table`(`" . join("`,`", $keys) . "`)value('" . join("','", $arg) . "')";
        }
        return  $this->pdo->exec($sql);
    }
   

}

