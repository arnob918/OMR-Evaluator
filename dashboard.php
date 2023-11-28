<?php
    session_start();
    include('checklogin.php');
    include('header.php');
    include('database/dbcon.php');
    $id =  $_SESSION['user_info']['id'];
    $query = "SELECT * FROM userinfo WHERE id='$id'";
    $run_query = mysqli_query($con, $query);
?>

<head>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-white bg-gradient static-top  pt-3 pb-0">
        <div class="container">
            <span>
                <a class="navbar-brand text-dark mx-4 font-rubik" href="">Account</a>
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


<div class="container">
<?php include('alertmessage.php');?>
    <div class="main-body py-1">
      <?php
        if(mysqli_num_rows($run_query) > 0)
        {

            $old_data = mysqli_fetch_array($run_query);
      ?>
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="images/<?= $old_data['image']?>" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4> <?=  $_SESSION['user_info']['name'] ?> </h4>
                      <p class="text-secondary mb-1"><?= $old_data['About']?></p>
                      <p class="text-muted font-size-sm"><?= $old_data['Organization']?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="btn btn-outline-primary list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h5 class="mb-0 py-1"><a class="nav-link" href="editProfile.php"><i class="fa-solid fa-user-pen"></i>&nbsp Edit Profile</a></h5>
                    
                  </li>
                  <li class="btn btn-outline-primary list-group-item d-flex justify-content-between align-items-center flex-wrap">
                  <h5 class="mb-0 py-1"><a class="nav-link " href="workspace.php"><i class="fa-solid fa-briefcase"></i>&nbsp Workspace</a></h5>
                  </li>
                  <li class="btn btn-outline-primary list-group-item d-flex justify-content-between align-items-center flex-wrap">
                  <h5 class="mb-0 py-1"><a class="nav-link " href="score.php"><i class="fa-sharp fa-solid fa-list-check"></i>&nbsp Exams</a></h5>
                  </li>
                 
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $old_data['FirstName']?> &nbsp <?= $old_data['LastName']?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?=  $_SESSION['user_info']['email'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $old_data['Phone']?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $old_data['Address']?>
                    </div>
                  </div>
                  <hr>
                </div>
              </div>

              <div class="row gutters-sm">
                <div class="col">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Usage Status</i></h6>
                      <?php
                        $query = "SELECT * FROM `result`";
                        $run_query = mysqli_query($con, $query);
                        $omrcnt = mysqli_num_rows($run_query);
                        
                        $query = "SELECT * FROM `exams`";
                        $run_query = mysqli_query($con, $query);
                        $xmcnt = mysqli_num_rows($run_query);
                        
                      ?>
                      <small>Number of OMRs (<?=$omrcnt?>/100)</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?=$omrcnt?>%" aria-valuenow="<?=$omrcnt?>" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Number of Exams (<?=$xmcnt?>/100)</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?=$xmcnt?>%" aria-valuenow="<?=$xmcnt?>" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



            </div>
          </div>
          <?php
              }
              else{
                  echo "id not found";
              }
          ?>

        </div>
    </div>


    <!-- <div class="sidebar">
    <div class="py-5">
            <a class="active" href="">Dashboard</a>
            <a href="products.php">Settings</a>
            <a href="add-product.php">History</a>
            <a href="placed-orders.php">Premium Account</a>
        </div>
    </div>
    
    <div class="content">
            <div class="container py-5">
                <h3 class="text-center">OMR Solver</h3>
                <hr>

            </div>
</div> -->



<?php
    include('footer.php');
?>