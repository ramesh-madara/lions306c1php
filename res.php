 <?php
    $titles = explode("-", $item['Title']);
    foreach ($titles as $title) {
        foreach ($titleArr as $titleArrItem) {
            if (isSimilarIgnoringCaseAndSpace($titleArrItem, $title)) {

                echo '<div class="outer">';
                echo '<div class="imgOuter">';
                echo '<img src="https://img.freepik.com/premium-photo/young-handsome-man-with-beard-isolated-keeping-arms-crossed-frontal-position_1368-132662.jpg" height="150" class="img-thumnail" />';
                echo '</div>';
                echo '<div class="VolunteerDetailsOuter">';
                echo '<div class="main">';
                if (
                    $item['Title'] == ""
                ) {
                    $title = "Club Member";
                } else {
                    $titleArr = explode("-", $item['Title']);
                    if (count($titleArr) > 1) {
                        $title = $titleArr[0] . ", " . $titleArr[1];
                    } else {
                        $title = $titleArr[0];
                    }
                }
                echo '<p class="position">' . $title . '</p>';
                echo '<p class="name">LION ';
                $firstNameArr = explode(" ", $item['First_Name']);
                if (count($firstNameArr) > 1) {
                    for ($i = 0; $i < count($firstNameArr); $i++) {
                        $subStr = strtoupper($firstNameArr[$i]);
                        if (strlen($subStr) != 0) {
                            echo $subStr[0] . ". ";
                        }
                    }
                } else {
                    echo strtoupper($item['First_Name']) . " ";
                }
                echo strtoupper($item['Last_Name']);
                echo '</p>';
                echo '</div>';
                echo '<div class="socialLinks">';
                echo '<a class="fb"><i class="fa-brands fa-facebook-f"></i></a>';
                echo '<a class="twitter"><i class="fa-brands fa-twitter"></i></a>';
                echo '<a class="insta"><i class="fa-brands fa-instagram"></i></a>';
                echo '<a class="in"><i class="fa-brands fa-linkedin-in"></i></a>';
                echo '<a class="wtsapp" class=""><i class="fa-brands fa-whatsapp"></i></a>';
                echo '<a class="email"><i class="fa-regular fa-envelope"></i></a>';
                echo '<a href="" class="more"><i class="fa-solid fa-plus"></i></a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
    }
    ?>


<?php
foreach ($volunteers as $item) {
    echo '<div class="volunteer">';
    echo '<div class="outer">';
    echo '<div class="imgOuter">';
    echo '<img src="https://img.freepik.com/premium-photo/young-handsome-man-with-beard-isolated-keeping-arms-crossed-frontal-position_1368-132662.jpg" height="150" class="img-thumnail" />';
    echo '</div>';
    echo '<div class="VolunteerDetailsOuter">';
    echo '<div class="main">';
    if ($item['Title'] == "") {
        $title = "Club Member";
    } else {
        $titleArr = explode("-", $item['Title']);
        if (count($titleArr) > 1) {
            $title = $titleArr[0] . ", " . $titleArr[1];
        } else {
            $title = $titleArr[0];
        }
    }
    echo '<p class="position">' . $title . '</p>';
    echo '<p class="name">LION ';
    $firstNameArr = explode(" ", $item['First_Name']);
    if (count($firstNameArr) > 1) {
        for ($i = 0; $i < count($firstNameArr); $i++) {
            $subStr = strtoupper($firstNameArr[$i]);
            if (strlen($subStr) != 0) {
                echo $subStr[0] . ". ";
            }
        }
    } else {
        echo strtoupper($item['First_Name']) . " ";
    }
    echo strtoupper($item['Last_Name']);
    echo '</p>';
    echo '</div>';
    echo '<div class="socialLinks">';
    echo '<a class="fb"><i class="fa-brands fa-facebook-f"></i></a>';
    echo '<a class="twitter"><i class="fa-brands fa-twitter"></i></a>';
    echo '<a class="insta"><i class="fa-brands fa-instagram"></i></a>';
    echo '<a class="in"><i class="fa-brands fa-linkedin-in"></i></a>';
    echo '<a class="wtsapp" class=""><i class="fa-brands fa-whatsapp"></i></a>';
    echo '<a class="email"><i class="fa-regular fa-envelope"></i></a>';
    echo '<a href="" class="more"><i class="fa-solid fa-plus"></i></a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>
