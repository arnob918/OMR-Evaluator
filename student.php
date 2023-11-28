<?php
    session_start();
    include('checklogin.php');
    include('header.php');
    include('database/dbcon.php');
    $userid =  $_SESSION['user_info']['id'];
    $id = $_GET['id'];
    $roll = $_GET['roll'];
    
    
    $query = "SELECT * FROM `exams` WHERE id = '$id' AND user_id = '$userid'";
    $run_query = mysqli_query($con, $query);
    $id_table = mysqli_fetch_array($run_query);
    $cor_jsn = json_decode($id_table['json']);
    $rows = $id_table['noofques'];

    $query = "SELECT * FROM `result` WHERE id = '$id' AND stdID = '$roll' AND user_id = '$userid'";
    $run_query = mysqli_query($con, $query);
    $id_table = mysqli_fetch_array($run_query);
    $st_jsn = json_decode($id_table['json']);
    $op_marks = $id_table['obtainedmarks'];

    function btntype($i, $op, $cor_jsn, $st_jsn)
    {
        $st = "qu".(string)$i;
        if(($cor_jsn->$st == "X" or $cor_jsn->$st == $op) and $st_jsn->$st == $op){
            echo "success";
        }
        else if(($cor_jsn->$st != $op or $cor_jsn->$st == "X") and $st_jsn->$st == $op){
            echo "danger";
        }
        else if($cor_jsn->$st == $op and $st_jsn->$st != $op){
            echo "warning";
        }
        else {
            echo "default";
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
                <a class="navbar-brand text-dark mx-4 font-rubik" href="">Detailed Result</a>
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
<div class="py-2">
    <div class="container">
    <?php include('alertmessage.php');?>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                    <div class="row d-flex justify-content-center">
                        <div class="col card shadow my-3">
                        <div class="card-header bg-primary">
                            <h3 class="text-center text-white">Roll <?= $roll?></h3>
                        </div>
                            <div class="py-3 px-5">
                                <?php
                                for ($x = 1; $x <= $rows; $x++) {
                                    
                                    ?>
                                    <div class="container">
                                        <div class="row py-1">
                                            <div class="col-sm-1 py-1">
                                                    <h4 class="px-2" style="display: inline-block"><?= $x ?></h4>
                                            </div>
                                                <div class="button mx-2">
                                                    <label class="btn btn-<?=btntype($x, "A", $cor_jsn, $st_jsn)?>" for="a-<?php echo $x ?>">A</label>
                                                </div>
                                                <div class="button mx-2">
                                                    <label class="btn btn-<?=btntype($x, "B", $cor_jsn, $st_jsn)?>" for="b-<?php echo $x ?>">B</label>
                                                </div>
                                                <div class="button mx-2">
                                                    <label class="btn btn-<?=btntype($x, "C", $cor_jsn, $st_jsn)?>" for="c-<?php echo $x ?>">C</label>
                                                </div>
                                                <div class="button mx-2">
                                                    <label class="btn btn-<?=btntype($x, "D", $cor_jsn, $st_jsn)?>" for="d-<?php echo $x ?>">D</label>
                                                </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?> 
                                
                            </div>
                            <h4 class="text-center py-2">Obtained Marks: <?=$op_marks?></h4>
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
                </div>
        </div>
    </div>
</div>
</body>




<?php
    include('footer.php');
?>