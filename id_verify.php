<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Id Verify</title>
    <style>
        .body {
            display: flex;
            justify-content: center;
            height: 100vh; /* Make sure the body takes the full height of the viewport */
        }
        .front{
            margin-top: 100px;
            width: 400px;
            background-image: url("images/id/FA-Id-card.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 635px;
        }
        .profile-image{
            height: 150px;
            width: 150px;
            border: 4px solid black;
            border-radius: 50%;
            margin-top: 42%;
            margin-left: 29%;
            overflow: hidden;
        }
        .profile-image img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
        .student-info{
            text-align: center;
            color: black;
        }
        .student-info h3{
            margin: 20px 0 0 0;
            font-size: 24px;
        }
        .student-info h4{
            margin: 10px 0 0 0;
            font-size: 20px;
        }
        .student-info p{
            font-weight: bold;
        }
        .details {
            margin: 20px 25px;
        }
        .details p{
            font-weight: bold;
            margin: 10px;
        }
        .back{
            margin-top: 100px;
            margin-left: 20px;
            width: 400px;
            background-image: url("images/id/FA-Id-card-back.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 635px;
        }
    </style>
</head>
<body>
<div class="body">
    <div class="front">
        <div class="profile-image">
            <img src="images/id/profile.jpg" alt="image">
        </div>
        <div class="student-info">
            <h3>Student Name</h3>
            <h4>Art/Coding</h4>
        </div>
        <div class="details">
            <p>Father's Name : </p>
            <p>Mother's Name :</p>
            <p>Contact Number :</p>
            <p>Contact Number :</p>
            <p>Blood Group :</p>
        </div>
        <div class="student-info">
            <p>www.frogbidacademy.com</p>
        </div>
    </div>
    <div class="back"></div>
</div>


</body>
</html>
