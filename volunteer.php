<link rel="stylesheet" type="text/css" href="style/volunteerIndividual.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php
include 'inc/header.php';


$regionName = trim(filter_input(INPUT_GET, 'region', FILTER_SANITIZE_SPECIAL_CHARS));
$district = trim(filter_input(INPUT_GET, 'district', FILTER_SANITIZE_SPECIAL_CHARS));
$zone = trim(filter_input(INPUT_GET, 'zone', FILTER_SANITIZE_SPECIAL_CHARS));
$clubID = trim(filter_input(INPUT_GET, 'clubID', FILTER_SANITIZE_SPECIAL_CHARS));
$prefix = trim(filter_input(INPUT_GET, 'prefix', FILTER_SANITIZE_SPECIAL_CHARS));
// echo $regionName . $zone . $clubID . $district;

// Assuming you have a database connection established
// Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials

// Get the value of 'key' from the URL parameter
$key = filter_input(INPUT_GET, 'key', FILTER_SANITIZE_SPECIAL_CHARS);

// Sanitize the input to prevent SQL injection
$sanitized_key = mysqli_real_escape_string($conn, $key);

// Construct the SQL query
$query = "SELECT * FROM c_1_members_new WHERE Member_ID = '$sanitized_key' LIMIT 1";
$result = mysqli_query($conn, $query);
// ---
$getAllMembers = "SELECT * FROM c_1_members_new WHERE Club_ID = '$clubID' ";
$allMembersResult = mysqli_query($conn, $getAllMembers);
$allMembersArr = mysqli_fetch_all($allMembersResult, MYSQLI_ASSOC);

// Assuming $currentMemberId is the Member_ID of the current record/item you are working with.
$currentMemberId = $key; // Replace this with the actual Member_ID of the current record.

// Find the position/index of the current record/item in the array.
$currentMemberIndex = array_search($currentMemberId, array_column($allMembersArr, 'Member_ID'));
$nextNavBtnActiveness = 'active';
$lastNavBtnActiveness = 'active';
// Check if the current record/item was found in the array and if it's not the last element.
if ($currentMemberIndex !== false && isset($allMembersArr[$currentMemberIndex + 1])) {
    // Get the next record/item and its Member_ID.
    $nextMember = $allMembersArr[$currentMemberIndex + 1];
    $nextMemberId = $nextMember['Member_ID'];
    // Now $nextMemberId contains the Member_ID of the next record/item.
    // echo "The Member_ID of the next record/item is: " . $nextMemberId;
    $nextNavBtnActiveness = 'active';
} else {
    $nextNavBtnActiveness = 'inactive';
    $nextMemberId = $key;


    // echo "No next record/item found.";
}
if ($currentMemberIndex !== false && isset($allMembersArr[$currentMemberIndex - 1])) {
    // Get the next record/item and its Member_ID.
    $lastMember = $allMembersArr[$currentMemberIndex - 1];
    $lastMemberId = $lastMember['Member_ID'];
    // Now $lastMemberId contains the Member_ID of the last record/item.
    // echo "The Member_ID of the last record/item is: " . $lastMemberId;
    $lastNavBtnActiveness = 'active';
} else {
    // echo "No next record/item found.";
    $lastNavBtnActiveness = 'inactive';
    $lastMemberId = $key;
}


// Check if the query execution was successful
if ($result) {

    // Display the results
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <?php
        $src = "https://img.freepik.com/premium-photo/young-handsome-man-with-beard-isolated-keeping-arms-crossed-frontal-position_1368-132662.jpg";
        if ($row['Member_Photo'] != null) {
            $src = "https://i.imgur.com/DaEQt4b.jpg";
        } else {
            $src = "https://img.freepik.com/premium-photo/young-handsome-man-with-beard-isolated-keeping-arms-crossed-frontal-position_1368-132662.jpg";
        }
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
        ];
        if ($row['Title'] == "") {
            $title = "Club Member";
        } else {
            $titleArrTemp = explode("-", $row['Title']);
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
                        // echo $title;
                    }
                } else {
                    $title = implode(", ", $arr);
                    // echo $title;
                }
            } else {
                $title = $titleArrTemp[0];
            }
        }

        $titleList = explode(", ", $title);
        $clubTitles = [];
        $districtTitles = [];
        $councilTitles = [];
        for ($i = 0; $i < count($titleList); $i++) {
            if (strpos($titleList[$i], "Multiple District") !== false | strpos($titleList[$i], "Council") !== false) {
                array_push($councilTitles, $titleList[$i]);
            } else if (strpos($titleList[$i], "District") !== false) {
                array_push($districtTitles, $titleList[$i]);
            } else {
                array_push($clubTitles, $titleList[$i]);
            }
        }
        // echo $districtTitles[0];
        ?>
        <div class="memberOuterMost">
            <div class="photoOuter">
                <img src=<?php echo $src; ?> height="150" class="img-thumnail" />
            </div>
            <div class="detailsOuter">
                <div class="breadCrumbs">
                    <a href="clubPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName ?>&zone=<?php echo $zone ?>&clubID=<?php echo $clubID; ?>&searchKey=<?php echo 'none' ?>"><?php echo  "<i class='fa-solid fa-arrow-left'></i>" . " Go Back"  ?></a>
                    <!-- <a href="index.php">></a> -->
                    <!-- <a href="">Club Page</a> -->
                </div>
                <div class="nameMain"><?php echo strtoupper("LION " . $prefix . " " . $row['First_Name'] . " " . $row['Last_Name'] . " " . $row['Suffix']); ?></div>
                <!-- <div class="position"><?php echo $row['district_position_1']; ?></div> -->
                <div class="contents">
                    <div class="description">
                        <label for="">About:</label><br>
                        <p>Meet Alex, a radiant beacon of positivity, spreading joy and warmth with an infectious smile. Their boundless energy and empathetic nature make them a trusted confidant and a true friend to all. As a natural leader, they uplift and motivate others, turning challenges into growth opportunities. Alex's compassion and optimism leave a lasting impact, making the world a better place, one smile at a time.</p>
                    </div>
                    <table>
                        <tr>
                            <td><span>M/N: </span></td>
                            <td class="detail"><?php echo strtoupper($row['Member_ID']); ?></td>
                        </tr>
                        <tr>
                            <td><span>DISTRICT: </span></td>
                            <td class="detail"><?php echo strtoupper(str_replace("District", "", $row['District_Name'])); ?></td>
                        </tr>
                        <tr>
                            <td><span>REGION: </span></td>
                            <td class="detail"><?php echo strtoupper(str_replace("Region:", "", $row['Region_Name'])); ?></td>
                        </tr>
                        <tr>
                            <td><span>ZONE: </span></td>
                            <td class="detail"><?php echo strtoupper(str_replace("Zone:", "", $row['Zone_Name'])); ?></td>
                        </tr>
                        <tr>
                            <td><span>CLUB NAME: </span></td>
                            <td class="detail"><?php echo strtoupper($row['Club_Name']); ?></td>
                        </tr>
                        <tr>
                            <td><span>JOINED DATE: </span></td>
                            <td class="detail"><?php echo strtoupper(date("d-m-Y", strtotime($row['Join_Date']))); ?></td>
                        </tr>
                        <tr>
                            <?php
                            // Given date
                            $givenDate = $row['Join_Date'];

                            // Current date
                            $currentDate = date('Y-m-d H:i:s');

                            // Convert the dates to DateTime objects
                            $givenDateTime = new DateTime($givenDate);
                            $currentDateTime = new DateTime($currentDate);

                            // Calculate the difference between the two dates
                            $interval = $givenDateTime->diff($currentDateTime);

                            // Extract the interval components
                            $years = $interval->format('%Y');
                            $months = $interval->format('%m');

                            // Output the result
                            $resultDuration = $years . ' Years ' . ", " . $months . ' Months';
                            // echo $resultDuration;
                            ?>

                            <td><span>DURATION SERVED: </span></td>
                            <td class="detail"><?php echo strtoupper($resultDuration); ?></td>
                        </tr>
                        <?php
                        for ($i = 0; $i < count($clubTitles); $i++) {
                            echo '<tr>';
                            echo '<td><span>CLUB POSITION ' . $i + 1 . ": " .  ' </span></td>';
                            echo '<td class="detail">' .  strtoupper($clubTitles[$i]) . '</td>';
                            echo '</tr>';
                        }
                        for ($i = 0; $i < count($districtTitles); $i++) {
                            echo '<tr>';
                            echo '<td><span>DISTRICT POSITION ' . $i + 1 . ": " .  ' </span></td>';
                            echo '<td class="detail">' .  strtoupper($districtTitles[$i]) . '</td>';
                            echo '</tr>';
                        }
                        for ($i = 0; $i < count($councilTitles); $i++) {
                            echo '<tr>';
                            echo '<td><span>COUNCIL POSITION ' . $i + 1 . ": " .  ' </span></td>';
                            echo '<td class="detail">' .  strtoupper($councilTitles[$i]) . '</td>';
                            echo '</tr>';
                        }
                        ?>


                        <!-- <tr>
                            <td><span>NAME: </span></td>
                            <td class="detail"><?php echo strtoupper($row['First_Name'] . " " . $row['Last_Name']); ?></td>
                        </tr> -->

                        <tr>
                            <td><span>OCCUPATION: </span></td>
                            <td class="detail"><?php echo strtoupper($row['Occupation']); ?></td>
                        </tr>
                        <tr>
                            <td><span>SPOUSE: </span></td>
                            <td class="detail"><?php echo strtoupper($row['Spouse_Name']); ?></td>
                        </tr>
                    </table>

                    <h3 class="contactDetails">CONTACT DETAILS</h3>
                    <table>

                        <tr>
                            <td><span>ADDRESS: </span></td>
                            <td class="detail"><?php echo strtoupper($row['Member_Address_Line_1'] . " " . $row['Member_Address_Line_2'] . " " . $row['Member_Address_Line_3'] . " " . $row['Member_Address_Line_4']); ?></td>
                        </tr>
                        <tr>
                            <td><span>TEL: </span></td>
                            <td class="detail"><?php $seperator = "";
                                                if (strlen($row['Home_Phone']) > 5 & strlen($row['Cell_Phone']) > 5) {
                                                    $seperator = " | ";
                                                }
                                                echo strtoupper($row['Cell_Phone'] . $seperator . $row['Home_Phone']); ?></td>
                        </tr>
                        <tr>
                            <td><span>EMAIL: </span></td>
                            <td class="detail"><?php echo $row['Email']; ?></td>
                        </tr>

                    </table>
                    <div class="socialLinks">
                        <a class="fb"><i class="fa-brands fa-facebook-f"></i></a>
                        <a class="twitter"><i class="fa-brands fa-twitter"></i></a>
                        <a class="insta"><i class="fa-brands fa-instagram"></i></a>
                        <a class="in"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a class="wtsapp" class=""><i class="fa-brands fa-whatsapp"></i></a>
                        <a class="email"><i class="fa-regular fa-envelope"></i></a>

                    </div>

                </div>
                <?php
                if ($nextNavBtnActiveness == 'inactive') {
                    $nextURL = '';
                } else {
                }
                ?>
                <div class="memberNavigation">
                    <a href="volunteer.php?key=<?php echo $lastMemberId ?>&district=<?php echo $district ?>&region=<?php echo $regionName ?>&zone=<?php echo $zone ?>&prefix=<?php echo $prefix ?>&clubID=<?php echo $clubID ?>"><i class="<?php echo $lastNavBtnActiveness . " " ?>fa-solid fa-left-long"></i></a>
                    <a href="clubPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName ?>&zone=<?php echo $zone ?>&clubID=<?php echo $clubID; ?>&searchKey=<?php echo 'none' ?>"><i class=" backtoDistrict fa-solid fa-house-chimney "></i></a>

                    <a href="volunteer.php?key=<?php echo $nextMemberId ?>&district=<?php echo $district ?>&region=<?php echo $regionName ?>&zone=<?php echo $zone ?>&prefix=<?php echo $prefix ?>&clubID=<?php echo $clubID ?>"><i class="<?php echo $nextNavBtnActiveness . " " ?> fa-solid fa-right-long"></i></a>
                </div>

            </div>




        </div>

<?php
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    // Display an error message if the query failed
    echo 'Error: ' . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>