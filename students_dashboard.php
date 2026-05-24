<?php
require_once 'db_connect/connection.php';
    session_start();

    //STRICT SESSION PROTECTION
    if(!isset($_SESSION['student_id'])){
        header("Location: students_login.php");
        exit;
    }

    //PREVENT BROWSER CACHING OF DASHBOARD AFTER LOGOUT
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check-0", false);
    header("Pragma: no-cache");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-icons-1.13.1/bootstrap-icons.css">
    <title>Student DashBoard</title>
</head>
<body>
<div class="container">
     <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top py-2" style="height: auto;">
        <div class="container">
                <!--Brand-->
                <span class=" text-white rounded-3 d-flex align-items-center justify-content-center me-2"
                style="width: 42px; height: 42px;"><img src="images/1765894691152.jpg" alt="logo" style="width: 50px; height: auto; border-radius: 50%;"></span>
                   &nbsp; Welcome, &nbsp; <strong><?= htmlspecialchars($_SESSION['student_name']) ?></strong>
            

            <!--Toggler-->
            <button class="navbar-toggler border-0" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#schoolmenu"
                    aria-controls="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
            </button>

        <!--Menu-->
        <div class="collapse navbar-collapse" id="schoolmenu">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                
                <li class="nav-item drop-down">
                    <a href="" class="nav-link dropdown-toggle px-3 fw-bold" role="button" data-bs-toggle="dropdown">
                       <span class="bi bi-book">&nbsp;&nbsp;Courses</span> 
                    </a>
                    <ul class="dropdown-menu shadow border-0">
                        <li><a href="student_login.html" class="dropdown-item fw-bold text-primary">Grade Sheet</a></li> 
                   </ul>
                </li>

                <li class="nav-item drop-down">
                    <a href="" class="nav-link dropdown-toggle px-3 fw-bold" role="button" data-bs-toggle="dropdown">
                      <span class="bi bi-calendar-event">&nbsp;&nbsp;Schedule</span>
                    </a>
                    <ul class="dropdown-menu shadow border-0">
                        <li><a href="student_login.html" class="dropdown-item fw-bold text-primary">Class Schedule</a></li>
                        <li><a href="teacher_login.html" class="dropdown-item fw-bold text-primary">Test Schedule</a></li>
                        <li><a href="admin_login.html" class="dropdown-item fw-bold text-primary">Holidays</a></li> 
                   </ul>
                </li>

                <li class="nav-item drop-down">
                    <a href="" class="nav-link dropdown-toggle px-3 fw-bold" role="button" data-bs-toggle="dropdown">
                       <span class="bi bi-pencil-square">&nbsp;&nbsp;Assignment</span> 
                    </a>
                    <ul class="dropdown-menu shadow border-0">
                        <li><a href="student_login.html" class="dropdown-item fw-bold text-primary">Home Work</a></li>
                        <li><a href="teacher_login.html" class="dropdown-item fw-bold text-primary">Upcoming Test/Quizzes</a></li>
                   </ul>
                </li>

                <li class="nav-item drop-down">
                    <a href="" class="nav-link dropdown-toggle px-3 fw-bold" role="button" data-bs-toggle="dropdown">
                        <span class="bi bi-megaphone">&nbsp;&nbsp;Announcement</span>
                    </a>
                    <ul class="dropdown-menu shadow border-0">
                        <li><a href="student_login.html" class="dropdown-item fw-bold text-primary">School Announcements</a></li>
                        <li><a href="teacher_login.html" class="dropdown-item fw-bold text-primary">Class Announcements</a></li>
                        <li><a href="admin_login.html" class="dropdown-item fw-bold text-primary">Even Reminders</a></li> 
                   </ul>
                </li>

                <li class="nav-item drop-down">
                    <a href="" class="nav-link dropdown-toggle px-3 fw-bold" role="button" data-bs-toggle="dropdown">
                       <span class="bi bi-folder">&nbsp;&nbsp;Resources</span> 
                    </a>
                    <ul class="dropdown-menu shadow border-0">
                        <li><a href="student_login.html" class="dropdown-item fw-bold text-primary">School Calender</a></li>
                        <li><a href="teacher_login.html" class="dropdown-item fw-bold text-primary">Counseling Services</a></li>
                        <li><a href="admin_login.html" class="dropdown-item fw-bold text-primary">Extra Curriculum Activities</a></li> 
                   </ul>
                </li>
                 
                
                <li class="nav-item drop-down">
                    <a href="logout.php" class="nav-link px-3 fw-bold" role="button">
                       <span class="bi bi-box-arrow-right" style="color: #dc3545;">&nbsp;&nbsp;Logout</span> 
                    </a>
                </li> 
            </ul>
        </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 6rem;">
        <div class="row g-3">
            <!--DASHBOARD BOX 1-->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card step-card p-4 text-center shadow-sm h-100" style="border-left:4px solid red; border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                    <i class="bi bi-book-fill display-3" style="color:red;"></i><p class="text-muted">Enrolled Subjects</p>
                    <div class="stat-number display-6">12</div>
                    
                </div>
            </div>

             <!--DASHBOARD BOX 2-->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card step-card p-4 text-center shadow-sm h-100" style="border-left:4px solid blue; border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                    <i class="bi bi-calendar-check display-3" style="color:#4e46e5;"></i><p class="text-muted">Attendance Rate</p>
                    <div class="stat-number display-6">94%</div>
                    
                </div>
            </div>

             <!--DASHBOARD BOX 3-->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card step-card p-4 text-center shadow-sm h-100" style="border-left:4px solid gold; border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                    <i class="bi bi-star display-3" style="color:gold;"></i><p class="text-muted">Current Average</p>
                    <div class="stat-number display-6">90.5%</div>
                    
                </div>
            </div>

             <!--DASHBOARD BOX 4-->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card step-card p-4 text-center shadow-sm h-100" style="border-left:4px solid #006600; border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                    <i class="bi bi-check-square display-3" style="color:#006600;"></i><p class="text-muted">Assignments Done</p>
                    <div class="stat-number display-6">28</div>
                    
                </div>
            </div>


           



            

        </div>
    </div>



    </div>
    
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>