<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood donation</title>
</head>
<style>
    *{
    margin: 0px;
    padding: 0px;
    }
    .button{
    width: 414px;
    height: 77px;
    background-color: #f77273;
    opacity: 0.8;
    border:2px solid black;
    border-radius: 14px;
    color: black;
    text-align: center;
    margin: 10px;
    padding: 20px;
    font-size: 30px;
    outline: none;
    cursor:pointer;
    transform: translate(300px, 180px);
    }
    .bg{
    width: 100%;
    height: 100%;
    z-index: -1;
    position: absolute;
    }
    .btn{
    display: flex;
    align-items: center;
    justify-items: center;
    flex-direction: column;
    }
</style>
<body>
    <img class="bg" src="images/final3.jpg" alt="Blood Donation">
    <div class="btn">
        <button class="button" onClick="window.location.href='index1.php';">DONATE BLOOD</button>
        <button class="button" onClick="window.location.href='index2.php';">SEARCH FOR A DONOR</button>
</div>
</body>
</html>