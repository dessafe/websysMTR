<?php
require("../components/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found Questionnaire</title>
    <link rel="stylesheet" href="../css/cssquestionaire.css">
</head>
<body>
    <h1>Lost and Found Questionnaire</h1>
    <form id="lostFoundForm" action="submit_form.php" method="post" enctype="multipart/form-data">
        <label for="itemName">Item Name:</label>
        <input type="text" id="itemName" name="itemName" required><br><br>
       
        <label for="campusID">Campus:</label>
        <select id="campusID" name="campusID" required>
            <option value="">Select Campus</option>
            <?php
            // Fetch campus data from the database
            require("../login/config.php");
            $campusQuery = "SELECT * FROM campus";
            $result = mysqli_query($conn, $campusQuery);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['campusID']}'>{$row['campusName']}</option>";
            }
            ?>
        </select><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

        <label for="locationLost">Location Lost/Found:</label>
        <input type="text" id="locationLost" name="locationLost" required><br><br>

        <label for="dateFound">Date Found/Lost:</label>
        <input type="datetime-local" id="dateFound" name="dateFound" required><br><br>

        <label for="contactInfo">Contact Information:</label>
        <input type="text" id="contactInfo" name="contactInfo" required><br><br>

        <label for="image">Upload Image (Optional):</label>
        <input type="file" id="image" name="image"><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
require("../components/footer.php");
?>
