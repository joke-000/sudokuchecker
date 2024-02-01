<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudoku Checker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript" src="sudoku_display.js"></script>
    <script type="text/javascript" src="form_handler.js"></script>
</head>
<body>

<?php
require 'sudoku_game.php';
?>

<?php if ($_POST): ?>
    <div class="container">
        <div id="table-div">
            <h3> Result </h3>
        </div>
        <button onclick="history.back()">Back to Input Page</button>
    </div>

    <?php
    $sudokuParser = new SudokuParser($_POST);
    $parsedSudokuArray = $sudokuParser->parse();
    $sudokuGame = new SudokuGame($parsedSudokuArray, new BackTrackSolver(), 25);
    ?>

    <?php if ($sudokuGame->solutionPossible()): ?>

        <?php
        $sudokuGrid = $sudokuGame->getSolution();
        $sudokuTime = $sudokuGame->getSolutionTime();
        ?>
        <script>
            var backendSudoku = <?php echo json_encode($sudokuGrid); ?>;
            var backendSudokuTime = <?php echo json_encode($sudokuTime); ?>;
            makeTable(backendSudoku, backendSudokuTime);
        </script>
    <?php else: ?>
        <?php if (!$sudokuGame->boardIsValid()): ?>
            <script>
                var infoText = "This is not a valid Sudoku board. "+ 
                "Please return to the input page and make sure your clues conform to the rules of Sudoku.";
                makeInfoPar(infoText, document.getElementById('table-div'));
                var link = document.createElement('a');
                var  linkText = document.createTextNode("Read more about sudoku rules");
                link.appendChild(linkText);
                link.href = "https://www.sudokuonline.io/tips/sudoku-rules";
                document.getElementById('table-div').appendChild(link);
            </script>
        <?php elseif (!$sudokuGame->boardIsSolvable()): ?>
            <script>
                var infoText = "This sudoku board is valid, but it cannot be solved in a reasonable amount of time. "+
                "This is because it has less than <?php echo $sudokuGame->minimumClues ?> clues."+
                "Press the button below to return to the input page and try again.";
                makeInfoPar(infoText, document.getElementById('table-div'))
            </script>
        <?php endif; ?>
    <?php endif; ?>

<?php else: ?>
    <div class="container">
        <h3> Make your own sudoku and check if it is valid </h3>
        <p> You need at least 25 clues for the sudoku to be solvable </p>
        <button onclick="location.replace('index.php')">
            Visit our SudokuMaker
        </button>
    </div>
<?php endif; ?>

</body>
</html>
