<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <!-- Icon -->
    <link rel="icon" href="./img/favicon.png">
    
    <!-- CSS -->
    <link rel="stylesheet" href="./css/main.css">
    
    <!-- Font -->
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" onload="this.rel='stylesheet'" />

    <!-- JS -->
    <script src="./js/functions.js"></script>

    <!-- Font Awesome -->
    <link href="./library/fontawesome/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?= $content ?>
</body>

</html>