@extends('layout')

@section('content')
        <div id="wrapper">
            <div id="page" class="container">

                @foreach($articles as $article)
                <div id="content">
                    <div class="title">
                        <h2>
                        {{-- <a href="/articles/{{ $article->id }}">--}}
                        {{-- Usind named route. Second argument - get the ID(wildecard "{article}") --}}
                            <a href="{{ route('articles.show', $article) }}">
                                {{ $article->title }}
                            </a>
                        </h2>
                    </div>
                    <p>
                        <img src="/images/banner.jpg" alt="" class="image image-full" />
                    </p>
                    {{ $article->body }}
                </div>
                @endforeach

            </div>
        </div>
@endsection
