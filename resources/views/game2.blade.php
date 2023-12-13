<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Memory Game') }}
        </h2>
    </x-slot>

    <style>
        .memory-game-board {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            max-width: 400px; /* Adjust as needed */
            margin: auto;
        }

        .memory-card {
            width: 100px;
            height: 100px;
            background-color: #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #scoreContainer {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 20px;
            color: #333;
        }

        #resultContainer {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            text-align: center;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    시도 횟수: <span id="score">0</span>
                
                    <div id="memoryGameBoard" class="memory-game-board"></div>
                    <form action="/game" method="post">
                        <input type="hidden" name="game_name" value="cardGame">
                        @csrf
                        <div id="resultContainer">
                            <h2>게임 결과</h2>
                            <p>시도 횟수: <input type="text" id="finalScore" value="0" name="point"></p>
                            <input type="submit" id="restartButton" value="다시하기">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const memoryGameBoard = document.getElementById('memoryGameBoard');
        const scoreContainer = document.getElementById('scoreContainer');
        const resultContainer = document.getElementById('resultContainer');
        const scoreElement = document.getElementById('score');
        const finalScoreElement = document.getElementById('finalScore');
        const restartButton = document.getElementById('restartButton');

        const cards = [
            'A', 'A', 'B', 'B', 'C', 'C', 'D', 'D',
            'E', 'E', 'F', 'F', 'G', 'G', 'H', 'H'
        ];

        let flippedCards = [];
        let matchedCards = [];
        let attempts = 0;

        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        function createGameBoard() {
            shuffleArray(cards);

            for (let i = 0; i < cards.length; i++) {
                const cardElement = document.createElement('div');
                cardElement.classList.add('memory-card');
                cardElement.dataset.card = cards[i];
                cardElement.addEventListener('click', flipCard);
                memoryGameBoard.appendChild(cardElement);
            }
        }

        function flipCard() {
            if (flippedCards.length < 2 && !flippedCards.includes(this)) {
                flippedCards.push(this);
                this.innerHTML = this.dataset.card;

                if (flippedCards.length === 2) {
                    attempts++;
                    scoreElement.textContent = attempts;
                    setTimeout(checkMatch, 1000);
                }
            }
        }

        function checkMatch() {
            const [card1, card2] = flippedCards;

            if (card1.dataset.card === card2.dataset.card) {
                matchedCards.push(card1, card2);
            } else {
                card1.innerHTML = '';
                card2.innerHTML = '';
            }

            flippedCards = [];

            if (matchedCards.length === cards.length) {
                showResult();
            }
        }

        function showResult() {
            resultContainer.style.display = 'block';
            finalScoreElement.value = attempts; // 최종 시도 횟수로 입력 필드의 값 업데이트
        }

        function resetGame() {
            memoryGameBoard.innerHTML = '';
            matchedCards = [];
            attempts = 0;
            scoreElement.textContent = attempts;
            resultContainer.style.display = 'none';
            createGameBoard();
        }

        restartButton.addEventListener('click', resetGame);

        createGameBoard();
    </script>
</x-app-layout>
