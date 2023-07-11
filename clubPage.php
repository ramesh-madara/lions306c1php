<?php include 'inc/header.php'; ?>
<link rel="stylesheet" type="text/css" href="style/clubPage5.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/solid.min.js" integrity="sha512-apZ8JDL5kA1iqvafDdTymV4FWUlJd8022mh46oEMMd/LokNx9uVAzhHk5gRll+JBE6h0alB2Upd3m+ZDAofbaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
$regionName =  trim($_GET['region'], "'");
$district = trim($_GET['district'], "'");
$zone = trim($_GET['zone'], "'");
$clubID = trim($_GET['clubID'], "'");
if (trim($_GET['searchKey'], "'") == 'none') {
    $searchKey = 'none';
} else {
    $searched = true;
    $searchKey = trim($_GET['searchKey'], "'");
}

$escapedDistrict = mysqli_real_escape_string($conn, $district); // Escape the district value
$escapedRegionName = mysqli_real_escape_string($conn, $regionName); // Escape the region name value
$escapedZoneName = mysqli_real_escape_string($conn, $zone); // Escape the zone name value
$escapedClubID = mysqli_real_escape_string($conn, $clubID); // Escape the clubID  value
$escapedSearchKey = mysqli_real_escape_string($conn, $searchKey); // Escape the clubID  value
// echo $escapedSearchKey;

// echo $escapedZoneName;
if ($searchKey == 'none') {
    echo 'nosearch';
} else {
    echo $searchKey;
}
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
        echo $searchKey;
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

if ($searchKey != 'none') {
    echo $searchKey;
    $fetch =
        "SELECT * FROM c_1_members_new WHERE District_Name = '$escapedDistrict' AND Region_Name = '$escapedRegionName' AND Zone_Name = '$escapedZoneName' AND Club_ID = '$escapedClubID' AND First_Name LIKE '%$searchKey%'  ORDER BY CAST(SUBSTRING(Club_ID, 6) AS UNSIGNED) ASC";
} else {
    $fetch = "SELECT * FROM c_1_members_new WHERE District_Name = '$escapedDistrict' AND Region_Name = '$escapedRegionName' AND Zone_Name = '$escapedZoneName' AND Club_ID = '$escapedClubID' ORDER BY CAST(SUBSTRING(Club_ID, 6) AS UNSIGNED) ASC";
}
$result = mysqli_query($conn, $fetch);
$volunteers = mysqli_fetch_all($result, MYSQLI_ASSOC);

$fetchDef = "SELECT * FROM c_1_members_new WHERE District_Name = '$escapedDistrict' AND Region_Name = '$escapedRegionName' AND Zone_Name = '$escapedZoneName' AND Club_ID = '$escapedClubID' ORDER BY CAST(SUBSTRING(Club_ID, 6) AS UNSIGNED) ASC LIMIT 10";
$resultDef = mysqli_query($conn, $fetchDef);
$volunteersDef = mysqli_fetch_all($resultDef, MYSQLI_ASSOC);
?>

<?php if (empty($volunteers)) : ?>
    <p class="lead mt-3">There is no Volunteers</p>
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
        <p>
            <?php echo   strtoupper("OUR CLUB"); ?>
        </p>
        <img src="img/volunteersBanner.jpg" alt="">
    </div>

    <div class="clubDetails">
        <p class="clubNameUpper"><?php echo   strtoupper("LIONS CLUB OF " .  $volunteersDef[1]["Club_Name"]); ?></p>
        <div class="details">
            <div class="upperSec">
                <div class="sec1">
                    <span>Destrict: <span class="content"><?php echo $district; ?></span></span><br>
                    <span>Region: <span class="content"><?php echo $regionName; ?></span></span><br>
                    <span>Zone: <span class="content"><?php echo $zone; ?></span></span>
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
    <script>
        function updateSearchKey(key) {

        }
    </script>
    <nav class="searchComponent ">
        <!-- <form action="<?php echo htmlspecialchars(
                                $_SERVER['PHP_SELF']
                            ); ?>" class="mt-4 w-155" style="display: flex;"> -->
        <input onchange="updateSearchKey(this.value)" name="search" id="search" class="form-control" type="search" placeholder="Search" aria-label="Search">
        <!-- <button class="btn btn-outline-success " name="submit" type="submit">Search</button> -->
        <!-- <input type="" name="submit" value="Search" class="btn btn-dark w-35"> -->
        <!-- <input type="" name="showall" value="Show all" class="btn btn-secondary w-25 text-center"> -->
        <a class="btn btn-dark w-35 search" onclick="this.href='clubPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName; ?>&zone=<?php echo $zone; ?>&clubID=<?php echo $clubID; ?>&searchKey='+(document.getElementById('search').value ==''? 'none':document.getElementById('search').value)">
            Search</a>
        <!-- <a class="btn btn-dark w-35" onclick="this.href='clubPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName; ?>&zone=<?php echo $zone; ?>&clubID=<?php echo $clubID; ?>&searchKey=<?php echo 'none'; ?>">
            Show all</a> -->
        <a class="btn btn-dark w-35 showAll" onclick="this.href='clubPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName; ?>&zone=<?php echo $zone; ?>&clubID=<?php echo $clubID; ?>&searchKey=<?php echo 'none'; ?>'">
            Show all</a>
        <!-- </form> -->

    </nav>

    <div class="volunteersOuter">
        <!-- <tbody> -->
        <?php foreach ($volunteers as $item) : ?>
            <!-- <div class="volunteer"> -->
            <div class="outer">
                <div class="imgOuter">
                    <img src=" https://img.freepik.com/premium-photo/young-handsome-man-with-beard-isolated-keeping-arms-crossed-frontal-position_1368-132662.jpg" height="150" class="img-thumnail" />
                </div>
                <div class="VolunteerDetailsOuter">
                    <div class="main">
                        <p class="position"><?php
                                            if ($item['Title'] == "") {
                                                echo "  <p></p>";
                                            } else {
                                                echo $item['Title'];
                                            }
                                            // }
                                            ?></p>

                        <p class="name">Lion <?php echo $item['First_Name'] . " " . $item['Last_Name']; ?> </p>
                    </div>

                    <div class="socialLinks">
                        <a class="fb"><i class="fa-brands fa-facebook-f"></i></a>
                        <a class="twitter"><i class="fa-brands fa-twitter"></i></a>
                        <a class="insta"><i class="fa-brands fa-instagram"></i></a>
                        <a class="in"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a class="wtsapp" class=""><i class="fa-brands fa-whatsapp"></i></a>
                        <a class="email"><i class="fa-regular fa-envelope"></i></a>
                        <a href="" class="more"><i class="fa-solid fa-plus"></i></a>

                    </div>
                </div>
            </div>
            <!-- </div> -->
        <?php endforeach; ?>
    </div>
    <script>
        // Get the first row items
        const firstRowItems = document.querySelectorAll('.volunteersOuter > .outer:nth-child(-n+3)'); // Adjust the selector to target the items in the first row

        // Get the maximum width of the first row items
        let maxItemWidth = 0;
        firstRowItems.forEach(item => {
            const itemWidth = item.offsetWidth;
            if (itemWidth > maxItemWidth) {
                maxItemWidth = itemWidth;
            }
        });

        // Set the same width for items in the last row
        const lastRowItems = document.querySelectorAll('.volunteersOuter > .outer:nth-last-child(-n+3)'); // Adjust the selector to target the items in the last row
        lastRowItems.forEach(item => {
            item.style.width = maxItemWidth + 'px';
        });
    </script>
</body>
<?php include 'inc/footer.php'; ?>