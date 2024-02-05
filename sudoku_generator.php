<?php

require 'validator.php';

class SudokuGenerator {
    public SudokuBoardValidator $sudokuBoardValidator;

    function __construct() {
        $this->sudokuBoardValidator = new SudokuBoardValidator();
    }
    
    public function generateSudoku($numberOfClues) {
        $startBoard = [
            [0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0],
        ];

        for ($i = 0; $i < $numberOfClues; $i++) {
            $row = random_int(0, 8);
            $col = random_int(0, 8);

            while ($startBoard[$row][$col] != 0) { 
                $row = random_int(0, 8);
                $col = random_int(0, 8);
            }

            $startBoard[$row][$col] = random_int(1, 9);

            while (!$this->sudokuBoardValidator->validateBoard($startBoard)) {
                $startBoard[$row][$col] = random_int(1, 9);
            }
        }

        return $startBoard;
    }
}

$SudokuGenerator = new SudokuGenerator();
$emptyBoard = $SudokuGenerator->generateSudoku(25);

?>
