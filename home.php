<?php
// Initialize the session
// Check if the user is already logged in, if yes then redirect him to welcome page
session_start();
 if(strlen($_SESSION['loggedin'])==0 ){
    header("location: login.php");
    exit;
}
// Include config file
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'donation');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
 

// Define variables and initialize with empty values
$amount = "";
 $amount_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    

    $input_amount = trim($_POST["amount"]);
    if(empty($input_amount)){
        $amount_err = "Please enter a amount.";
    }  else{
         $user  = $_SESSION['id'];
        $amount = $input_amount;
    }
    
 
     
    // Check input errors before inserting in database
    if(!empty($amount)){
        // Prepare an insert statement
        $sql = "INSERT INTO users_donation(user_id,amount) VALUES ( ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $param_id,$param_amount);
            
            // Set parameters
            $param_amount = $amount;
            $param_id = $user;
                        
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                ?>
                 <script>         alert ("Donation Sent.");
            window.location = window.history.back(); </script>
            <?php
            
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         echo 'closed';
        // Close statement
       // mysqli_stmt_close($stmt);
    }
    
    // Close connection
    //mysqli_close($link);
}
?>


<!Doctype html>

<html>
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

<body>
             <a href="logout.php" class="btn btn-danger btn-lg pull-right"><i style="color: maroon;" class="material-icons">&#xE8AC;</i> Sign out </a>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
        </div>

    <nav class="navbar">
        <div class="max-width">
        <div class="logo"><a href="#">Donations<span></span></a></div>
        <ul class="menu">
            <li><a href="#about">About Us</a></li>
            <li><a href="#service">Help</a></li>
            <li><a href="#teams">Team</a></li>
            <li><a href="#portfolio">Projects</a></li>
            <li><a href="#contact">Sign up</a></li>
            <li><a href="#donate">Donate</a>  </li>
        </ul>
        <div class="btn-menu">
           
        </div>
        </div>

    </nav>

    <section id="home" class="home">
        <div class="max-width">
            
            <div class="home-content">
                <div class="text1"><?php 

   $sql= ("SELECT name from users where id='".$_SESSION['id']."'"); 

$result = $link->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo   "<b> Welcome: " . $row["name"].  "<br></b>" ;
 

  }}
            ?></div>
            
                <div class="text2">Donations Online</div>
                <div class="text3"><span class="typing"></span></div>
                <!-- <a href="#service">Help</a> -->
            
               <a href="#helpModal" class="btn btn-danger btn-lg" data-toggle="modal">DONATE HERE</a>

        </div>
    </section>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Donations done</h2>
                   
                    </div>
                    <form id="#data">
                    <?php
 

                    $count=1;
                    // Attempt select query execution
                    // query to join for tables...loan_list, loan_plan, loan_type and member tables
                     $sql = "SELECT  users_donation.amount,users_donation.date_created,users.* from users
                     join users_donation on users.id= users_donation.user_id where users.id='".$_SESSION['id']."'";

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped" id ="donation">';
                                echo '<thead class="bg-dark text-light">';
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Donated Amt</th>";
                                        echo "<th>Date</th>";
                                        echo "<th>Donation type</th>";
                                        
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                
                                while($row = mysqli_fetch_array($result)){
                      
                                    echo "<tr>";
                                     echo "<td> " . $count . "</td>";
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
                            echo '<div class="alert alert-info"><em>No contributions done .</em></div>';
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
                        <a href="#contact">Donate here</a></p>
                        </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-gift"></i>
                        <div class="text">Church mission</div>
                        <p>With mission we mean reaching as many families as possible.People who are not privilaged.</br>This year we are aiming to reach 4000 families</br>
                        target=$4000</br>Donations done $2000</br><a href="#contact">Donate here</a></p>
                        </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-comment-dollar"></i>
                        <div class="text">Childrens home visit</div>
                        <p>We are suppossed to visit childrens home from time to time and help them with things that help them survive.</br>Project $9000</br>Donation done $3900</br><a href="#contact">Donate here</a></p>

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




    <!--- help modal   ---->


    <div id="helpModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Donation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div  class="form-group col-sm-6">
                <label class="text-dark">Enter amount</label>
               <input type="number" name="amount" class="form-control" name="donateAmt">
            </div>
            
          <div  class="form-group col-sm-6">
                <label class="text-dark" >Donation type</label>
               <input type="text" name="text" class="form-control" name="donateAmt">
            </div>
            </div>
           </b>
            <div class="modal-footer">
               
          
                <button type="button"  class="btn btn-warning" data-dismiss="modal">Cancel</button>
                
                <input type="submit" name="submitButton" class="btn btn-primary" value="Donate">
                
           
            </div>
        </div>
    </div>
</div>
</body>
</html>