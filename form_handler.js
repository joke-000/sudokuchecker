
function makeTable(sudokuBoard, sudokuTime) {
    var tableDiv = document.getElementById('table-div');
    var sudoku = new SudokuDisplay(sudokuBoard);
    sudoku.createSudokuTable(tableDiv);
    makeInfoPar('Sudoku solved in ' + sudokuTime + ' seconds', tableDiv);
}

function makeInfoPar(text, parentElement) {
    var textNode = document.createTextNode(text);
    var para = document.createElement('p');
    para.appendChild(textNode);
    parentElement.appendChild(para);
}
