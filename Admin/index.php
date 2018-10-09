<?php 
session_start();
include '../User/includes/db.php';
$parts = mysqli_query($con,"SELECT SUM(quantity) FROM parts");
$parts2 = mysqli_fetch_array($parts);
$accessories = mysqli_query($con,"SELECT SUM(quantity) FROM accessories");
$accessories2 = mysqli_fetch_array($accessories);
$user = mysqli_query($con,"SELECT COUNT(*) FROM loginform WHERE status = 'User' AND deleted = 0");
$user2 = mysqli_fetch_array($user);
$pending = mysqli_query($con,"SELECT COUNT(*) FROM reservation,appointment WHERE reservation.status = 'Pending' AND appointment.status = 'Pending'");
$pending2 = mysqli_fetch_array($pending);
$total = $parts2[0]+$accessories2[0];
if($_COOKIE['role'] == 'Admin'){
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> MetroFocus </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../icon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/app-blue.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/bulma.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <div class="main-wrapper">
        <div class="app" id="app">
            <header class="header">
                <div class="header-block header-block-collapse d-lg-none d-xl-none">
                    <button class="collapse-btn" id="sidebar-collapse-btn">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="header-block">
                    <nav class="breadcrumb" aria-label="breadcrumbs">
                        <ul>
                            <li style="margin-left: 20px;">
                                <a href="#">
                                    <span class="icon is-small">
                                        <i class="fal fa-home" aria-hidden="true"></i>
                                    </span>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="header-block header-block-nav">
                    <ul class="nav-profile">
                        <li class="notifications new" id="notif">
                            <a href="" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                <sup>
                                    <span class="counter" id="count">2</span>
                                </sup>
                            </a>
                            <div class="dropdown-menu notifications-dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <ul class="notifications-container" id='notifto'>
                                    <!-- <li>
                                        <a href="" class="notification-item">
                                            <div class="img-col">
                                                <div class="img" style="background-image: url('http://localhost/metroFocusv5/User/assets/img/METRO%20FOCUS.jpg')"></div>
                                            </div>
                                            <div class="body-col">
                                                <p>
                                                    <span class="accent">Zack Alien</span> pushed new commit:
                                                    <span class="accent">Fix page load performance issue</span>. </p>
                                            </div>
                                        </a>
                                    </li> -->
                                    <!-- <li>
                                        <a href="#" class="notification-item">
                                            <div class="img-col">
                                                <div class="img" style="background-image: url('')"></div>
                                            </div>
                                            <div class="body-col">
                                                <p>
                                                    <span class="accent">Zack Alien</span><br />
                                                    <span>Reservation pending</span><br />
                                                    <span>10-08-2018</span> <span>11:00 AM</span>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="notification-item">
                                            <div class="img-col">
                                                <div class="img" style="background-image: url('')"></div>
                                            </div>
                                            <div class="body-col">
                                                <p>
                                                    <span class="accent">Amaya Hatsumi</span><br />
                                                    <span>Appointment pending</span><br />
                                                    <span>10-09-2018</span> <span>3:00 PM</span>
                                                </p>
                                            </div>
                                        </a>
                                    </li> -->
                                </ul>
                                <footer>
                                    <ul>
                                        <li>
                                            <a href="#"> View All </a>
                                        </li>
                                    </ul>
                                </footer>
                            </div>
                        </li>
                        <li class="profile dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-alt fa-lm"></i>
                                <span class="name"> Admin </span>
                            </a>
                            <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                <a class="dropdown-item" href="../User/pages/profile.php">
                                    <i class="fa fa-user icon"></i> Profile </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../User/pages/logout.php">
                                    <i class="fa fa-power-off icon"></i> Logout </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </header>
            <aside class="sidebar">
                <div class="sidebar-container">
                    <div class="sidebar-header">
                        <div class="brand">
                            <div style="text-align: center;margin-left: -30px;"><span style="font-size: 25px;font-weight: bold;">Metro</span><span
                                    style="font-size: 25px;color: #FF7100;font-weight:bold;">Focus</span></div>
                        </div>
                    </div>
                    <nav class="menu">
                        <ul class="sidebar-menu metismenu" id="sidebar-menu">
                            <li class="active">
                                <a href="#">
                                    <i class="fal fa-home"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fal fa-camera-retro"></i> Products
                                    <i class="fa arrow"></i>
                                </a>
                                <ul class="sidebar-nav">
                                    <li>
                                        <a href="brand.php"> Brand</a>
                                    </li>
                                    <li>
                                        <a href="category.php"> Category</a>
                                    </li>
                                    <li>
                                        <a href="parts.php"> Parts</a>
                                    </li>
                                    <li>
                                        <a href="accessories.php"> Accessories</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="reservation.php">
                                    <i class="fal fa-calendar-alt"></i> Reservation
                                </a>
                            </li>
                            <li>
                                <a href="appointment.php">
                                    <i class="fal fa-calendar-check"></i> Appointment
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fal fa-id-card"></i> User Management
                                    <i class="fa arrow"></i>
                                </a>
                                <ul class="sidebar-nav">
                                    <li>
                                        <a href="admin.php"> Admin</a>
                                    </li>
                                    <li>
                                        <a href="client.php"> Registered Users</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="faq.php">
                                    <i class="fal fa-question-circle"></i> FAQ
                                </a>
                            </li>
                            <li>
                                <a href="activitylog.php">
                                    <i class="fal fa-pen"></i> Activity Logs
                                </a>
                            </li>
                            <li>
                                <a href="trash.php">
                                    <i class="fal fa-trash"></i> Trash
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <article class="content dashboard-page animated bounceInLeft">
                <section class="info-tiles">
                    <div class="tile is-ancestor has-text-centered">
                        <div class="tile is-parent">
                            <article class="tile is-child box" style="background: #0078D7;">
                                <p class="title" style="color: #fff;">
                                    <?php echo $pending2[0] ?>
                                </p>
                                <p class="subtitle" style="color: #fff;"><span class="icon is-small"><i class="fal fa-chart-bar"></i></span>
                                    Pending Appointments</p>
                            </article>
                        </div>
                        <div class="tile is-parent">
                            <article class="tile is-child box" style="background: red;">
                                <p class="title" style="color: #fff;">
                                    <?php echo $pending2[0] ?>
                                </p>
                                <p class="subtitle" style="color: #fff;"><span class="icon is-small"><i class="fal fa-chart-bar"></i></span>
                                    Pending Reservation</p>
                            </article>
                        </div>
                        <div class="tile is-parent">
                            <article class="tile is-child box is-danger" style="background: #071425">
                                <p class="title" style="color: #fff;">
                                    <?php echo $parts2[0] ?>
                                </p>
                                <p class="subtitle" style="color: #fff;"><span class="icon is-small"><i class="fal fa-camera-retro"></i></span>
                                    Camera Parts</p>
                            </article>
                        </div>
                        <div class="tile is-parent">
                            <article class="tile is-child box is-danger" style="background: #ff7100">
                                <p class="title" style="color: #fff;">
                                    <?php echo $accessories2[0] ?>
                                </p>
                                <p class="subtitle" style="color: #fff;"><span class="icon is-small"><i class="fal fa-cogs"></i></span>
                                    Camera Accessories</p>
                            </article>
                        </div>
                        <div class="tile is-parent">
                            <article class="tile is-child box is-danger" style="background: green;">
                                <p class="title" style="color: #fff;">
                                    <?php echo $user2[0] ?>
                                </p>
                                <p class="subtitle" style="color: #fff;"><span class="icon is-small"><i class="fal fa-users"></i></span>
                                    Registered Users</p>
                            </article>
                        </div>
                    </div>
                </section>
                <section class="section">
                    <div class="columns is-multiline is-mobile">
                        <div class="column is-6">
                            <nav class="panel">
                                <p class="panel-heading">
                                    Recent Activities
                                </p>
                                <a class="panel-block is-active">
                                    <strong>Admin1 </strong>&nbsp;added CANON PIXMA to Camera Parts
                                </a>
                            </nav>
                        </div>
                        <div class="column is-6">
                            <nav class="panel">
                                <p class="panel-heading">
                                    Top Items
                                </p>
                                <a class="panel-block is-active">
                                </a>
                            </nav>
                        </div>
                    </div>
                </section>
                <div class="tile is-parent">
                    <article class="tile is-child box">
                        <div id="chartContainer" style="height: 450px; width: 100%;"></div>
                    </article>
                </div>
            </article>
            <div class="sidebar-overlay" id="sidebar-overlay"></div>
            <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
            <div class="mobile-menu-handle"></div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/vendor.js"></script>
    <script src="js/app.js"></script>
    <script src="js/canvasjs.min.js"></script>
    <script>
        function notifandcount(){
            $.ajax({
                url:'php/notification.php',
                dataType:'json',
                success:function(data){
                    $('#notifto').html(data.notification);
                    $('#count').html(data.count);
                }
            })
        }
        $(document).ready(function(){
            notifandcount();
        });
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Company Performance"
                },
                axisX: {
                    valueFormatString: "MMM DD, YY"
                },
                axisY: {
                    title: "Percentage",
                    includeZero: false,

                },
                legend: {
                    cursor: "pointer",
                    fontSize: 16,
                    itemclick: toggleDataSeries
                },
                toolTip: {
                    shared: true
                },
                data: [{
                        name: "Sales",
                        type: "spline",
                        yValueFormatString: "#0.## °C",
                        showInLegend: true,
                        dataPoints: [{
                                x: new Date(2018, 8, 11),
                                y: 2700
                            },
                            {
                                x: new Date(2018, 7, 18),
                                y: 2000
                            },
                            {
                                x: new Date(2018, 6, 26),
                                y: 1800
                            },
                            {
                                x: new Date(2018, 5, 25),
                                y: 1700
                            },
                            {
                                x: new Date(2018, 4, 31),
                                y: 1600
                            }
                        ]
                    },

                ]
            });
            chart.render();

            function toggleDataSeries(e) {
                if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                chart.render();
            }

        }
    </script>
</body>

</html>
<?php
}
else{
header('Location: ../User/');
}
?>
