<style>
    * {
      padding: 0;
      margin: 0;
    }
    canvas {
      background: #eee;
      display: block;
      margin: 0 auto;
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
                    <canvas id="myCanvas" width="900" height="600"></canvas>

                    <script>
                        var canvas = document.getElementById("myCanvas");
                        var ctx = canvas.getContext("2d");
                        let x = canvas.width / 2;
                        let y = canvas.height - 30;
                        let dx = 2;
                        let dy = -2;

                        function draw() {
                            ctx.clearRect(0, 0, canvas.width, canvas.height); // 캔버스를 지워줌으로써 공의 궤적이 그려지지 않도록 함

                            ctx.beginPath();
                            ctx.arc(x, y, 10, 0, Math.PI * 2);
                            ctx.fillStyle = "#0095DD";
                            ctx.fill();
                            ctx.closePath();

                            x += dx;
                            y += dy;

                            // 캔버스 경계에서 튕기도록 처리
                            if (x + dx > canvas.width - 10 || x + dx < 10) {
                                dx = -dx;
                            }

                            if (y + dy > canvas.height - 10 || y + dy < 10) {
                                dy = -dy;
                            }
                        }
                        setInterval(draw, 10);
                    </script>

                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>
