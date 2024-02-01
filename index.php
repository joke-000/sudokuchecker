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
    <script defer src="sudoku_display.js"></script>
</head>
<body>

<div class="container">
    <h3> Make your own sudoku and check if it is valid </h3>
    <p> You need at least 25 clues for the sudoku to be solvable </p>   
    <button onclick="useExampleSudoku()" id="switch-button">Use example with some clues filled in</button> 
    <div id="form-div"></div>
</div>

<script defer src="index.js"></script>

</body>
</html>





