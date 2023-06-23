<?php
session_start();
if(!isset($_SESSION["username"])){
  header("location:register.php?action=login");
}
?>
<?php include 'inc/header.php'; ?>

<!-- //Delete -->
<?php
if (isset($_GET['id'])) {  
      $id = $_GET['id'];  
      $query = "DELETE FROM `appointment` WHERE appointmentNumber = '$id'";  
      $run = mysqli_query($conn,$query);  
      if ($run) {  
           header('location:feedback.php');  
      }else{  
           echo "Error: ".mysqli_error($conn);  
      }  
      echo $_GET['id'];
 }
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
        'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS
      );
    }
// THE BIT FLIP
    $searched = true;

    if (empty($_POST['search'])) {
      $nameErr = 'Enter Key';
    } else {
      $Name = filter_input(
        INPUT_POST,
        'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS
      );
    }
  }
  if(isset ($_POST['showall'])){
    $searched = false;
  }       

  if($searched ==true){
    $fetch="SELECT * from appointment
    WHERE patientName LIKE '%$searchKey%'
    OR NIC LIKE '%$searchKey%' ";

    $result= mysqli_query($conn, $fetch);
    $appointment = mysqli_fetch_all($result, MYSQLI_ASSOC);
  }else{
    $fetch='SELECT * from appointment';
    $result= mysqli_query($conn, $fetch);
    $appointment = mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
?>

  <?php if (empty($appointment)): ?>
    <p class="lead mt-3">There is no appointment</p>
  <?php endif; ?>

  <?php //foreach ($appointment as $item): ?>
    <!-- <div class="card my-3 w-75">
     <div class="card-body text-center">
       <?php //echo $item['patientName']; ?>
       <div class="text-secondary mt-2"> <?php //echo $item['NIC']; ?>
          Doctor: <?php // echo $item['docName'];?>
  </div>
     </div>
   </div> -->
  <?php 
  echo '<h6>Welcome '.$_SESSION["username"].'</h6>';  
  echo '<label><a class="text-danger " href="logout.php">Logout</a></label>';  
  ?>
  <div style="display: flex;">
  <a href="feedback.php" class="btn btn-secondary btn-sm active" role="button" aria-pressed="true">Appointments</a>
  <a href="patients.php" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Patients</a>
  <a href="doctors.php" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Doctors</a>
  </div>
  <h2>Past appointment</h2>


<!-- SEARCH -->
  <nav class="navbar navbar-light ">
  <form  method="POST" action="<?php echo htmlspecialchars(
      $_SERVER['PHP_SELF']
    ); ?>" class="mt-4 w-155" style="display: flex;">
    <input name="search" class="form-control" type="search" placeholder="Search" aria-label="Search">
    <!-- <button class="btn btn-outline-success " name="submit" type="submit">Search</button> -->
    <input type="submit" name="submit" value="Search" class="btn btn-dark w-35">
    <input type="submit" name="showall" value="Show all" class="btn btn-secondary w-25 text-center">
  </form>
</nav>

  <table class="table">
  <thead>
    <tr >
      <th scope="col">Appointment #</th>
      <th scope="col">Name</th>
      <th scope="col">NIC</th>
      <th scope="col">Doctor</th>
      <th scope="col">x</th>

    </tr>
  </thead>
  <tbody>
  <?php foreach ($appointment as $item): 
    echo "
    <tr>
      <th >".$item['appointmentNumber']."</th>
      <td>".$item['patientName']."</td>
      <td>".$item['NIC']."</td>
      <td>".$item['docName']."</td>
      <td>
      <a href='feedback.php?id=".$item["appointmentNumber"]."' class='btn btn-outline-danger'>Delete</a></td>
    </tr>
    ";
    
 endforeach; ?>

  </tbody>
</table>





<?php include 'inc/footer.php'; ?>
