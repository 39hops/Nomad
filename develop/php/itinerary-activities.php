<?php

session_start();

$itryActArray = $_SESSION["itinerary-activities"];

?>

<!DOCTYPE html>
<html lang="en">

<body>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/itinerary-activities.css?v=<?php echo time(); ?>">
        <title>NOMAD | Itinerary Activities</title>
    </head>

    <div class="activity-container">

        <div class="nav">
            <span id="nomad">NOMAD</span>
            <a href="../php/profile.php">PROFILE</a>
            <a href="../pages/login.html">LOGIN</a>
            <a href="../pages/signup.html">SIGNUP</a>
        </div>

        <h1>now viewing <span id='itry-name'></span></h1>

        <div class="activity-wrapper"></div>

    </div>

    <script>
        var itryActArray = <?php echo json_encode($itryActArray) ?>;
        var wrapper = document.querySelector('.activity-wrapper');
        var span = document.getElementById('itry-name');
        span.innerHTML = itryActArray[0].it_name;

        console.log(itryActArray);

        if (itryActArray && itryActArray.length > 0) {
            for (i = 0; i < itryActArray.length; i++) {
                var card = document.createElement('div');
                var imgWrapper = document.createElement('div');
                var img = document.createElement('img');
                var content = document.createElement('div');
                var title = document.createElement('p');
                var address = document.createElement('p');
                var desc = document.createElement('p');

                card.classList.add('card');
                card.classList.add('glass');
                imgWrapper.classList.add('imgWrapper');
                content.classList.add('content');
                title.classList.add('title');

                img.src = itryActArray[i].image;
                title.innerText = itryActArray[i].it_name;
                address.innerText = itryActArray[i].address;
                desc.innerText = itryActArray[i].a_description

                content.append(title);
                content.append(address);
                content.append(desc);
                imgWrapper.append(img);
                card.append(imgWrapper);
                card.append(content);
                wrapper.append(card);
            }
        }

    </script>
</body>

</html>