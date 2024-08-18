<?php
require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    function logIn($table, $username, $password)
    {
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $this->sql = "select * from " . $table . " where email = '" . $username . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
            $dbusername = $row['email'];
            $dbpassword = $row['password'];
            if ($dbusername == $username && password_verify($password, $dbpassword)) {
                $login = true;
            } else $login = false;
        } else $login = false;

        return $login;
    }

    function signUp($table, $f_name, $l_name, $spouse_name, $spouse_BA_no, $spouse_rk, $unit, $username, $password, $designation, $birthday)
    {
        $f_name = $this->prepareData($f_name);
        $l_name = $this->prepareData($l_name);
        $spouse_name = $this->prepareData($spouse_name);
        $spouse_BA_no = $this->prepareData($spouse_BA_no);
        $spouse_rk = $this->prepareData($spouse_rk);
        $unit = $this->prepareData($unit);
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $designation = $this->prepareData($designation);
        $birthday = $this->prepareData($birthday);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->sql =
            "INSERT INTO " . $table . " (ladies_Club_ID, f_name, l_name, spouse_name, spouse_BA_no, spouse_rk, unit, username, password, designation, birthday, created_on) VALUES 
            ('," . $f_name . "','" . $l_name . "','" . $spouse_name . "','" . $spouse_BA_no . "','" . $spouse_rk . "','" . $unit . "','" . $username . "','" . $password . "','" . $designation . "','" . $birthday .", ')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

}

?>


/**
 INSERT INTO `users` (`Ladies_Club_ID`, `f_name`, `l_name`, `spous_name`, `spous_BA_No`, `spous_rk`, `unit`, `email`, `password`, `designation`, `birthday`, `created_on`) VALUES (NULL, 'AFSAHUN', 'NESA', 'MOHAMMAD ASADUZZAMAN', '10365', '2', '10 SIG BN', 'afsahunnesa@gmail.com', 'abcd', 'MEMBER', '1994-12-12', current_timestamp());
*/
