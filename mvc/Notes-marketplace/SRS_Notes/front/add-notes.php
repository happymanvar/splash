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
    
    $user_id = "";
    $user_id = $_SESSION['user_id'];
    $isflag = 0;
    $name_to_store_np = "";
    $name_to_store_dp = "";
    $selling_price = "";
    $last_inserted_id = "";
    $is_note_inserted = "false";
    $last_query = "";
    
    
    if(isset($_POST['submit'])) {
        
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $note_type = mysqli_real_escape_string($conn, $_POST['note-type']);
        $number_of_pages = mysqli_real_escape_string($conn, $_POST['number-of-pages']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $institute_name = mysqli_real_escape_string($conn, $_POST['institute-name']);
        $course_name = mysqli_real_escape_string($conn, $_POST['course-name']);
        $course_code = mysqli_real_escape_string($conn, $_POST['course-code']);
        $professor_name = mysqli_real_escape_string($conn, $_POST['professor-name']);
        $sellingtype = mysqli_real_escape_string($conn, $_POST['sellingtype']);
        $sellprice = mysqli_real_escape_string($conn, $_POST['sellprice']);
        $note_preview = $_FILES['note-preview'];
        $display_picture = $_FILES['display-picture'];
        $notes_data = $_FILES['notes-data'];
        
                // note previe file data
                $note_preview_filename = $note_preview['name'];
                $note_preview_fileerror = $note_preview['error'];
                $note_preview_filetemp = $note_preview['tmp_name'];

                $note_preview_fileext = explode('.',$note_preview_filename);
                $note_preview_filecheck = strtolower(end($note_preview_fileext));
                $note_preview_ext = end($note_preview_fileext);

                $fileextstored = array('pdf');
        
                
            // display picture file data
                $display_pic_filename = $display_picture['name'];
                $display_pic_fileerror = $display_picture['error'];
                $display_pic_filetemp = $display_picture['tmp_name'];
                
                $display_pic_fileext = explode('.',$display_pic_filename);
                $display_pic_filecheck = strtolower(end($display_pic_fileext));
                $display_pic_ext = end($display_pic_fileext);
                $display_pic_fileextstored = array('png', 'jpg', 'jpeg');

                
        if($sellingtype == "0") {
            
            if(!empty($note_preview_filename)) {
                if(in_array($note_preview_filecheck,$fileextstored)) {
                
                //$destinationfile2 = '../Members/'.$note_preview_filename;
                //move_uploaded_file($note_preview_filetemp,$destinationfile2);
                $name_to_store_np = $note_preview_filename;    
            
                } else {
                    ?>
                <script>
                    alert("select proper file type for preview 1")
                </script>
                <?php
                }
                
            } // free with preview end
            
        } // free selling off
        else {
            if(!empty($sellprice) && !empty($note_preview_filename)) {
                if(in_array($note_preview_filecheck,$fileextstored)) {
            
                $name_to_store_np = $note_preview_filename;    
            
                } else {
                      ?>
                <script>
                    alert("select proper file type for preview 2")
                </script>
                <?php
                }
            }
        } // paid selling off
        
        if(!empty($display_pic_filename)) {
            if(in_array($display_pic_filecheck,$display_pic_fileextstored)) {
                
                $name_to_store_dp = $display_pic_filename;    
            
                } else {
                    ?>
                <script>
                    alert("select proper file type for preview 2")
                </script>
                <?php
                }
            
        } // display pic provided end 
        else {
            
        } // default display pic end
        
        if(!empty($title) && !empty($category) && !empty($notes_data) && !empty($note_type) && !empty($description) && !empty($country) && !empty($institute_name) && !empty($course_name) && !empty($course_code)) {
            
            if($sellingtype == "1") {
                if(!empty($sellprice) && !empty($name_to_store_np)) {
                    $selling_price = $sellprice;
                    
                    
                    $insert_note_query = "INSERT INTO `sellernotes` (`SellerID`, `Status`, `ActionedBy`, `AdminRemarks`, `PublishedDate`, `Title`, `Category`, `DisplayPicture`, `NoteType`, `NumberofPages`, `Description`, `UniversityName`, `Country`, `Course`, `CourseCode`, `Professor`, `IsPaid`, `SellingPrice`, `NotesPreview`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES ($user_id, '6', $user_id, 'best', current_timestamp(), '$title', $category, '$name_to_store_dp', $note_type, $number_of_pages, '$description', '$institute_name', $country, '$course_name', '$course_code', '$professor_name', b'$sellingtype', '$selling_price', '$name_to_store_np', current_timestamp(), '1', current_timestamp(), '1', b'1')";
                    
                    $inotequery = mysqli_query($conn, $insert_note_query);
                    
                    if($inotequery) {
                        $is_note_inserted = "true";
                         $last_inserted_id = mysqli_insert_id($conn);
                            echo "last entry paid id:" . $last_inserted_id ;
                        echo "last entry paid id:" . $last_inserted_id;
                        $_SESSION['last_id'] = $last_inserted_id;
                        $_SESSION['note_title'] = $title;
                        echo "happy";
                        echo $_SESSION['last_id'];
                        echo $_SESSION['note_title'];
                    } else {
                        ?>
                <script>
                    alert("query fail to insert with paid note")
                </script>
                <?php
                    }
                    
                    
                } // paid note with selling price end
                else {
                     ?>
                <script>
                    alert("please enter selling amount and notes preview")
                </script>
                <?php
                } // paid note withour selling price
            } // paid note inserted successfully
            else {
                $selling_price = 0;
                
                $insert_note_query = "INSERT INTO `sellernotes` (`SellerID`, `Status`, `ActionedBy`, `AdminRemarks`, `PublishedDate`, `Title`, `Category`, `DisplayPicture`, `NoteType`, `NumberofPages`, `Description`, `UniversityName`, `Country`, `Course`, `CourseCode`, `Professor`, `IsPaid`, `SellingPrice`, `NotesPreview`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES ($user_id, '6', $user_id, 'best', current_timestamp(), '$title', $category, '$name_to_store_dp', $note_type, $number_of_pages, '$description', '$institute_name', $country, '$course_name', '$course_code', '$professor_name', b'$sellingtype', '$selling_price', '$name_to_store_np', current_timestamp(), '1', current_timestamp(), '1', b'1')";
                    
                    $inotequery = mysqli_query($conn, $insert_note_query);
                    
                    if($inotequery) {
                        $is_note_inserted = "true";
                         $last_inserted_id = mysqli_insert_id($conn);
                        
                        echo "last entry paid id:" . $last_inserted_id;
                        $_SESSION['last_id'] = $last_inserted_id;
                        $_SESSION['note_title'] = $title;
                        echo "happy";
                        echo $_SESSION['last_id'];
                        echo $_SESSION['note_title'];
                    } else {
                        ?>
                <script>
                    alert("query fail to insert with free note")
                </script>
                <?php
                    }
            }
            
        } // all field provided ends
        else {
            echo "all fields are required please fill all fields..";
            
        } // missing some field ends
        
        if($is_note_inserted == "true") {
            
            if(!empty($last_inserted_id)) {
                
                // notes atteachments file data

                $atta_count = count($_FILES['notes-data']['name']);
                echo $atta_count;
                for($i=0; $i<$atta_count; $i++) {
                    $notes_data_filename = $_FILES['notes-data']['name'][$i];
                    $notes_data_filetemp = $_FILES['notes-data']['tmp_name'][$i];
                    
                    $note_date_fileext = explode('.',$notes_data_filename);
                    $note_data_filecheck = strtolower(end($note_date_fileext));
                    $note_data_ext = end($note_date_fileext);
                    
                    if(in_array($note_data_filecheck,$fileextstored)) {
                
                        $store_name_atta = "Attachement_" . $i . "_" . date("dmyhis") . "." . $note_data_ext;
                        $atta_path = "../Members/$user_id/$last_inserted_id/Attachements/$store_name_atta"; 

                        $insert_attachements = "INSERT INTO `sellernotesattachements`(`NoteID`, `FileName`, `FilePath`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES ($last_inserted_id, '$store_name_atta', '$atta_path', current_timestamp(), '1', current_timestamp(), '1', b'1')";


                        date_default_timezone_set('Asia/Kolkata');


                        if(!is_dir("../Members/$user_id/$last_inserted_id/Attachements")) {
                            mkdir("../Members/$user_id/$last_inserted_id/Attachements", 0777, true);
                        }
                        move_uploaded_file($notes_data_filetemp, "../Members/$user_id/$last_inserted_id/Attachements/$store_name_atta"); 

                        $ins_atta_query = mysqli_query($conn, $insert_attachements);
                        if(!($ins_atta_query)) {
                            die("QUERY FAILED".mysqli_error($conn));
                        }    
            
                    } else {
                         ?>
                <script>
                    alert("select proper file type for note attachements")
                </script>
                <?php
                    }
                    
                } // for loop over
                
                $store_name_dp = "DP_". date("dmyhis") . "." . $display_pic_ext;
                $store_name_np = "Preview_". date("dmyhis") . "." . $note_preview_ext;
                if(!is_dir("../Members/$user_id/$last_inserted_id")) {
                    mkdir("../Members/$user_id/$last_inserted_id", 0777, true);
                }
                    
                move_uploaded_file($display_pic_filetemp, "../Members/$user_id/$last_inserted_id/$store_name_dp");
                if (!empty($note_preview_filetemp)) {
                    move_uploaded_file($note_preview_filetemp, "../Members/$user_id/$last_inserted_id/$store_name_np");     
                }   
                $isflag = 1;
            } // notes attachements are stored and files are moved to folder
            else {
                 ?>
                <script>
                    alert("somthing want wrong")
                </script>
                <?php
            }
            $is_note_inserted == "true";
        }
    }
    
    if(isset($_POST['publish'])) {
    
                $last_note_id = $_SESSION['last_id'];
                $seller_email = $_SESSION['email'];
                $seller_name =  $_SESSION['username'];
                $note_title = $_SESSION['note_title'];
                $query = "UPDATE sellernotes SET Status = 7 WHERE ID = $last_note_id";
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
                        header('location:http://localhost/Notes-marketplace/SRS_Notes/front/dashboard.php');
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
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter your notes title">
                                </div>
                                <div class="form-group col-sm-6 col-12 col-md-6">
                                    <label for="category">Category *</label>
                                     <?php 
                                        $getcategoryquery = "SELECT * FROM notecategories WHERE IsActive = b'1'";
                                        $categoryquery = mysqli_query($conn, $getcategoryquery);
                                        $categoryrows = mysqli_num_rows($categoryquery);
                                    ?>
                                    <select id="category" name="category" class="form-control">
                                        <option selected hidden value="">Select your category <type></type>
                                        </option>
                                        <?php 
                                        for($i=1;$i<=$categoryrows;$i++) {
                                            $categoryrow = mysqli_fetch_array($categoryquery);
                                        ?>
                                        <option value="<?php echo $categoryrow["ID"] ?>"><?php echo $categoryrow["Name"] ?></option>
                                        <?php 
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
                                        <option selected hidden value="">Select your note type<type></type>
                                        </option>
                                        <?php 
                                        for($i=1;$i<=$notetyperows;$i++) {
                                            $notetyperow = mysqli_fetch_array($notetypequery);
                                        ?>
                                        <option value="<?php echo $notetyperow["ID"] ?>"><?php echo $notetyperow["Name"] ?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="number-of-page">Number of Pages</label>
                                    <input type="text" name="number-of-pages" class="form-control" id="number-of-page" placeholder="Enter number of note pages">
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-12 col-sm-12 col-md-12">
                                    <label for="description">Description *</label>
                                    <textarea class="form-control"  name="description" id="description" placeholder="Enter your description"></textarea>
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
                                        <option selected hidden value="">Select your country<type></type>
                                        </option>
                                         <?php 
                                        for($i=1;$i<=$countryrows;$i++) {
                                            $countryrow = mysqli_fetch_array($countryquery);
                                        ?>
                                        <option value="<?php echo $countryrow["ID"] ?>"><?php echo $countryrow["Name"] ?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="institution-name">Institution Name</label>
                                    <input type="text" name="institute-name" class="form-control" id="institution-name" placeholder="Enter your institution name">
                                </div>
                            </div>

                            <!-- address details -->
                            <div class="form-group-heading">
                                <h3>Course Details</h3>
                            </div>


                            <div class="form-row">

                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="course-name">Course Name</label>
                                    <input type="text" name="course-name" class="form-control" id="course-name" placeholder="Enter your course name">
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="course-code">Course Code</label>
                                    <input type="text" name="course-code" class="form-control" id="course-code" placeholder="Enter your course code">
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="professor-name">Professor/Lecturer</label>
                                    <input type="text" name="professor-name" class="form-control" id="professor-name" placeholder="Enter your professor name">
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
                                                <input class="form-check-input" type="radio" name="sellingtype" id="free" value="0" checked>
                                                <label class="form-check-label" for="free">Free</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sellingtype" id="paid" value="1">
                                                <label class="form-check-label" for="paid">Paid</label>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="sell-price" style="margin-top: 6px;">Sell Price *</label>
                                    <input type="text" name="sellprice" class="form-control" id="sell-price" placeholder="Enter your price" style="margin-top: 6px;">
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
                                                <button type="submit" id="note-publish" name="publish" class="btn publish-btn" <?php if( $isflag == 0) { echo 'Disabled';} else {
                                                echo 'enabled';} ?>>Publish</button>
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