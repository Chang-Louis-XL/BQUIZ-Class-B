<?php
session_start();


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
        if (isset($arg['id'])) {
            $tmp = $this->a2s($arg);
            $sql = "update `$this->table` set" . join(",", $tmp);
            $sql .= "where `id`={$arg['id']}";
        } else {
            $keys = array_keys($arg);
            $sql = "insert into `$this->table` (`" . join("`,`", $keys) . "`)values('" . join("','", $arg) . "')";
        }
        // dd($arg);
        // dd(...$arg);
        // echo $sql;
        return $this->pdo->exec($sql);
    }

    public function all(...$arg)
    {
        $sql = "select * from `$this->table`";
        if (isset($arg[0])) {
            if (is_array($arg)) {
                $tmp = $this->a2s($arg);
                $sql = "where" . join("&&", $tmp);
            } else {
                $sql .= $arg[0];
            }
        }

        if (isset($arg[1])) {
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchall(2);

    }

    public function count(...$arg)
    {

        $sql = "select count(*) from `$this->table`";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->a2s($arg[0]);
                $sql .= "where" . join(" && ", $tmp);
            } else {
                $sql .= $arg[0];
            }
        }

        if (isset($arg[1])) {
            $sql .= $arg[1];
        }
        // dd($arg);
        // dd(...$arg);
        // echo $sql;
        return $this->pdo->query($sql)->fetchColumn();

    }


    public function find($arg)
    {
        $sql = "select * from `$this->table`";
        if (isset($arg)) {
            $tmp = $this->a2s($arg);
            $sql = "where" . join("&&", $tmp);
        } else {
            $sql .= "where `id`='$arg'";
        }
        return $this->pdo->query($sql)->fetch(2);
    }

    public function del($arg)
    {
        $sql = "select * from `$this->table`";
        if (isset($arg)) {
            $tmp = $this->a2s($arg);
            $sql = "where" . join("&&", $tmp);
        } else {
            $sql .= "where `id`='$arg'";
        }
        return $this->pdo->exec($sql);
    }


}

function to($url)
{
    header("location" . $url);
}

function q($sql)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=db11";
    $pdo = new PDO($dsn, 'root', '');
    return $pdo->query($sql)->fetch(2);
}

function dd($array)
{
    echo "<br>";
    echo print_r($array);
    echo "</br>";
}

$User = new DB("users");




