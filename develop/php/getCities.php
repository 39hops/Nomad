<?php
if (isset($_POST['countryID'])) {

    $countryID = $_POST['countryID'];

    include ("db_connection.php");

    $citiesArray = [];
    $sql = "SELECT id, name FROM city WHERE country_id = $countryID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $citiesArray[$row["id"]] = $row["name"];
        }
    }

    echo json_encode($citiesArray);

} else {
    echo "No cityID received";
}
?>