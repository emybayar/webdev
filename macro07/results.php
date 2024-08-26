<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Macro Assignment #07 - Results</title>
        <style>
            body {
                font-family: 'Courier New', Courier, monospace;
                background-image: url("background.webp");
                margin: 0;
                padding: 0;
            }
            
           .container {
                max-width: 600px;
                max-height: 600px;
                margin: 20px auto;
                background-color: #fff;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                align-items: center;
            }

           .result-item {
                height: 20px;
                margin-bottom: 10px;
                background-color: #4CAF50;
                border-radius: 5px;
                text-align: center;
                line-height: 20px;
                width: calc(<?php echo $percentage;?>% - 10px);
                white-space: nowrap; /*prevent text from wrapping */
            }


           .aggregate-button {
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
            <h1>Aggregate Results</h1>
            <?php
                //open file
                $resultsFile = file_get_contents('results.txt');

                //count++
                $totalSubmissions = substr_count($resultsFile, "\n") + 1;

                $characterCounts = array(
                    'Bette' => 0,
                    'Shane' => 0,
                    'Alice' => 0,
                    'Jenny' => 0
                );

                foreach ($characterCounts as $character => $count) {
                    $characterCounts[$character] = substr_count($resultsFile, $character);
                }
                $characterPercentages = array();
                foreach ($characterCounts as $character => $count) {
                    $characterPercentages[$character] = ($count / $totalSubmissions) * 100;
                }
           ?>

            <p>Total Submissions: <?php echo $totalSubmissions;?></p>

            <?php foreach ($characterPercentages as $character => $percentage) :?>
                <div class="result-item" style="width: <?php echo $percentage;?>%;">
                    <?php echo $character. ': '. $percentage. '%';?>
                </div>
            <?php endforeach;?>

            <form action="index.php" method="POST">
                <input type="submit" value="Back To Quiz" class="aggregate-button">
            </form>
        </div>
    </body> 
</html>