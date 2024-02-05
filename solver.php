<?php

interface SudokuSolver {
    public function getResult($sudokuArray);
}

/*
The code for this solver uses a backtracking algorithm and was borrowed from 
https://github.com/kirilkirkov/Sudoku-Solver
The code was partially changed to enable interaction with the GameObject
*/
class BackTrackSolver implements SudokuSolver {
    private $initialArray = array();
    private $grids = array();
    private $columns = array();
    private $timeTracking = array();
    public $elapsedTime;

    public function __construct() {
        $this->timeTracking['start'] = microtime(true);
    }

    private function setGrids() {
        $grids = array();
        foreach ($this->initialArray as $rowIndex => $row) {
            $gridRowIndex = intdiv($rowIndex, 3) + 1;

            foreach ($row as $colIndex => $value) {
                $gridColIndex = intdiv($colIndex, 3) + 1;
                $grids[$gridRowIndex][$gridColIndex][] = $value;
            }
        }
        $this->grids = $grids;
    }

    private function setColumns() {
        $columns = array();
        $i = 1;
        foreach ($this->initialArray as $rowIndex => $row) {
            $e = 1;
            foreach ($row as $colIndex => $value) {
                $columns[$e][$i] = $value;
                $e++;
            }
            $i++;
        }
        $this->columns = $columns;
    }

    private function getPossibilities($rowIndex, $colIndex) {
        $values = array();
        $gridRowIndex = intdiv($rowIndex, 3) + 1;
        $gridColIndex = intdiv($colIndex, 3) + 1;

        for ($num = 1; $num <= 9; $num++) {
            if (
                !in_array($num, $this->initialArray[$rowIndex]) &&
                !in_array($num, $this->columns[$colIndex + 1]) &&
                !in_array($num, $this->grids[$gridRowIndex][$gridColIndex])
            ) {
                $values[] = $num;
            }
        }
        shuffle($values);
        return $values;
    }

    public function solveSudoku($sudokuArray) {
        while (true) {
            $this->initialArray = $sudokuArray;

            $this->setColumns();
            $this->setGrids();

            $emptyCells = array();
            foreach ($sudokuArray as $rowIndex => $row) {
                foreach ($row as $colIndex => $value) {
                    if ($value == 0) {
                        $possibilities = $this->getPossibilities($rowIndex, $colIndex);
                        $emptyCells[] = array(
                            'rowIndex' => $rowIndex,
                            'columnIndex' => $colIndex,
                            'possibleValues' => $possibilities
                        );
                    }
                }
            }

            if (empty($emptyCells)) {
                return $sudokuArray;
            }

            usort($emptyCells, array($this, 'sortEmptyCells'));

            if (count($emptyCells[0]['possibleValues']) == 1) {
                $sudokuArray[$emptyCells[0]['rowIndex']][$emptyCells[0]['columnIndex']] = current($emptyCells[0]['possibleValues']);
                continue;
            }

            foreach ($emptyCells[0]['possibleValues'] as $value) {
                $temporaryArray = $sudokuArray;
                $temporaryArray[$emptyCells[0]['rowIndex']][$emptyCells[0]['columnIndex']] = $value;
                if ($result = $this->solveSudoku($temporaryArray)) {
                    return $this->solveSudoku($temporaryArray);
                }
            }

            return false;
        }
    }

    public function getResult($sudokuArray) {
        if ($this->solveSudoku($sudokuArray)) {
            $this->timeTracking['end'] = microtime(true);
            $this->elapsedTime = $this->timeTracking['end'] - $this->timeTracking['start'];
            $this->elapsedTime = number_format($this->elapsedTime, 3);
            return $this->initialArray;
        } else {
            return false;
        }
    }

    private function sortEmptyCells($a, $b) {
        $countA = count($a['possibleValues']);
        $countB = count($b['possibleValues']);
        if ($countA == $countB) {
            return 0;
        }
        return ($countA < $countB) ? -1 : 1;
    }
}

?>
