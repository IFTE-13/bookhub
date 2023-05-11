<?php
class databaseConnection{

    function openConnection(){
        $dataBaseHost = 'localhost';
        $dataBaseUser = 'root';
        $dataBasePass = '';
        $dataBase = 'bookhub';

        $connection = new mysqli($dataBaseHost, $dataBaseUser, $dataBasePass, $dataBase);

        if($connection->connect_error)
        {
            echo "error setting connection";
        }
        return $connection;
    }   

    function adminLogin($connection, $userid, $password, $role){
        $result = $connection->query("SELECT * FROM DOCTOR  WHERE doctorId='". $userid."' AND password='". $password."'AND role='". $role."'");
        return $result;
    }

    // Database connection close
    function closeConnection($connection)
    {
        $connection -> close();
    }
}

// CREATE TABLE MANAGER (MGRID NUMBER(4) CONSTRAINT PK_EMP PRIMARY KEY, NAME VARCHAR2(10), PHONE VARCHAR2(9), ADDRESS NUMBER(4),EMAIL VARCHAR2(20), LOCATION VARCHAR2(20), READINGROOMID NUMBER(10), DEPTNO NUMBER(2) CONSTRAINT FK_DEPTNO REFERENCES DEPT);
        
?>