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
.button {
  border-radius: 8px;
  border: 2px solid #5cb85c;
  float: left;
  margin: 0 5px 0 0;
  width: 60px;
  height: 40px;
  position: relative;
}

.button label,
.button input {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

.button input[type="radio"] {
  opacity: 0.011;
  z-index: 100;
}

.button input[type="radio"]:checked + label {
  background: #5cb85c;
  border: 2px solid green;
}

.button label {
  cursor: pointer;
  z-index: 90;
  line-height: 1.8em;
}

</style>

<head>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-white bg-gradient static-top  pt-3 pb-0">
        <div class="container">
            <span>
                <a class="navbar-brand text-dark mx-4 font-rubik" href="">Customize UI OMR</a>
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
                        <li><a class="dropdown-item" href="">History</a></li>
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
                <form action="codes/code.php" method="POST" enctype="multipart/form-data">
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
                            <div class="nav-item dropdown px-4">
                                <a class="nav-link btn btn-outline-primary" href="" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false" style="width:400px; height:50px">
                                    <h5> Options <i class="fa-solid fa-caret-down"></i></h5>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="correctsamplefile.php">File Upload</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="correctsampleui.php">Customize OMR</a></li>
                                </ul>
                            </div>
                            <!-- <label for=""><h4>Options</h4></label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="py-3">
                                        <button type="button" class="btn btn-outline-success">File Upload</button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="py-3">
                                        <button type="button" class="btn btn-outline-success">Customize OMR</button>
                                    </div>
                                </div>
                            </div> -->
                            
                    <div class="row">
                        <div class="omr hide" id="omr-show">
                            <div id="questions">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Number of Questions</label>
                                        <input type="text" value="10" name="numofques" class="form-control my-2" id="rownum" disabled>
                                        <a class="btn btn-primary py-2s" onclick="myFunctioncshow()">OK</a>
                                    </div>
                                </div>
                            </div>

                            <div id="choices" class="hide">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Number of Choises</label>
                                        <input type="text" value="4" class="form-control my-2" disabled>
                                        <a class="btn btn-primary py-2s" onclick="myFunctionomrshow()">OK</a>
                                    </div>
                                </div>
                            </div>

                            <div class="omr-sheet hide" id="omr-sheet-show">
                                <?php
                                $txt = $_COOKIE[$cookie_name];
                                 $num =  (int)$txt;

                                for ($x = 1; $x <= $num; $x++) {
                                    ?>
                                    <div class="container">
                                        <div class="row py-1">
                                            <div class="col-sm-1 py-1">
                                                    <h4 class=""><?php echo $x ?></h4>
                                            </div>
                                                <div class="button">
                                                    <input type="radio" id="a-<?php echo $x ?>" name="id-<?php echo $x ?>" />
                                                    <label class="btn btn-default" for="a-<?php echo $x ?>">A</label>
                                                </div>
                                                <div class="button">
                                                    <input type="radio" id="b-<?php echo $x ?>" name="id-<?php echo $x ?>" />
                                                    <label class="btn btn-default" for="b-<?php echo $x ?>">B</label>
                                                </div>
                                                <div class="button">
                                                    <input type="radio" id="c-<?php echo $x ?>" name="id-<?php echo $x ?>" />
                                                    <label class="btn btn-default" for="c-<?php echo $x ?>">C</label>
                                                </div>
                                                <div class="button">
                                                    <input type="radio" id="d-<?php echo $x ?>" name="id-<?php echo $x ?>" />
                                                    <label class="btn btn-default" for="d-<?php echo $x ?>">D</label>
                                                </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?> 
                                <center><input type="submit" value="Submit" class="btn btn-success my-4">
                                </center>
                            </div>
                       

      

      
                        </div>
                    </div>
                    <div class="row">
                        <div class="file hide" id="file-show">
                            <label for="">Correct OMR Sheet</label>

                            <input type="file" name="image" class="form-control my-2">
                            <center><input type="submit" value="Submit" class="btn btn-success my-4">
                                </center>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

</div>



<?php
    include('footer.php');
?>