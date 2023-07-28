    <?php include 'inc/header.php'; ?>

    <?php
    $last = 0;
    $lasttxt = "";
    $lasttxt2 = "";
    $M_N = $District = $Region = $Zone = $Club = $ClubPosition1 = $ClubPosition2 = $ClubPosition3 = $DistrictPosition = 'j';
    $Name = $Address = $Designation = $Employer = $Tel = $Email = 'j';
    $Spouse = 'j';
    $M_NErr = $DistrictErr = $RegionErr = $ZoneErr = $ClubErr = $ClubPosition1Err = $ClubPosition2Err = $ClubPosition3Err = $DistrictPositionErr = 'j';
    $NameErr = $AddressErr = $DesignationErr = $EmployerErr = $TelErr = $EmailErr = 'j';


    $M_N = $District = $Region = $Zone = $Club = $ClubPosition1 = $ClubPosition2 = $ClubPosition3 = $DistrictPosition = 'j';
    $Name = $Address = $Designation = $Employer = $Tel = $Email = 'j';
    $Spouse = 'j';

    // Initialize variables
    $M_N = $District = $Region = $Zone = $Club = $ClubPosition1 = $ClubPosition2 = $ClubPosition3 = $DistrictPosition = 'j';
    $Name = $Address = $Designation = $Employer = $Tel = $Email = 'j';
    $Spouse = 'j';

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form values and assign them to variables
        $M_N = isset($_POST['m_n']) ? htmlspecialchars($_POST['m_n']) : '';
        $District = isset($_POST['district']) ? htmlspecialchars($_POST['district']) : '';
        $Region = isset($_POST['region']) ? htmlspecialchars($_POST['region']) : '';
        $Zone = isset($_POST['zone']) ? htmlspecialchars($_POST['zone']) : '';
        $Club = isset($_POST['club']) ? htmlspecialchars($_POST['club']) : '';
        $ClubPosition1 = isset($_POST['club_position_1']) ? htmlspecialchars($_POST['club_position_1']) : '';
        $ClubPosition2 = isset($_POST['club_position_2']) ? htmlspecialchars($_POST['club_position_2']) : '';
        $ClubPosition3 = isset($_POST['club_position_3']) ? htmlspecialchars($_POST['club_position_3']) : '';
        $DistrictPosition = isset($_POST['district_position_1']) ? htmlspecialchars($_POST['district_position_1']) : '';
        $Name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
        $Address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
        $Designation = isset($_POST['designation']) ? htmlspecialchars($_POST['designation']) : '';
        $Employer = isset($_POST['employer']) ? htmlspecialchars($_POST['employer']) : '';
        $Tel = isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '';
        $Email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
        $Spouse = isset($_POST['spouse']) ? htmlspecialchars($_POST['spouse']) : '';

        // Insert the values into the database table (assuming you have a database connection established)
        // Replace 'your_table_name' with the actual table name in your database
        $sql = "INSERT INTO club1 (m_n, district, club, region, zone, club_position_1, club_position_2, club_position_3, district_position_1, district_position_2, district_position_3, volunteer_code, name, address, designation, employer, tel, email, spouse) VALUES ('$M_N', '$District', '$Club', '$Region', '$Zone', '$ClubPosition1', '$ClubPosition2', '$ClubPosition3', '$DistrictPosition', '', '', '$M_N', '$Name', '$Address', '$Designation', '$Employer', '$Tel', '$Email', '$Spouse')";

        // Execute the SQL query (assuming you have a database connection object named $db)
        $result = mysqli_query($conn, $sql);

        // Check if the insertion was successful
        if ($result) {
            // Insertion successful
            echo "Data inserted successfully.";
        } else {
            // Insertion failed
            echo "Error inserting data.";
        }
    }
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Anton&family=Montserrat:wght@100&display=swap');

            /* Add your CSS styles here */
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
            }

            .container {
                max-width: 400px;
                margin: 0 auto;
                /* padding: 20px; */
                /* background-color: #fff; */
                /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
                /* display: flex; */
                justify-content: center;
                align-items: center;
            }

            form {
                flex-direction: column;
                padding-bottom: 20px;
            }

            h2 {
                text-align: center;
            }

            label {
                display: block;
                margin-bottom: 10px;
                margin-top: 5px;
            }

            input[type="text"] {
                width: 100%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            button[type="submit"] {
                width: 100%;
                padding: 10px;
                background-color: #4CAF50;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-top: 20px;
                /* display: block; */
            }

            button[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h2>New Volunteer</h2>
            <form method="POST" action="<?php echo htmlspecialchars(
                                            $_SERVER['PHP_SELF']
                                        ); ?>" class="mt-4 w-75">
                <label for="m_n">M/N:</label>
                <input type="text" id="m_n" name="m_n" required>

                <label for="district">District:</label>
                <input type="text" id="district" name="district" required>

                <label for="region">Region:</label>
                <input type="text" id="region" name="region" required>

                <label for="zone">Zone:</label>
                <input type="text" id="zone" name="zone" required>

                <label for="club">Club:</label>
                <input type="text" id="club" name="club" required>

                <label for="club_position_1">Club Position 1:</label>
                <input type="text" id="club_position_1" name="club_position_1" required>

                <label for="club_position_2">Club Position 2:</label>
                <input type="text" id="club_position_2" name="club_position_2" required>

                <label for="club_position_3">Club Position 3:</label>
                <input type="text" id="club_position_3" name="club_position_3" required>

                <label for="district_position_1">District Position:</label>
                <input type="text" id="district_position_1" name="district_position_1" required>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>

                <label for="designation">Designation:</label>
                <input type="text" id="designation" name="designation" required>

                <label for="employer">Employer:</label>
                <input type="text" id="employer" name="employer" required>

                <label for="tel">Tel:</label>
                <input type="text" id="tel" name="tel" required>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>

                <label for="spouse">Spouse:</label>
                <input type="text" id="spouse" name="spouse" required>

                <input type="submit" name="submit" value="Submit" class="btn btn-danger w-100">
            </form>
        </div>
    </body>

    </html>