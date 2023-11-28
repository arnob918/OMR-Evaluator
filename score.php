<?php
    session_start();
    include('checklogin.php');
    include('header.php');
    include('database/dbcon.php');
     $userid =  $_SESSION['user_info']['id'];
?>

<head>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-white  static-top  pt-3 pb-0">
        <div class="container">
            <span>
                <a class="navbar-brand text-dark mx-4 font-rubik" href="">Exams</a>
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item px-2">
                        <a class="nav-link  text-dark" href="index.php">&nbsp Home</a>
                    </li>
                    <li class="nav-item px-4">
                        <a class="nav-link  text-dark" href="trending-products.php">&nbsp Team</a>
                    </li>
                    <li class="vr  text-dark"></li>

                    <?php
                    if(isset($_SESSION['logged_in']))
                    {
                        ?>
                <li class="nav-item dropdown px-4">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?=  $_SESSION['user_info']['name'] ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="dashboard.php">Account</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>

                <?php
                    }
                    else
                    {
                        ?>
                <li class="nav-item px-2">
                        <a class="nav-link text-dark" href="login.php">&nbsp Log In</a>
                    </li>
                    <li class="nav-item px-2">
                        <a href="register.php"><button type="button" class="btn btn-primary"> Register </button></a>
                    </li>
                <?php
                    }
                ?>


                    
                </ul>
            </div>
        </div>
    </nav>
    <hr>


</head>


<body>
<div >
    <div class="py-2">
    <div class="content">
            <div class="container py-4">
            <?php include('alertmessage.php');?>
                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h3 class="text-center text-white">All Subject</h3>
                    </div>
                    <div class="card-body table-responsive-sm">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Exam Code</th>
                                    <th>Exam Name</th>
                                    <th>Show</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "SELECT DISTINCT xmname, xmcode, id FROM exams Where user_id = '$userid'";
                                    $all_subject = mysqli_query($con, $query);
                                    if(mysqli_num_rows($all_subject) > 0){
                                        
                                        foreach($all_subject as $item)
                                        {
                                            ?>
                                                <tr>
                                                    <td> <?= $item['xmcode'] ?> </td>
                                                    <td> <?= $item['xmname'] ?> </td>
                                                    <td><a href="result.php?id=<?= $item['id'] ?>"class="btn btn-success">show</a></td>
                                    
                                                    
                                                </tr>
                                            <?php
                                        }

                                    }
                                    else{
                                        echo "no records found";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>

<?php
    include('footer.php');
?>