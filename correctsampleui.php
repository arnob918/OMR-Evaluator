<?php
    session_start();
    include('checklogin.php');
    include('header.php');
     
    $cookie_name = "numofrow";
    $cookie_value = "0";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    $cookie_name = "numofcol";
    $cookie_value = "0";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
?>

<style>
    .hide{
        display : none;
    }
</style>

<head>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-white  static-top  pt-3 pb-0">
        <div class="container">
            <span>
                <a class="navbar-brand text-dark mx-4 font-rubik" href="">UI OMR</a>
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


<body>
<div class="py-5">
    <div class="container">
    <?php include('alertmessage.php'); ?>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                 <!-- <div class="row">
                        <div class="col-md-6">
                            <label for="">Exam Name</label>
                            <input type="text" value="" name="" class="form-control my-2">
                        </div>
                        <div class="col-md-6">
                        <a class="btn btn-warning" onclick="myFunctionwarning()"><i class="fa-solid fa-triangle-exclamation fa-1x"></i></a>
                        <div class="alert alert-warning hide" role="alert" id="warning-text">
                            &nbsp 
                            You would have to use this name later for checking OMR sheets. So give a unique, recognizable name.
                        </div>    
                        </div>
                    </div> -->
                    
                    <div class="row">
                    
                        <div class="omr" id="omr-show">
                        <form action="customizeomr.php" method="post">
                            <div class="row">
                            <div class="col-md-6">
                                <label for="">Exam Name</label>
                                <input type="text" value="" name="xm-name" class="form-control my-2">
                                <label for="">Exam Code</label>
                                <input type="text" value="" name="xm-code" class="form-control my-2" style="width:180px">
                            </div>
                            <div class="col-md-6">
                            <a class="btn btn-warning" onclick="showhide()"><i class="fa-solid fa-triangle-exclamation fa-1x"></i></a>
                            <div class="alert alert-warning hide" role="alert" id="warning-text">
                                &nbsp 
                                You would have to use this name later for checking OMR sheets. So give a unique, recognizable name.
                            </div>    
                            </div>
                        </div>
                            <div id="questions">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Number of Questions</label>
                                        <input type="text" value="25" name="rows" class="form-control my-2" >
                                        
                                    </div>
                                </div>
                            </div>

                            <input class="btn btn-primary py-2s" type="submit" value="OK" name="submit">
                        </form>
                            
                        </div>
                    </div>
                    

            </div>
        </div>

    </div>

</div>
</body>

<script>
    function showhide() {
        var element = document.getElementById("warning-text");
        element.classList.toggle("hide");
    } 
</script>


<?php
    include('footer.php');
?>