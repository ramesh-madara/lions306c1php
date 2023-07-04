<?php include 'inc/header.php'; ?>
<?php
$region = $_GET["value"];
$val_M = mysqli_real_escape_string($conn, $region);
$sql = "SELECT DISTINCT  Zone_Name from clubs WHERE Region_Name = '$val_M' ORDER BY Zone_Name ASC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // echo "<select>";
    while ($rows = mysqli_fetch_assoc($result)) {
        echo "<option>" . $rows["Zone_Name"]  . "</option>";
    }
    // echo "</select>";
}
?>