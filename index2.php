<?php include 'inc/header.php'; ?>

<?php
$last =0; $lasttxt=""; $lasttxt2="";
// Set vars to empty values
$NIC = $Name = $Doctor = $Address = $Gender = $Age = $tp ='';
$NICErr = $NameErr = $DocErr = $AddressErr = $GenderErr = $AgeErr = $tpErr = '';

// Form submit
if (isset($_POST['submit'])) {
  // echo 'rooooOOOOOOOOOOOO';
  // Validate name



  if (empty($_POST['Name'])) {
    $nameErr = 'Name is required';
  } else {
    // $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $Name = filter_input(
      INPUT_POST,
      'Name', FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  // Validate NIC
  if (empty($_POST['NIC'])) {
    $NICErr = 'NIC is required';
  } else {
    // $Name = filter_var($_POST['Name'], FILTER_SANITIZE_Name);
    $NIC = filter_input(INPUT_POST, 'NIC', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
  }

  // Validate Doc
  if (empty($_POST['Doctor'])) {
    $DocErr = 'DOC is required';
  } else {
    // $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $Doctor = filter_input(
      INPUT_POST,
      'Doctor',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  if (empty($_POST['Address'])) {
    $AddressErr = 'Address is required';
  } else {
    // $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $Address = filter_input(
      INPUT_POST,
      'Address',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  if (empty($_POST['tp'])) {
    $tpErr = 'Contact Number is required';
  } else {
    // $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $tp = filter_input(
      INPUT_POST,
      'tp',
      FILTER_SANITIZE_NUMBER_INT
    );
  }

  if (empty($_POST['Age'])) {
    $AgeErr = 'Age is required';
  } else {
    // $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $Age = filter_input(
      INPUT_POST,
      'Age',
      FILTER_SANITIZE_NUMBER_INT
    );
  }
  if (empty($_POST['Gender'])) {
    $GenderErr = 'Gender is required';
  } else {
    // $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $Gender = filter_input(
      INPUT_POST,
      'Gender',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }
  // $Gender = $_POST['Gender'];
  if (empty($nameErr) && empty($NameErr) && empty($DocErr) && empty($AddressErr)) {
    // add to database
    $sql = "INSERT INTO appointment (NIC, patientName, docName) VALUES ('$NIC','$Name', '$Doctor')";
    $sql2 = "INSERT INTO patient (NIC, name, Address,  tp,age, gender ) VALUES ('$NIC', '$Name', '$Address',  '$tp', '$Age', '$Gender')";

    $fetch='SELECT * from patient';
    $result= mysqli_query($conn, $fetch);
    $patientContent = mysqli_fetch_all($result, MYSQLI_ASSOC);




//Avoid Multiple User entries

    $patientExists = false;

    foreach ($patientContent as $item): 
      if($item['NIC'] == $NIC){
       $patientExists = true;
        
      } 
    endforeach; 

    if($patientExists== true){
      // echo 'true';
       
     }

    if ($patientExists == false){
      if (mysqli_query($conn, $sql2) ) {
        echo "success";
        // header('Location: feedback.php');
      } else {
        // error
        echo 'Error: ' . mysqli_error($conn);
      }
    }

    if (mysqli_query($conn, $sql)) {
      // success
      // header('Location: feedback.php');



      $fetch='SELECT * from appointment';
      $result= mysqli_query($conn, $fetch);
      $lastApp = mysqli_fetch_all($result, MYSQLI_ASSOC);

      
      
      foreach ($lastApp as $item): 

        $last = $item['appointmentNumber'];
        $lasttxt="Your Appointmnet Number is: ";
        $lasttxt2="Appointment Successfully Made!";
        // echo $last . " ";
     endforeach;
 



    } else {
      // error
      echo 'Error: ' . mysqli_error($conn);
      header('location:index.php');
    }
  }
}
?>
      <img src="/feedback/img/logo.png" class="w-25 mb-8" alt="">
    <h2>Welcome!</h2>
    <?php echo isset($name) ? $name : ''; ?>
    <p class="lead text-center">Make your appointment below.</p>

    
    <h2 class="text-success"><?php echo  $lasttxt2; ?></h2>
    <h1 class="text-success"><?php echo  $lasttxt . " " .$last; ?></h1>

    <form method="POST" action="<?php echo htmlspecialchars(
      $_SERVER['PHP_SELF']
    ); ?>" class="mt-4 w-75">
      <div class="mb-3">
        <label for="Name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo !$nameErr ?:
          'is-invalid'; ?>" id="Name" name="Name" placeholder="Enter your name" value="<?php echo $Name; ?>">
        <div id="validationServerFeedback" class="invalid-feedback">
          Please provide a valid name.
        </div>
      </div>
      <div class="mb-3">
        <label for="NIC" class="form-label">NIC</label>
        <input type="text" class="form-control <?php echo !$NICErr ?:
          'is-invalid'; ?>" id="NIC" name="NIC" placeholder="Enter your NIC" value="<?php echo $NIC; ?>">
      </div>

      <div class="mb-3">
        <label for="Age" class="form-label">Age (yr)</label>
        <input type="number" class="form-control <?php echo !$AgeErr ?:
          'is-invalid'; ?>" id="Age" name="Age" placeholder="Enter your Age" value="<?php echo $Age; ?>">
      </div>

      <!-- <div class="mb-3">
        <label for="body" class="form-label">Doctor</label>
        <textarea class="form-control <?php echo !$DocErr ?:
          'is-invalid'; ?>" id="Doctor" name="Doctor" placeholder="Enter your feedback"><?php echo $Doctor; ?></textarea>
      </div> -->

      <div class="col-md-3">
        <label for="validationCustom04" class="form-label">Doctor</label>
        <select name="Doctor" class="form-select <?php echo !$DoctorErr ?:'is-invalid'; ?>" id="validationCustom04" required>
          <option selected disabled value="">Choose...</option>

          <?php 
              $fetch='SELECT * from doctor';
              $result= mysqli_query($conn, $fetch);
              $doc = mysqli_fetch_all($result, MYSQLI_ASSOC);
          ?>

    <?php foreach ($doc as $item): 
      echo "
      <option >".$item['docName']."</option>
        ";
    
 endforeach; ?>
          <!-- <option>Dr. Padma Gunaratna</option>
          <option>Dr. Ravin Kumara</option>
          <option>Dr. Aruna Fernando</option> -->
        </select>
        <div class="invalid-feedback">
          Please select a valid state.
        </div>
      </div>

      <div class="mb-3">
        <label for="Address" class="form-label">Address</label>
        <textarea class="form-control <?php echo !$AddressErr ?:
          'is-invalid'; ?>" id="Address" name="Address" placeholder="Enter your Address"><?php echo $Address; ?></textarea>
      </div>

      <div class="mb-3">
        <label for="tp" class="form-label">Contact Number</label>
        <input type="number" class="form-control <?php echo !$tpErr ?:
          'is-invalid'; ?>" id="tp" name="tp" placeholder="Enter your Contact Number" value="<?php echo $tp; ?>">
      </div>

  <div class="col-md-3">
    <label for="validationCustom04" class="form-label">Gender</label>
    <select name="Gender" class="form-select <?php echo !$GenderErr ?:'is-invalid'; ?>" id="validationCustom04" required>
      <option selected disabled value="">Choose...</option>
      <option>Male</option>
      <option>Female</option>
      <option>Other</option>
    </select>
    <div class="invalid-feedback">
      Please select a valid state.
    </div>
  </div>
        </br>
      <div class="mb-3">
        <input type="submit" name="submit" value="Submit" class="btn btn-danger w-100">
      </div>
    </form>
<?php include 'inc/footer.php'; ?>
