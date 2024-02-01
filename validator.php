<?php


 /*
The code for this validator was inspired by 
https://github.com/sushantgawali/sudoku/blob/master/sudoku.php
*/

class SudokuBoardValidator {

    public function sectionIsValid($array) {
        $nonZeroArray = array_filter($array);
        if (count($nonZeroArray) == 0) {
            return true;
        }
        if (count(array_unique($nonZeroArray)) < count($nonZeroArray)) {
            return false;
        }
        return true;
    }

    public function validateBoard($sudokuBoard) {
        foreach ($sudokuBoard as $row) {
            if (!$this->sectionIsValid($row)) {
                return false;
            }
        }

        for ($i = 0; $i < 9; $i++) {
            $columnArray = [];
            foreach ($sudokuBoard as $row) {
                $columnArray[] = $row[$i];
            }
            if (!$this->sectionIsValid($columnArray)) {
                return false;
            }
        }

        for ($row = 0; $row < 9; $row += 3) {
            for ($col = 0; $col < 9; $col += 3) {
                $startRow = $row;
                $startCol = $col;
            
                $regionArray = [];
            
                for ($innerRow = $startRow; $innerRow < $startRow + 3; $innerRow++) {
                    for ($innerCol = $startCol; $innerCol < $startCol + 3; $innerCol++) {
                        $regionArray[] = $sudokuBoard[$innerRow][$innerCol];
                    }
                    if (!$this->sectionIsValid($regionArray)) {
                        return false;
                    }
                }
            }
        }

        return true;
    }
}

?>
