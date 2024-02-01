<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudoku maker</title>
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
    $sudokuGame = new SudokuGame($parsedSudokuArray, new BackTrackSolver(), 28);
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
                makeInfoPar("Not a valid Sudoku board.", document.getElementById('table-div'))
            </script>
        <?php elseif (!$sudokuGame->boardIsSolvable()): ?>
            <script>
                var infoText = "This sudoku board is not solvable in a reasonable amount of time, because it has less than <?php echo $sudokuGame->minimumClues ?> clues."
                makeInfoPar(infoText, document.getElementById('table-div'))
            </script>
        <?php endif; ?>
    <?php endif; ?>

<?php else: ?>
    <div class="container">
        <h3> Make your own sudoku and check if it is valid </h3>
        <p> You need at least 28 clues for the sudoku to be solvable </p>
        <button onclick="location.replace('index.php')">
            Visit our SudokuMaker
        </button>
    </div>
<?php endif; ?>

</body>
</html>
