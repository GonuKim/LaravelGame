<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex">

                <div class="card m-3" style="width: 18rem;" onclick="window.location.href = 'game/ballGame'">
                    <div class="card-body">
                        <h5 class="card-title">공튀기기 게임</h5>
                        <p class="card-text">클릭하여 플레이</p>
                    </div>
                </div>

                <div class="card m-3" style="width: 18rem;" onclick="window.location.href = 'game/cardGame'">
                    <div class="card-body">
                        <h5 class="card-title">카드 게임</h5>
                        <p class="card-text">클릭하여 플레이</p>
                    </div>
                </div>

                <div class="card m-3" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">게임3</h5>
                        <p class="card-text">게임3 설명</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
