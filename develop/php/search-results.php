<?php

session_start();

$searchResults = $_SESSION["search-results"];
echo 'hello! welcome to the search-results page';

?>

<script>
    var data = <?php echo json_encode($searchResults); ?>;
    console.log(data);
    console.log(typeof data);
</script>