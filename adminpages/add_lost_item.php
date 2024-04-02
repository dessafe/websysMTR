<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Lost Item</title>
</head>


<body>

<style>
        body {
            margin: 0;
            padding: 0;
        }

        .topnav {
            background-color: #333;
            overflow: hidden;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #4CAF50;
            color: white;
        }

        .topnav .icon {
            display: none;
        }

        @media screen and (max-width: 600px) {
            .topnav a:not(:first-child) {display: none;}
            .topnav a.icon {
                float: right;
                display: block;
            }
        }

        @media screen and (max-width: 600px) {
            .topnav.responsive {position: relative;}
            .topnav.responsive .icon {
                position: absolute;
                right: 0;
                top: 0;
            }
            .topnav.responsive a {
                float: none;
                display: block;
                text-align: left;
            }
        }
    </style>
</head>
<body>

<div class="topnav" id="myTopnav">
    <a href="adminBoard.php" class="active"><i class="fa fa-fw fa-home"></i>Home</a>
    <a href="#adminpost.php"><i class="fas fa-fw fa-user"></i>Lost & Found</a>
    <a href="add_lost_item.php"><i class="fa-solid fa-utensils"></i>Add Post</a>
    <a href="manageitems.php"><i class="fa-solid fa-utensils"></i>Manage</a>
    <a href="usersAdmin.php"><i class="fa-solid fa-utensils"></i>Users</a>
    <a href="../login/logout.php"><i class="fas fa-fw fa-sign-out"></i>Logout</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>
</div>

<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>



    <h2>Add Lost Item</h2>
    <form action="process_lost_item.php" method="post" enctype="multipart/form-data">
        <label for="itemName">Item Name:</label><br>
        <input type="text" id="itemName" name="itemName"><br>
        
        <label for="campusID">Campus ID:</label><br>
        <select id="campusID" name="campusID">
            <option value="CAMP1001">Urdaneta</option>
            <option value="CAMP1002">Asingan</option>
            <!-- Add more options as needed -->
        </select><br>
        
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br>
        
        <label for="locationLost">Location Lost:</label><br>
        <input type="text" id="locationLost" name="locationLost"><br>
        
        <label for="dateFound">Date Found:</label><br>
        <input type="datetime-local" id="dateFound" name="dateFound"><br>
        
        <label for="contactInfo">Contact Info:</label><br>
        <input type="text" id="contactInfo" name="contactInfo"><br>
        
        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>




