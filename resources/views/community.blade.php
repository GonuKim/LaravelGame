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

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">번호</th>
                                    <th scope="col">제목</th>
                                    <th scope="col">작성자</th>
                                    <th scope="col">작성일</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <th scope="row">{{$loop->index+1}}</th>
                                    <td><a href="/posts/{{$post->id}}" style="text-decoration: none">{{$post->title}}</a></td>
                                    <td>{{$post->user->name}}</td>
                                    <td>{{$post->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 

                    <div class="mb-4">
                        <a href="/posts/create" class="btn btn-primary">글 작성</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
