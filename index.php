<?php include 'inc/header.php'; ?>
<link rel="stylesheet" type="text/css" href="style/clubs2.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/solid.min.js" integrity="sha512-apZ8JDL5kA1iqvafDdTymV4FWUlJd8022mh46oEMMd/LokNx9uVAzhHk5gRll+JBE6h0alB2Upd3m+ZDAofbaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- //Delete -->

<?php
//global
$volunteers;
$searched = false;
$district = "District 306 C1";
$region = "x";
$zone = "x";
$max = '6';
$fetch = "SELECT DISTINCT  Region_Name from clubs WHERE District_Name = '$district' ORDER BY Region_Name ASC";
$result = mysqli_query($conn, $fetch);
$volunteersDefault = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<?php


function printt($reg, $zon)
{

  global $searched, $district, $zone;
  global $region;
  global $conn;
  global $volunteers;
  $region = $reg;
  $zone = $zon;
  $searchKey = '';
  if ($searched == false | ($reg == "none" & $zon == "none")) {

    $fetch = "SELECT DISTINCT  Region_Name from clubs WHERE District_Name = '$district' ORDER BY Region_Name ASC";
  } else {
    if ($reg != "none") {
      $fetch = "SELECT DISTINCT  Region_Name from clubs WHERE District_Name = '$district' AND Region_Name = '$reg' AND Zone_Name = '$zon' ORDER BY Region_Name ASC";
    }
    // $zon = "Zone: 1";
    $fetch = "SELECT DISTINCT  Region_Name from clubs WHERE District_Name = '$district' AND Region_Name = '$reg'  ORDER BY Region_Name ASC";
    // } else {
    // $fetch = "SELECT DISTINCT  Region_Name from clubs WHERE District_Name = '$district' AND Region_Name = '$reg' and Zone_Name = '$zon' ORDER BY Region_Name ASC";
    // echo $zon;
    // }
  }
  $result = mysqli_query($conn, $fetch);
  $volunteers = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
printt("none", "none");

// $Zone = "";
?>
<!--GO TO TOP-->
<script>
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {
    showGoToTopButton();
  };

  function showGoToTopButton() {
    var goToTopBtn = document.getElementById("goToTopBtn");

    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      goToTopBtn.style.display = "block";
    } else {
      goToTopBtn.style.display = "none";
    }
  }

  // Function to scroll back to the top of the page when the button is clicked
  function goToTop() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
  }
</script>

<style>
  /* Styling for the "Go to Top" button */
  #goToTopBtn {
    display: none;
    /* Hide the button by default */
    position: fixed;
    bottom: 40px;
    right: 40px;
    z-index: 99;
    font-size: 18px;
    border: none;
    outline: none;
    border-radius: 35px;
    background-color: white;
    width: 45px;
    /* Customize the button's background color */
    color: #fff;
    /* Customize the button's text color */
    cursor: pointer;
    padding: 10px 10px 10px 10px;
    /* border-radius: 4px; */
    transition: 0.2s;
    box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.545);
  }

  #goToTopBtn i {
    color: #45AC89;
  }

  #goToTopBtn:hover {
    transition: 0.2s;
    box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.545);
    bottom: 42px;
  }

  #goToTopBtn:active {
    transition: 0.05s;
    box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.545);

    bottom: 40px;
  }
</style>

<button id="goToTopBtn" onclick="goToTop()"><i class="fa-solid fa-arrow-up"></i></button>
<?php


?>

<?php if (empty($volunteers)) : ?>
  <!-- <p class="lead mt-3">There is no Volunteers</p> -->
<?php endif; ?>

<div style="display: flex;">
</div>

<body>

  <div class="banner">
    <p>OUR DISTRICT</p>
    <img src="img/volunteersBanner.jpg" alt="">
  </div>

  <div class="clubDetails">
    <p class="clubNameUpper"><?php echo strtoupper("LIONS INTERNATIONAL " . $district)  ?></p>
    <div class="details">
      <div class="upperSec">

        <div></div>
      </div>

    </div>
    <nav class="navbar navbar-light ">
      <form method="POST" action="<?php echo htmlspecialchars(
                                    $_SERVER['PHP_SELF']
                                  ); ?>" class="mt-4 w-155" style="display: flex;">
        <input name="search" class="form-control" type="search" placeholder="Search" aria-label="Search">
        <!-- <button class="btn btn-outline-success " name="submit" type="submit">Search</button> -->
        <input type="submit" name="submit" value="SEARCH" class="search">
        <input type="submit" name="showall" value="SHOW ALL" class="showall">
      </form>
    </nav>



    <script>
      function update(str) {
        updateZones(str);
        setRegion(str);

      }

      // function setRegion(region) {
      //   var xhr = new XMLHttpRequest();
      //   xhr.open("POST", "clubs.php", true);
      //   xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      //   xhr.onreadystatechange = function() {
      //     if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      //       // Request completed successfully
      //       console.log("<?php echo $region; ?>");
      //       console.log(xhr.responseText);
      //     }
      //   };
      //   xhr.send("region=" + encodeURIComponent(region));
      //   var regionValue = "<?php echo $region; ?>";
      //   console.log(regionValue);
      // }

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
        .navbar form {
          display: flex;
          gap: 5px;
        }

        .search,
        .showall {
          width: 150px;
          height: 40px;
          background-color: black;
          color: white;
          border: 1px solid white;
        }

        .showall {
          background-color: grey;

        }

        .regionDisplay {
          font-family: "Anton", sans-serif;
          font-size: 2.6rem;

        }

        .zoneDisplay {
          font-family: "Anton", sans-serif;
          font-size: 2.0rem;
        }

        .clubDisplay {
          font-weight: 600;
        }

        .hierarchy {
          width: 80vw;
        }

        .volunteersOuter {
          margin: 10px 0px 10px 0px;
        }

        .reg {
          display: flex;
          gap: 25px;
          flex-wrap: wrap;
        }


        .ded {
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

        .contentOuter {
          /* background-color: #45AC89; */
          margin-top: 20px;
        }

        .regionDisplay:hover,
        .zoneDisplay:hover,
        .clubDisplay:hover {
          text-decoration: underline !important;
          color: #45AC89;
        }

        @media (max-width: 657px) {}
      </style>
      <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['selectedRegion'] == "none") {
          $selectedRegion = "none";
        } else {
          $selectedRegion = $_POST['selectedRegion'];
        }
        if ($_POST['selectedZone'] == "none") {
          $selectedZone = "none";
        } else {
          $selectedZone = $_POST['selectedZone'];
        }
        $searched = true;

        printt($selectedRegion, $selectedZone);
      }
      ?>

      <div class="hierarchy">
        <div class="volunteersOuter">
          <div id="select-container">
            <form method="POST">
              <select class="regSelect select" name="selectedRegion" id="SelectA" onchange="update(this.value)">
                <option selected value="none">SELECT A REGION</option>
                <?php foreach ($volunteersDefault as $item) : ?>
                  <option value="<?php echo $item['Region_Name'];  ?>"><?php echo strtoupper($item['Region_Name']);  ?></option>
                <?php endforeach; ?>
              </select>
              <!--Options for zone and clubs select menus are displayed by retrieving from the helper.php via update() and updatreClubs() function -->
              <select class="zonSelect select" name="selectedZone" id="zone" onchange="updateClubs(this.value)">
                <option selected value="none">SELECT A ZONE</option>
              </select>
              <!-- <select class="clubSelect select" id="clubs">
                <option disabled selected value="">Select a Club</option>
              </select> -->
              <input class="selectSubmitBtn" type="submit" value="APPLY FILTERS">
            </form>
          </div>
        </div>
      </div>

      <?php foreach ($volunteers as $item) : ?>
        <div class="contentOuter">


          <div>
            <h1><a class="regionDisplay" href="regionPage.php?region=<?php echo $item['Region_Name']; ?>&district=<?php echo $district ?>"><?php echo strtoupper($item['Region_Name']); ?></a></h1>
          </div>
          <?php
          if ($region != "none") {
            $regionName = $region;
          } else {
            $regionName = $item['Region_Name'];
          }
          if ($zone != "none") {
            $zoneName = $zone;
            $fetch2 = "SELECT DISTINCT Zone_Name FROM clubs WHERE District_Name = '$district' AND Region_Name = '$regionName' AND Zone_Name = '$zone' ORDER BY CAST(SUBSTRING(Zone_Name, 6) AS UNSIGNED) ASC ";
          } else {
            $fetch2 = "SELECT DISTINCT Zone_Name FROM clubs WHERE District_Name = '$district' AND Region_Name = '$regionName' ORDER BY CAST(SUBSTRING(Zone_Name, 6) AS UNSIGNED) ASC ";
          }
          // $regionName = $item['Region_Name'];
          $result2 = mysqli_query($conn, $fetch2);
          $volunteers2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
          ?>
          <div class="reg">
            <?php foreach ($volunteers2 as $item2) : ?>
              <div class="ded">
                <!-- <span><?php echo $region; ?></span> -->
                <h4><a class="zoneDisplay" href="zonePage.php?district=<?php echo $district  ?>&region=<?php echo $item['Region_Name']; ?>&zone=<?php echo $item2['Zone_Name']; ?>"><?php echo strtoupper($item2['Zone_Name']); ?></a></h4>
                <?php
                if ($zone != "none") {
                  $zoneName2 = $zone;
                } else {
                  $zoneName2 = $item2['Zone_Name'];
                }
                $zoneName2 = $item2['Zone_Name'];
                $fetch3 = "SELECT DISTINCT Club_Name, Club_ID FROM clubs WHERE District_Name = '$district' AND Region_Name = '$regionName' AND Zone_Name = '$zoneName2' ORDER BY Club_Name ASC";
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
                          <!-- <span><?php echo $zone; ?></span> -->
                          <p><a class="clubDisplay" href="clubPage.php?district=<?php echo $district  ?>&region=<?php echo $item['Region_Name']; ?>&zone=<?php echo $item2['Zone_Name']; ?>&clubID=<?php echo $clubs[$i]['Club_ID']; ?>&searchKey=<?php echo 'none' ?>"><?php echo strtoupper($clubs[$i]['Club_Name']); ?></a></p>
                        </div>

                      </td>
                    </tr>
                  </table>
                <?php } ?>
              </div>
            <?php endforeach; ?>
          </div>


        </div>

      <?php endforeach; ?>

</body>
<?php
include 'inc/footer.php'; ?>