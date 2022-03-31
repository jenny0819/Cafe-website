<?php
$mysqli = new mysqli('localhost', 'jianyil', '475611', 'jianyil');

//check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
class Mysql
{
    //2
    public $host;
    public $login;
    public $password;
    public $dbname;
    public $link;//

    //3
    function __construct()
    {
        $this->host = hostname;//localhost
        $this->username = username;
        $this->password = password;
        $this->dbname = dbname;
        //4
        $this->link = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        mysqli_set_charset($this->link, 'utf8');
    }

    //5
    public function query_select($table_name)
    {
        $sql = "select * from " . $table_name;
        $result = $this->link->query($sql);
        // 
        $_list = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $_list[] = $row;
        }
        // 
        $result->close();
        return $_list;
    }
   public function query_select_order($table_name)
    {
        $star_time = strtotime(date('Y-m-d') . ' 00:00:00');
        $end_time = strtotime(date('Y-m-d') . ' 23:59:59');
        $sql = "select * from " . $table_name . " where inputtime > $star_time and inputtime < $end_time";
        $result = $this->link->query($sql);
        // 
        $_list = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $_list[] = $row;
        }
        // 
        $result->close();
        return $_list;
    }
    //'select * from users where username = ' . $input['username']
    public function query_first($sql = '')
    {
        if ($sql) {
            $result = $this->link->query($sql);
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
        }
    }

    //'update users set balance = 12 where id = 1'
    //DELETE FROM Persons WHERE LastName='Griffin
    public function query_update($sql = '')
    {
        if ($sql) {
            $result = $this->link->query($sql);
            return $result;
        } else {
            return false;
        }
    }

    public function query_insert($table_name, $data = [])
    {
        $file = '';
        $val_string = '';
        foreach ($data as $key => $val) {
            $file .= $key . ', ';
            $val_string .= '"' . $val . '", ';
        }
        $file = rtrim($file, ', ');
        $val_string = rtrim($val_string, ', ');
        $sql = "INSERT INTO $table_name ($file) VALUES ($val_string)";
        echo $sql;
        if ($this->link->query($sql) === TRUE) {
            return $this->link->insert_id;
        } else {
            //echo "Error: " . $sql . "<br>" . $this->link->error;
            return false;
        }
    }
}
?>