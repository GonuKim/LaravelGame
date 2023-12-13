<style>
    canvas {
        border: 1px solid #000;
    }

    #gameOverScreen {
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 255, 255, 0.9);
        padding: 20px;
        text-align: center;
    }

    #restartButton {
        background-color: #0095DD;
        color: #fff;
        padding: 10px 20px;
        cursor: pointer;
    }

    #gameContainer {
        position: relative;
    }

    #scoreContainer {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 20px;
        color: #333;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div id="gameContainer">

                        <canvas id="gameCanvas" width="1170" height="600"></canvas>

                        <div id="scoreContainer">
                            점수: <span id="currentScore">0</span>
                        </div>
                    </div>

                    <form action="/game" method="post">
                        <input type="hidden" name="game_name" value="ballGame">
                        <div id="gameOverScreen">
                            @csrf
                            <h2>Game Over</h2>
                            <p>점수: <input type="text" id="score" value=0 name="point"></p>
                            <input type="submit" id="restartButton" value="다시하기">
                        </div>
                    </form>
                
                    <script>
                        const canvas = document.getElementById('gameCanvas');
                        const ctx = canvas.getContext('2d');
                        const gameOverScreen = document.getElementById('gameOverScreen');
                        const restartButton = document.getElementById('restartButton');
                        const scoreElement = document.getElementById('score');
                
                        // 네모의 초기 위치 및 크기
                        let paddle = {
                            x: canvas.width / 2 - 50,
                            y: canvas.height - 20,
                            width: 100,
                            height: 10,
                            speed: 10
                        };
                
                        // 공의 초기 위치 및 속도
                        let ball = {
                            x: canvas.width / 2,
                            y: canvas.height - 30,
                            radius: 10,
                            dx: 7,
                            dy: -7
                        };
                
                        let score = 0;
                
                        function drawPaddle() {
                            ctx.beginPath();
                            ctx.rect(paddle.x, paddle.y, paddle.width, paddle.height);
                            ctx.fillStyle = '#0095DD';
                            ctx.fill();
                            ctx.closePath();
                        }
                
                        function drawBall() {
                            ctx.beginPath();
                            ctx.arc(ball.x, ball.y, ball.radius, 0, Math.PI * 2);
                            ctx.fillStyle = '#0095DD';
                            ctx.fill();
                            ctx.closePath();
                        }
                
                        function draw() {
                            ctx.clearRect(0, 0, canvas.width, canvas.height);

                            drawPaddle();
                            drawBall();

                            // 네모의 위치 업데이트
                            if (rightPressed && paddle.x < canvas.width - paddle.width) {
                                paddle.x += paddle.speed;
                            } else if (leftPressed && paddle.x > 0) {
                                paddle.x -= paddle.speed;
                            }

                            // 공의 위치 업데이트
                            ball.x += ball.dx;
                            ball.y += ball.dy;

                            // 공이 벽에 닿으면 방향 바꾸기
                            if (ball.x + ball.dx > canvas.width - ball.radius || ball.x + ball.dx < ball.radius) {
                                ball.dx = -ball.dx;
                            }

                            if (ball.y + ball.dy < ball.radius) {
                                ball.dy = -ball.dy;
                            } else if (ball.y + ball.dy > canvas.height - ball.radius) {
                                // 공이 네모에 닿으면 방향 바꾸기
                                if (ball.x > paddle.x && ball.x < paddle.x + paddle.width) {
                                    // 패들의 가로 중심점으로부터 떨어진 거리 계산
                                    const distanceFromCenter = ball.x - (paddle.x + paddle.width / 2);
                                    
                                    // 패들 가로 중심점으로부터 떨어진 거리에 따라 방향 설정
                                    ball.dy = -ball.dy;
                                    ball.dx = 8 * (distanceFromCenter / (paddle.width / 2));

                                     // 각 공을 받을 때마다 dx와 dy를 0.2씩 늘려줌
                                    ball.dx += Math.sign(ball.dx) * 0.2;
                                    ball.dy += Math.sign(ball.dy) * 0.2;
                                    
                                    score++; // 공을 받으면 점수 증가
                                    scoreElement.textContent = score;
                                    document.getElementById('score').value = score;

                                    // 동적으로 점수 표시 업데이트
                                    document.getElementById('currentScore').textContent = score;
                                } else {
                                    // 공을 받지 못하면 게임 오버
                                    showGameOverScreen();
                                    return;
                                }
                            }

                            requestAnimationFrame(draw);
                        }
                
                        let rightPressed = false;
                        let leftPressed = false;
                
                        document.addEventListener('keydown', keyDownHandler);
                        document.addEventListener('keyup', keyUpHandler);
                
                        function keyDownHandler(e) {
                            if (e.key === 'Right' || e.key === 'ArrowRight') {
                                rightPressed = true;
                            } else if (e.key === 'Left' || e.key === 'ArrowLeft') {
                                leftPressed = true;
                            }
                        }
                
                        function keyUpHandler(e) {
                            if (e.key === 'Right' || e.key === 'ArrowRight') {
                                rightPressed = false;
                            } else if (e.key === 'Left' || e.key === 'ArrowLeft') {
                                leftPressed = false;
                            }
                        }
                
                        function showGameOverScreen() {
                            gameOverScreen.style.display = 'block';
                            scoreElement.textContent = score;
                            document.getElementById('score').innerText = score;
                            document.getElementById('pointInput').value = score;
                        }
                
                        restartButton.addEventListener('click', () => {
                            // 게임 초기화
                            paddle.x = canvas.width / 2 - 50;
                            ball.x = canvas.width / 2;
                            ball.y = canvas.height - 30;
                            score = 0;
                            pointInput.value = score;
                            gameOverScreen.style.display = 'none';
                            draw();
                        });
                
                        draw();
                    </script>

                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>
