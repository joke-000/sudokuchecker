
var empty = [
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
  
  var validAndEasy = [
    [0, 6, 0, 0, 0, 0, 0, 3, 1],
    [0, 0, 0, 5, 0, 0, 9, 0, 4],
    [4, 1, 0, 0, 0, 9, 0, 2, 5],
    [0, 0, 4, 0, 0, 0, 0, 0, 0],
    [0, 3, 6, 0, 0, 0, 0, 8, 9],
    [0, 0, 0, 4, 8, 0, 0, 0, 0],
    [0, 2, 7, 0, 0, 0, 0, 9, 0],
    [6, 5, 1, 9, 0, 0, 0, 0, 7],
    [9, 4, 8, 0, 0, 5, 0, 1, 0],
  ];


  
  function useExampleSudoku() {
    resetForm(validAndEasy);
  }
  
  function useEmptySudoku() {
    resetForm(empty);
  }
  
  function useRandomSudoku() {
    resetForm(generatedSudoku);
  }

  function resetForm(sudokuBoard) {
    document.getElementById('form-div').innerHTML = '';
    var sudoku = new SudokuDisplay(sudokuBoard);
    sudoku.createSudokuForm(document.getElementById('form-div'));
  }

  
  var sudoku = new SudokuDisplay(empty);
  sudoku.createSudokuForm(document.getElementById('form-div'));
  
  
 