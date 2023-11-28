<?php
    session_start();
    include('checklogin.php');
    include('header.php');
include('database/dbcon.php');
if(isset($_POST['submit']))
{
    $row = mysqli_real_escape_string($con, $_POST['rows']);
    $xm_name = mysqli_real_escape_string($con, $_POST['xm-name']);
    if($xm_name == "")
    {
        $_SESSION['message'] = "Exam name not provided!";
        header('Location: correctsampleui.php');
        exit();
    }
    $xm_code = mysqli_real_escape_string($con, $_POST['xm-code']);
    if($xm_code == "")
    {
        $_SESSION['message'] = "Exam Code not provided!";
        header('Location: correctsampleui.php');
        exit();
    }
    $query = "SELECT * FROM `exams` WHERE xmname = '$xm_name' AND xmcode = '$xm_code'";
    $run_query = mysqli_query($con, $query);

    if(mysqli_num_rows($run_query) > 0)
    {
        $_SESSION['message'] = "Exam name and Exam code already used!";
        header('Location: correctsampleui.php');
        exit();
    }
}
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-white  static-top  pt-3 pb-0">
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
    <?php include('alertmessage.php');?>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
            <form action="codes/code.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="omr-row" value="<?=$row?>">
                <input type="hidden" value="<?=$xm_name?>" name="xm-name">
                <input type="hidden" value="<?=$xm_code?>" name="xm-code">
                    
                    
                    <div class="row d-flex justify-content-center">
                        <div class="col card shadow my-3">
                            <div class="py-3 px-5">
                                <?php
                                 $num =  (int)$row;

                                for ($x = 1; $x <= $num; $x++) {
                                    ?>
                                    <div class="container">
                                        <div class="row py-1">
                                            <div class="col-sm-1 py-1">
                                                    <h4 class="px-2" style="display: inline-block"><?= $x ?></h4>
                                            </div>
                                                <div class="button mx-2">
                                                    <input type="radio" id="a-<?php echo $x ?>" value ="A" name="id-<?php echo $x ?>" />
                                                    <label class="btn btn-default" for="a-<?php echo $x ?>">A</label>
                                                </div>
                                                <div class="button mx-2">
                                                    <input type="radio" id="b-<?php echo $x ?>" value ="B" name="id-<?php echo $x ?>" />
                                                    <label class="btn btn-default" for="b-<?php echo $x ?>">B</label>
                                                </div>
                                                <div class="button mx-2">
                                                    <input type="radio" id="c-<?php echo $x ?>" value ="C" name="id-<?php echo $x ?>" />
                                                    <label class="btn btn-default" for="c-<?php echo $x ?>">C</label>
                                                </div>
                                                <div class="button mx-2">
                                                    <input type="radio" id="d-<?php echo $x ?>" value ="D" name="id-<?php echo $x ?>" />
                                                    <label class="btn btn-default" for="d-<?php echo $x ?>">D</label>
                                                </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?> 
                                
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="file hide" id="file-show">
                            <label for="">Correct OMR Sheet</label>

                            <input type="file" name="image" class="form-control my-2">
                            <center><input type="submit" value="Submit" class="btn btn-success my-4">
                                </center>
                        </div>
                    </div> -->
                    <center><input type="submit" value="Submit" class="btn btn-success my-4" name="cus-omr-btn">
                                </center>
                </form>
                </div>
        </div>
    </div>
</div>
</body>




<?php
    include('footer.php');
?>