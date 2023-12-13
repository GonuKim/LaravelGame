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

                    <form action="/posts/{{$post->id}}" method="post" class="mb-4">
                        @csrf
                        @method("PUT")
                        <div class="mb-3">
                            <label for="title" class="form-label">제목:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">내용:</label>
                            <textarea class="form-control" id="content" name="content" style="width: 300px; height: 230px;">{{$post->content}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="form-label">작성자:</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{$post->user_id}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="created_at" class="form-label">생성일:</label>
                            <p class="form-control-static">{{$post->created_at}}</p>
                        </div>
                        <div class="mb-3">
                            <label for="updated_at" class="form-label">수정일:</label>
                            <p class="form-control-static">{{$post->updated_at}}</p>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">수정</button>
                    </form>
                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
