<?php include 'inc/header.php'; ?>
<link rel="stylesheet" type="text/css" href="style/clubPage54.css">
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
$regionName = trim(filter_input(INPUT_GET, 'region', FILTER_SANITIZE_SPECIAL_CHARS));
$district = trim(filter_input(INPUT_GET, 'district', FILTER_SANITIZE_SPECIAL_CHARS));
$zone = trim(filter_input(INPUT_GET, 'zone', FILTER_SANITIZE_SPECIAL_CHARS));
$clubID = trim(filter_input(INPUT_GET, 'clubID', FILTER_SANITIZE_SPECIAL_CHARS));

// Apply additional validation if needed
if (empty($regionName) || empty($district) || empty($zone) || empty($clubID)) {
    // Handle the case when required parameters are missing
    // Return an error message or redirect the user to an appropriate page
}

$searchKey = trim(filter_input(INPUT_GET, 'searchKey', FILTER_SANITIZE_SPECIAL_CHARS));
$searched = ($searchKey !== 'none');

// Continue with your code securely


$escapedDistrict = mysqli_real_escape_string($conn, $district); // Escape the district value
$escapedRegionName = mysqli_real_escape_string($conn, $regionName); // Escape the region name value
$escapedZoneName = mysqli_real_escape_string($conn, $zone); // Escape the zone name value
$escapedClubID = mysqli_real_escape_string($conn, $clubID); // Escape the clubID  value
$escapedSearchKey = mysqli_real_escape_string($conn, $searchKey); // Escape the clubID  value
// echo $escapedSearchKey;

// echo $escapedZoneName;
// if ($searchKey == 'none') {
// echo 'nosearch';
// } else {
// echo $searchKey;
// }
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
        // echo $searchKey;
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
    // echo $searchKey;
    $fetch =
        "SELECT * FROM c_1_members_new WHERE District_Name = '$escapedDistrict' AND Region_Name = '$escapedRegionName' AND Zone_Name = '$escapedZoneName' AND Club_ID = '$escapedClubID' AND (First_Name LIKE '%$searchKey%' or Last_Name LIKE '%$searchKey%') ORDER BY CAST(SUBSTRING(Club_ID, 6) AS UNSIGNED) ASC";
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
                <div class="lowerSecDetails">
                    <p>Extended by: <span class="content">Lions Club of Kiribathkumbura</span></p><br>
                    <p>Extension Chairman: <span class="content">Lion Luxman Ullandupitiya</span></p><br>
                    <p>Guiding Lion: <span class="content">Lion Luxman Ullandupitiya</span></p><br>
                    <p>DG then in Office: <span class="content">DG Lion Amal Pussallage</span></p>
                </div>
                <div class="searchOuter">
                    <nav class="searchComponent ">
                        <!-- <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-4 w-155" style="display: flex;"> -->
                        <input name="search" id="search" class="form-control" type="search" placeholder="Enter Search key" aria-label="Search" onkeydown="if(event.keyCode==13) document.querySelector('.search').click()">
                        <a class="btn btn-dark w-35 search" onclick="this.href='clubPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName; ?>&zone=<?php echo $zone; ?>&clubID=<?php echo $clubID; ?>&searchKey='+(document.getElementById('search').value ==''? 'none':document.getElementById('search').value)">
                            Search</a>
                        <a class="btn btn-dark w-35 showAll" onclick="this.href='clubPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName; ?>&zone=<?php echo $zone; ?>&clubID=<?php echo $clubID; ?>&searchKey=<?php echo 'none'; ?>'">
                            Show all</a>

                    </nav>
                </div>

            </div>
        </div>
    </div>
    <script>

    </script>
    <!-- <nav class="searchComponent "> -->
    <!-- <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-4 w-155" style="display: flex;"> -->
    <!-- <input name="search" id="search" class="form-control" type="search" placeholder="Enter Search key" aria-label="Search" onkeydown="if(event.keyCode==13) document.querySelector('.search').click()"> -->
    <!-- <a class="btn btn-dark w-35 search" onclick="this.href='clubPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName; ?>&zone=<?php echo $zone; ?>&clubID=<?php echo $clubID; ?>&searchKey='+(document.getElementById('search').value ==''? 'none':document.getElementById('search').value)"> -->
    <!-- Search</a> -->
    <!-- <a class="btn btn-dark w-35 showAll" onclick="this.href='clubPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName; ?>&zone=<?php echo $zone; ?>&clubID=<?php echo $clubID; ?>&searchKey=<?php echo 'none'; ?>'"> -->
    <!-- Show all</a> -->

    <!-- </nav> -->
    <?php
    $titleArr = [
        'clubpresident',
        'clubfirstvicepresident',
        'clubsecondvicepresident',
        'clubsecretary',
        'clubtreasurer',
        'clubmembershipchairperson',
        'clublcifcoordinator',
        'clubservicechairperson',
        'clubmarketingchairperson',
        'clubdirector',
        'clubmember'
    ];
    $string3 = $titleArr[0];
    $string4 = "Club President";
    function isSimilarIgnoringCaseAndSpace($string1, $string2)
    {
        // Remove spaces and convert to lowercase
        $processedString1 = str_replace(' ', '', strtolower($string1));
        $processedString2 = str_replace(' ', '', strtolower($string2));

        // Sort the characters in the strings to ensure proper comparison
        $sortedString1 = str_split($processedString1);
        sort($sortedString1);
        $sortedString2 = str_split($processedString2);
        sort($sortedString2);

        // Compare the sorted strings to check for similarity
        return $sortedString1 === $sortedString2;
    }
    // echo isSimilarIgnoringCaseAndSpace($string3, $string4) . " 8";

    ?>
    <div class="volunteersOuter">

        <?php foreach ($volunteers as $item) : ?>
            <?php
            $titles = explode("-", $item['Title']);

            ?>

            <div class="outer">
                <div class="imgOuter">
                    <img src=" https://img.freepik.com/premium-photo/young-handsome-man-with-beard-isolated-keeping-arms-crossed-frontal-position_1368-132662.jpg" height="150" class="img-thumnail" />
                </div>
                <div class="VolunteerDetailsOuter">
                    <div class="main">
                        <p class="position"><?php
                                            if ($item['Title'] == "") {
                                                $title = "Club Member";
                                            } else {
                                                $titleArr = explode("-", $item['Title']);
                                                if (count($titleArr) > 1) {
                                                    $title = $titleArr[0] . ", " . $titleArr[1];
                                                } else {
                                                    $title = $titleArr[0];
                                                }
                                            }
                                            echo $title;
                                            // }
                                            ?></p>

                        <p class="name">LION <?php
                                                $firstNameArr = explode(" ", $item['First_Name']);
                                                if (count($firstNameArr) > 1) {
                                                    for ($i = 0; $i < count($firstNameArr); $i++) {
                                                        $subStr = strtoupper($firstNameArr[$i]);
                                                        if (strlen($subStr) != 0) {
                                                            echo $subStr[0] . ". ";
                                                        }
                                                    }
                                                } else {
                                                    echo strtoupper($item['First_Name']) . " ";
                                                }
                                                echo  strtoupper($item['Last_Name']);

                                                // echo $item['First_Name'] . " ";
                                                ?> </p>
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
        // // Get the first row items
        // const firstRowItems = document.querySelectorAll('.volunteersOuter > .outer:nth-child(-n+3)'); // Adjust the selector to target the items in the first row

        // // Get the maximum width of the first row items
        // let maxItemWidth = 0;
        // firstRowItems.forEach(item => {
        //     const itemWidth = item.offsetWidth;
        //     if (itemWidth > maxItemWidth) {
        //         maxItemWidth = itemWidth;
        //     }
        // });

        // // Set the same width for items in the last row
        // const lastRowItems = document.querySelectorAll('.volunteersOuter > .outer:nth-last-child(-n+3)'); // Adjust the selector to target the items in the last row
        // lastRowItems.forEach(item => {
        //     item.style.width = maxItemWidth + 'px';
        // });
    </script>

</body>
<?php include 'inc/footer.php'; ?>