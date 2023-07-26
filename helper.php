<?php include 'inc/header.php'; ?>
<?php
if (isset($_GET["value"])) {
    $region = $_GET["value"];
    $val_M = mysqli_real_escape_string($conn, $region);
    $sql = "SELECT DISTINCT  Zone_Name from clubs WHERE Region_Name = '$val_M' ORDER BY Zone_Name ASC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<option   selected value='none' >" . "SELECT A ZONE"  . "</option>";

        while ($rows = mysqli_fetch_assoc($result)) {
            echo "<option>" .  strtoupper($rows["Zone_Name"])  . "</option>";
        }
        // echo "</select>";
    }
}



if (isset($_GET["region"]) && isset($_GET["zone"])) {
    $region = $_GET["region"];
    $zone = $_GET["zone"];
    $val_region = mysqli_real_escape_string($conn, $region);
    $val_zone = mysqli_real_escape_string($conn, $zone);
    $sql = "SELECT DISTINCT  Club_Name from clubs WHERE Region_Name = '$val_region' AND Zone_Name = '$val_zone' ORDER BY Club_Name ASC";
    $result = mysqli_query($conn, $sql);
    echo $region . $zone;
    // <option disabled selected value="">Select an option</option>

    if (mysqli_num_rows($result) > 0) {
        echo "<option  disabled selected >" . "SELECT A CLUB"  . "</option>";

        while ($rows = mysqli_fetch_assoc($result)) {
            echo "<option>" . strtoupper($rows["Club_Name"])   . "</option>";
        }
        // echo "</select>";
    }
}



?>


<?php

// echo '<div class="volunteersOuter">';
//     echo '<!-- <tbody> -->';
//     foreach ($volunteers as $item) :
//     echo '<div class="volunteer">';
//         echo '<div class="outer">';
//             echo '<div class="imgOuter">';
//                 echo '<img src="data:image/jpeg;base64,' . base64_encode($item['profile_image']) . '" height="150" class="img-thumnail" />';
//                 echo '</div>';
//             echo '<div class="VolunteerDetailsOuter">';
//                 echo '<div class="main">';
//                     echo '<p class="position">' . $item['district_position_1'] . '</p>';
//                     echo '<p class="name">Lion ' . $item['name'] . '</p>';
//                     echo '</div>';
//                 echo '<div class="socialLinks">';
//                     echo '<a class="fb"><i class="fa-brands fa-facebook-f"></i></a>';
//                     echo '<a class="twitter"><i class="fa-brands fa-twitter"></i></a>';
//                     echo '<a class="insta"><i class="fa-brands fa-instagram"></i></a>';
//                     echo '<a class="in"><i class="fa-brands fa-linkedin-in"></i></a>';
//                     echo '<a class="wtsapp" class=""><i class="fa-brands fa-whatsapp"></i></a>';
//                     echo '<a class="email"><i class="fa-regular fa-envelope"></i></a>';
//                     echo '<a href="volunteer.php?key=' . $item['volunteer_code'] . '" class="more"><i class="fa-solid fa-plus"></i></a>';
//                     echo '</div>';
//                 echo '</div>';
//             echo '</div>';
//         echo '</div>';
//     endforeach;
//     echo '</div>';
?>