<?php
    include ("../../model/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../bootstrap.css">
    <script src="../bootstrap.js"></script>
    <title>Admin/Writer</title>
</head>
<body>
<div class="offcanvas offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Book Hub</h6>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0">
    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
            <li class="nav-item">
                <a href="./adminProfile.php" class="nav-link text-truncate">
                    <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="./adminBook.php" class="nav-link text-truncate">
                    <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Book</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="./adminWriter.php" class="nav-link text-truncate">
                    <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Writer</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="./adminMember.php" class="nav-link text-truncate">
                    <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Member</span>
                </a>
            </li>
            <li>
                <a href="./adminAdmins.php" class="nav-link text-truncate">
                    <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline">Admins</span></a>
            </li>
            <li>
                <a href="./adminSetting.php" class="nav-link text-truncate">
                    <i class="fs-5 bi-grid"></i><span class="ms-1 d-none d-sm-inline">Settings</span></a>
            </li>
            <li>
                <a href="../../control/logout.php" class="nav-link text-truncate">
                    <i class="fs-5 bi-people"></i><span class="ms-1 d-none d-sm-inline">Log out</span> </a>
            </li>
        </ul>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col min-vh-100 p-4">
            <!-- toggler -->
            <button class="btn float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
                <i class="bi bi-arrow-right-square-fill fs-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"></i>
                <h1>X</h1>
            </button>

            
            <div class="container">
                <h1>Writers</h1>
                <form class="text-center border border-light p-5" method="POST">

                <p class="h4 mb-4">New Writer</p>

                <input type="text" name="name" class="form-control mb-4" placeholder="Twilight">
                <input type="text" name="nationality" class="form-control mb-4" placeholder="Bangladeshi">
                <input type="date" name="dateofbirth" class="form-control mb-4">
                <input type="text" name="biography" class="form-control mb-4" placeholder="Description">

                <button class="btn btn-info my-4 btn-block" type="submit" name="registerWriter">Register</button>
                <?php 
                    $restrationError;
                ?>
                </form>
            </div>


            <div class="container mt-5 pt-5">
            <div>
                <table class="table table-success table-striped">
                    <thead>
                        <tr>
                        <th scope="col">WRITER ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">NATIONALITY</th>
                        <th scope="col">DATE OF BIRTH</th>
                        <th scope="col">BIOGRAPHY</th>
                        <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
                        $res = SHOWALLWRITERS();
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


