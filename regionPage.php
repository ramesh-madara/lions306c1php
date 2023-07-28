<?php include 'inc/header.php'; ?>
<link rel="stylesheet" type="text/css" href="style/RegionPage.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/solid.min.js" integrity="sha512-apZ8JDL5kA1iqvafDdTymV4FWUlJd8022mh46oEMMd/LokNx9uVAzhHk5gRll+JBE6h0alB2Upd3m+ZDAofbaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- //Delete -->


<!--SEARCHED or NOT BITFLIP-->
<?php
$regionName =  trim($_GET['region'], "'");
$district = trim($_GET['district'], "'");
$escapedDistrict = mysqli_real_escape_string($conn, $district); // Escape the district value
$escapedRegionName = mysqli_real_escape_string($conn, $regionName); // Escape the region name value

$searchKey = 'none';
$searchKey = trim(filter_input(INPUT_GET, 'searchKey', FILTER_SANITIZE_SPECIAL_CHARS));
$escapedSearchKey = mysqli_real_escape_string($conn, $searchKey); // Escape the clubID  value
$searched = ($searchKey !== 'none');

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

if ($searchKey != 'none') {

    $fetch
        = "SELECT * FROM c_1_members_new WHERE District_Name = '$escapedDistrict' AND Region_Name = '$escapedRegionName' and (First_Name LIKE '%$searchKey%' OR Last_Name LIKE '%$searchKey%')
     ORDER BY CAST(SUBSTRING(Zone_Name, 6) AS UNSIGNED) ASC";

    $result = mysqli_query($conn, $fetch);
    $volunteers = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $fetch =
        "SELECT * FROM c_1_members_new WHERE District_Name = '$escapedDistrict' AND Region_Name = '$escapedRegionName' ORDER BY CAST(SUBSTRING(Zone_Name, 6) AS UNSIGNED) ASC";
    $result = mysqli_query($conn, $fetch);
    $volunteers = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<?php if (empty($volunteers)) : ?>
    <p class="lead mt-3">There is no Volunteers</p>
<?php endif; ?>


<div style="display: flex;">
    <!-- <a href="feedback.php" class="btn btn-secondary btn-sm active" role="button" aria-pressed="true">Appointments</a>
  <a href="patients.php" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Patients</a>
  <a href="doctors.php" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Doctors</a> -->
</div>
<style>
    .dist {
        font-size: xx-large !important;
    }
</style>


<body>

    <div class="banner">
        <!-- <p><?php echo $district; ?></p> -->
        <!-- <p><?php echo "<span class='dist'>$district</span>" . " </br> " . "<span class = 'reg'>$regionName</span>"; ?></p> -->
        <p><?php echo  "<span class = 'reg'>OUR REGION</span>"; ?></p>
        <img src="img/volunteersBanner.jpg" alt="">
    </div>

    <div class="clubDetails">
        <p class="clubNameUpper">LIONS DISTRICT 306C1 : <?php echo strtoupper($regionName) ?></p>
        <div class="details">
            <div class="upperSec">
                <div class="sec1">
                    <span>DESTRICT: <span class="content"><?php echo strtoupper(str_replace('District ', '', $district)); ?></span></span><br>
                    <span>REGION: <span class="content"><?php echo strtoupper(str_replace('Region:', '', $regionName)); ?></span></span><br>
                    <!-- <span>MEMBER COUNT: <span class="content"><?php echo strtoupper(str_replace('Region:', '', $regionName)); ?></span></span><br> -->
                </div>
                <!-- <div class="sec2"> -->
                <!-- <span>REG. NO: <span class="content"><?php echo $clubDetails2[0]["Reg_No"] ?></span></span><br> -->
                <!-- <span>Chartered On: <span class="content">20-06-2022</span></span> -->
                <!-- </div> -->
            </div>
            <!-- <div class="lowerSec">
                <p>Extended by: <span class="content">Lions Club of Kiribathkumbura</span></p><br>
                <p>Extension Chairman: <span class="content">Lion Luxman Ullandupitiya</span></p><br>
                <p>Guiding Lion: <span class="content">Lion Luxman Ullandupitiya</span></p><br>
                <p>DG then in Office: <span class="content">DG Lion Amal Pussallage</span></p>
            </div> -->
            <!-- <div></div> -->
        </div>

    </div>

    <div class="breadCrumbs">
        <div class="navigation">
            <!-- <a class=" btn districtPageLink" href="index.php"><i class='fa-solid fa-arrow-left'></i>District Page</a> -->
            <a class=" btn districtPageLink" href="index.php"> OUR DISTRICT</a>
            <!-- <span class="payOuter"><a class=" btn pay" href="">PAY DUES</a></span> -->
        </div>
        <div class="searchOuter">
            <nav class="searchComponent ">
                <input name="search" id="search" class="form-control" type="search" placeholder="Enter Search key" aria-label="Search" onkeydown="if(event.keyCode==13) document.querySelector('.search').click()">
                <a class="btn btn-dark w-35 search" onclick="this.href='regionPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName; ?>&searchKey='+(document.getElementById('search').value ==''? 'none':document.getElementById('search').value)">
                    SEARCH</a>
                <a class="btn btn-dark w-35 showAll" onclick="this.href='regionPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName; ?>&searchKey=<?php echo 'none'; ?>'">
                    SHOW ALL</a>

            </nav>
        </div>
        <!-- <a href="index.php"><?php echo  "<i class='fa-solid fa-arrow-left'></i>" . " Go Back"  ?></a> -->



        <!-- <a href="index.php">></a> -->
        <!-- <a href="">Club Page</a> -->
    </div>


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
                        <!-- <p class="name">Lion <?php echo $item['First_Name'] . " " . $item['Last_Name']; ?> </p> -->
                        <?php if (
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
                        echo '</p>'; ?>

                        <p class="position"><?php
                                            if ($item['Title'] == "") {
                                                echo "  Club Member";
                                            } else {
                                                echo $item['Title'];
                                            }
                                            // }
                                            ?></p>

                    </div>

                    <div class="socialLinks">
                        <a class="fb"><i class="fa-brands fa-facebook-f"></i></a>
                        <a class="twitter"><i class="fa-brands fa-twitter"></i></a>
                        <a class="insta"><i class="fa-brands fa-instagram"></i></a>
                        <a class="in"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a class="wtsapp" class=""><i class="fa-brands fa-whatsapp"></i></a>
                        <a class="email"><i class="fa-regular fa-envelope"></i></a>
                        <!-- <a href="" class="more"><i class="fa-solid fa-plus"></i></a> -->
                        <?php
                        echo '<a href="volunteer.php?key=' . $item["Member_ID"] . "&district=" . $district . "&region=" . $regionName . "&zone=" . $item["Zone_Name"] . "&clubID=" . $item["Club_ID"] . "&prefix=" . $item["Prefix"] . '" class="more"><i class="fa-solid fa-plus"></i></a>';

                        ?>
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