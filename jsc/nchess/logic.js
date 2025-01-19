const board = document.getElementById('board');
const initialSetup = [
    '♖', '♘', '♗', '♕', '♔', '♗', '♘', '♖',
    '♙', '♙', '♙', '♙', '♙', '♙', '♙', '♙',
    '', '', '', '', '', '', '', '',
    '', '', '', '', '', '', '', '',
    '', '', '', '', '', '', '', '',
    '', '', '', '', '', '', '', '',
    '♟', '♟', '♟', '♟', '♟', '♟', '♟', '♟',
    '♜', '♞', '♝', '♛', '♚', '♝', '♞', '♜'
];

function createBoard() {
    initialSetup.forEach((piece, index) => {
        const square = document.createElement('div');
        square.classList.add('square');
        square.innerHTML = piece;
        square.addEventListener('click', () => onSquareClick(index));
        board.appendChild(square);
    });
}

let selectedSquare = null;

function onSquareClick(index) {
    const squares = document.querySelectorAll('.square');
    if (selectedSquare === null) {
        selectedSquare = index;
        squares[index].style.backgroundColor = 'yellow';
    } else {
        squares[selectedSquare].style.backgroundColor = '';
        squares[index].innerHTML = squares[selectedSquare].innerHTML;
        squares[selectedSquare].innerHTML = '';
        selectedSquare = null;
    }
}

createBoard();
