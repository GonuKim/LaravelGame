<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Community') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="/community" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">제목:</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">내용:</label>
                            <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">등록</button>
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>