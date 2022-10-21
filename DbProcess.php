<?php
namespace DB;

class DbProcess
{
    static $conn;
    static function ConnectDb()
    {
        self::$conn = mysqli_connect("localhost", "root", "", "books");
        self::$conn->query("SET NAMES 'utf8'");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            return false;
        }
        return (true);
    }
    static function Insert($sql)
    {
        self::ConnectDb();
        if (mysqli_query(DbProcess::$conn, $sql)) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . DbProcess::$conn->error;
        }
        mysqli_close(DbProcess::$conn);
    }
    static function GetData($sql)
    {
        self::ConnectDb();
        $result = mysqli_query(DbProcess::$conn, $sql);
        mysqli_close(DbProcess::$conn);
        return $result;
    }
    static function GetRecordById($sql)
    {
        self::ConnectDb();
        $result = mysqli_query(DbProcess::$conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        mysqli_close(DbProcess::$conn);
        return $row;
    }
    static function DeleteRecord($sql)
    {
        self::ConnectDb();
        $result = "";
        if (mysqli_query(DbProcess::$conn, $sql)) {
            $result = "Delete successfully!";
        }
        return $result;
    }
}
?>