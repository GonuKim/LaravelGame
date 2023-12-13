<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ranking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-2xl mb-4">공튀기기 게임 랭킹</h3>
                <div class="row">
                    @php $rank = 1; @endphp
                    @foreach($games->where('game_name', 'ballGame')->sortByDesc('point')->take(3) as $game)
                        <div class="col-md-4 mb-4">
                            <div class="card border-success">
                                <div class="card-body">
                                    <h5 class="card-title text-success">{{ $rank }}등</h5>
                                    <p class="card-text"><strong>이름:</strong> {{ $game->user->name }}</p>
                                    <p class="card-text"><strong>점수:</strong> {{ $game->point }}</p>
                                </div>
                            </div>
                        </div>
                        @php $rank++; @endphp
                    @endforeach
                </div>

                <hr/>

                <h3 class="text-2xl mb-4">카드 게임 랭킹</h3>
                <div class="row">
                    @php $rank = 1; @endphp
                    @foreach($games->where('game_name', 'cardGame')->sortBy('point')->take(3) as $game)
                        <div class="col-md-4 mb-4">
                            <div class="card border-success">
                                <div class="card-body">
                                    <h5 class="card-title text-success">{{ $rank }}등</h5>
                                    <p class="card-text"><strong>이름:</strong> {{ $game->user->name }}</p>
                                    <p class="card-text"><strong>횟수:</strong> {{ $game->point }}</p>
                                </div>
                            </div>
                        </div>
                        @php $rank++; @endphp
                    @endforeach
                </div>

                <hr/>

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <h3 class="text-2xl mb-4">{{ $user->name }}님의 기록</h3>
            
                            <div class="card mb-3">
                                <div class="card-header bg-success text-white">
                                    공튀기기 최고 점수
                                </div>
                                <div class="card-body">
                                    <p class="card-text">최고 점수: {{ $user->games->where('game_name', 'ballGame')->max('point') }}</p>
                                </div>
                            </div>
            
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    카드게임 최저 횟수
                                </div>
                                <div class="card-body">
                                    <p class="card-text">최저 횟수: {{ $user->games->where('game_name', 'cardGame')->max('point') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
