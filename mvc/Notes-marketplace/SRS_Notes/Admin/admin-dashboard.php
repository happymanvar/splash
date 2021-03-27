<?php 
session_start();

if(!isset($_SESSION['username'])) {
    header('location:admin-login.php');
}

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Dashboard</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">

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
                            <img src="admin-images/images/logo.png" alt="logo">
                        </a>

                    </div>

                    <button class="navbar-toggler collapsed col-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="mobile-nav-close-btn">&times;</span>
                        <span class="mobile-nav-open-btn">&#9776;</span>
                    </button>

                    <div class="collapse navbar-collapse col-lg-9" id="navbarSupportedContent">

                        <ul class="navbar-nav ml-auto">

                            <li class="nav-item"><a class="nav-link" href="admin-dashboard.php">Dashboard</a></li>

                            <li class="nav-item notes-dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Notes</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="notes-under-review.html">Notes Under Review</a>
                                    <a class="dropdown-item" href="published-notes.html">Published Notes</a>
                                    <a class="dropdown-item" href="downloaded-notes.html">Downloaded Notes</a>
                                    <a class="dropdown-item" href="rejected-notes.html">Rejected Notes</a>
                                </div>
                            </li>

                            <li class="nav-item"><a class="nav-link" href="mambers.html">Members</a></li>

                            <li class="nav-item reports-dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Reports</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="spam-report.html">Spam Reports</a>
                                </div>
                            </li>

                            <li class="nav-item setting-dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Settings</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="manage-system-config.html">Manage System Configuration</a>
                                    <a class="dropdown-item" href="manage-administrator.html">Manage Administrator</a>
                                    <a class="dropdown-item" href="manage-category.html">Manage Category</a>
                                    <a class="dropdown-item" href="manage-type.html">Manage Type</a>
                                    <a class="dropdown-item" href="manage-country.html">Manage Countries</a>
                                </div>
                            </li>

                            <li class="nav-item profile-dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="admin-images/images/reviewer-1.png" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="user-profile.html">Update Profile</a>
                                    <a class="dropdown-item" href="my downloads.html">Change Password</a>
                                    <a class="dropdown-item" href="localhost/Notes-marketplace/SRS_Notes/Admin/logout.php"><span>Logout</span></a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="http://localhost/Notes-marketplace/SRS_Notes/Admin/logout.php">Logout</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation Bar END -->

    <!-- Dashboard Starts  -->
    <section id="admin-dashboard">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="horizontal-heading">
                            <h3>Deshboard</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-12 dashboard-box-outer">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3 class="heading-numeric">20</h3>
                            <p>Numbers of Notes in Review for publish</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 dashboard-box-outer">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3 class="heading-numeric">103</h3>
                            <p>Numbers of New Notes Downloaded<br>(Lsat 7 Days)</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 dashboard-box-outer">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3 class="heading-numeric">223</h3>
                            <p>Numbers of New Registrations (Last 7 Days)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Ends -->

    <!-- Published Notes Starts -->
    <section id="dashboard-published-notes">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="horizontal-heading-sm">
                            <h3>Published Notes</h3>
                        </div>
                    </div>

                    <div class="col-md-8 col-12">
                        <div class="row text-right">
                            <div class="col-md-5 col-8 table-search-bar">
                                <div class="form-group">
                                    <input type="search" class="form-control" id="search" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-3 col-4 table-header-search-btn">
                                <div id="search-btn">
                                    <a class="btn table-search-btn" href="#" title="search" role="button">SEARCH</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-12 table-select-menu">
                                <form>
                                    <div class="form-group">
                                        <select id="month" class="form-control">
                                            <option selected>Select month</option>
                                            <option>January</option>
                                            <option>February</option>
                                            <option>March</option>
                                            <option>April</option>
                                            <option>May</option>
                                            <option>June</option>
                                            <option>July</option>
                                            <option>August</option>
                                            <option>September</option>
                                            <option>October</option>
                                            <option>November</option>
                                            <option>December</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="dashboard-published-notes-table table-responsive">

                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="table-header">SR NO.</th>
                                        <th scope="col" class="table-header seller">TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header">ATTACHMENT SIZE</th>
                                        <th scope="col" class="table-header">SELL TYPE</th>
                                        <th scope="col" class="table-header">PRICE</th>
                                        <th scope="col" class="table-header seller">PUBLISHER</th>
                                        <th scope="col" class="table-header date">PUBLISHED DATE</th>
                                        <th scope="col" class="table-header">NUMBER OF DOWNLOADS</th>
                                        <th scope="col" class="table-header"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 50px;" class="text-center">
                                        <td>1</td>
                                        <td style="color: #6255a5;">Data Science</td>
                                        <td>Science</td>
                                        <td>10 KB</td>
                                        <td>Free</td>
                                        <td>$0</td>
                                        <td>Pritesh Panchal</td>
                                        <td>09-10-2020, 10:10</td>
                                        <td>10</td>
                                        <td class="text-center">
                                            <div class="btn-group dropleft">
                                                <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="admin-images/images/dots.png" alt="menu" class="">
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <button class="dropdown-item" type="button">Download Notes</button>
                                                    <button class="dropdown-item" type="button">View More Details</button>
                                                    <button class="dropdown-item" type="button">Unpublish</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="height: 50px;" class="text-center">
                                        <td>2</td>
                                        <td style="color: #6255a5;">Accounts</td>
                                        <td>Commerce</td>
                                        <td>23 MB</td>
                                        <td>Paid</td>
                                        <td>$22</td>
                                        <td>Rahil Shah </td>
                                        <td>10-10-2020, 12:30</td>
                                        <td>10</td>
                                        <td class="text-center">
                                            <div class="btn-group dropleft">
                                                <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="admin-images/images/dots.png" alt="menu" class="">
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <button class="dropdown-item" type="button">Download Notes</button>
                                                    <button class="dropdown-item" type="button">View More Details</button>
                                                    <button class="dropdown-item" type="button">Unpublish</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="height: 50px;" class="text-center">
                                        <td>3</td>
                                        <td style="color: #6255a5;">Social Studies</td>
                                        <td>Social</td>
                                        <td>3 MB</td>
                                        <td>Paid</td>
                                        <td>$56</td>
                                        <td>Anish Patel</td>
                                        <td>11-10-2020, 01:00</td>
                                        <td>10</td>
                                        <td class="text-center">
                                            <div class="btn-group dropleft">
                                                <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="admin-images/images/dots.png" alt="menu" class="">
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <button class="dropdown-item" type="button">Download Notes</button>
                                                    <button class="dropdown-item" type="button">View More Details</button>
                                                    <button class="dropdown-item" type="button">Unpublish</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="height: 50px;" class="text-center">
                                        <td>4</td>
                                        <td style="color: #6255a5;">AI</td>
                                        <td>IT</td>
                                        <td>1 MB</td>
                                        <td>Free</td>
                                        <td>$0</td>
                                        <td>Vijay Vaishnav</td>
                                        <td>12-10-2020, 10:10</td>
                                        <td>34</td>
                                        <td class="text-center">
                                            <div class="btn-group dropleft">
                                                <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="admin-images/images/dots.png" alt="menu" class="">
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <button class="dropdown-item" type="button">Download Notes</button>
                                                    <button class="dropdown-item" type="button">View More Details</button>
                                                    <button class="dropdown-item" type="button">Unpublish</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="height: 50px;" class="text-center">
                                        <td>5</td>
                                        <td style="color: #6255a5;">Lorem ipsum</td>
                                        <td>Lorem</td>
                                        <td>105 KB</td>
                                        <td>Paid</td>
                                        <td>$90</td>
                                        <td>Mehul Patel</td>
                                        <td>13-10-2020, 11:25</td>
                                        <td>9</td>
                                        <td class="text-center">
                                            <div class="btn-group dropleft">
                                                <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="admin-images/images/dots.png" alt="menu" class="">
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <button class="dropdown-item" type="button">Download Notes</button>
                                                    <button class="dropdown-item" type="button">View More Details</button>
                                                    <button class="dropdown-item" type="button">Unpublish</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true"><img src="admin-images/images/left-arrow.png" alt="left arrow"> </span>
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true"><img src="admin-images/images/right-arrow.png" alt="left arrow"></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Dashboard Ends -->

    <!-- Footer -->
    <footer>
        <section id="footer">
            <div class="container">
                <div class="row">
                    <!-- Copyright -->
                    <div class="col-md-6 col-sm-4 footer-text text-left">
                        <p>Version: 1.1.24</p>
                    </div>
                    <!-- Social Icon -->
                    <div class="col-md-6 col-sm-8 footer-icon text-right">
                        <p>Copyright &copy; TatvaSoft All Rights Reserved</p>
                    </div>
                </div>
            </div>

        </section>
    </footer>
    <!-- Footer Ends -->

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- poper JS -->
    <script src="js/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>