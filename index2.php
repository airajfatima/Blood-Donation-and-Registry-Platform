<?php
$reload=true;
include('connection.php');

$query = "SELECT name, email, phone, state, city, blood_group FROM donor";
$filterConditions = array();

$state = isset($_POST['State']) ? $_POST['State'] : '';
$city = isset($_POST['City']) ? $_POST['City'] : '';
$bloodGroup = isset($_POST['bloodgroup']) ?$_POST['bloodgroup'] : '';

if ($state != '') {
    $filterConditions[] = "state = '$state'";
}
if ($city != '') {
    $filterConditions[] = "city = '$city'";
}
if ($bloodGroup != '') {
    $filterConditions[] = "blood_group = '$bloodGroup'";
}

if (!empty($filterConditions)) {
    $query .= " WHERE " . implode(" AND ", $filterConditions);
}

$result = mysqli_query($con, $query);





function getAllStates()
{
    $con = mysqli_connect("localhost", "root", "", "blood donation project");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sqlState = "SELECT DISTINCT(city_state) FROM cities ORDER BY city_state";
    $resultState = mysqli_query($con, $sqlState);

    if ($resultState) {
        echo '<select name="State" id="State" style="width:250px;" >';
        echo '<option value="" disabled selected>Select State</option>';
        while ($row = mysqli_fetch_assoc($resultState)) {
            echo '<option value="' . $row['city_state'] . '">' . $row['city_state'] . '</option>';
        }
        echo '</select>';

        mysqli_free_result($resultState);
    } else {
        echo "Error: " . $sqlState . "<br>" . mysqli_error($con);
    }
    $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search for a Donor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark" >
    <img class="bg" src="images/final6.jpg" alt="final 6">
    <div class="container">
        <h1>SEARCH FOR A DONOR</h1>

        <form action="index2.php" method="post">
            <div style='display:flex;align-items:left;flex-direction:row;'>
                <div style='font-size:18px;margin: 10px 5px;'>Location:</div>
                <?php
                getAllStates();
                include('cityDropdown.php');
                ?>
            </div>
            <div style='display:flex;align-items:left;flex-direction:row;'>
                <div style='font-size:18px;margin: 10px 5px;'>Blood Group:</div>
                <select name="bloodgroup" id="bloodgrp" style="width:250px;" >
                    <option value="" disabled selected>Select</option>
                    <option value="A+">A+</option>
                    <option value="B+">B+</option>
                    <option value="AB+">AB+</option>
                    <option value="O+">O+</option>
                    <option value="A-">A-</option>
                    <option value="B-">B-</option>
                    <option value="AB-">AB-</option>
                    <option value="O-">O-</option>
                </select>
            </div>
            <script src="index.js"></script>
            <button class="btn" id= "filter">Filter</button>
        </form>
        <div id="resultContainer" class="card mt-5">
            <table id="resultTable" class="table table-bordered">
                <tr style="background-color:#d1335a;">
                    <td> Name </td>
                    <td> Email </td>
                    <td> Phone </td>
                    <td> State </td>
                    <td> City </td>
                    <td> Blood Group</td>
                </tr>

                <?php
                $empty=true;
                while ($row = mysqli_fetch_assoc($result)) {
                    $empty=false;
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['phone'] . '</td>';
                    echo '<td>' . $row['state'] . '</td>';
                    echo '<td>' . $row['city'] . '</td>';
                    echo '<td>' . $row['blood_group'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
            <table id="resultTable" class="table table-bordered">
                <?php
                if($empty){
                    // echo "<script type='text/javascript'>alert('No result found for the given filter.');</script>";
                    
                    echo '<td style="text-align:center;">' . 'No result found for the given filter.' . '</td>';
                }
                ?>
            </table>
            
        </div>
    </div>
</body>
</html>
