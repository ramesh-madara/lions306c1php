<?php include 'inc/header.php'; ?>
<link rel="stylesheet" type="text/css" href="style/clubPage55.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/solid.min.js" integrity="sha512-apZ8JDL5kA1iqvafDdTymV4FWUlJd8022mh46oEMMd/LokNx9uVAzhHk5gRll+JBE6h0alB2Upd3m+ZDAofbaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- //Delete -->
<?php

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

$searchKey = 'none';
$searchKey = trim(filter_input(INPUT_GET, 'searchKey', FILTER_SANITIZE_SPECIAL_CHARS));
$searched = ($searchKey !== 'none');

// Continue with your code securely


$escapedDistrict = mysqli_real_escape_string($conn, $district); // Escape the district value
$escapedRegionName = mysqli_real_escape_string($conn, $regionName); // Escape the region name value
$escapedZoneName = mysqli_real_escape_string($conn, $zone); // Escape the zone name value
$escapedClubID = mysqli_real_escape_string($conn, $clubID); // Escape the clubID  value
$escapedSearchKey = mysqli_real_escape_string($conn, $searchKey); // Escape the clubID  value

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
    $fetch =
        "SELECT * FROM c_1_members_new WHERE District_Name = '$escapedDistrict' AND Region_Name = '$escapedRegionName' AND Zone_Name = '$escapedZoneName' AND Club_ID = '$escapedClubID' AND (First_Name LIKE '%$searchKey%' or Last_Name LIKE '%$searchKey%' or Middle_Name LIKE '%$searchKey%') ORDER BY CAST(SUBSTRING(Club_ID, 6) AS UNSIGNED) ASC";
    // "SELECT * FROM c_1_members_new WHERE District_Name = '$escapedDistrict' AND Region_Name = '$escapedRegionName' AND Zone_Name = '$escapedZoneName' AND Club_ID = '$escapedClubID' AND (First_Name LIKE '%shalaka%' or Last_Name LIKE '%shalaka%') ORDER BY CAST(SUBSTRING(Club_ID, 6) AS UNSIGNED) ASC";
} else {
    $fetch = "SELECT * FROM c_1_members_new WHERE District_Name = '$escapedDistrict' AND Region_Name = '$escapedRegionName' AND Zone_Name = '$escapedZoneName' AND Club_ID = '$escapedClubID' ORDER BY CAST(SUBSTRING(Club_ID, 6) AS UNSIGNED) ASC";
}
$result = mysqli_query($conn, $fetch);
$volunteers = mysqli_fetch_all($result, MYSQLI_ASSOC);
// echo count($volunteers);
$titleArrPre = [
    'Club President',
    'Club First Vice President',
    'Club Second Vice President',
    'Club Secretary',
    'Club Treasurer',
    'Club Membership Chairperson',
    'Club LCIF Coordinator',
    'Club Service Chairperson',
    'Club Marketing Chairperson',
    'Club Director',
    // 'Club Member'
];


$fetchDef = "SELECT * FROM c_1_members_new WHERE District_Name = '$escapedDistrict' AND Region_Name = '$escapedRegionName' AND Zone_Name = '$escapedZoneName' AND Club_ID = '$escapedClubID' ORDER BY CAST(SUBSTRING(Club_ID, 6) AS UNSIGNED) ASC ";
$resultDef = mysqli_query($conn, $fetchDef);
$volunteersDef = mysqli_fetch_all($resultDef, MYSQLI_ASSOC);
?>
<!--GO TO TOP-->
<script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        showGoToTopButton();
    };

    function showGoToTopButton() {
        var goToTopBtn = document.getElementById("goToTopBtn");

        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            goToTopBtn.style.display = "block";
        } else {
            goToTopBtn.style.display = "none";
        }
    }

    // Function to scroll back to the top of the page when the button is clicked
    function goToTop() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
    }
</script>

<style>
    /* Styling for the "Go to Top" button */
    #goToTopBtn {
        display: none;
        /* Hide the button by default */
        position: fixed;
        bottom: 40px;
        right: 40px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        border-radius: 35px;
        background-color: white;
        width: 45px;
        /* Customize the button's background color */
        color: #fff;
        /* Customize the button's text color */
        cursor: pointer;
        padding: 10px 10px 10px 10px;
        /* border-radius: 4px; */
        transition: 0.2s;
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.545);
    }

    #goToTopBtn i {
        color: #45AC89;
    }

    #goToTopBtn:hover {
        transition: 0.2s;
        box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.545);
        bottom: 42px;
    }

    #goToTopBtn:active {
        transition: 0.05s;
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.545);

        bottom: 40px;
    }
</style>

<button id="goToTopBtn" onclick="goToTop()"><i class="fa-solid fa-arrow-up"></i></button>
<?php if (empty($volunteers)) : ?>
    <p class="lead mt-3">There is no Volunteers</p>
<?php endif; ?>

<?php
//global

$fetchClubDetails = "SELECT *   from clubdetails WHERE Reg_No = '$clubID' ORDER BY Reg_No ASC";
$resultClubDetails = mysqli_query($conn, $fetchClubDetails);
$clubDetails2 = mysqli_fetch_all($resultClubDetails, MYSQLI_ASSOC);
// echo count($clubDetails2);
?>



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
                    <span>DESTRICT: <span class="content"><?php echo strtoupper(str_replace('District ', '', $district)); ?></span></span><br>
                    <span>REGION: <span class="content"><?php echo strtoupper(str_replace('Region:', '', $regionName)); ?></span></span><br>
                    <span>ZONE: <span class="content"><?php echo strtoupper(str_replace('Zone:', '', $zone)); ?></span></span>
                </div>
                <div class="sec2">
                    <span>REG. NO: <span class="content"><?php echo $clubDetails2[0]["Reg_No"] ?></span></span><br>
                    <!-- <span>Chartered On: <span class="content"><?php echo $clubDetails2[0]["Charter_Date"] ?></span></span><br> -->
                    <span>CHARTERED ON: <span class="content"><?php echo date("d-m-Y", strtotime($clubDetails2[0]["Charter_Date"])) ?></span></span><br>

                    <span>MEMBER COUNT: <span class="content"><?php echo count($volunteersDef); ?></span></span>
                </div>
                <div class="sec2">
                    <span class="paySection">LCI PAYMENT: <span class="content lciPayment"><?php $payment = '';
                                                                                            if ($clubDetails2[0]["LCI_Payment"] < 0) {
                                                                                                $payment = explode("-", $clubDetails2[0]["LCI_Payment"])[1];
                                                                                                echo " " . " USD " .  number_format($payment, 2, '.', ',') . " CR";
                                                                                            } else {
                                                                                                $payment = $clubDetails2[0]["LCI_Payment"];
                                                                                                echo " " . " USD " . number_format($payment, 2, '.', ',');
                                                                                            }
                                                                                            ?></span></span>
                    <!-- <span class="payOuter"><a class="pay" href="">Pay</a></span> -->
                    <span>DISTRICT PAYMENT: <span class="content"><?php echo "LKR " . number_format($clubDetails2[0]["District_Payment"]) . ".00" ?></span></span><br>

                    <!-- </span><br> -->
                </div>
            </div>
            <div class="lowerSec">
                <div class="lowerSecDetails">
                    <p>EXTENDED BY: <span class="content"><?php echo strtoupper($clubDetails2[0]["Extended_by"])  ?></span></p><br>
                    <p>EXTENSION CHAIRMAN: <span class="content"><?php echo strtoupper($clubDetails2[0]["Extention_Chairman"])  ?></span></p><br>
                    <p>GUIDING LION: <span class="content"><?php echo strtoupper($clubDetails2[0]["Guiding_Lion"])  ?></span></p><br>
                    <p>DG THEN IN OFFICE: <span class="content"><?php echo strtoupper($clubDetails2[0]["DG_then_in_office"])  ?></span></p>
                </div>
                <!-- <div class="searchOuter">
                    <nav class="searchComponent ">
                        <input name="search" id="search" class="form-control" type="search" placeholder="Enter Search key" aria-label="Search" onkeydown="if(event.keyCode==13) document.querySelector('.search').click()">
                        <a class="btn btn-dark w-35 search" onclick="this.href='clubPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName; ?>&zone=<?php echo $zone; ?>&clubID=<?php echo $clubID; ?>&searchKey='+(document.getElementById('search').value ==''? 'none':document.getElementById('search').value)">
                            Search</a>
                        <a class="btn btn-dark w-35 showAll" onclick="this.href='clubPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName; ?>&zone=<?php echo $zone; ?>&clubID=<?php echo $clubID; ?>&searchKey=<?php echo 'none'; ?>'">
                            Show all</a>

                    </nav>
                </div> -->

            </div>
        </div>
    </div>
    <div class="breadCrumbs">
        <div class="navigation">
            <!-- <a class=" btn districtPageLink" href="index.php"><i class='fa-solid fa-arrow-left'></i>District Page</a> -->
            <a class=" btn districtPageLink" href="index.php"> OUR DISTRICT</a>
            <span class="payOuter"><a class=" btn pay" href="">PAY DUES</a></span>
        </div>
        <div class="searchOuter">
            <nav class="searchComponent ">
                <!-- <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-4 w-155" style="display: flex;"> -->
                <input name="search" id="search" class="form-control" type="search" placeholder="Enter Search key" aria-label="Search" onkeydown="if(event.keyCode==13) document.querySelector('.search').click()">
                <a class="btn btn-dark w-35 search" onclick="this.href='clubPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName; ?>&zone=<?php echo $zone; ?>&clubID=<?php echo $clubID; ?>&searchKey='+(document.getElementById('search').value ==''? 'none':document.getElementById('search').value)">
                    SEARCH</a>
                <a class="btn btn-dark w-35 showAll" onclick="this.href='clubPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName; ?>&zone=<?php echo $zone; ?>&clubID=<?php echo $clubID; ?>&searchKey=<?php echo 'none'; ?>'">
                    SHOW ALL</a>

            </nav>
        </div>
        <!-- <a href="index.php"><?php echo  "<i class='fa-solid fa-arrow-left'></i>" . " Go Back"  ?></a> -->



        <!-- <a href="index.php">></a> -->
        <!-- <a href="">Club Page</a> -->
    </div>
    <script>

    </script>

    <?php
    $titleArr = [
        'Club President',
        'Club First Vice President',
        'Club Second Vice President',
        'Club Secretary',
        'Club Treasurer',
        'Club Administrator',
        'Club Membership Chairperson',
        'Club LCIF Coordinator',
        'Club Service Chairperson',
        'Club Marketing Chairperson',
        'Club Director',
        // 'Club Member'
    ];
    $lastMemberID2 = [];
    function printMember($item)
    {
        global $lastMemberID2;
        // echo $lastMemberID2 . $item['Last_Name'];
        if (!in_array($item['Member_ID'], $lastMemberID2)) {
            global $regionName;
            global $district;
            global $zone;
            global $clubID;

            global $titleArr;
            $title = "";
            $src = "https://img.freepik.com/premium-photo/young-handsome-man-with-beard-isolated-keeping-arms-crossed-frontal-position_1368-132662.jpg";
            if ($item['Member_Photo'] != null) {
                $src = "https://i.imgur.com/DaEQt4b.jpg";
            } else {
                $src = "https://img.freepik.com/premium-photo/young-handsome-man-with-beard-isolated-keeping-arms-crossed-frontal-position_1368-132662.jpg";
            }
            echo '<div class="outer">';
            echo '<div class="imgOuter">';
            echo '<img src="' . $src . '" height="150" class="img-thumnail" />';
            echo '</div>';
            echo '<div class="VolunteerDetailsOuter">';
            echo '<div class="main">';
            if ($item['Title'] == "") {
                $title = "Club Member";
            } else {
                $titleArrTemp = explode("-", $item['Title']);
                if (count($titleArrTemp) > 1) {
                    $arr = [];
                    foreach ($titleArr as $u) {
                        for ($v = 0; $v < count($titleArrTemp); $v++) {
                            if ($titleArrTemp[$v] == $u & strlen($titleArrTemp[$v]) > 0) {
                                $arr[$v] = $titleArrTemp[$v];
                            }
                        }
                    }
                    $arr2 = [];

                    $diffArr  = array_diff($titleArrTemp, $arr);
                    $arr2 = array_merge($arr2, $diffArr);
                    if (count($arr2) > 0) {
                        if (strlen($arr2[0]) > 1) {
                            $title = implode(", ", $arr) . ", " . implode(", ", $arr2);
                        }
                    } else {
                        $title = implode(", ", $arr);
                    }
                } else {
                    $title = $titleArrTemp[0];
                }
            }
            //Prefix
            $prefix = "";
            if (
                strpos(strtolower($item["Prefix"]), 'mr') !== false || strpos(strtolower($item["Prefix"]), 'mrs') !== false || strpos(strtolower($item["Prefix"]), 'ms') !== false
            ) {
                $prefix = "";
            } else {
                $prefix = strtoupper($item["Prefix"]) . " ";
            }

            echo '<p class="name">LION ' . $prefix;
            $firstNameArr = explode(" ", $item['First_Name']);
            // if (count($firstNameArr) > 1) {
            for ($i = 0; $i < count($firstNameArr); $i++) {
                $subStr1 = strtoupper($firstNameArr[$i]);
                if (strlen($subStr1) != 0) {
                    echo $subStr1[0] . ". ";
                }
            }
            $middleNameArr = explode(" ", $item['Middle_Name']);
            // if (count($middleNameArr) > 1) {
            for ($i = 0; $i < count($middleNameArr); $i++) {
                $subStr2 = strtoupper($middleNameArr[$i]);
                if (strlen($subStr2) != 0) {
                    echo $subStr2[0] . ". ";
                }
            }
            $lastNameArr = explode(" ", $item['Last_Name']);
            if (count($lastNameArr) > 1) {
                for ($i = 0; $i < count($lastNameArr) - 1; $i++) {
                    $subStr3 = strtoupper($lastNameArr[$i]);
                    if (strlen($subStr3) != 0) {
                        echo $subStr3[0] . ". ";
                    }
                }
                if (isset($lastNameArr[count($lastNameArr) - 1])) {
                    echo strtoupper($lastNameArr[count($lastNameArr) - 1]);
                }
            } else {
                echo strtoupper($item['Last_Name']) . " ";
            }
            // else {
            //     if (strlen($item['First_Name']) >= 9) {
            //         echo $item['First_Name'][0] . ". ";
            //     } else {
            //         echo strtoupper($item['First_Name']) . " ";
            //     }
            // }
            // echo strtoupper($item['Last_Name'] . " " . $item['Suffix']);
            echo '</p>';
            echo '<p class="position">' . $title . '</p>';

            echo '</div>';
            echo '<div class="socialLinks">';
            echo '<a class="fb"><i class="fa-brands fa-facebook-f"></i></a>';
            echo '<a class="twitter"><i class="fa-brands fa-twitter"></i></a>';
            echo '<a class="insta"><i class="fa-brands fa-instagram"></i></a>';
            echo '<a class="in"><i class="fa-brands fa-linkedin-in"></i></a>';
            echo '<a class="wtsapp" class=""><i class="fa-brands fa-whatsapp"></i></a>';
            echo '<a class="email"><i class="fa-regular fa-envelope"></i></a>';
            echo '<a href="volunteer.php?key=' . $item["Member_ID"] . "&district=" . $district . "&region=" . $regionName . "&zone=" . $zone . "&clubID=" . $clubID . "&prefix=" . $prefix . '" class="more"><i class="fa-solid fa-plus"></i></a>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        array_push($lastMemberID2, $item['Member_ID']);
    }

    function printMemberTitled($item, $memTitle, $title3, $lastMemID)
    {
        if ($memTitle == $title3) {
            printMember($item);
        }
    }

    ?>
    <div class="volunteersOuter">

        <?php
        if ($searchKey != 'none') {
            foreach ($volunteers as $item) {

                // if ($item["Title"] == null) {

                printMember($item);
                // }
            }
        } else {

            $lastMemID = "";
            foreach ($titleArr as $title3) {

                foreach ($volunteers as $item) {

                    if ($item["Title"] != null) {
                        $memTitles =  explode("-", $item["Title"]);
                        if ($item["Member_ID"] != $lastMemID) {
                            $lastMemTittle = "";
                            $titleCount = 0;
                            foreach ($memTitles as $memTitle) {
                                // if (in_array($memTitle, $titleArr)) {
                                //     $titleCount++;
                                // }
                                if (($memTitle == $title3)) {
                                    $titleCount++;
                                }
                                // echo $titleCount;

                                if ($memTitle == $title3 & $titleCount <= 1) {
                                    printMember($item);
                                }
                                $lastMemID = $item["Member_ID"];
                                $lastMemTittle = $memTitle;
                            }
                        }
                    }
                }
            }

            foreach ($volunteers as $item) {

                if ($item["Title"] == null) {

                    printMember($item);
                }
            }
        }

        ?>


        <?php foreach ($volunteers as $item) : ?>

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