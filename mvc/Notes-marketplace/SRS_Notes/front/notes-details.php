<?php 
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Notes Details</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- custom nav with profile image CSS -->
    <link rel="stylesheet" href="css/navigation.css">

</head>

<body>

     <!-- Navigation Bar -->
    <header>

        <nav class="navbar navbar-expand-lg white-navbar navbar-fixed-height fixed-top">

            <div class="container">
                <div class="row">

                    <!-- Logo -->
                    <div class="navbar-header col-lg-3 col-10">

                        <a class="navbar-brand text-left" href="#">
                            <img src="images/home/logo.png" alt="logo">
                        </a>

                    </div>

                    <button class="navbar-toggler collapsed col-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="mobile-nav-close-btn">&times;</span>
                        <span class="mobile-nav-open-btn">&#9776;</span>
                    </button>

                    <div class="collapse navbar-collapse col-lg-9" id="navbarSupportedContent">

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="search-notes.html">Search Notes</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Sell Your Notes</a></li>
                            <li class="nav-item"><a class="nav-link" href="buyer-request.html">Buyer Requests</a></li>
                            <li class="nav-item"><a class="nav-link" href="FAQ.html">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact-us.html">Contact Us</a></li>
                            <li class="nav-item profile-dropdown dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="images/notes-details/reviewer-1.png" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="user-profile.html">My Profile</a>
                                    <a class="dropdown-item" href="my-downloads.html">My Downloads</a>
                                    <a class="dropdown-item" href="my-sold-notes.html">My Sold Notes</a>
                                    <a class="dropdown-item" href="my-rejected-notes.html">My Rejected Notes</a>
                                    <a class="dropdown-item" href="change-password.html">Change Password</a>
                                    <a class="dropdown-item logout" <?php if(isset($_SESSION['is_loggedin'])) {echo 'href="http://localhost/Notes-marketplace/SRS_Notes/front/logout.php"';}  ?> >Logout</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" <?php if(isset($_SESSION['is_loggedin'])) {echo 'href="http://localhost/Notes-marketplace/SRS_Notes/front/logout.php"';}  ?>>Logout</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation Bar END -->

    <!-- Notes Details -->
    <section id="note-details">
        <div class="content-box notes-detail">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-6 col-12 col-sm-12">
                        <div class="note-detail-left">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-12 col-sm-12 horizontal-heading-sm text-left">
                                    <h3>Notes Details</h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5 col-12 col-lg-5 col-sm-5 note-image">
                                    <img src="images/notes-details/1.jpg" alt="notedetail">
                                </div>

                                <div class="col-md-7 col-12 col-lg-7 col-sm-7">
                                    <div class="note-heading">
                                        <h2>Computer Science</h2>
                                        <p>Science</p>
                                    </div>
                                    <div class="note-description">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At labore vero non deleniti, ex suscipit ut quo nesciunt in veniam, totam, quod amet tempora debitis voluptate, ducimus mollitia cum eligendi?</p>
                                    </div>
                                    <div class="download-btn">
                                       <?php if(isset($_SESSION['is_loggedin'])) {
                                        ?>
                                       <button type="button" class="btn btn-download" data-toggle="modal" data-target="#exampleModalLong">Download /$15</button>
                                       <?php }
                                        else {
                                            ?>
                                            <button type="button" class="btn btn-download" onclick="login()">Download /$15</button>
                                        <?php 
                                        }
                                        ?>
                                        <!--<a class="btn btn-download" href="#" title="Download" role="button" data-toggle="modal" data-target="#exampleModalLong">Download /$15</a>-->
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 col-12 col-lg-6 col-sm-12">
                        <div class="note-detail-right">
                            <div class="row">
                                <div class="col-md-6 col-6 col-lg-6 col-sm-6 left-side text-left">
                                    <p>Institution:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p>University of California</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 left-side text-left">
                                    <p>Country:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p>United States</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 left-side text-left">
                                    <p>Course Name:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p>Computer Engineering</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 left-side text-left">
                                    <p>Course Code:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p>248705</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 left-side text-left">
                                    <p>Professor:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p>Mr. Richard Brown</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 left-side text-left">
                                    <p>Number of Pages:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p>277</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 left-side text-left">
                                    <p>Approved Date:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p>November 25 2020</p>
                                </div>
                                <div class="col-md-4 col-4 col-sm-4 col-lg-4 left-side text-left">
                                    <p>Rating:</p>
                                </div>
                                <div class="col-md-8 col-8 col-sm-8 col-lg-8 right-side note-rating text-right">
                                    <div class="row">
                                        <div class="col-lg-7 col-6 col-sm-7 col-md-7">
                                        <div class="stars text-right">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>

                                    </div>    
                                        </div>
                                        <div class="col-lg-5 col-6 col-sm-5 col-md-5">
                                            <p>100 Reviews</p>    
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12 col-12 col-sm-9 col-lg-12 instruction left-side text-left">
                                    <p>5 Users marked this note as inappropriat</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="bottom-border col-md-12">

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Notes Details Ends -->

    <!-- Notes Preview -->
    <section id="notes-preview">
        <div class="content-box note-preview">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-12 col-sm-12 preview">
                        <div class="note-preview-left">
                            <div class="row">
                                <div class="col-md-12 col-12 col-sm-12 horizontal-heading-sm text-left">
                                    <h3>Notes Preview</h3>
                                </div>

                                <div class="note-detail-preview">
                                    <iframe src="http://www.africau.edu/images/default/sample.pdf" scrolling="no"></iframe>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-7 col-12 col-sm-12 preview">
                        <div class="note-preview-right">
                            <div class="row">
                                <div class="col-md-12 col-12 col-sm-12 horizontal-heading-sm text-left">
                                    <h3>Customer Reviews</h3>
                                </div>

                                <div class="review-container">
                                    <div clas="note-reviews">
                                        <!-- review 01 -->
                                        <div class="review">
                                            <div class="row">
                                                <div class="user-image col-md-2 col-2 col-sm-2">
                                                    <img src="images/notes-details/reviewer-1.png" alt="user" class="img-responsive img-circle">
                                                </div>
                                                <div class="review-detail col-md-10 col-10 col-sm-10">

                                                    <h4>Richard Brown</h4>
                                                    <div class="stars text-left">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto tempora aut, nesciunt rem excepturi itaque laborum odio, id explicabo.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- review 02 -->
                                        <div class="review">
                                            <div class="row">
                                                <div class="user-image col-md-2 col-2 col-sm-2">
                                                    <img src="images/notes-details/reviewer-2.png" alt="user" class="img-responsive img-circle">
                                                </div>
                                                <div class="review-detail col-md-10 col-10 col-sm-10">
                                                    <h4>Alice Ortiaz</h4>
                                                    <div class="stars text-left">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto tempora aut, nesciunt rem excepturi itaque laborum odio, id explicabo.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- review 03 -->
                                        <div class="review">
                                            <div class="row">
                                                <div class="user-image col-md-2 col-2 col-sm-2">
                                                    <img src="images/notes-details/reviewer-3.png" alt="user" class="img-responsive img-circle">
                                                </div>
                                                <div class="review-detail col-md-10 col-10 col-sm-10">
                                                    <h4>Sara Passmore</h4>
                                                    <div class="stars text-left">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto tempora aut, nesciunt rem excepturi itaque laborum odio, id explicabo.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Notes Preview Ends -->


    <!-- Section Footer -->
    <footer>
        <div class="container">
            <div class="row">

                <!-- Copyright -->
                <div class="col-md-7 col-sm-8 footer-text text-left">
                    <p>Copyright &copy; TatvaSoft All Rights Reserved By</p>
                </div>

                <!-- Social Icon -->
                <div class="col-md-5 col-sm-4 foot-icon text-right">
                    <ul class="social-list">
                        <li><a href="#"><img src="images/User-Profile/facebook.png" alt="facbook"></a></li>
                        <li><a href="#"><img src="images/User-Profile/twitter.png" alt="twitter"></a></li>
                        <li><a href="#"><img src="images/User-Profile/linkedin.png" alt="linkedin"></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>
    <!-- Section Footer END -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <div class="row">
                            <div class="col-md-12 col-12 col-sm-12">
                                <img src="images/notes-details/SUCCESS.png" alt="success">
                            </div>
                            <div class="col-md-12 col-12 col-sm-12">
                                <h3>Thank you for purchasing!</h3>
                            </div>
                        </div>

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="images/notes-details/close.png" alt="close">
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Dear Smith,</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id tempora ab tenetur, a libero voluptatum vero officiis similique iste amet, quam, in autem culpa qui quisquam, maiores omnis minima recusandae?</p>

                    <p>In case, you have urgency,<br>Please contect us on +9195377345949</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque aliquam dolor excepturi porro, </p>

                    <p>Have a good day</p>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
    
    <script>
        function login() {
            alert("please login first to download note.");
            window.location.href = "http://localhost/Notes-marketplace/SRS_Notes/front/login.php";
        }
    </script>

</body>

</html>