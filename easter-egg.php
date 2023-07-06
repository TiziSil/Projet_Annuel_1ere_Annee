<!DOCTYPE html>
<html>
<head>
    <title>Easter Egg Champagne</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        #champagne-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url(champagne-explosion.gif) no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div id="champagne-container"></div>

    <script>
        setTimeout(function() {
            window.location.href = "assets/champagne.gif";
        }, 500); // Temps en millisecondes avant la redirection (5 secondes dans cet exemple)
    </script>
</body>
</html>
