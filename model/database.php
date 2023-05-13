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

    function SHOWALLBOOKS(){
        
    $connection = connection();  
    if(isset($_POST['searchFromBooks'])){
        $DATA = strtoupper($_REQUEST['data']);
        $sql = oci_parse($connection, "SELECT BOOKID, TITLE, AUTHOR, PUBLICATION, LANGUAGE, AVAILABLECOPIES, TOTALCOPIES FROM BOOK WHERE TITLE LIKE '%$DATA%' OR AUTHOR LIKE'%$DATA%'");
        $res = oci_execute($sql);
        return $sql;

    } else {
        $sql = oci_parse($connection,"select BOOKID, TITLE, AUTHOR, PUBLICATION, LANGUAGE, AVAILABLECOPIES, TOTALCOPIES from BOOK") ;
        $res = oci_execute($sql);
        return $sql;
        }
    }
    
    function SHOWCOLLECTION(){
        
    $connection = connection();  
    if(isset($_POST['search'])){
        $DATA = strtoupper($_REQUEST['data']);
        $sql = oci_parse($connection, "SELECT BOOKID, TITLE, AUTHOR, PUBLICATION, LANGUAGE FROM BOOK WHERE TITLE LIKE '%$DATA%' OR AUTHOR LIKE'%$DATA%'");
        $res = oci_execute($sql);
        return $sql;

    } else {
        $sql = oci_parse($connection,"select BOOKID, TITLE, AUTHOR, PUBLICATION, LANGUAGE from BOOK") ;
        $res = oci_execute($sql);
        return $sql;
        }
    }


    function SHOWALLMEMBERS(){
        
    $connection = connection();  
    if(isset($_POST['searchFromMembers'])){
        $DATA = strtoupper($_REQUEST['data']);
        $sql = oci_parse($connection, "SELECT USERID, NAME, ADDRESS, EMAIL, PHONE from MEMBER WHERE NAME LIKE '%$DATA%' OR EMAIL LIKE '%$DATA%' OR USERID LIKE '%$DATA%'");
        $res = oci_execute($sql);
        return $sql;

    } else {
        $connection = connection();
        $sql = oci_parse($connection,"select USERID, NAME, ADDRESS, EMAIL, PHONE from MEMBER") ;
        $res = oci_execute($sql);
        return $sql;
        }
    }

    function SHOWALLWRITERS(){
        $connection = connection();
        $sql = oci_parse($connection,"select WRITERID, NAME, NATIONALITY, DATEOFBIRTH, BIOGRAPHY from WRITER") ;
        $res = oci_execute($sql);
        return $sql;
    }

    function SHOWALLSELL(){
        $connection = connection();
        $sql = oci_parse($connection,"select SELLID, MEMBERID, BOOKID, PURCHASE from SELL") ;
        $res = oci_execute($sql);
        return $sql;
    }

    function SHOWSOLDHISTORY(){
        $connection = connection();
        $sql = oci_parse($connection,"select TITLE, SOLD_COPIES from BOOK_SELL_HISTORY") ;
        $res = oci_execute($sql);
        return $sql;
    }

    function SHOWENGLISHBOOK(){
        $connection = connection();
        $sql = oci_parse($connection,"select BOOKID, TITLE, AUTHOR from ENGLISH_BOOK") ;
        $res = oci_execute($sql);
        return $sql;
    }

    function SHOWSPECIALBOOKS(){
        $connection = connection();
        $sql = oci_parse($connection,"select TITLE, AUTHOR, PUBLICATION from SPECAIL_BOOKS") ;
        $res = oci_execute($sql);
        return $sql;
    }

    if(isset($_POST['sell'])){
        $MEMBERID = $_REQUEST['memberid'];
        $BOOKID = $_REQUEST['bookid'];
        $connection = connection();
        $query = oci_parse($connection, "INSERT INTO SELL VALUES (SELL_SEQ.NEXTVAL, '$MEMBERID', '$BOOKID', SYSDATE)");
        $result = oci_execute($query);
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

    if(isset($_POST['sell'])){
        $MEMBERID = $_REQUEST['memberid'];
        $BOOKID = $_REQUEST['bookid'];
        $connection = connection();
        $query = oci_parse($connection, "INSERT INTO SELL VALUES (SELL_SEQ.NEXTVAL, '$MEMBERID', '$BOOKID', SYSDATE)");
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