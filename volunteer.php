<link rel="stylesheet" type="text/css" href="style/volunteerIndividual.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php
include 'inc/header.php';


$regionName = trim(filter_input(INPUT_GET, 'region', FILTER_SANITIZE_SPECIAL_CHARS));
$district = trim(filter_input(INPUT_GET, 'district', FILTER_SANITIZE_SPECIAL_CHARS));
$zone = trim(filter_input(INPUT_GET, 'zone', FILTER_SANITIZE_SPECIAL_CHARS));
$clubID = trim(filter_input(INPUT_GET, 'clubID', FILTER_SANITIZE_SPECIAL_CHARS));
// echo $regionName . $zone . $clubID . $district;

// Assuming you have a database connection established
// Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials

// Get the value of 'key' from the URL parameter
$key = filter_input(INPUT_GET, 'key', FILTER_SANITIZE_SPECIAL_CHARS);

// Sanitize the input to prevent SQL injection
$sanitized_key = mysqli_real_escape_string($conn, $key);

// Construct the SQL query
$query = "SELECT * FROM c_1_members_new WHERE Member_ID = '$sanitized_key'";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query execution was successful
if ($result) {

    // Display the results
    while ($row = mysqli_fetch_assoc($result)) {
?>
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
        ?>
        <div class="memberOuterMost">
            <div class="photoOuter">
                <img src="https://img.freepik.com/premium-photo/young-handsome-man-with-beard-isolated-keeping-arms-crossed-frontal-position_1368-132662.jpg" height="150" class="img-thumnail" />
            </div>
            <div class="detailsOuter">
                <div class="breadCrumbs">
                    <a href="clubPage.php?district=<?php echo $district  ?>&region=<?php echo $regionName ?>&zone=<?php echo $zone ?>&clubID=<?php echo $clubID; ?>&searchKey=<?php echo 'none' ?>"><?php echo  "<i class='fa-solid fa-arrow-left'></i>" . " Go Back"  ?></a>
                    <!-- <a href="index.php">></a> -->
                    <!-- <a href="">Club Page</a> -->
                </div>
                <div class="nameMain"><?php echo strtoupper("LION " . $row['First_Name'] . " " . $row['Last_Name']); ?></div>
                <!-- <div class="position"><?php echo $row['district_position_1']; ?></div> -->
                <div class="contents">
                    <table>
                        <tr>
                            <td><span>M/N: </span></td>
                            <td class="detail"><?php echo strtoupper($row['Member_ID']); ?></td>
                        </tr>
                        <tr>
                            <td><span>DISTRICT: </span></td>
                            <td class="detail"><?php echo strtoupper($row['District_Name']); ?></td>
                        </tr>
                        <tr>
                            <td><span>REGION: </span></td>
                            <td class="detail"><?php echo strtoupper($row['Region_Name']); ?></td>
                        </tr>
                        <tr>
                            <td><span>ZONE: </span></td>
                            <td class="detail"><?php echo strtoupper($row['Zone_Name']); ?></td>
                        </tr>
                        <tr>
                            <td><span>UPPER: </span></td>
                            <td class="detail"><?php echo strtoupper($row['Club_Name']); ?></td>
                        </tr>
                        <?php
                        for ($i = 0; $i < count($titleList); $i++) {
                            echo '<tr>';
                            echo '<td><span>POSITION ' . $i + 1 . ": " .  ' </span></td>';
                            echo '<td class="detail">' .  strtoupper($titleList[$i]) . '</td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr>
                            <td><span>UPPER: </span></td>
                            <td class="detail"><?php echo strtoupper($row['Spouse_Name']); ?></td>
                        </tr>
                        <tr>
                            <td><span>NAME: </span></td>
                            <td class="detail"><?php echo strtoupper($row['First_Name'] . " " . $row['Last_Name']); ?></td>
                        </tr>

                        <tr>
                            <td><span>DESIGNATION: </span></td>
                            <td class="detail"><?php echo strtoupper($row['Occupation']); ?></td>
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