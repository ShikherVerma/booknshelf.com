@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            @if(count($notes) == 0)
                <div class="notification">
                    <p class="title">
                        There aren't any notes here yet.</br></br>
                        When you add notes on books they appear here.
                    </p>
                </div>
            @endif
            @foreach ($notes as $note)
                <div class="columns">
                    <div class="column is-3">
                        <aside class="test" style="margin-bottom: 100px;">
                            <figure class="image is-480x480">
                                <img src="https://booknshelf.imgix.net/book-covers/{{ $note['book']['cover_image']}}">
                            </figure>
                        </aside>
                    </div>
                    <div class="column is-8">
                        <div class="notification">
                            @if($note['is_private'])
                                <nav class="level" style="margin-bottom: 10px;">
                                    <div class="level-left" >
                                        <div class="level-item">
                                            <p class="subtitle is-5">
                                                <span class="tag is-warning is-medium">Only visible to you</span >
                                            </p>
                                        </div>
                                    </div>
                                </nav>
                            @endif
                            {{ $note['text'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
