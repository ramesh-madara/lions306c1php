<link rel="stylesheet" type="text/css" href="style/volunteerIndividual.css">
<?php
include 'inc/header.php';

// Assuming you have a database connection established
// Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials

// Get the value of 'key' from the URL parameter
$key = filter_input(INPUT_GET, 'key', FILTER_SANITIZE_SPECIAL_CHARS);

// Sanitize the input to prevent SQL injection
$sanitized_key = mysqli_real_escape_string($conn, $key);

// Construct the SQL query
$query = "SELECT * FROM club1 WHERE volunteer_code = '$sanitized_key'";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query execution was successful
if ($result) {

    // Display the results
    while ($row = mysqli_fetch_assoc($result)) {
?>

        <div class="memberOuterMost">
            <div class="photoOuter">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['profile_image']); ?>" height="150" class="img-thumnail" />
            </div>
            <div class="detailsOuter">
                <div class="nameMain"><?php echo $row['name']; ?></div>
                <div class="position"><?php echo $row['district_position_1']; ?></div>
                <div class="contents">
                        <table>
                            <tr>
                                <td><span>M/N: </span></td>
                                <td><?php echo $row['m_n']; ?></td>
                            </tr>
                            <tr>
                                <td><span>District: </span></td>
                                <td><?php echo $row['district']; ?></td>
                            </tr>
                            <tr>
                                <td><span>Region: </span></td>
                                <td><?php echo $row['region']; ?></td>
                            </tr>
                            <tr>
                                <td><span>Zone: </span></td>
                                <td><?php echo $row['zone']; ?></td>
                            </tr>
                            <tr>
                                <td><span>Club: </span></td>
                                <td><?php echo $row['club']; ?></td>
                            </tr>
                            <tr>
                                <td><span>Club Position1: </span></td>
                                <td><?php echo $row['club_position_1']; ?></td>
                            </tr>
                            <tr>
                                <td><span>Club Position2: </span></td>
                                <td><?php echo $row['club_position_2']; ?></td>
                            </tr>
                            <tr>
                                <td><span>Club Position3: </span></td>
                                <td><?php echo $row['club_position_3']; ?></td>
                            </tr>
                            <tr>
                                <td><span>District Position: </span></td>
                                <td><?php echo $row['district_position_1']; ?></td>
                            </tr>
                            <tr>
                                <td><span>Name: </span></td>
                                <td><?php echo $row['name']; ?></td>
                            </tr>
                            <tr>
                                <td><span>Address: </span></td>
                                <td><?php echo $row['address']; ?></td>
                            </tr>
                            <tr>
                                <td><span>Designation: </span></td>
                                <td><?php echo $row['designation']; ?></td>
                            </tr>
                            <tr>
                                <td><span>Employer: </span></td>
                                <td><?php echo $row['employer']; ?></td>
                            </tr>
                            <tr>
                                <td><span>Tel: </span></td>
                                <td><?php echo $row['tel']; ?></td>
                            </tr>
                            <tr>
                                <td><span>Email: </span></td>
                                <td><?php echo $row['email']; ?></td>
                            </tr>
                            <tr>
                                <td><span>Spouse: </span></td>
                                <td><?php echo $row['spouse']; ?></td>
                            </tr>
                        </table>

                    </table>
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