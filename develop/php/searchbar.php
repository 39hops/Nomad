<?php 
include ("db_connection.php");
    $countriesArray = [];
    $sql = "SELECT id, name FROM country";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $countriesArray[$row["id"]] = $row["name"];
        }
    }
        
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <title>NOMAD</title>
</head>

<body>
    <div class="main">

        <div class="container" id="start">
            <a href="#search">
                <header>NOMAD</header>
            </a>
        </div>

        <div class="container" id="search">

            <div class="nav">
                <span id="nomad">NOMAD</span>
                <a href="../pages/login.html">LOGIN</a>
                <a href="../pages/signup.html">SIGNUP</a>
            </div>

            <h1 id="discover">discover.</h1>

            <div class="search-bar glass">

                <div class="dropdown">
                    <input type="text" class="text02" readonly placeholder="COUNTRY">
                    <div class="option glass" id="countries" onclick="showCountries()">
                        <div id="text02" onclick="show('No countries. ');">No countries</div>
                        <div id="text02" class="text02" onclick="show('No countries.');">No countries</div>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <script>
    let dropdown = document.querySelectorAll('.dropdown');
    let test02 = document.getElementById('text02');
    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener('click', toggle);
    }
    function show(e){
        test02.value 
    }

    function toggle() {
        this.classList.toggle('active');
    }
    let countries = <?php echo json_encode($countriesArray); ?>;
    console.log(countries);
    console.log(countries[1]);

    function showCountries() {
        for (i = 1; i <= countries.length; i++) {
            let node = document.createElement('div');
            let text = countries[i];
            console.log(text);
            let textNode = document.createTextNode(text);
            node.textContent = text;
            document.getElementById('countries').appendChild(node);
        }
    }
    </script>
</body>

</html>