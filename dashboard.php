 <a href="logout.php" class="btn btn-danger btn-lg pull-right"><i style="color: maroon;" class="material-icons">&#xE8AC;</i> Sign out </a>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
        </div><?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'donation');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} ?>
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device=width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">contributions</h2>
                   
                    </div>
                    <form id="#data">
                    <?php
 

                    $count=1;
                    // Attempt select query execution
                    // query to join for tables...loan_list, loan_plan, loan_type and member tables
                     $sql = "SELECT  users_donation.amount,users_donation.date_created,users.* from users
                     join users_donation on users.id= users_donation.user_id ";

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped" id ="loan-list">';
                                echo '<thead class="bg-dark text-light">';
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Donated Amt</th>";
                                        echo "<th>Date</th>";
                                      
                                        
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                      
                                    echo "<tr>";
                                     echo "<td> " . $count . "</td>";
                                      echo "<td> " . $row['name'] . "</td>";
                                        echo "<td>Ksh : " . $row['amount'] . "</td>";
                                        echo "<td>" . date('D-d-M-y', strtotime($row['date_created'])). "</td>";
                                       
                                       
    
                                    echo "</tr>";
                                    $count++;
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-info"><em>No contributions.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                   // mysqli_close($link);
                    ?>
                    </form>
                </div>
            </div>        
        </div>
    </div>


    <section class="about" id="about">
        <div class="max-width">
        <h2 class="section-title">About Us</h2>
        <div class="about-content">
        <div class="left column">
            <img src="wor.jpg" alt="">
        </div>
        <div class="column right">
            <div class="text">Online donations  <span>for church projects</span></div>
            We visit the needy who can not make it to church</br> and air their stories here to reach willing donors </br>
    You don't have to visit the church and instead you can connect</br> with the person in need and help </br>them even if you are far away.
            <a href="#service">Read More</a>
        </div>
        </div>
        </div>

</section>
        <!-- Service Section-->
        <section class="service" id="service">
            <div class="max-width">
            <h2 class="section-title">Help</h2>
            <div class="content-service">
                <div class="card">
                    <div class="box">
                        <i class="fas fa-paint-brush"></i>
                        <div class="text">Church project</div>
                        <p>We are building our church that has so much to be done.We are therefore requesting for money to help us in the completion of the church.We have done half of the project and our management team have come up with a bill for the other half which sums up to$20,000</br>
                        Donation done=$5000</br>
                        <a href="#donate">Donate here</a></p>
                        </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-gift"></i>
                        <div class="text">Church mission</div>
                        <p>With mission we mean reaching as many families as possible.People who are not privilaged.</br>This year we are aiming to reach 4000 families</br>
                        target=$4000</br>Donations done $2000</br><a href="#donate">Donate here</a></p>
                        </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-comment-dollar"></i>
                        <div class="text">Childrens home visit</div>
                        <p>We are suppossed to visit childrens home from time to time and help them with things that help them survive.</br>Project $9000</br>Donation done $3900</br><a href="#donate">Donate here</a></p>

                        </div>
                </div>
            </div>
            </div>
    </section>   
    
    <section class="teams" id="teams">
        <div class="max-width">
            <h2 class="section-title">Team</h2>
            <div class="carousel owl-carousel">
                <div class="card">
                    <div class="box">
                    <img src="mum.jpg" alt="">
                    <div class="text">Purity</div>
                    Ceo& planner.
                </div>
                </div>
         
                <div class="card">
                    <div class="box">
                    <img src="shosh.jpg" alt="">
                    <div class="text">Dorcas</div>
                    Treasurer and manager.
                </div>
            </div>
            
                <div class="card">
                    <div class="box">
                    <img src="wor1.jpg" alt="">
                    <div class="text">Hassan</div>
                    The admin.
                </div>                
            </div>
            </div>
        </div>
    </section>
    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio">
    <div class="max-width">
    <h2 class="section-title">Done projects</h2>
    <div class="main">
        <div class="gallery" id="gallery">
            <div class="img">
            <a href="church.jpeg">
            <img src="1.jpg" class="image" alt=""/>
            </a>
        
        </div>
        <div class="img">
        <a href="wor1.jpg">
            <img src="6.jfif" class="image" alt=""/>
        </a>
        
        </div>
        <div class="img">
        <a href="assest/team/3.jpg">
            <img src="3.jpg" class="image" alt=""/>
        </a>
        
        </div>
        <div class="img">
        <a href="4.jpg">
            <img src="4.jpeg" class="image" alt=""/>
        </a>
        
        </div>
        <div class="img">
        <a href="assest/team/5.jpg">
        <img src="5.jpg" class="image"alt="" />
        </a>
        
        </div>
        <div class="img">
        <a href="assest/team/2.jpg">
            <img src="9.jpg" class="image" alt=""/>
        </a>
        
        </div>
        <div class="img">
        <a href="assest/team/4.jpg">
            <img src="7.jpg" class="image" alt=""/>
        </a>
        
        </div>
        <div class="img">
        <a href="assest/team/5.jpg">
            <img src="8.jpg" class="image" alt="" />
        </a>
        
        
        </div>
    </div>
</div>
</div>
</section>

    <!--Contact Section -->

    <section class="contact" id="contact">
        <div class="max-width">
            <h2 class="section-title">Contact</h2>
            <div class="contact-content">
            <div class="column left">
                <div class="text">Get in Touch</div>
                <p>Get in touch with our customer care.Ask a question where you feel something is not clear and feel free to visit us at our offices located in Tudor haile building second flour.</p>
                <div class="icons">
                    <div class="row">
                        <i class="fas fa-user"></i>
                        <div class="info">
                            <div class="head">Name</div>
                            <div class="sub-title">HalimaV</div>
                        </div>
                    </div>
                    <div class="row">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="info">
                            <div class="head">Address</div>
                            <div class="sub-title">Mombasa,Kenya</div>
                        </div>
                    </div>
                    <div class="row">
                        <i class="fas fa-envelope"></i>
                        <div class="info">
                            <div class="head">Email</div>
                            <div class="sub-title">halimahussein20@gmail.com</div>
                        </div>
                    </div>
                </div>
            </div>
        </div></div>
    </section>




</body>
</html>