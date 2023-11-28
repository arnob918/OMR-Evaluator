<?php
session_start();

    if(isset($_SESSION['logged_in']))
    {
        $_SESSION['message'] = "Already logged in!";
        header('Location: index.php');
        exit();
    }
    include('header.php');
?>

<head>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-white bg-gradient static-top  pt-3 pb-0">
        <div class="container">
            <span>
                <a class="navbar-brand text-dark mx-4 font-rubik" href="">Login</a>
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

                    <li class="nav-item px-2">
                        <a class="nav-link text-dark" href="login.php">&nbsp Log In</a>
                    </li>
                    <li class="nav-item px-2">
                        <a href="register.php"><button type="button" class="btn btn-primary"> Register </button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <hr>


</head>

<div class="py-5">
    <div>
        <main>
            <div class="container py-5">
            <?php include('alertmessage.php');?>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <?php include('alertmessage.php'); ?>
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h4 class="text-white px-3 py-1">Login Form</h4>
                            </div>
                            <div class="card-body bg-light">
                                <form action="codes/code.php" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Your email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Your Password">
                                    </div>
                                    <div class="justify-content-center">
                                        <button type="submit" name="login_btn"
                                            class="btn btn-primary navbar-bg-gradient ">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>



<?php
    include('footer.php');
?>