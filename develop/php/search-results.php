<?php

session_start();

$searchResults = $_SESSION["search-results"];

$json_output = json_encode($searchResults);

echo " <div class='nav'>
<span id='nomad'>NOMAD</span>
<a href='../pages/login.html'>LOGIN</a>
<a href='../pages/signup.html'>SIGNUP</a>
</div> ";
?>
<script defer>
    const body = document.body;
    var data = <?php echo $json_output; ?>;
    console.log(data);
    console.log(data[0]);
    console.log(data[0].id);
    const searchResults = document.createElement('div');
    searchResults.setAttribute('class', 'search-results-container');
    body.appendChild(searchResults);
    for (let i = 0; i < data.length; i++) {
        var result = document.createElement('div');
        var aName = document.createElement('div');
        var aDescription = document.createElement('div');
        var aImage = document.createElement('img');
        aImage.src = data[i].image;
        aDescription.innerHTML = data[i].description;
        aName.innerHTML = data[i].a_name;
        aName.setAttribute('class', 'activity-name');
        result.appendChild(aName);
        aDescription.setAttribute('class', 'description');

        result.appendChild(aImage);

        result.appendChild(aDescription);
        searchResults.append(result);
        result.setAttribute('class', 'search-results');
    }
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/search-results.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>

</body>

</html>