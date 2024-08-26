
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>macro assignment #07</title>
        <style>
            body {
                font-family: 'Courier New', Courier, monospace;
                background-image: url("background.webp");
                margin: 0;
                padding: 0;
            }

            .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h2 {
            margin-top: 0;

            }
            label {
                display: block;
                margin-bottom: 10px;
                font-weight: bold;
            }
            select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                margin-bottom: 20px;
            }
            button, .aggregate-button {
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            button:hover, .aggregate-button:hover {
                background-color: #45a049;
            }
        </style>
    </head>

    <body>
        <div class ="container">
        <h1>which l word character are you?</h1>
        <form action="processresults.php" method="POST">
            <label for="q1">Friday night, you're going out. What's your outfit of choice?</label>
            <select name="q1" id="q1">
                <option value="">Select an answer</option>
                <option value="Bette Porter">Power suit that commands attention</option>
                <option value="Shane McCutcheon">Edgy leather jacket and boots</option>
                <option value="Alice Pieszecki">Flowy dress with a statement necklace</option>
                <option value="Jenny Schecter">Cozy sweater and jeans for a chill night</option>
            </select>

            <label for="q2">How do you handle conflict in a relationship?</label>
            <select name="q2" id="q2">
                <option value="">Select an answer</option>
                <option value="Bette Porter">Direct and assertive, you won't hold back</option>
                <option value="Shane McCutcheon">You keep things cool and mysterious</option>
                <option value="Alice Pieszecki">You try to understand the other person's perspective</option>
                <option value="Jenny Schecter">You avoid confrontation and hope things smooth over</option>
            </select>

            <label for="q3">Your best friend is going through a tough time. What's your way of showing support?</label>
            <select name="q3" id="q3">
                <option value="">Select an answer</option>
                <option value="Bette Porter">You offer tough love and a kick in the pants</option>
                <option value="Shane McCutcheon">You provide a distraction with a wild night out</option>
                <option value="Alice Pieszecki">You lend a listening ear and offer emotional support</option>
                <option value="Jenny Schecter">You bring comfort food and binge-watch their favorite show</option>
            </select>

            <label for="q4">What fictional character would be your ultimate girl crush?</label>
            <select name="q4" id="q4">
                <option value="">Select an answer</option>
                <option value="Bette Porter">A powerful CEO who breaks glass ceilings</option>
                <option value="Shane McCutcheon">A badass biker chick who doesn't play by the rules</option>
                <option value="Alice Pieszecki">A free-spirited artist who marches to the beat of their own drum</option>
                <option value="Jenny Schecter">A witty and relatable journalist who navigates life's ups and downs</option>
            </select>

            <button type="submit">Submit</button>
            <br>
        </form>

        <?php
            //display error msg if answers missing
            if(isset($_GET['message'])) {
                $message = $_GET['message'];
                if($message == "MISSING_ANSWERS") {
                    print "<p style='color: red;'>Please Answer All Questions!</p>";
                }
            }
        ?>
        <?php
            if (isset($_COOKIE["result"])) {
                print "<p style='color: green;'>Your Previous Result Was: " . $_COOKIE["result"] . "</p>";
            }
        ?>
            <!-- results.php -->
            <form action="results.php" method="POST">
                <input type="submit" value="See Aggregate Results" class="aggregate-button">
            </form>

        </div>
    </body>
</html>