<?php
session_start();

class DB
{
    protected $table;
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db07";
    protected $pdo;

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
    }

    public function all(...$arg)
    {
        $sql = "select * from  `$this->table`";

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
        //echo $sql;
<<<<<<< HEAD

=======
        // fetch(PDO::FETCH_ASSOC)回傳資料表中全部欄值
>>>>>>> b7f6ceb65750b20c28484c9d87701e9a2c107c41
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($arg)
    {
        $sql = "select * from `$this->table` ";
        if (is_array($arg)) {
            $tmp = $this->a2s($arg);
            $sql .= " where " . join(" && ", $tmp);
        } else {
            $sql .= " where `id`='$arg'";
        }
<<<<<<< HEAD
        //echo $sql;

=======
        
        // echo $sql;
        // fetch(PDO::FETCH_ASSOC)回傳資料表中第一欄值
>>>>>>> b7f6ceb65750b20c28484c9d87701e9a2c107c41
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function save($arg)
    {
        if (isset($arg['id'])) {
            //update
            $tmp = $this->a2s($arg);
            $sql = "update `$this->table` set " . join(",", $tmp);
            $sql .= " where `id`='{$arg['id']}'";
        } else {
            //insert
            $keys = array_keys($arg);
            $sql = "insert into `$this->table` (`" . join("`,`", $keys) . "`) 
                   values('" . join("','", $arg) . "')";
        }
        //  dd ($arg);
        // echo $sql;
        return $this->pdo->exec($sql);
    }

    public function del($arg)
    {
        $sql = "delete from `$this->table` ";
        if (is_array($arg)) {
            $tmp = $this->a2s($arg);
            $sql .= " where " . join(" && ", $tmp);
        } else {
            $sql .= " where `id`='$arg'";
        }
        // echo $sql;
        return $this->pdo->exec($sql);
    }

    public function count(...$arg)
    {
        $sql = "select count(*) from  `$this->table`";

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
<<<<<<< HEAD
        //echo $sql;

=======
        // dd ($arg);
        // echo $sql;

        // fetchColumn該欄的值
>>>>>>> b7f6ceb65750b20c28484c9d87701e9a2c107c41
        return $this->pdo->query($sql)->fetchColumn();
    }


    protected function a2s($array)
    {
        $tmp = [];
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }

        return $tmp;
    }
}



function q($sql)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=db07";
    $pdo = new PDO($dsn, 'root', '');
    // echo $sql;
    // dd($sql);
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

}

function to($url)
{
    header("location:" . $url);
}

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


$User = new DB("users");
$Total = new DB("total");
$News = new DB('news');
$Log = new DB('logs');
<<<<<<< HEAD
$Que = new DB("que");
=======
>>>>>>> b7f6ceb65750b20c28484c9d87701e9a2c107c41

if (!isset($_SESSION['total'])) {
    if ($Total->count(['date' => date("Y-m-d")]) > 0) {
        $total = $Total->find(['date' => date("Y-m-d")]);
        $total['total']++;
        $Total->save($total);
    } else {
        $Total->save(['date' => date("Y-m-d"), 'total' => 1]);
    }
    $_SESSION['total'] = $Total->find(['date' => date("Y-m-d")])['total'];
}
// echo $_SESSION['total'] ;