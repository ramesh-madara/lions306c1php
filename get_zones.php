<?php include 'inc/header.php'; ?>

<?php
echo "hi";
// Retrieve the selected region from the AJAX request
$selected_region = $_POST['region'];
$selected_district = $_POST['district'];

// Fetch the zone options based on the selected region
$fetch2 = "SELECT DISTINCT  Zone_Name from clubs WHERE District_Name = '$selected_district' and Region_Name = '$selected_region' ORDER BY Zone_Name ASC";
$result2 = mysqli_query($conn, $fetch2);
$volunteers2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

// Generate the HTML for the zone select options
$options = '';
foreach ($volunteers2 as $item2) {
    $options .= '<option value="' . $item2['Zone_Name'] . '">' . $item2['Zone_Name'] . '</option>';
}

// Return the generated HTML as the response
echo $options;
?>