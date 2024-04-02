<?php
// Include the database configuration file
require("../login/config.php");

// Initialize the campus filter variable and search query variable
$campusFilter = "";
$searchQuery = "";

// Check if a specific campus is selected
if (isset($_GET['campusID']) && $_GET['campusID'] !== 'all') {
    // Sanitize the input
    $campusFilter = mysqli_real_escape_string($conn, $_GET['campusID']);
    $campusFilterClause = "WHERE lostitems.campusID = '{$campusFilter}'";
} else {
    // If "All Campuses" is selected or no filter is applied, show all posts
    $campusFilterClause = "";
}

// Check if a search query is provided
if (isset($_GET['search']) && !empty($_GET['search'])) {
    // Sanitize the input
    $searchQuery = mysqli_real_escape_string($conn, $_GET['search']);
    
    // Construct the search condition
    $searchCondition = "AND (ItemName LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%' OR locationLost LIKE '%$searchQuery%' OR contactInfo LIKE '%$searchQuery%')";
} else {
    $searchCondition = "";
}

// Fetch all lost items from the database with associated campus names
$query = "SELECT lostitems.*, campus.campusName 
          FROM lostitems 
          INNER JOIN campus ON lostitems.campusID = campus.campusID
          {$campusFilterClause}
          {$searchCondition}";
$result = mysqli_query($conn, $query);

// Check if there are any lost items
if (mysqli_num_rows($result) > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lost Items</title>
        <style>
            .card {
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 10px;
                margin-bottom: 10px;
                background-color: #f9f9f9;
            }
            .card img {
                max-width: 100%;
                height: auto;
            }
        </style>
    </head>
    <body>
    <nav>
       <div class="logo">
           <img src="../images/Found.png" alt="Logo">
       </div>
       <ul>
           <li><a href="../userpage/userdashboard.php">Home</a></li>
           <li><a href="../userpage/questionaire.php">Lost Something?</a></li>
           <li><a href="../login/logout.php">Logout</a></li>
       </ul>
   </nav>
        <h2>Lost Items</h2>

        <!-- Filter Dropdown -->
        <div>
            <label for="campusFilter">Filter by Campus:</label>
            <select id="campusFilter">
                <option value="all">All Campuses</option>
                <?php
                // Fetch distinct campus names and populate the dropdown
                $campusQuery = "SELECT DISTINCT campusID, campusName FROM campus";
                $campusResult = mysqli_query($conn, $campusQuery);
                while ($row = mysqli_fetch_assoc($campusResult)) {
                    $selected = ($row['campusID'] === $campusFilter) ? "selected" : "";
                    echo "<option value='{$row['campusID']}' $selected>{$row['campusName']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Search Form -->
        <div>
            <form action="" method="get">
                <label for="search">Search:</label>
                <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Enter search keyword">
                <input type="submit" value="Search">
            </form>
        </div>

        <!-- Display Lost Items -->
        <div class="container" id="lostItemsContainer">
            <?php
            // Loop through each row and display lost item data
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card">
                    <h3><?php echo htmlspecialchars($row['ItemName']); ?></h3>
                    <p><strong>Campus:</strong> <?php echo htmlspecialchars($row['campusName']); ?></p> <!-- Display Campus Name -->
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
                    <p><strong>Location Lost:</strong> <?php echo htmlspecialchars($row['locationLost']); ?></p>
                    <p><strong>Date Found:</strong> <?php echo htmlspecialchars($row['dateFound']); ?></p>
                    <p><strong>Contact Info:</strong> <?php echo htmlspecialchars($row['contactInfo']); ?></p>
                    <?php 
                        $imagePath = '../uploads/' . $row['image']; // Adjusted path
                        if (!empty($row['image']) && file_exists($imagePath)) {
                            echo '<p><strong>Image:</strong><br><img src="' . htmlspecialchars($imagePath) . '" alt="Item Image"></p>';
                        } else {
                            echo '<p><strong>No Image Available</strong></p>';
                        }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>

        <script>
            // JavaScript to handle campus filtering
            document.getElementById('campusFilter').addEventListener('change', function() {
                var campusID = this.value;
                var searchQuery = document.getElementById('search').value; // Get the search query
                var url = "../adminpages/filter_lost_item.php";

                // Adjust the URL based on the selected campus ID and search query
                if (campusID !== "all") {
                    url += "?campusID=" + campusID;
                }
                if (searchQuery.trim() !== "") {
                    url += (campusID !== "all" ? "&" : "?") + "search=" + encodeURIComponent(searchQuery); // Include search query in URL
                }

                // Send AJAX request to update lost items
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('lostItemsContainer').innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", url, true);
                xhttp.send();
            });
        </script>
    </body>
    </html>
    <?php
} else {
    // No lost items found
    echo "No lost items found";
}

// Close the database connection
mysqli_close($conn);
?>
