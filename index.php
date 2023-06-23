<?php include 'inc/header.php'; ?>
<link rel="stylesheet" type="text/css" href="style/volunteers.css">
<!-- //Delete -->
<?php
// if (isset($_GET['id'])) {
//   $id = $_GET['id'];
//   $query = "DELETE FROM `appointment` WHERE appointmentNumber = '$id'";
//   $run = mysqli_query($conn, $query);
//   if ($run) {
//     header('location:feedback.php');
//   } else {
//     echo "Error: " . mysqli_error($conn);
//   }
//   echo $_GET['id'];
// }
?>

<!--SEARCHED or NOT BITFLIP-->
<?php
$searchKey = '';
$searched = false;
if (isset($_POST['submit'])) {

  if (empty($_POST['search'])) {
    $nameErr = 'Search Key required!';
  } else {
    // $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $searchKey = filter_input(
      INPUT_POST,
      'search',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }
  // THE BIT FLIP
  $searched = true;

  if (empty($_POST['search'])) {
    $nameErr = 'Enter Key';
  } else {
    $Name = filter_input(
      INPUT_POST,
      'search',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }
}
if (isset($_POST['showall'])) {
  $searched = false;
}

if ($searched == true) {
  $fetch = "SELECT * from club1
    WHERE name LIKE '%$searchKey%'
    OR club LIKE '%$searchKey%' ";

  $result = mysqli_query($conn, $fetch);
  $volunteers = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
  $fetch = 'SELECT * from club1';
  $result = mysqli_query($conn, $fetch);
  $volunteers = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<?php if (empty($volunteers)) : ?>
  <!-- <p class="lead mt-3">There is no Volunteers</p> -->
<?php endif; ?>

<?php //foreach ($volunteers as $item): 
?>
<!-- <div class="card my-3 w-75">
     <div class="card-body text-center">
       <?php //echo $item['patientName']; 
        ?>
       <div class="text-secondary mt-2"> <?php //echo $item['NIC']; 
                                          ?>
          Doctor: <?php // echo $item['docName'];
                  ?>
  </div>
     </div>
   </div> -->
<?php
// echo '<h6>Welcome '.$_SESSION["username"].'</h6>';  
// echo '<label><a class="text-danger " href="logout.php">Logout</a></label>';
?>
<div style="display: flex;">
  <!-- <a href="feedback.php" class="btn btn-secondary btn-sm active" role="button" aria-pressed="true">Appointments</a>
  <a href="patients.php" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Patients</a>
  <a href="doctors.php" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Doctors</a> -->
</div>
<!-- <h2>Past appointment</h2> -->


<!-- SEARCH -->

<body>
  <div class="banner">
    <p>OUR VOLUNTEERS</p>
    <img src="img/volunteersBanner.jpg" alt="">
  </div>

  <div class="clubDetails">
    <p class="clubNameUpper">LIONS CLUB OF YATINUWARA GREEN ELITE</p>
    <div class="details">
      <div class="upperSec">
        <div class="sec1">
          <span>Region: <span class="content">6A</span></span><br>
          <span>Zone: <span class="content">3</span></span>
        </div>
        <div class="sec2">
          <span>Reg. No.: <span class="content">123456</span></span><br>
          <span>Chartered On: <span class="content">20-06-2022</span></span>
        </div>
      </div>
      <div class="lowerSec">
        <p>Extended by: <span class="content">Lions Club of Kiribathkumbura</span></p><br>
        <p>Extension Chairman: <span class="content">Lion Luxman Ullandupitiya</span></p><br>
        <p>Guiding Lion: <span class="content">Lion Luxman Ullandupitiya</span></p><br>
        <p>DG then in Office: <span class="content">DG Lion Amal Pussallage</span></p>
      </div>
      <div></div>
    </div>

  </div>
  <nav class="navbar navbar-light ">
    <form method="POST" action="<?php echo htmlspecialchars(
                                  $_SERVER['PHP_SELF']
                                ); ?>" class="mt-4 w-155" style="display: flex;">
      <input name="search" class="form-control" type="search" placeholder="Search" aria-label="Search">
      <!-- <button class="btn btn-outline-success " name="submit" type="submit">Search</button> -->
      <input type="submit" name="submit" value="Search" class="btn btn-dark w-35">
      <input type="submit" name="showall" value="Show all" class="btn btn-secondary w-25 text-center">
    </form>
  </nav>

  <div class="volunteersOuter">
    <!-- <tbody> -->
    <?php foreach ($volunteers as $item) : ?>
      <a class="volunteer" href="volunteer.php?key=<?php echo $item['volunteer_code']; ?>">
        <div class="outer">
          <div>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($item['profile_image']); ?>" height="150" class="img-thumnail" />
          </div>
          <div>
            <p class="name"><?php echo $item['name'] . ', <span>' . $item['district_position_1'] . '</span>'; ?></p>
          </div>

        </div>
      </a>
    <?php endforeach; ?>

  </div>
</body>








<?php include 'inc/footer.php'; ?>