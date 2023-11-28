<?php
    session_start();
    include('header.php');
     
?>

<head>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-white  static-top  pt-3 pb-0">
        <div class="container">
            <span>
                <a class="navbar-brand text-dark mx-4 font-rubik" href="index.php">OMR Solver</a>
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
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
                        <li><a class="dropdown-item" href="score.php">Exams
                            
                        </a></li>
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
    <div class="py-3">
        <div>
            <div >
                <div class="container">
                <?php include('alertmessage.php'); ?>
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                <table style="height: 350px;">
                                        <tbody>
                                            <tr>
                                            <td class="align-middle">
                                                <h1><strong>OMR SHEET EVALUATOR</strong></h1>
                                                <p class="h5">
                                                    Easily evaluate omr sheets. Avoid boring work and save time.
                                                </p>
                                                <hr>
                                                <a href="workspace.php" type="button" class="btn btn-primary btn-lg">Workspace</a>
                                                <a href="score.php" type="button" class="btn btn-warning btn-lg">Exams</a>
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    
                                </div>
                                <div class="col">
                                    <div class="px-5">
                                        <div class="px-5">
                                        <a href="">
                                        <img src="images/omr-evaluation.jpg" height="350" width="400" alt="omr-pic">
                                        </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                </main>

            </div>
        </div>
    </div>
</div>
</body>

<?php
    include('footer.php');
?>