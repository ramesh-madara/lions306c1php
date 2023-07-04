<?php include 'inc/header.php'; ?>
<link rel="stylesheet" type="text/css" href="style/clubs2.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/solid.min.js" integrity="sha512-apZ8JDL5kA1iqvafDdTymV4FWUlJd8022mh46oEMMd/LokNx9uVAzhHk5gRll+JBE6h0alB2Upd3m+ZDAofbaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- //Delete -->
<?php
$district = "District 306 C1";
$region = "Select Region";
$zone = "Select Zone";
// $Zone = "";
?>

<!--SEARCHED or NOT BITFLIP-->
<?php
$searchKey = '';
$searched = false;

$fetch = "SELECT DISTINCT  Region_Name from clubs WHERE District_Name = '$district' ORDER BY Region_Name ASC";
$result = mysqli_query($conn, $fetch);
$volunteers = mysqli_fetch_all($result, MYSQLI_ASSOC);

// $fetch2 = "SELECT DISTINCT  Zone_Name from clubs WHERE District_Name = '$district' and Region_Name = '$region' ORDER BY Zone_Name ASC";
// $result2 = mysqli_query($conn, $fetch2);
// $volunteers2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
// }
?>

<?php if (empty($volunteers)) : ?>
  <!-- <p class="lead mt-3">There is no Volunteers</p> -->
<?php endif; ?>


<?php
if (isset($_POST['selected_region'])) {
  $selectedRegion = $_POST['selected_region'];
  $region = $selectedRegion;
  echo $region;
  // echo $zone;
  // $fetch2 = "SELECT DISTINCT  Zone_Name from clubs WHERE District_Name = '$district' and Region_Name = '$region' ORDER BY Zone_Name ASC";
  // $result2 = mysqli_query($conn, $fetch2);
  // $volunteers2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
}
if (isset($_POST['selected_zone'])) {
  // $selectedRegion = $_POST['selected_region'];
  // $region = $selectedRegion;
  $selectedZone = $_POST['selected_zone'];
  $zone = $selectedZone;
  // echo $region;
  echo $zone;
  echo $region;

  // $fetch2 = "SELECT DISTINCT  Zone_Name from clubs WHERE District_Name = '$district' and Region_Name = '$region' ORDER BY Zone_Name ASC";
  // $result2 = mysqli_query($conn, $fetch2);
  // $volunteers2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
  // echo  $volunteers2;
}
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
    <p class="clubNameUpper">BROWSE THROUGH</p>
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
    <div id="select-container">
      <select class="region" name="selected_region" onchange="updateZones()">
        <?php foreach ($volunteers as $item) : ?>
          <option value="<?php echo $item['Region_Name']; ?>"><?php echo $item['Region_Name']; ?></option>
        <?php endforeach; ?>
      </select>
      <select class="zone" name="selected_zone">
        <?php foreach ($volunteers2 as $item) : ?>
          <option value="<?php echo $item['Zone_Name']; ?>"><?php echo $item['Region_Name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      function updateZones() {
        console.log($('.region').val());
        var region = $('.region').val();
        var district = "District 306 C1";

        $.ajax({
          type: 'POST',
          url: 'get_zones.php',
          data: {
            region: region,
            district: district
          },
          success: function(response) {
            $('.zone').html(response);
          }
        });
      }
    </script>










  </div>
</body>








<?php include 'inc/footer.php'; ?>