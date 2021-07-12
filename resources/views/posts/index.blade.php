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
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium mb-10">Post</button>
            </div>

        </form>



        @if ($posts->count())
        @foreach ($posts as $post)

        <div class="mb-4">
            <div class="hover:bg-light-blue-500 hover:border-transparent hover:shadow-lg group block rounded-lg p-4 border border-gray-200 mt-3 mb-6">
                <a href="" class="font-bold">{{$post->user->name}}</a>
                <span class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span>
                <p class="mb-2">{{$post->body}}</p>


                @auth

                @if($post->ownedBy(auth()->user()) || auth()->user()->is_admin === 1)
                <div>
                    <div>
                        <form action="{{route('posts.destroy',$post)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-4 py-2 rounded font-medium mb-3" type="submit">Delete</button>
                        </form>
                    </div>
                    @elseif( $post->ownedBy(auth()->user()) )
                    <div>
                        <form method="get" action="{{route('posts.edite',$post)}}">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium mb-6 mx-3">Modifier</button>
                        </form>
                    </div>
                </div>

                @endif
                @endauth
                <!-- divv ajouter pour comeeeent -->

                <div>
                    <form action="{{route('comments')}}" method="post">
                        @csrf
                        <textarea name="corp" cols="10" rows="2" class="bg-gray-100 border-2 w-full p-2 rounded-lg  border-black-500 " placeholder="Post something!"></textarea>
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Comments</button>
                        </div>

                    </form>


                </div>
            </div>

            <!-- ennnnnnnnnnnnnnnnnnnnnnnnd -->
            @endforeach
            {{$posts->links()}}
            @else
            <p>There are no posts</p>
            @endif



        </div>
    </div>
    @endsection
