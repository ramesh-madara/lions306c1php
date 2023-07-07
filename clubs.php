<?php include 'inc/header.php'; ?>
<link rel="stylesheet" type="text/css" href="style/clubs.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/solid.min.js" integrity="sha512-apZ8JDL5kA1iqvafDdTymV4FWUlJd8022mh46oEMMd/LokNx9uVAzhHk5gRll+JBE6h0alB2Upd3m+ZDAofbaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- //Delete -->
<?php
$district = "District 306 C1";
$region = '';
$zone = "Select Zone";
$max = '6';
// $Zone = "";
?>
<!--SEARCHED or NOT BITFLIP-->
<?php
$searchKey = '';
$searched = false;
$fetch = "SELECT DISTINCT  Region_Name from clubs WHERE District_Name = '$district' ORDER BY Region_Name ASC";
$result = mysqli_query($conn, $fetch);
$volunteers = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php if (empty($volunteers)) : ?>
  <!-- <p class="lead mt-3">There is no Volunteers</p> -->
<?php endif; ?>

<div style="display: flex;">
</div>



<body>

  <div class="banner">
    <p>OUR VOLUNTEERS</p>
    <img src="img/volunteersBanner.jpg" alt="">
  </div>

  <div class="clubDetails">
    <p class="clubNameUpper">BROWSE THROUGH</p>
    <div class="details">
      <div class="upperSec">
        <div class="sec1">
          <span>Region: <span class="content">6A</span></span><br>
          <span>Zone: <span class="content">3</span></span>
        </div>
        <div class="sec2">
          <span>Reg. No.: <span class="content">123456</span></span><br>
          <span>Chartered On: <span class="content">20-06-2022</span></span>
        </div>
      </div>
      <div class="lowerSec">
        <p>Extended by: <span class="content">Lions Club of Kiribathkumbura</span></p><br>
        <p>Extension Chairman: <span class="content">Lion Luxman Ullandupitiya</span></p><br>
        <p>Guiding Lion: <span class="content">Lion Luxman Ullandupitiya</span></p><br>
        <p>DG then in Office: <span class="content">DG Lion Amal Pussallage</span></p>
      </div>
      <div></div>
    </div>

  </div>
  <nav class="navbar navbar-light ">
    <form method="POST" action="<?php echo htmlspecialchars(
                                  $_SERVER['PHP_SELF']
                                ); ?>" class="mt-4 w-155" style="display: flex;">
      <input name="search" class="form-control" type="search" placeholder="Search" aria-label="Search">
      <!-- <button class="btn btn-outline-success " name="submit" type="submit">Search</button> -->
      <input type="submit" name="submit" value="Search" class="btn btn-dark w-35">
      <input type="submit" name="showall" value="Show all" class="btn btn-secondary w-25 text-center">
    </form>
  </nav>

  <?php
  if (isset($_POST['region'])) {
    echo $region;

    $region = $_POST['region'];
    echo $region;

    // Use the $region variable in your PHP script as needed
    echo $region;
  } else {
    echo "No region value received.";
  }
  ?>

  <script>
    function update(str) {
      updateZones(str);
      setRegion(str);

    }

    function setRegion(region) {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "clubs.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Request completed successfully
          console.log("<?php echo $region; ?>");
          console.log(xhr.responseText);
        }
      };
      xhr.send("region=" + encodeURIComponent(region));
      var regionValue = "<?php echo $region; ?>";
      console.log(regionValue);
    }

    function updateZones(str) {


      // console.log(str);
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
        // console.log(xmlhttp);
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        // console.log(xmlhttp);

      }
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // console.log(this.resposeText);
          document.getElementById("zone").innerHTML = this.responseText;
        }
      }
      xmlhttp.open("GET", "helper.php?value=" + str, true);
      xmlhttp.send();
      // console.log("<?php echo $region; ?>");
    };

    function updateClubs(zone) {
      var region = document.getElementById("SelectA").value;
      console.log(region);
      console.log(zone);

      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }

      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("clubs").innerHTML = this.responseText;
        }
      }

      var url = "helper.php?region=" + (region) + "&zone=" + (zone);
      console.log(url);
      xmlhttp.open("GET", "helper.php?region=" + (region) + "&zone=" + (zone), true);
      xmlhttp.send();
    };
  </script>



  <div>
    <style>
      .hierarchy {
        /* background-color: grey; */
        width: 70vw;
        /* display: flex; */
      }

      .reg {
        display: flex;
        /* justify-content: center; */
        /* background-color: blue; */
        gap: 35px;
        flex-wrap: wrap;
      }

      .ded {
        /* background-color: wheat; */
        width: 250px;

      }

      tr {
        display: flex;
        /* align-items: flex-start; */
      }

      .clubCount p {
        font-weight: bold;
      }

      a {
        text-decoration: none;
        color: black;
      }
    </style>
    <div class="hierarchy">
      <div class="volunteersOuter">
        <div id="select-container">
          <form action="POST">
            <select id="SelectA" onchange="update(this.value)">
              <option disabled selected value="">Select an option</option>
              <?php foreach ($volunteers as $item) : ?>
                <option value="<?php echo $item['Region_Name']; ?>"><?php echo $item['Region_Name']; ?></option>
              <?php endforeach; ?>
            </select>
            <select id="zone" onchange="updateClubs(this.value)">
              <option disabled selected value="">Select a Zone</option>
            </select>
            <select id="clubs">
              <option disabled selected value="">Select a Club</option>
            </select>
          </form>
        </div>
      </div>

      <?php foreach ($volunteers as $item) : ?>


        <div>
          <h1><a href="regionPage.php?region=<?php echo $item['Region_Name']; ?>&district=<?php echo $district ?>"><?php echo $item['Region_Name']; ?></a></h1>
        </div>
        <?php
        $regionName = $item['Region_Name'];
        $fetch2 = "SELECT DISTINCT Zone_Name FROM clubs WHERE District_Name = '$district' AND Region_Name = '$regionName' ORDER BY CAST(SUBSTRING(Zone_Name, 6) AS UNSIGNED) ASC ";
        $result2 = mysqli_query($conn, $fetch2);
        $volunteers2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
        ?>
        <div class="reg">
          <?php foreach ($volunteers2 as $item2) : ?>
            <div class="ded">
              <h4><a href="zonePage.php?district=<?php echo $district  ?>&region=<?php echo $item['Region_Name']; ?>&zone=<?php echo $item2['Zone_Name']; ?>"><?php echo $item2['Zone_Name']; ?></a></h4>
              <?php
              $zoneName = $item2['Zone_Name'];
              $fetch3 = "SELECT DISTINCT Club_Name, Club_ID FROM clubs WHERE District_Name = '$district' AND Region_Name = '$regionName' AND Zone_Name = '$zoneName' ORDER BY Club_Name ASC";
              $result3 = mysqli_query($conn, $fetch3);
              $clubs = mysqli_fetch_all($result3, MYSQLI_ASSOC);
              ?>
              <?php for ($i = 0; $i < count($clubs); $i++) {
              ?>
                <table>
                  <tr>
                    <td>
                      <div class="clubCount">
                        <p><?php $count = $i + 1;
                            echo $count . "."; ?></p>
                      </div>
                    </td>
                    <td>
                      <div>
                        <p><a href="clubPage.php?district=<?php echo $district  ?>&region=<?php echo $item['Region_Name']; ?>&zone=<?php echo $item2['Zone_Name']; ?>&clubID=<?php echo $clubs[$i]['Club_ID']; ?>"><?php echo $clubs[$i]['Club_Name']; ?></a></p>
                      </div>

                    </td>
                  </tr>
                </table>
              <?php } ?>
            </div>
          <?php endforeach; ?>
        </div>



      <?php endforeach; ?>
    </div>

  </div>
</body>
<?php
include 'inc/footer.php'; ?>