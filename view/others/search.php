<?php
    include ("../../model/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../bootstrap.css">
    <script src="../bootstrap.js"></script>
    <title>Views</title>
</head>
<body>
<?php
  include("navbar.php")
 ?>
    <div class="d-flex justify-content-center container">
        
      <form class="d-flex" role="search" method="POST">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="data">
        <button class="btn btn-outline-success" type="submit" name="search">Search</button>
      </form>
    </div>

    <div class="container mt-5 pt-5">
                <div>
                    <table class="table table-success table-striped">
                        <thead>
                            <tr>
                            <th scope="col">USERID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">ADDRESS</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">PHONE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php
                            $res = SEARCHBOOK();
                            while ($row = oci_fetch_array($res, OCI_RETURN_NULLS+OCI_ASSOC)) {
                                
                                echo '<tr>';
                                foreach ($row as $item) 
                                {
                                    echo '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
                                }
                                echo '</tr>';
                                }
                        ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
</body>
</html>


