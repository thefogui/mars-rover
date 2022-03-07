<?php

$base_url='http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].dirname($_SERVER['REQUEST_URI'].'?');

if($_SERVER['REQUEST_METHOD'] == "POST") {
    goToApp();
}

function goToApp() {
    exit;
}

?>

<!DOCTYPE html>
    <html>

    <head>
        <meta name="viewport" content="width=device" />
        <meta name="description" content="Basic mars-rover-simulator">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <style type="text/css">
            body {
                width: 100vw;
                height: 100vh;

                display: grid;
                place-items: center;
            }

            button {
                background-color: #722ae6;
                outline: 0;
                width: 200px;
                border: 0;
                margin: 0 0 15px;
                padding: 15px;
                box-sizing: border-box;
                font-size: 14px;
                margin-top: 20px;
                color: white;
            }

            button:hover {
                background-color: #e4b5cb;
                cursor: pointer;
            }
        </style>
    </head>
    <body>

        <button type="button" id="start-app">
            Open Simulator
        </button>

        <script type="text/javascript">
            $('#start-app').click(function() {
                localStorage.setItem("server", "<?= $base_url ?>")

                $.ajax({
                    type: "POST",
                    url: "index.php",
                    success: function(data) {
                        window.location = 'frontend/build/index.html';
                    },
                })
            });
        </script>
    </body>
</html>