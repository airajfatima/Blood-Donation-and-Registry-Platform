<?php
$insert = false;

if (isset($_POST['name'])) {
    include('connection.php');

    $name = $_POST['name'];
    $dob = convertDateFormat($_POST['dob']);
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $selectedState = $_POST["State"];
    $selectedCity = $_POST["City"];
    $bloodGroup = $_POST["bloodgroup"];
    $sql = "INSERT INTO `blood donation project`.`donor`(`name`, `dob`, `gender`, `email`, `phone`,`state`,`city`,`blood_group`) VALUES ('$name','$dob', '$gender', '$email', '$phone','$selectedState','$selectedCity','$bloodGroup');";
    if ($con->query($sql) == true) {
        $insert=true;
    } else {
        echo "ERROR : $sql <br> $con->error";
    }

    $con->close();
}

function getAllStates()
{
    $con = mysqli_connect("localhost", "root", "", "blood donation project");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sqlState = "SELECT distinct(city_state) FROM cities order by city_state";
    $resultState = mysqli_query($con, $sqlState);

    if ($resultState) {
        echo '<select name="State" id="State" style="width:250px;" required>';
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

function convertDateFormat($inputDate) {
    $dateTime = DateTime::createFromFormat('d-m-Y', $inputDate);
    if ($dateTime) {
        $outputDate = $dateTime->format('Y-m-d');
        return $outputDate;
    } else {
        return 'Invalid date format';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/css/pikaday.min.css">
</head>
<body >
    <?php
    if($insert){
        echo "<script type='text/javascript'>alert('Thank you for Registering.');</script>";
    }
    ?>
    <img class="bg" src="images/final5.jpg" alt="final 5" style="height:100%;">
    <div class="container">
        <h1>DONOR REGISTRATION</h1>
        <form action="index1.php" method="post">
            <input type="text" name="name" id="name" placeholder="Enter your name" required>
            <input type="text" name="dob" id="dob" placeholder="DD-MM-YYYY (Enter your date of birth)" required>
            <input type="hidden" name="age" id="age" readonly>
            <div class="radiofield" style="display:flex;align-items:left;flex-direction:row;">
                <p>Gender:</p>
                <input type="radio" id="Male" name="gender" value="Male" required>
                <label for="Male">Male&nbsp;</label>
                <input type="radio" id="Female" name="gender" value="Female" required>
                <label for="Female">Female</label>
            </div>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <input type="text" name="phone" id="phone" placeholder="Enter your phone number" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
            <?php
            echo "<div style='display:flex;align-items:left;flex-direction:row;' ><div style='font-size:18px;margin: 10px 5px;'>Location:</div>";
            getAllStates();
            include('cityDropdown.php');
            echo "</div>";
            ?>

            <div style='display:flex;align-items:left;flex-direction:row;' ><div style='font-size:18px;margin: 10px 5px;'>Blood Group:</div>
                <select name="bloodgroup" id="bloodgrp" style="width:250px;" required>
                    <option value="" disabled selected
                    >Select</option>
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js"></script>
            <script>
            document.addEventListener('DOMContentLoaded', function () {
            var dobInput = document.getElementById('dob');
            var ageInput = document.getElementById('age');
            
            var picker = new Pikaday({
                field: dobInput,
                format: 'DD-MM-YYYY',
                yearRange: [1900, moment().year()],
                onSelect: function () {
                    var selectedDate = moment(this.getDate());
                    var age = moment().diff(selectedDate, 'years');
                    ageInput.value = age;
                    if(age<18 || age>65 ){
                        alert("Age should be in between 18 to 65 to be eligible to donate. Please enter correct DOB.");
                        document.getElementById('dob').value = '';
                        document.getElementById('age').value = '';
                    }
                }
            });
            });
            </script>
            <button class="btn" onClick="">Submit</button>
        </form>
    </div>
</body>
</html>
