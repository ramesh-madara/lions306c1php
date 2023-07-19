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
// echo $regionName;
// echo $district;
// echo $zone;
// echo $clubID;

// Apply additional validation if needed
if (empty($regionName) || empty($district) || empty($zone) || empty($clubID)) {
    // Handle the case when required parameters are missing
    // Return an error message or redirect the user to an appropriate page
}

$searchKey = trim(filter_input(INPUT_GET, 'searchKey', FILTER_SANITIZE_SPECIAL_CHARS));
$searched = ($searchKey !== 'none');

// Continue with your code securely


$escapedDistrict = mysqli_real_escape_string($conn, $district); // Escape the district value
// echo $escapedDistrict;
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
echo count($volunteers);
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
// $arr = [];
// $titleArr2 = explode("-", $volunteers[18]['Title']);
// echo count($titleArr2);
// // echo $titleArr2[0];
// foreach ($titleArrPre as $u) {
//     for ($v = 0; $v < count($titleArr2); $v++) {
//         if ($titleArr2[$v] == $u & strlen($titleArr2[$v]) != 0) {
//             $arr[$v] = $u;
//         }
//     }
// }

// foreach ($arr as $ar) {
//     echo $ar . ', ';
// }
// echo ($titleArr2[1]);

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
    function printMember($item)
    {
        global $titleArr;
        $title = "";

        echo '<div class="outer">';
        echo '<div class="imgOuter">';
        echo '<img src="https://img.freepik.com/premium-photo/young-handsome-man-with-beard-isolated-keeping-arms-crossed-frontal-position_1368-132662.jpg" height="150" class="img-thumnail" />';
        echo '</div>';
        echo '<div class="VolunteerDetailsOuter">';
        echo '<div class="main">';
        if ($item['Title'] == "") {
            $title = "Club Member";
        } else {
            $titleArrTemp = explode("-", $item['Title']);
            if (count($titleArrTemp) > 1) {
                $arr = [];
                // echo count($titleArrTemp);
                // echo $titleArrTemp[0];
                foreach ($titleArr as $u) {
                    for ($v = 0; $v < count($titleArrTemp); $v++) {
                        if ($titleArrTemp[$v] == $u & strlen($titleArrTemp[$v]) > 0) {
                            // $arr[$v] = $u;
                            $arr[$v] = $titleArrTemp[$v];
                        }
                    }
                }
                $arr2 = [];

                $w = [1, 2, 3, 4];
                $w2 = [1, 2, 3, 4, 5, 6];
                $diffArr  = array_diff($titleArrTemp, $arr);
                $arr2 = array_merge($arr2, $diffArr);
                if (count($arr2) > 0) {
                    if (strlen($arr2[0]) > 1) {
                        $title = implode(", ", $arr) . ", " . implode(", ", $arr2);
                    }
                } else {
                    $title = implode(", ", $arr);
                }
                // foreach ($arr as $ar) {
                //     // $title = $title . $ar . ', ';
                //     // echo $ar . "|";
                // }
                // foreach ($arr as $key => $ar) {
                //     // $title = $title . "Index: " . $key . ", Value: " . $ar . ', ';

                //     $title = $title . $ar . ', ';
                // }



                // $title = $titleArrTemp[0] . ", " . $titleArrTemp[1];
            } else {
                $title = $titleArrTemp[0];
            }
        }
        echo '<p class="position">' . $title . '</p>';
        echo '<p class="name">LION ';
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
        echo strtoupper($item['Last_Name']);
        echo '</p>';
        echo '</div>';
        echo '<div class="socialLinks">';
        echo '<a class="fb"><i class="fa-brands fa-facebook-f"></i></a>';
        echo '<a class="twitter"><i class="fa-brands fa-twitter"></i></a>';
        echo '<a class="insta"><i class="fa-brands fa-instagram"></i></a>';
        echo '<a class="in"><i class="fa-brands fa-linkedin-in"></i></a>';
        echo '<a class="wtsapp" class=""><i class="fa-brands fa-whatsapp"></i></a>';
        echo '<a class="email"><i class="fa-regular fa-envelope"></i></a>';
        echo '<a href="" class="more"><i class="fa-solid fa-plus"></i></a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    function printMemberTitled($item, $memTitle, $title3)
    {

        if ($memTitle == $title3) {
            printMember($item);
        }
    }

    ?>
    <div class="volunteersOuter">

        <?php
        $lastMemID = "";
        foreach ($titleArr as $title3) {

            foreach ($volunteers as $item) {

                if ($item["Title"] != null) {
                    $memTitles =  explode("-", $item["Title"]);
                    // echo 88;
                    foreach ($memTitles as $memTitle) {
                        if ($item["Member_ID"] != $lastMemID) {

                            printMemberTitled($item, $memTitle, $title3);
                            $lastMemID = $item["Member_ID"];
                        }
                    }
                }
            }
        }
        // foreach ($volunteers as $item) {
        //     $memTitlesOther =  explode("-", $item["Title"]);
        //     $othersExists = false;
        //     foreach ($titleArr as $title) {
        //         foreach ($memTitlesOther as $other) {
        //             if ($item["Title"] != null & $title != $other) {
        //                 $othersExists = true;
        //             }
        //         }
        //     }

        //     if ($othersExists == true) {

        //         printMember($item);
        //     }
        // }
        foreach ($volunteers as $item) {

            if ($item["Title"] == null) {

                printMember($item);
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