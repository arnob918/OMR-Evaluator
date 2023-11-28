<?php
    session_start();
    include('checklogin.php');
    include('header.php');
?>

<head>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-white bg-gradient static-top  pt-3 pb-0">
        <div class="container">
            <span>
                <a class="navbar-brand text-dark mx-4 font-rubik" href="">Workspace</a>
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
                        <li><a class="dropdown-item" href="score.php">Exams</a></li>
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


<div class="py-5">
    <div class="container">
    <?php include('alertmessage.php');?>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <!-- <a href="correctsample.php"> -->
                            <div class="card btn btn-outline-primary shadow">

                                <div class="card-body">
                                    <!-- <img src="images/mens-watch.webp" height="400" alt="mes's watch"
                                        class="w-50"> -->
                                        <i class="fa-solid fa-download fa-5x"></i>
                                      <!-- <i class="fa-regular fa-square-check "></i> -->
                                      <h4 class="py-4"> Give Correct Sample</h4>
                                      <div class="nav-item dropdown px-4">
                    <a class="nav-link dropdown-toggle btn btn-light text-dark" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Options
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="correctsamplefile.php">File Upload</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="correctsampleui.php">Customize OMR</a></li>
                        
                    </ul>
                </div>
                                </div>
                            </div>
                        <!-- </a> -->
                    </div>
                    <div class="col-md-6">
                      <a href="check.php">
                            <div class="card btn btn-outline-primary shadow">

                                <div class="card-body" style="height: 222px;">
                                    <!-- <img src="images/mens-watch.webp" height="400" alt="mes's watch"
                                        class="w-50"> -->
                                      <i class="fa-regular fa-square-check fa-5x"></i>
                                      <h4 class="py-4"> Check OMR Scripts</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
    </main>

</div>

<div class="py-5">
    
</div>


<?php
    include('footer.php');
?>