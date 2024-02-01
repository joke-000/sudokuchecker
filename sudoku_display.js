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
                rowDiv.appendChild(newField);
            }
            form.appendChild(rowDiv);
        }
        var newField = document.createElement('input');
        newField.setAttribute('type', 'submit');
        newField.setAttribute('value', 'check validity and solve it!');
        form.appendChild(newField);

        element.appendChild(form);
    }
}