@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg mb-6 ">

        <form action="{{route('posts')}}" method="post">
            @csrf
            <label for="body" class="sr-only">Body</label>
            <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>

            @error('body')

            <div class="text-red-500 mt-2 text-sm">
                {{ $message }}

            </div>
            @enderror

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
            </div>

        </form>
        @if ($posts->count())
        @foreach ($posts as $post)
        <div class="mb-4">
            <a href="" class="font-bold">{{$post->user->name}}</a>
            <span class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span>
            <p class="mb-2">{{$post->body}}</p>


            @if($post->ownedBy(auth()->user()))
            <div>
                <form action="{{route('posts.destroy',$post)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500 ">Delete</button>
                </form>
            </div>

            <div>
                <form method="get" action="{{route('posts.edite',$post)}}">
                    <button type="submit" class="text-blue-500 ">Modifier</button>
                </form>
            </div>
            @endif


            @endforeach
            {{$posts->links()}}
            @else
            <p>There are no posts</p>
            @endif



        </div>
    </div>
    @endsection
