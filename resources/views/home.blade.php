@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <book-save-modal :user="user" :book="bookSaveModalBook" :show="bookSaveModal"></book-save-modal>
    @endif
    <section class="hero is-medium home-search-bg" style="background-image: url('/img/giulia-bertelli-104575-resized.jpg')">
        <div class="hero-body home-search-body">
            <div class="container has-text-centered">
                <h3 class="title is-3 primary-span-home">
                    Stay organized with your books & read more
                </h3>
                <div class="columns">
                    <div class="column is-offset-one-quarter is-half">
                        <form role="form" method="GET" action="{{ url('/books/search') }}">
                            <p class="control has-icon">
                                <input class="input is-large" type="text" value="{{ $q or '' }}" name="q"
                                       placeholder="Search books here to add them to your shelves ...">
                                <span class="icon">
                                    <i class="fa fa-search"></i>
                                </span>
                            </p>
                            <input type="submit" style="display: none;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="columns">
            <div class="column is-4 has-text-centered">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" class="heroicon-magnify heroicon heroicons-lg">
                    <path class="heroicon-magnify-glass-edge heroicon-component-accent heroicon-component-fill" fill="#7ACFC0" d="M70 36a34 34 0 1 1-68 0 34 34 0 0 1 68 0z"></path>
                    <path class="heroicon-magnify-glass heroicon-component-fill" fill="#FFFFFF" d="M61 36a25 25 0 1 1-50 0 25 25 0 0 1 50 0z"></path>
                    <polygon class="heroicon-magnify-handle heroicon-component-fill" fill="#FFFFFF" points="94.879 87.707 75.293 68.121 68.121 75.293 87.707 94.879"></polygon>
                    <path class="heroicon-magnify-handle-connector heroicon-component-fill" fill="#FFFFFF" d="M63.92 58.73L65.16 60 60 65.17l-1.26-1.26a36.22 36.22 0 0 0 5.18-5.18zm-.5 5.86l1.17-1.18 4 4-1.18 1.18-4-4z"></path>
                    <path class="heroicon-magnify-handle-edge heroicon-component-accent heroicon-component-fill" fill="#7ACFC0" d="M90 97.17l-1.59-1.58 7.18-7.18L97.17 90 90 97.17zM73 65.83l1.59 1.58-7.18 7.18L65.83 73 73 65.83z"></path>
                    <path class="heroicon-shadows" fill="#000000" d="M6.04 37.5a30 30 0 1 1 59.93 0 30 30 0 0 0-59.93 0z" opacity=".2"></path>
                    <path class="heroicon-outline" fill="#4A4A4A" fill-rule="nonzero" d="M65.14 57.14l1.45 1.45L68 60l-1.41 1.41L66 62l4 4 1.59-1.59L73 63l1.41 1.41L76 66l.7.7 19.6 19.6.7.7 1.59 1.59L100 90l-1.41 1.41-7.18 7.18L90 100l-1.41-1.41L87 97l-.7-.7-19.6-19.6-.7-.7-1.59-1.59L63 73l1.41-1.41L66 70l-4-4-.59.59L60 68l-1.41-1.41-1.45-1.45h.01a36 36 0 1 1 8-8zM70 36a34 34 0 1 0-68 0 34 34 0 0 0 68 0zm-6.08 22.73a36.22 36.22 0 0 1-5.18 5.18L60 65.17 65.17 60l-1.26-1.26zm-.5 5.86l4 4 1.17-1.18-4-4-1.18 1.18zM90 97.17L97.17 90l-1.58-1.59-7.18 7.18L90 97.17zm4.88-9.46L75.29 68.12l-7.17 7.17 19.59 19.59 7.17-7.17zM73 65.83L65.83 73l1.58 1.59 7.18-7.18L73 65.83zM66 36a30 30 0 1 1-60 0 30 30 0 0 1 60 0zM36 65a29 29 0 1 0 0-58 29 29 0 0 0 0 58zm0-2a27 27 0 1 1 0-54 27 27 0 0 1 0 54zm25-27a25 25 0 1 0-50 0 25 25 0 0 0 50 0zM36 15v1a20 20 0 0 0-17.9 28.95l-.89.44A21 21 0 0 1 36 15zm37.65 61.35l.7-.7 14 14-.7.7-14-14z"></path>
                </svg>

                <p class="title has-text-centered" style="margin-top: 6px;">
                    Search for books or discover from our curated topics
                </p>
                <p class="subtitle has-text-centered" style="margin-top: -0.5rem;">
                    We've handpicked the topics that are most likely
                    to interest you. We add more topics from our readers' suggestions.
                </p>
            </div>
            <div class="column is-4 has-text-centered">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" class="heroicon-book heroicon heroicons-lg">
                    <path class="heroicon-book-cover heroicon-component-fill" fill="#FFFFFF" d="M89 75H15v10h10v4h-9a5 5 0 0 1-5-5V6a5 5 0 0 1 5-5h73v74zM39 85h50v4H39v-4z"></path>
                    <path class="heroicon-book-binding heroicon-component-accent heroicon-component-fill" fill="#7ACFC0" d="M25 71V1h-9a5 5 0 0 0-5 5v69l4-4h10z"></path>
                    <rect class="heroicon-book-pages heroicon-component-fill" width="72" height="10" x="15" y="75" fill="#FFFFFF"></rect>
                    <polygon class="heroicon-book-bookmark heroicon-component-accent heroicon-component-fill" fill="#7ACFC0" points="24 77 40 77 40 99 32 95 24 99"></polygon>
                    <path class="heroicon-shadows" fill="#000000" d="M11 75.99A4.99 4.99 0 0 1 16 71h73v4h-2v10h2v4H39v-7H25v7h-9a5 5 0 0 1-5-4.99v-8.02z" opacity=".2"></path>
                    <path class="heroicon-outline" fill="#4A4A4A" fill-rule="nonzero" d="M24 90h-8a6 6 0 0 1-6-6V6A6 6 0 0 1 16 0h74v76h-2v8h2v6H40v10l-8-4-8 4V90zM88 2H20v66h-1V2h-2v66h-1V2a4 4 0 0 0-4 4.01v65.52A5.97 5.97 0 0 1 16 70h72V2zM16 72a4 4 0 0 0-4 4V84A4 4 0 0 0 16 88h8v-2h-8a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h72v-2H16zm24 16h48v-2H40v2zm0-4h46v-1H40v1zm0-2h46v-1H58v-1h28v-2H40v4zm-2-4H26v18.76l6-3 6 3V78zm-14 0h-6v-1h68v-1H16v8h8v-6zm0-76h2v68h-2V2zm18 18h31v2H41v-2h1zm3 5h24v2H45v-2z"></path>
                </svg>
                <p class="title has-text-centered" style="margin-top: 6px;">
                    Easily organize books in shelves
                </p>
                <p class="subtitle has-text-centered" style="margin-top: -0.5rem;">
                    You can create your reading journey by storing the books you've read or going to read.
                    Staying organized is nice, isn't it?
                </p>

            </div>
            <div class="column is-4 has-text-centered">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" class="heroicon-couple1 heroicon heroicons-lg">
                    <path class="heroicon-couple1-male-top heroicon-component-accent heroicon-component-fill" fill="#7ACFC0" d="M55.94 69.03c-.4-3.07-2.63-6.37-5.3-7.71L36 54v4a8 8 0 1 1-16 0v-4L5.37 61.32C2.4 62.79 0 66.68 0 70v25h50-6V81c0-3.31 2.41-7.2 5.37-8.68l6.57-3.29z"></path>
                    <path class="heroicon-couple1-male-collar heroicon-component-accent heroicon-component-fill" fill="#7ACFC0" d="M18 57.24l2-1V58a8 8 0 1 0 16 0v-1.76l2 1V58a10 10 0 1 1-20 0v-.76z"></path>
                    <path class="heroicon-couple1-male-face heroicon-component-fill" fill="#FFFFFF" d="M41 35v3c0 5.02-2.84 9.37-7 11.54V58a6 6 0 0 1-12 0v-8.46c-4.16-2.17-7-6.52-7-11.53V35h-2a3 3 0 1 1 0-6h2v-7.34a5.99 5.99 0 0 0 6.42-1.6 5.48 5.48 0 0 0 6.28-.09 7.47 7.47 0 0 0 6.66.46A5 5 0 0 0 41 21v8h2a3 3 0 1 1 0 6h-2z"></path>
                    <path class="heroicon-couple1-male-mouth heroicon-component-fill" fill="#FFFFFF" d="M24 44a5 5 0 0 0 8 0h-8z"></path>
                    <path class="heroicon-couple1-male-teeth heroicon-component-fill" fill="#FFFFFF" d="M23.42 43a4.96 4.96 0 0 1-.32-1h9.8c-.07.35-.18.68-.32 1h-9.16z"></path>
                    <path class="heroicon-couple1-male-hair heroicon-component-fill" fill="#FFFFFF" d="M41.08 13.92l-.1-.76a2.5 2.5 0 0 0-2.24-2.15l-.64-.06-.21-.6a2 2 0 0 0-2.46-1.27l-.45.13-.4-.26a5.47 5.47 0 0 0-5.55-.37l-.55.28-.5-.37a2.48 2.48 0 0 0-3.54.6l-.51.74-.79-.42a3.5 3.5 0 0 0-4.94 1.93l-.25.7-.75-.03L17 12a4 4 0 0 0-3.94 3.32l-.1.6-.58.18a2 2 0 1 0 1.77 3.54l.5-.35.53.27a3.98 3.98 0 0 0 5.23-1.46l.67-1.1.9.93a3.49 3.49 0 0 0 4.96.08l.6-.6.7.51a5.47 5.47 0 0 0 5.92.4l.82-.46.5.78a3 3 0 0 0 4.57.55l.39-.36.51.11A2.51 2.51 0 0 0 44 16.5a2.5 2.5 0 0 0-2.16-2.48l-.76-.1z"></path>
                    <path class="heroicon-couple1-female-top heroicon-component-accent heroicon-component-fill" fill="#7ACFC0" d="M64.83 64.58l-15.46 7.74C46.4 73.79 44 77.69 44 81v14h56V81c0-3.32-2.4-7.2-5.37-8.68l-14.37-7.19c-.72.4-1.47.74-2.26 1.02v9.84c0 1.44-1.06 4-2.08 5.01L73 83.93 70.08 81A9.08 9.08 0 0 1 68 76v-9.85c-1.12-.4-2.18-.93-3.17-1.57z"></path>
                    <path class="heroicon-couple1-female-collar heroicon-component-accent heroicon-component-fill" fill="#7ACFC0" d="M64 67.24l.5-.25c.5-.02 1-.08 1.5-.17v9.17c0 1.98 1.27 5.03 2.66 6.43L73 86.76l4.34-4.34c1.4-1.4 2.66-4.46 2.66-6.43v-8.75l2 1v7.75c0 2.5-1.48 6.08-3.25 7.84L73 89.6l-5.75-5.76A12.88 12.88 0 0 1 64 76v-8.75z"></path>
                    <path class="heroicon-couple1-female-face heroicon-component-fill" fill="#FFFFFF" d="M60 51v1a13 13 0 0 0 8 12v12c0 1.44 1.05 3.98 2.08 5L73 83.93 75.92 81A9.11 9.11 0 0 0 78 76V64a13 13 0 0 0 8-12v-1h2a3 3 0 1 0 0-6h-2v-5h-8c-5.4 0-10.32-2.04-14.03-5.38a22.28 22.28 0 0 1-3.97 3.6V45h-2a3 3 0 1 0 0 6h2z"></path>
                    <path class="heroicon-couple1-female-mouth heroicon-component-fill" fill="#FFFFFF" d="M73 60a3.99 3.99 0 0 1-2.65-1h5.3c-.71.62-1.64 1-2.65 1z"></path>
                    <path class="heroicon-couple1-female-hair heroicon-component-fill" fill="#FFFFFF" d="M88 38H78a18.93 18.93 0 0 1-14.23-6.4A19.09 19.09 0 0 1 58 37.15V44c-.73 0-1.41.2-2 .54V36a16 16 0 0 1 32 0v2zm0 14a4 4 0 1 0 0-8v-4a8 8 0 0 1 4.8 14.4l-.8.6v1a9 9 0 0 1-11.1 8.75A14.99 14.99 0 0 0 88 52zm-30 0c0 5.27 2.72 9.9 6.83 12.58L64 65a9 9 0 0 1-7.83-13.44c.55.28 1.17.44 1.83.44z"></path>
                    <path class="heroicon-shadows" fill="#000000" d="M60 46.11v-7.88a22.28 22.28 0 0 0 3.97-3.6A20.93 20.93 0 0 0 78 40h8v7-5h-8c-5.4 0-10.32-2.04-14.03-5.38a22.28 22.28 0 0 1-3.97 3.6v5.9zM15 21.66a5.99 5.99 0 0 0 6.42-1.6 5.48 5.48 0 0 0 6.28-.09 7.47 7.47 0 0 0 6.66.46A5 5 0 0 0 41 21v2a4.98 4.98 0 0 1-6.64-.57 7.48 7.48 0 0 1-6.66-.46 5.48 5.48 0 0 1-6.28.09 5.99 5.99 0 0 1-6.42 1.6v-2zm65.26 43.47A15 15 0 0 0 88 52c.73 0 1.41-.2 2-.53V52c0 5.93-3.03 11.14-7.63 14.19l3.38 1.68A20.92 20.92 0 0 1 72 73a20.92 20.92 0 0 1-13.75-5.13l4.55-2.27A16.97 16.97 0 0 1 56 52v-.53c.59.34 1.27.53 2 .53a15 15 0 0 0 14.5 15c2.64-.1 5.1-.86 7.22-2.14l.54.27zM36 50.69V54l3.35 1.67A20.9 20.9 0 0 1 28 59a20.9 20.9 0 0 1-11.35-3.33L20 54v-3.3a14.93 14.93 0 0 0 8 2.3c2.94 0 5.68-.85 8-2.3z" opacity=".2"></path>
                    <path class="heroicon-outline" fill="#4A4A4A" fill-rule="nonzero" d="M36 7a4 4 0 0 1 3.53 2.12 4.5 4.5 0 0 1 3.28 3.07 4.5 4.5 0 0 1 .19 8.55V28a4 4 0 1 1 0 8v2c0 5.35-2.8 10.04-7 12.7V54l3 1.5 11.63 5.82c2.68 1.34 4.9 4.64 5.3 7.71l4.96-2.48a11 11 0 0 1-6.23-16.36A3.98 3.98 0 0 1 54 48V36a18 18 0 0 1 36 0v2.2A10 10 0 0 1 94 56a11 11 0 0 1-10.08 10.96l10.71 5.36C97.6 73.8 100 77.68 100 81v14H0V70c0-3.32 2.41-7.2 5.37-8.68L17 55.5l3-1.5v-3.3c-4.2-2.66-7-7.35-7-12.7v-2a4 4 0 1 1 0-8v-6a4 4 0 0 1-1.79-7.58 6 6 0 0 1 5.38-4.4 5.5 5.5 0 0 1 6.74-2.71 4.5 4.5 0 0 1 5.34-.76 7.48 7.48 0 0 1 6.67.5c.21-.03.44-.05.66-.05zm52 31v-2a16 16 0 0 0-32 0v8.54a3.98 3.98 0 0 1 2-.54v-6.84a19.1 19.1 0 0 0 5.77-5.57A18.93 18.93 0 0 0 78 38l8 .01h2zM38 22a5 5 0 0 1-3.64-1.57 7.48 7.48 0 0 1-6.66-.46 5.48 5.48 0 0 1-6.28.09 5.99 5.99 0 0 1-6.42 1.6V38a13 13 0 0 0 26 0V21c-.85.64-1.9 1-3 1zm3.08-8.08l-.1-.76a2.5 2.5 0 0 0-2.24-2.15l-.64-.06-.21-.6a2 2 0 0 0-2.46-1.27l-.45.13-.4-.26a5.47 5.47 0 0 0-5.55-.37l-.55.28-.5-.37a2.48 2.48 0 0 0-3.54.6l-.51.74-.79-.42a3.5 3.5 0 0 0-4.94 1.93l-.25.7-.75-.03L17 12a4 4 0 0 0-3.94 3.32l-.1.6-.58.18a2 2 0 1 0 1.77 3.54l.5-.35.53.27a3.98 3.98 0 0 0 5.23-1.46l.67-1.1.9.93a3.49 3.49 0 0 0 4.96.08l.6-.6.7.51a5.47 5.47 0 0 0 5.92.4l.82-.46.5.78a3 3 0 0 0 4.57.55l.39-.36.51.11A2.51 2.51 0 0 0 44 16.5a2.5 2.5 0 0 0-2.16-2.48l-.76-.1zM60 44v8a13 13 0 0 0 26 0V40h-8c-5.4 0-10.32-2.04-14.03-5.38a22.28 22.28 0 0 1-3.97 3.6V44zm28 6a2 2 0 1 0 0-4v4zm0 2c0 5.39-2.84 10.1-7.1 12.75A9.02 9.02 0 0 0 92 56v-1l.8-.6A7.98 7.98 0 0 0 88 40v4a4 4 0 1 1 0 8zm-30-6a2 2 0 1 0 0 4v-4zm0 6c-.66 0-1.28-.16-1.83-.44A9 9 0 0 0 64 65l.83-.42A14.99 14.99 0 0 1 58 52zm6 15.24v8.75c0 2.51 1.48 6.07 3.25 7.84L73 89.6l5.75-5.76A12.9 12.9 0 0 0 82 76v-7.75l-2-1v8.75c0 1.97-1.27 5.04-2.66 6.43L73 86.76l-4.34-4.34A10.95 10.95 0 0 1 66 75.99v-9.17c-.5.09-1 .15-1.5.17l-.5.25zm4 8.75c0 1.45 1.05 4 2.08 5.01L73 83.93 75.92 81A9.11 9.11 0 0 0 78 76v-9.76l-.1-.06a14.98 14.98 0 0 1-9.76.01l-.14.06v9.74zM44 93V81c0-1.3.37-2.69 1-3.98V72h1v3.33a9.53 9.53 0 0 1 3.37-3.01L54 70c0-2.56-1.97-5.75-4.26-6.9L39 57.75V58a11 11 0 0 1-22 0v-.26L6.26 63.1C3.98 64.25 2 67.45 2 70v23h8V72h1v21h33zm2-12v12h6v-7h1v7h38v-7h1v7h6V81a8.64 8.64 0 0 0-4.26-6.9L83 68.75v7.25c0 2.77-1.58 6.6-3.54 8.55L73 91l-6.46-6.46A13.85 13.85 0 0 1 63 75.99v-8.25L50.26 74.1C47.98 75.25 46 78.45 46 81zM13 30a2 2 0 1 0 0 4v-4zm30 4a2 2 0 1 0 0-4v4zM22 51.75V58a6 6 0 0 0 12 0v-6.25a14.96 14.96 0 0 1-12 0zm-4 5.49V58a10 10 0 1 0 20 0v-.76l-2-1V58a8 8 0 1 1-16 0v-1.76l-2 1zm7.17-20.41l.7-.7a3 3 0 0 0 4.25 0l.7.7a3.99 3.99 0 0 1-5.65 0zM23 32a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm.58-4.74l-.31.94a4 4 0 0 0-4.85 2.01l-.9-.45a5 5 0 0 1 6.06-2.5zM34 27a5 5 0 0 1 4.47 2.76l-.9.45a4 4 0 0 0-4.84-2l-.31-.95A5 5 0 0 1 34 27zm0 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm-11.92 9a6.05 6.05 0 0 1-.08-1h12a6 6 0 0 1-11.92 1zM24 44a5 5 0 0 0 8 0h-8zm-.58-1h9.16c.14-.32.25-.65.32-1h-9.8c.07.35.18.68.32 1zm47.36 11.33l.56-.83a2.99 2.99 0 0 0 3.32 0l.56.83a3.98 3.98 0 0 1-4.44 0zM68 48a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1-5v1a4 4 0 0 0-3.58 2.21l-.9-.45A5 5 0 0 1 67 43zm12 0a5 5 0 0 1 4.47 2.76l-.9.45A4 4 0 0 0 79 44v-1zm0 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm-10.58 9h9.16a5 5 0 0 1-9.16 0zM73 60c1.01 0 1.94-.38 2.65-1h-5.3c.71.62 1.64 1 2.65 1z"></path>
                </svg>

                <p class="title has-text-centered" style="margin-top: 6px;">
                    Connect with friends and other readers
                </p>
                <p class="subtitle has-text-centered" style="margin-top: -0.5rem;">
                    Connect your social accounts to see what your friends are reading. Find other readers with common
                    interests.
                </p>

            </div>
        </div>
      </div>
    </section>

    <section class="hero is-light">
      <div class="hero-body">
        <div class="container">
          <h1 class="title has-text-centered">
            <a class="button is-primary is-large hvr-float-shadow" href="{{ url('/auth/facebook') }}">
                <strong style="color: white;">Get started with a single click</strong>
            </a>
          </h1>
        </div>
      </div>
    </section>

    <section class="section is-primary is-fullheight is-bold" style="padding-bottom: 0px;" v-cloak>
        <div class="container">
            <div class="notification">
                <div class="title is-4">
                    <strong>Explore Our Favorite Topics</strong>
                    <a href="/topics" style="color: #00AB91;">See all ></a>
                </div>
            </div>
        </div>
    </section>

    <topics :topics="{{ $topics }}" :user="user" :user-topics="userTopics"></topics>


    <home-books-section id="favorite-books" :books="{{ $books }}" :user="user" :likes="userLikedBooks"
                        :saves="userSavedBooks" title="Explore Some of Our Favorite Books"></home-books-section>

    <div class="tile is-ancestor" style="display: none;">
        <div class="tile is-parent">
            <article class="tile is-child notification">
                <p class="title has-text-centered">Like Booknshelf? 😊</p>
                <p class="subtitle has-text-centered">Make a small donation to help me to keep the site
                    running!</span>
                <p class="has-text-centered">
                    <a class="button is-dark" href="https://paypal.me/tiggreen" target="_blank"
                       type="button" class="btn btn-bright">
                        <span class="icon">
                          <i class="fa fa-paypal"></i>
                        </span>
                        <span>MAKE A DONATION!</span>
                    </a>
                </p>
            </article>
        </div>
    </div>

@endsection
