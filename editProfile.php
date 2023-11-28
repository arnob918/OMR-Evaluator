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
                <a class="navbar-brand text-dark mx-4 font-rubik" href="">Edit Profile</a>
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
    
                    
    <form action="codes/code.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" value="<?= $id?>" name="id">
    <input type="hidden" value="<?= $old_data['image']?>" name="oldimage">
    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <img src="images/<?= $old_data['image']?>" alt="Admin" class="rounded-circle" width="150">
                <label for="">Profile Picture</label>

                <input type="file" name="image" class="form-control my-2">
                <div class="mt-3">
                  <!-- <p class="text-secondary mb-1">Student</p> -->
                  <label for="">About</label>
                  <input type="text" value="<?= $old_data['About']?>" name="about" class="form-control my-2">
                  <!-- <p class="text-muted font-size-sm">Khulna University of Engineering & Technology</p> -->
                  <label for="">Organization</label>
                  <input type="text" value="<?= $old_data['Organization']?>" name="organization" class="form-control my-2">
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="col-md-8">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                    <!-- <input type="hidden" name="id" value="Arnob"> -->
                    <!-- <label for="">First Name</label> -->
                    
                  <h6 class="pt-3">First Name</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <input type="text" value="<?= $old_data['FirstName']?>" name="fname" class="form-control my-2">
                  <!-- <h6 class="mb-0">First Name</h6> -->
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="pt-3">Last Name</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <input type="text" value="<?= $old_data['LastName']?>" name="lname" class="form-control my-2">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="pt-3">Phone</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <input type="text" value="<?= $old_data['Phone']?>" name="phone" class="form-control my-2">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="pt-3">Address</h6>
                </div>
                <div class="col-sm-6 text-secondary">
                  <input type="text" value="<?= $old_data['Address']?>" name="address" class="form-control my-2">
                </div>
              </div>
            </div>
          </div>

          



        </div>
        <div class="row">
        <div class="col-sm-3"></div>
          <div class="col-sm-3">
            <center><button type="submit" class="btn btn-success mt-3 shadow" name="edit-profile">Update</button></center>
          </div>
          <div class="col-sm-3">
          <a href="dashboard.php" class="btn btn-danger mt-3 shadow">Cancel</a>
          </div>
        </div>
    </div>
      </form>
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