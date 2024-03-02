<?php
include('connection.php');


$selectedState = isset($_GET['state']) ? $_GET['state'] : '';

$sqlCity = "SELECT distinct(city_name) FROM cities WHERE city_state='$selectedState' ORDER BY city_name";
$resultCity = mysqli_query($con, $sqlCity);

if ($resultCity) {
    $html = '<select name="City" id="City" style="width:250px;" >';
    $html .= '<option value="" disabled selected>Select City</option>';

    while ($row = mysqli_fetch_assoc($resultCity)) {
        $html .= '<option value="' . $row['city_name'] . '">' . $row['city_name'] . '</option>';
    }

    $html .= '</select>';
    echo $html;

    mysqli_free_result($resultCity);
} else {
    echo "Error: " . $sqlCity . "<br>" . mysqli_error($con);
}

mysqli_close($con);
?>
