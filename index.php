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

<?php
require 'sudoku_generator.php';
?>

<script type="text/javascript">
        var generatedSudoku = <?php echo json_encode($emptyBoard); ?>;
</script>




<div class="container">
    <h3> Make your own sudoku and check whether it can be solved</h3>
    <p> You need at least 25 clues for the sudoku to be solvable </p>
    <div><button onclick="useExampleSudoku()" >Use example with some clues filled in</button></div> 
    <div><button onclick="useRandomSudoku()" >Use randomly generated clues</button></div>  
    <div><button onclick="useEmptySudoku()" >Clear sudoku to start from scratch</button></div>   
    

    <div id="form-div"></div>
</div>

<script defer src="index.js"></script>

</body>
</html>





