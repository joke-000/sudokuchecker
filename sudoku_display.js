class SudokuDisplay {
    constructor(sudoku) {
        this.sudoku = sudoku;
    }

    createSudokuTable(element) {
        var table = document.createElement('TABLE');
        for (let i = 0; i < Object.keys(this.sudoku).length; i++) {
            var tableRow = document.createElement("TR");
            for (let j = 0; j < this.sudoku[i].length; j++) {
                var tableData = document.createElement("TD");
                var tableContents = document.createTextNode(this.sudoku[i][j]);
                tableData.appendChild(tableContents);
                tableRow.appendChild(tableData);
            }
            table.appendChild(tableRow);
        }
        element.appendChild(table);
    }

    createSudokuForm(element) {
        var form = document.createElement('form');
        form.setAttribute("method", "post");
        form.setAttribute("action", "form_handler.php");
        form.setAttribute("id", "inputdiv");
        for (let i = 0; i < Object.keys(this.sudoku).length; i++) {
            var rowDiv = document.createElement('div');
            if (i==2 || i==5){
                rowDiv.setAttribute('class', 'horizontal-divider');
            }
            for (let j = 0; j < this.sudoku[i].length; j++) {
                var newField = document.createElement('input');
                newField.setAttribute('type', 'text');
                newField.setAttribute('inputmode', 'numeric');
                newField.setAttribute('pattern', '[1-9]');
                newField.setAttribute('maxlength', '1');
                newField.setAttribute('name', 'row' + i + '[]');

                if (this.sudoku[i][j] != 0) {
                    newField.setAttribute('value', this.sudoku[i][j]);
                }
                if (j==2 || j==5){
                    newField.setAttribute('class', 'vertical-divider');
                }
                rowDiv.appendChild(newField);
            }
            form.appendChild(rowDiv);
        }
        var newField = document.createElement('input');
        newField.setAttribute('type', 'submit');
        newField.setAttribute('value', 'Find out if this sudoku can be solved!');
        form.appendChild(newField);

        element.appendChild(form);
    }
}
