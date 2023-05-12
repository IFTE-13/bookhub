<?php

    // Connection
    function connection()
    {
        $connectionObject = oci_connect("system","1234","localhost/XE");
        if(!$connectionObject){

            $error = oci_error();
            trigger_error(htmlentities($error['message'], ENT_QUOTES),E_USER_ERROR);
        }
        
        return $connectionObject;
    }


    // Admin
    function SHOWALLADMIN(){
        $connection = connection();
        $sql = oci_parse($connection,"select ID, EMAIL from ADMIN") ;
        $res = oci_execute($sql);
        return $sql;
    }

    function SHOWALLMEMBERS(){
        $connection = connection();
        $sql = oci_parse($connection,"select USERID, NAME, ADDRESS, EMAIL, PHONE from MEMBER") ;
        $res = oci_execute($sql);
        return $sql;
    }

    function SHOWALLBOOKS(){
        $connection = connection();
        $sql = oci_parse($connection,"select BOOKID, TITLE, AUTHOR, PUBLICATION, LANGUAGE, AVAILABLECOPIES, TOTALCOPIES from BOOK") ;
        $res = oci_execute($sql);
        return $sql;
    }

    function SHOWALLWRITERS(){
        $connection = connection();
        $sql = oci_parse($connection,"select WRITERID, NAME, NATIONALITY, DATEOFBIRTH, BIOGRAPHY from WRITER") ;
        $res = oci_execute($sql);
        return $sql;
    }

    // Add or register new member in the system
    if(isset($_POST['register'])){
        $NAME = $_REQUEST['name'];
        $ADDRESS = $_REQUEST['address'];
        $EMAIL = $_REQUEST['email'];
        $PHONE = $_REQUEST['phone'];
        $connection = connection();
        $query = oci_parse($connection, "INSERT INTO MEMBER VALUES (USER_SEQ.NEXTVAL, '$NAME', '$ADDRESS', '$EMAIL', '0000', '$PHONE')");
        $result = oci_execute($query);
    }


    if(isset($_POST['addBook'])){
        $TITLE = $_REQUEST['title'];
        $AUTHOR = $_REQUEST['author'];
        $PUBLICATION = $_REQUEST['publication'];
        $LANGUAGE = $_REQUEST['language'];
        $AVAILABLE = $_REQUEST['available'];
        $TOTAL = $_REQUEST['total'];
        $connection = connection();
        $query = oci_parse($connection, "INSERT INTO BOOK VALUES (BOOK_SEQ.NEXTVAL, '$TITLE', '$AUTHOR', TO_DATE('$PUBLICATION', 'YYYY-MM-DD'), '$LANGUAGE', $AVAILABLE, $TOTAL)");
        $result = oci_execute($query);
    }

    if(isset($_POST['registerWriter'])){
        $NAME = $_REQUEST['name'];
        $NATIONALITY = $_REQUEST['nationality'];
        $DATEOFBIRTH = $_REQUEST['dateofbirth'];
        $DIOGRAPHY = $_REQUEST['biography'];
        $connection = connection();
        $query = oci_parse($connection, "INSERT INTO WRITER VALUES (WRITER_SEQ.NEXTVAL, '$NAME', '$NATIONALITY', TO_DATE('$DATEOFBIRTH', 'YYYY-MM-DD'), '$DIOGRAPHY')");
        $result = oci_execute($query);
    }

    // Admin password update
    if(isset($_POST['changeAdminPassword'])){
        $NEW = $_REQUEST['newPassword'];
        $CONFIRM = $_REQUEST['confirmPassword'];
        if($NEW === $CONFIRM){
            $connection = connection();
            $query = oci_parse($connection, "UPDATE ADMIN SET PASSWORD = $NEW WHERE ID = 1001");
            $result = oci_execute($query);
        }
    }
        
?>