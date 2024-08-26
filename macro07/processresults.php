<?php
    //obtain incoming variables
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];
    $q4 = $_POST['q4'];
    //print "Hello, $q1"; //$q1 returns value of the form "Bette"

    if(empty($q1) || empty($q2) || empty($q3) || empty($q4)) {
        //redirect back to micro06.php page
        header('Location: index.php?message=MISSING_ANSWERS');
        exit();
    }
?>

<?php
    //if the form is submitted -->
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //init variables in an array
        $scores = array(
            'Bette' => 0,
            'Shane' => 0,
            'Alice' => 0,
            'Jenny' => 0
        );

        //increment scores based on answers;
        $scores[$q1]++;
        $scores[$q2]++;
        $scores[$q3]++;
        $scores[$q4]++;
        //find the maximum score
        $maxScore = max($scores);
        //if tied
        $winners = array_keys($scores, $maxScore);

        //set cookies
        setcookie("result",  $winners[0], time() + (86400 * 30), "/");
        //save results to txt file
        $results = $winners[0]. "\n";
        file_put_contents('results.txt', $results, FILE_APPEND);

        //results disp;ay
        $result = "You Are ". $winners[0]. "!";
        // if (count($winners) == 1) {
        //     echo "You Are " . $winners[0] . "!";
        // } else {
        //     echo "You Are " . $winners[0] . "!";
        // }
    } else {
        //redirect if form is not submitted
        header("Location: index.php");
        exit();
    }
?>

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
            align-items: center;
            }

            .try-again-button, .aggregate-button {
                display: block;
                margin: 10px;
                padding: 10px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>which l word character are you?</h1>
            <?php if (isset($result)) :?>
                <p style="text-align: center;"><?php echo $result;?></p>
            <?php endif;?>
            <?php if ($winners[0] == "Jenny Schecter") :?>
                <img src="images/jenny.jpeg" alt="Jenny" style="display: block; margin: 0 auto;">
            <?php elseif ($winners[0] == "Alice Pieszecki") :?>
                <img src="images/alice.jpeg" alt="Alice" style="display: block; margin: 0 auto;">
            <?php elseif ($winners[0] == "Shane McCutcheon") :?>
                <img src="images/shane.jpeg" alt="Shane" style="display: block; margin: 0 auto;">
            <?php elseif ($winners[0] == "Bette Porter") :?>
                <img src="images/bette.jpeg" alt="Bette" style="display: block; margin: 0 auto;">
            <?php endif;?>
            <form action="index.php" method="POST">
                <input type="submit" value="Try Again" class="try-again-button">
            </form>
            <form action="results.php" method="POST">
                <input type="submit" value="See Aggregate Results" class="aggregate-button">
            </form>
        </div>
    </body> 
</html>

