<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photobanner Animation</title>
    <style>
        .wrapper {
            width: 100%;
            overflow: hidden;
        }
        .photobanner {
            display: flex;
            width: 100%;
            animation: bannermove 50s linear infinite;
        }
        .photobanner img {
            margin: 0 25px;
            box-shadow: 2px 2px 8px #8a8a8a;
        }
        @keyframes bannermove {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="photobanner">
            <a href="shop-sidebar.php"><img src="https://i.ibb.co/DfbLcN1/photo-1426901013385-803d40bd5558.jpg" alt="Image 1" /></a>
        </div>
    </div>
</body>
</html>
