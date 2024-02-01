<?php

require 'validator.php';
require 'solver.php';

class SudokuParser {
    public $postObject;

    function __construct($postObject) {
        $this->postObject = $postObject;
    }

    public function parse() {
        $parsedResponse = [];
        foreach ($this->postObject as $postRow) {
            $row = [];
            foreach ($postRow as $rowItem) {
                $row[] = (int) $rowItem;
            };
            $parsedResponse[] = $row;
        }
        return $parsedResponse;
    }
}

class SudokuGame {
    public $sudokuBoard;
    public $sudokuBoardValidator;
    public SudokuSolver $sudokuSolver;
    public $minimumClues;

    function __construct($sudokuBoard, SudokuSolver $sudokuSolver, $minimumClues) {
        $this->sudokuBoard = $sudokuBoard;
        $this->sudokuBoardValidator = new SudokuBoardValidator();
        $this->sudokuSolver = $sudokuSolver;
        $this->minimumClues = $minimumClues;
    }

    public function solutionPossible() {
        return ($this->boardIsSolvable() && $this->sudokuBoardValidator->validateBoard($this->sudokuBoard));
    }

    public function boardIsValid() {
        return $this->sudokuBoardValidator->validateBoard($this->sudokuBoard);
    }

    public function boardIsSolvable() {
        $clues = [];
        foreach ($this->sudokuBoard as $row) {
            foreach ($row as $rowItem) {
                if ($rowItem != 0) {
                    $clues[] = $rowItem;
                }
            }
        }
        if (count($clues) < $this->minimumClues) {
            return false;
        }
        return true;
    }

    public function getSolution() {
        return $this->sudokuSolver->getResult($this->sudokuBoard);
    }

    public function getSolutionTime() {
        return $this->sudokuSolver->time;
    }
}

?>



