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
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">제목: {{$post->title}}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">내용: {{$post->content}}</p>
                        <p class="card-text">작성자: {{$post->user->name}}</p>
                        <p class="card-text">생성일: {{$post->created_at}}</p>
                        <p class="card-text">수정일: {{$post->updated_at}}</p>
                    </div>
                    <div class="card-footer">
                        <form style="display: inline-block" action="/posts/{{$post->id}}/edit">
                            @csrf
                            <button type="submit" class="btn btn-warning">수정</button>
                        </form>
                        <form style="display: inline-block" action="/posts/{{$post->id}}" method="post" onsubmit="return confirm('삭제하시겠습니까?')">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger">삭제</button>
                        </form>
                        <a href="/community" class="btn btn-secondary">돌아가기</a>
                    </div>
                    <hr>
                    <!-- 댓글 등록 폼 -->
                    <h4>댓글 등록</h4>
                    <form action="/posts/{{$post->id}}/comments" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea class="form-control" rows="3" name="text" placeholder="댓글을 입력하세요"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">댓글 등록</button>
                    </form>

                    <hr/>
                    <!-- 댓글 목록 -->
                    <div>
                        <h4>댓글 목록</h4>
                        @foreach($post->comments as $comment)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">#{{$loop->index+1}}</h6>
                                    <textarea class="form-control mb-2" name="text" rows="2" readonly>{{$comment->text}}</textarea>
                                    <p class="card-text">작성자: {{$comment->user->name}}</p>
                                    <p class="card-text">작성일: {{$comment->created_at}}</p>
                                    <form action="{{$post->id}}/comments/{{$comment->id}}" method="POST" onsubmit="return send_delete()" class="d-inline">
                                        <button type="submit" class="btn btn-danger btn-sm">삭제</button>
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    

                    
                    
                    
                     
                    <script type="text/javascript">
                    function send_delete(num) {
                        return confirm("삭제하시겠습니까?");
                    }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
