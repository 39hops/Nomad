<?php
if (isset($_POST['activity']) && isset($_POST['cityID'])) {

    $activity = $_POST['activity'];
    $cityID = $_POST['cityID'];

    include ("db_connection.php");

    $activitiesArray = [];
    $sql = "SELECT *
    FROM $activity
    JOIN activity
    ON $activity.activity_id = activity.a_id
    JOIN city
    ON activity.city_id = city.id
    WHERE city.id = $cityID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $activitiesArray[] = (object) $row;
        }
    }

    array_unshift($activitiesArray, $activity);

    session_start();
    $_SESSION['search-results']=$activitiesArray;

    // i think this can be deleted later ??
    echo json_encode($activitiesArray);

} else {
    echo "No data received";
}
?>