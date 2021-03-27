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
    <title>Add Notes</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- custom nav with profile image CSS -->
    <link rel="stylesheet" href="css/navigation.css">

</head>

<body>

<?php 
    
    include 'db_conntect.php';
    include 'send_mail.php';
?>
<?php
    if(!(isset($_SESSION['is_loggedin']))){
        header("Location:login.php");
    }
    
    if(!(isset($_GET['edit']))){
        header("Location:dashboard.php");
    }
    else{
        $note_id = (int)$_GET['edit'];
        
        $edit_notes = "SELECT * FROM sellernotes WHERE ID='$note_id'";
        $edit_notes_query = mysqli_query($conn,$edit_notes);
        if(!($edit_notes_query)){
            die("QUERY FAILED".mysqli_error($conn));
        }
        $count = mysqli_num_rows($edit_notes_query);
        
        $row = mysqli_fetch_assoc($edit_notes_query);
        
        $edit_title = $row['Title'];
        
        $edit_category = $row['Category'];
        $edit_type = $row['NoteType'];
        $edit_pages = $row['NumberofPages'];
        $description = $row['Description'];
        $country = $row['Country'];
        $institution_name = $row['UniversityName']; 
        $course = $row['Course'];
        $course_code = $row['CourseCode'];
        $professor = $row['Professor'];
        $sell = $row['IsPaid'];
        $sell_price = $row['SellingPrice'];
        $edit_dp = $row['DisplayPicture'];
        $edit_cv = $row['NotesPreview'];
        //$flag = 1;
    }
    
    if(isset($_POST['submit'])){
         date_default_timezone_set('Asia/Kolkata');
            $save_title = $_POST['title'];
        
            $save_category = $_POST['category'];
            $save_type = $_POST['note-type'];
            $save_pages = $_POST['number-of-pages'];
            $save_description = $_POST['description'];
            $save_country = $_POST['country'];
            $save_institution_name = $_POST['institute-name']; 
            $save_course = $_POST['course-name'];
            $save_course_code = $_POST['course-code'];
            $save_professor = $_POST['professor-name'];
            $save_sell = $_POST['sellingtype'];
            $save_sell_price = $_POST['sellprice'];
            $profile_picture = $_FILES['display-picture']['name'];
            $profile_picture_tmp = $_FILES['display-picture']['tmp_name'];
            $preview_cv = $_FILES['note-preview']['name'];
            $preview_cv_tmp = $_FILES['note-preview']['tmp_name'];
            $accepted_image = array('png','jpg','jpeg');
            $accepted_pdf = array('pdf');
            if(!empty($_FILES['display-picture']['tmp_name'])){
                
                $profile_picture_ext = pathinfo( $_FILES["display-picture"]["name"], PATHINFO_EXTENSION ); 
                
                $profile_picture = "DP_". date("dmYhis") . "." . $profile_picture_ext;
            }
            else{
                $profile_picture = $edit_dp;
                $profile_picture_ext = "jpg";
            }
            if(!empty($_FILES['note-preview']['tmp_name'])){
                $preview_cv_ext = pathinfo( $_FILES["note-preview"]["name"], PATHINFO_EXTENSION ); 
                $preview_cv = "Preview_". date("dmYhis") ."." . $preview_cv_ext;
            }
            else{
                $preview_cv = $edit_cv;
                $preview_cv_ext = "jpg";
            }
            
            if(!in_array($profile_picture_ext,$accepted_image) ){
                echo "<script>alert('please enter valid image file extension like .jpg ,.jpeg or .png ');</script>";
            }
            elseif(!in_array($preview_cv_ext,$accepted_image)){
                echo "<script>alert('please enter valid image file extension like .jpg ,.jpeg or .png ');</script>";
            }
            $update_query = "UPDATE sellernotes SET Title = '{$save_title}', ";
            $update_query .= "Category = '{$save_category}', ";
            $update_query .= "NoteType = '{$save_type}', ";
            $update_query .= "NumberofPages = '{$save_pages}', ";
            $update_query .= "Country = '{$save_country}', ";
            $update_query .= "UniversityName = '{$save_institution_name}', ";
            $update_query .= "Course = '{$save_course}', ";
            $update_query .= "CourseCode = '{$save_course_code}', ";
            $update_query .= "Professor = '{$save_professor}', ";
            $update_query .= "IsPaid = $save_sell, ";
            $update_query .= "SellingPrice = $save_sell_price, ";
            $update_query .= "DisplayPicture = '{$edit_dp}', ";
            $update_query .= "NotesPreview = '{$edit_cv}' ";
            $update_query .= "WHERE ID= $note_id ";
            $update_select_query = mysqli_query($conn,$update_query);
            if(!($update_select_query)){
                die("QUERY FAILED".mysqli_error($conn));
            }else {
                 header('location:dashboard.php');
            }

        }
    
    if(isset($_POST['publish'])) {
    
                $last_note_id = $_SESSION['last_id'];
                $seller_email = $_SESSION['email'];
                $seller_name =  $_SESSION['username'];
                $note_title = $_SESSION['note_title'];
                $query = "UPDATE sellernotes SET Status = 7 WHERE ID = $note_id";
                $uquery = mysqli_query($conn, $query);
                if($uquery) {
                    
                    // This email address and name will be visible as sender of email

                    $mail->addAddress($seller_email);  // This email is where you want to send the email
                    $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address

                    // Setting the email content
                    $mail->IsHTML(true);  
                    $mail->Subject = "$seller_name sent his note for review"; 

                    $mail->Body = "Hello Admins,<br><br> We want to inform you that, $seller_name sent his note <br> $note_title for review. Please look at the notes and take required actions. <br><br> Regards,<br>Notes Marketplace";

                    if(!$mail->send()) {
                        ?>
                        <script>
                            alert('somthing went wrong');
                        </script>
                        <?php
                    }
                    else {
                        header('location:dashboard.php');
                    }    
                }else {
                    ?>
                <script>
                    alert("query fail")
                </script>
                <?php
                }
        
        } 
    
?>
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
                                    <a class="dropdown-item logout" href="http://localhost/Notes-marketplace/SRS_Notes/front/logout.php">Logout</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="http://localhost/Notes-marketplace/SRS_Notes/front/logout.php">Logout</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation Bar END -->


    <!-- Header Image Part -->
    <section id="head-part">
        <div id="head-part-content">
            <div class="container">
                <div class="row">
                    <div id="head-part-inner">
                        <div class="col-md-12">
                            <div class="header-statement" class="text-center">
                                <h3>Add Notes</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Header Image Part Ends -->

    <!-- Basic Notes Detail Strats -->
    <section id="basic-notes-details">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12 text-left">

                        <div class="horizontal-heading">
                            <h3>Basic Note Details</h3>
                        </div>

                    </div>

                    <div class="col-md-12 col-sm-12 col-12">

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">

                                <div class="form-group col-sm-6 col-12 col-md-6">
                                    <label for="title">Title *</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter your notes title"<?php if(isset($edit_title)) { echo "value='$edit_title'";} ?>  >
                                </div>
                                
                                
                                <div class="form-group col-sm-6 col-12 col-md-6">
                                    <label for="category">Category *</label>
                                     <?php 
                                        $getcategoryquery = "SELECT * FROM notecategories WHERE IsActive = b'1'";
                                        $categoryquery = mysqli_query($conn, $getcategoryquery);
                                        $categoryrows = mysqli_num_rows($categoryquery);
                                    ?>
                                    <select id="category" name="category" class="form-control">
                                        <?php 
                                        for($i=1;$i<=$categoryrows;$i++) {
                                            $categoryrow = mysqli_fetch_array($categoryquery);
                                            $cat_id = $categoryrow['ID'];
                                            $cat_name = $categoryrow['Name'];
                                            if($cat_id == $edit_category) {
                                                echo "<option value='$cat_id}' selected>$cat_name</option>";
                                            } else {
                                                echo "<option value='$cat_id}'>$cat_name</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-6 col-12 col-md-6 file-upload">
                                    <label for="display-picture">Display Picture</label>
                                    <input type="file" name="display-picture" class="form-control-file display-picture" id="display-picture">
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="upload-notes">Upload Notes *</label>
                                    <input type="file" name="notes-data[]" class="form-control-file upload-notes" id="upload-notes" multiple>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="type">Type</label>
                                    <?php 
                                        $getnotetypequery = "SELECT * FROM notetypes WHERE IsActive = b'1'";
                                        $notetypequery = mysqli_query($conn, $getnotetypequery);
                                        $notetyperows = mysqli_num_rows($notetypequery);
                                    ?>
                                    <select id="type" name="note-type" class="form-control">
                                        <?php 
                                        for($i=1;$i<=$notetyperows;$i++) {
                                            $notetyperow = mysqli_fetch_array($notetypequery);
                                            $note_type_id = $notetyperow['ID'];
                                            $note_type_name = $notetyperow['Name'];
                                            if($note_type_id == $edit_type) {
                                                echo "<option value='$note_type_id}' selected>$note_type_name</option>";
                                            } else {
                                                echo "<option value='$note_type_id}'>$note_type_name</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="number-of-page">Number of Pages</label>
                                    <input type="text" name="number-of-pages" class="form-control" id="number-of-page" placeholder="Enter number of note pages" <?php if(isset($edit_pages)) { echo "value='$edit_pages'";} ?>>
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-12 col-sm-12 col-md-12">
                                    <label for="description">Description *</label>
                                    <textarea class="form-control"  name="description" id="description" <?php echo "placeholder='$description'";?>></textarea>
                                </div>
                            </div>

                            <!-- address details -->
                            <div class="form-group-heading">
                                <h3>Institution Information</h3>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="country">Country</label>
                                    <?php 
                                        $getcountryquery = "SELECT * FROM countries WHERE IsActive = b'1'";
                                        $countryquery = mysqli_query($conn, $getcountryquery);
                                        $countryrows = mysqli_num_rows($countryquery);
                                    ?>
                                    <select id="country" name="country" class="form-control">
                                        <?php 
                                        for($i=1;$i<=$countryrows;$i++) {
                                            $countryrow = mysqli_fetch_array($countryquery);
                                            $country_id = $countryrow['ID'];
                                            $country_name = $countryrow['Name'];
                                            if($note_type_id == $country) {
                                                echo "<option value='$country_id' selected>$country_name</option>";
                                            } else {
                                                echo "<option value='$country_id'>$country_name</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="institution-name">Institution Name</label>
                                    <input type="text" name="institute-name" class="form-control" id="institution-name" placeholder="Enter your institution name" <?php if(isset($institution_name)) { echo "value='$institution_name'";} ?>>
                                </div>
                            </div>

                            <!-- address details -->
                            <div class="form-group-heading">
                                <h3>Course Details</h3>
                            </div>


                            <div class="form-row">

                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="course-name">Course Name</label>
                                    <input type="text" name="course-name" class="form-control" id="course-name" placeholder="Enter your course name" <?php if(isset($course)) { echo "value='$course'";} ?>>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="course-code">Course Code</label>
                                    <input type="text" name="course-code" class="form-control" id="course-code" placeholder="Enter your course code" <?php if(isset($course_code)) { echo "value='$course_code'";} ?>>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="professor-name">Professor/Lecturer</label>
                                    <input type="text" name="professor-name" class="form-control" id="professor-name" placeholder="Enter your professor name" <?php if(isset($professor)) { echo "value='$professor'";} ?>>
                                </div>

                            </div>

                            <!-- university details -->
                            <div class="form-group-heading">
                                <h3>Selling Information</h3>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <div class="row checkBox">
                                        <div class="form-group sell-for-div col-lg-12 col-md-12 col-sm-12 col-12" id="btn-radio-paid-free">
                                            <p id="radio-heading" style="margin-bottom: 9px;">Sell For *</p>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sellingtype" id="free" value="0" <?php if($sell == 0) {echo "checked";} ?>>
                                                <label class="form-check-label" for="free">Free</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sellingtype" id="paid" value="1" <?php if($sell == 1) {echo "checked";} ?> >
                                                <label class="form-check-label" for="paid">Paid</label>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="sell-price" style="margin-top: 6px;">Sell Price *</label>
                                    <input type="text" name="sellprice" class="form-control" id="sell-price" placeholder="Enter your price" style="margin-top: 6px;" <?php if($sell == 1) {echo "value='$sell_price'";} ?>>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="note-preview">Note Preview</label>
                                    <input type="file" name="note-preview" class="form-control-file note-preview" id="note-preview">
                                </div>

                            </div>



                            <div class="row">
                                <div class="col-10 col-md-6 col-lg-4 col-sm-7">
                                    <div class="row">
                                        <div class="col-6 col-md-6 col-lg-6 col-sm-6" style="padding-right: 0px;">
                                            <div id="notes-submit-btn">
                                                 <button type="submit" id="note-submit" name="submit" class="btn note-submit-btn" <?php echo isset($_POST['submit']) ? 'disabled="true"' : ''; ?>>SUBMIT</button>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-6 col-lg-6 col-sm-6" style="padding: 0px;">
                                            <div id="publish-btn">
                                                <button type="submit" id="note-publish" name="publish" class="btn publish-btn" >Publish</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Notes Detail Strats -->

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




    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>