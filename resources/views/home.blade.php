@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <book-save-modal :user="user" :book="bookSaveModalBook" :show="bookSaveModal"></book-save-modal>
    @endif
    <section class="hero is-medium home-search-bg" style="background-image: url('/img/giulia-bertelli-104575-resized.jpg')">
        <div class="hero-body home-search-body">
            <div class="container has-text-centered">
                <h3 class="title is-3 primary-span-home">
                    Discover great books and bookshelves on different topics
                </h3>
                <div class="columns">
                    <div class="column is-offset-one-quarter is-half">
                        <form role="form" method="GET" action="{{ url('/books/search') }}">
                            <p class="control has-icon">
                                <input class="input is-large" type="text" value="{{ $q or '' }}" name="q"
                                       placeholder="Search for great books ...">
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

                <p class="title has-text-centered">
                    Find your next read from our curated topics
                </p>
                <p class="subtitle has-text-centered">
                    We've handpicked the topics that are most likely
                    to interest you. We add more topics as our community suggests.
                </p>
            </div>
            <div class="column is-4 has-text-centered">
                <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="heroicon-folder-plus heroicon heroicon-lg">
                    <path class="heroicon-folder-plus-tab-heroicon-component-accent-heroicon-component-fill" fill="#7ACFC0" d="M0 7.003C0 4.793 1.792 3 3.993 3H45l10 10h41.007c2.205 0 3.993 1.797 3.993 3.993v4.004L0 21V7.003z"></path>
                    <rect class="heroicon-folder-plus-cover-heroicon-component-fill" fill="#ffffff" y="19" width="100" height="64" rx="4"></rect>
                    <circle class="heroicon-folder-plus-circle-heroicon-component-accent-heroicon-component-fill" fill="#7ACFC0" cx="82" cy="82" r="18"></circle>
                    <path class="heroicon-folder-plus-symbol-heroicon-component-fill" fill="#ffffff" d="M84 80v-7h-4v7h-7v4h7v7h4v-7h7v-4z"></path>
                    <path class="heroicon-shadows" fill="#000000" d="M100 21.003C100 18.795 98.21 17 96.003 17H3.997C1.8 17 0 18.792 0 21.003v2C0 20.793 1.8 19 3.997 19h92.006C98.21 19 100 20.795 100 23.003v-2z" opacity=".2"></path>
                    <path class="heroicon-outline" fill="#4A4A4A" fill-rule="nonzero" d="M55 13h41c2.21 0 4 1.79 4 4v62c0 .33-.04.65-.115.954.076.672.115 1.354.115 2.046 0 9.94-8.06 18-18 18-9.606 0-17.454-7.524-17.973-17H4c-2.21 0-4-1.79-4-4V7c0-2.21 1.79-4 4-4h41l10 10zm43 10.535V23c0-1.105-.895-2-2-2H4c-1.105 0-2 .895-2 2v.535c.588-.34 1.27-.535 2-.535h92c.73 0 1.412.195 2 .535zm-96 1.23V79c0 1.105.895 2 2 2h60.027c.52-9.476 8.367-17 17.973-17 6.966 0 13.007 3.957 16 9.746V24.764c-.53-.475-1.232-.764-2-.764H4c-.768 0-1.47.29-2 .764zM4 19h92c.73 0 1.412.195 2 .535V17c0-1.105-.895-2-2-2H54.172l-.586-.586L44.172 5H4c-1.105 0-2 .895-2 2v12.535c.588-.34 1.27-.535 2-.535zm94 63c0-8.837-7.163-16-16-16s-16 7.163-16 16 7.163 16 16 16 16-7.163 16-16zM42 9v1H6V9h36zM6 14h32v1H6v-1zm62.962 73.11C68.342 85.53 68 83.805 68 82c0-7.732 6.268-14 14-14v1c-7.18 0-13 5.82-13 13 0 1.652.308 3.232.87 4.686l-.908.425zM80 80v-7h4v7h7v4h-7v7h-4v-7h-7v-4h7zm1 0v1h-7v2h7v7h2v-7h7v-2h-7v-7h-2v6z"></path>
                </svg>

                <p class="title has-text-centered">
                    Easily organize books in shelves
                </p>
                <p class="subtitle has-text-centered">
                    You can create your reading journey by storing the books you've read or going to read.
                    Staying organized is nice, isn't it?
                </p>

            </div>
            <div class="column is-4 has-text-centered">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" class="heroicon-couple2 heroicon heroicons-lg">
                    <path class="heroicon-couple2-male-top heroicon-component-accent heroicon-component-fill" fill="#7ACFC0" d="M44 92V80c0-1.3.37-2.69 1-3.98V71h1v3.33a9.53 9.53 0 0 1 3.37-3.01L54 69c0-2.56-1.97-5.75-4.26-6.9L36 55.25V64c0 3.32-1.9 4.1-4.25 1.75L28 62l-3.75 3.75C21.9 68.1 20 67.32 20 64v-8.76L6.26 62.1C3.98 63.25 2 66.45 2 69v23h8V71h1v21h33z"></path>
                    <path class="heroicon-couple2-male-collar heroicon-component-accent heroicon-component-fill" fill="#7ACFC0" d="M35 55v9c0 2.43-.82 2.77-2.54 1.05l-3.75-3.76L35 55zm-7.7 6.3l-3.76 3.75C21.82 66.77 21 66.43 21 64v-9l6.3 6.3z"></path>
                    <path class="heroicon-couple2-male-hair heroicon-component-fill" fill="#FFFFFF" d="M12 17v10.13a4 4 0 0 1 1-.13v-9.42c.61.27 1.29.42 2 .42h28v9a4 4 0 0 1 1 .13V15.99a4.99 4.99 0 0 0-2.7-4.43l-.57-.3-.29-.56A5 5 0 0 0 36 8H15a5 5 0 0 0-3 9z"></path>
                    <path class="heroicon-couple2-male-face heroicon-component-fill" fill="#FFFFFF" d="M41 34v3a13 13 0 0 1-7 11.54v4.63l-6 6-6-6v-4.63A13 13 0 0 1 15 37V34h-2a3 3 0 1 1 0-6h2v-8h26v8h2a3 3 0 1 1 0 6h-2z"></path>
                    <path class="heroicon-couple2-male-mouth heroicon-component-fill" fill="#FFFFFF" d="M28 45a5 5 0 0 1-4-2h8a5 5 0 0 1-4 2z"></path>
                    <path class="heroicon-couple2-male-teeth heroicon-component-fill" fill="#FFFFFF" d="M23.1 41c.07.35.18.68.32 1h9.16c.14-.32.25-.65.32-1h-9.8z"></path>
                    <path class="heroicon-couple2-female-top heroicon-component-accent heroicon-component-fill" fill="#7ACFC0" d="M59.72 71.29a4.01 4.01 0 0 1-1.55-2.14l-7.91 3.96C47.98 74.25 46 77.45 46 80V92h6v-7h1v7h38v-7h1v7h6V80a8.64 8.64 0 0 0-4.26-6.9l-7.9-3.95a4 4 0 0 1-1.56 2.14 4 4 0 0 1-3.3 5.7 4 4 0 0 1-5.7 3.29 4 4 0 0 1-6.57 0 4 4 0 0 1-5.7-3.3 4 4 0 0 1-3.29-5.7z"></path>
                    <path class="heroicon-couple2-female-collar heroicon-component-accent heroicon-component-fill" fill="#7ACFC0" d="M80 66.24l4.92 2.46a3 3 0 0 1-1.21 1.77l-.7.48.36.77a3 3 0 0 1-2.47 4.27l-.84.07-.07.85a3 3 0 0 1-4.27 2.46l-.77-.36-.48.7a3 3 0 0 1-4.94 0l-.48-.7-.77.36a3 3 0 0 1-4.27-2.47l-.07-.84-.85-.07a3 3 0 0 1-2.46-4.27l.36-.77-.7-.48a3 3 0 0 1-1.2-1.77L64 66.24V68a8 8 0 1 0 16 0v-1.76z"></path>
                    <path class="heroicon-couple2-female-hair heroicon-component-fill" fill="#FFFFFF" d="M92 53a14 14 0 0 1-8.37 12.82L80 64v-.3c4.2-2.66 7-7.35 7-12.7a4 4 0 0 0 0-8v-5c-6.1 0-11.52-2.87-15-7.34A18.97 18.97 0 0 1 57 38v5a4 4 0 0 0 0 8 15 15 0 0 0 7.28 12.86L64 63.7V64l-3.63 1.82A14 14 0 0 1 52 53V34a13 13 0 0 1 19.07-11.5l.93.5.93-.5A13 13 0 0 1 92 34v19z"></path>
                    <path class="heroicon-couple2-female-face heroicon-component-fill" fill="#FFFFFF" d="M85 50v1a13 13 0 0 1-7 11.54V68a6 6 0 0 1-12 0v-5.47A13 13 0 0 1 59 51v-1h-2a3 3 0 1 1 0-6h2v-4.1c4.98-.47 9.56-2.69 13-6.2a20.94 20.94 0 0 0 13 6.2V44h2a3 3 0 1 1 0 6h-2z"></path>
                    <path class="heroicon-couple2-female-mouth heroicon-component-fill" fill="#FFFFFF" d="M72 59a4 4 0 0 1-3.47-2h6.94A4 4 0 0 1 72 59z"></path>
                    <path class="heroicon-shadows" fill="#000000" d="M85 39.9v2a20.94 20.94 0 0 1-13-6.2 20.94 20.94 0 0 1-13 6.2v-2c4.98-.47 9.56-2.69 13-6.2a20.94 20.94 0 0 0 13 6.2zM12 19h30v3H12v-3zm69.8 45.9l3.95 1.97A20.92 20.92 0 0 1 72 72a20.92 20.92 0 0 1-13.75-5.13l3.96-1.97A16.98 16.98 0 0 1 55 51v-.53c.59.34 1.27.53 2 .53a15 15 0 0 0 30 0c.73 0 1.41-.2 2-.53V51c0 5.74-2.85 10.82-7.2 13.9zM36 49.7V53l3.35 1.67A20.9 20.9 0 0 1 28 58a20.9 20.9 0 0 1-11.35-3.33L20 53v-3.3a14.93 14.93 0 0 0 8 2.3c2.94 0 5.68-.85 8-2.3z" opacity=".2"></path>
                    <path class="heroicon-outline" fill="#4A4A4A" fill-rule="nonzero" d="M43 35v2c0 5.35-2.8 10.04-7 12.7V53l14.63 7.32c.68.34 1.33.8 1.93 1.35A15.92 15.92 0 0 1 50 53V34a15 15 0 0 1 22-13.27A15 15 0 0 1 94 34v19a16 16 0 0 1-8.13 13.93l8.76 4.39C97.6 72.8 100 76.68 100 80v14H0V69c0-3.32 2.41-7.2 5.37-8.68L20 53v-3.3c-4.2-2.67-7-7.35-7-12.7v-2a4 4 0 0 1-3-6.65V17.9A7 7 0 0 1 15 6h21a7 7 0 0 1 6.21 3.78A6.99 6.99 0 0 1 46 15.99v12.36A4 4 0 0 1 43 35zm1 57V80c0-1.3.37-2.69 1-3.98V71h1v3.33a9.53 9.53 0 0 1 3.37-3.01L54 69c0-2.56-1.97-5.75-4.26-6.9L36 55.25V64c0 3.32-1.9 4.1-4.25 1.75L28 62l-3.75 3.75C21.9 68.1 20 67.32 20 64v-8.76L6.26 62.1C3.98 63.25 2 66.45 2 69v23h8V71h1v21h33zm11.94-23.97l2.2-1.1a16.07 16.07 0 0 1-3.59-2.76 10.38 10.38 0 0 1 1.39 3.86zM13 27v-7.29c-.35-.1-.68-.23-1-.38v7.8a4 4 0 0 1 1-.13zm28-7H15v17a13 13 0 0 0 26 0V20zm2 13a2 2 0 1 0 0-4v4zm1-5.87V15.99a4.99 4.99 0 0 0-2.7-4.43l-.57-.3-.29-.56A5 5 0 0 0 36 8H15a5 5 0 0 0 0 10h28v9a4 4 0 0 1 1 .13zM13 29a2 2 0 1 0 0 4v-4zm9 24.17l6 6 6-6v-2.42a14.96 14.96 0 0 1-12 0v2.42zM35 55l-6.3 6.3 3.76 3.75C34.18 66.77 35 66.43 35 64v-9zm-7.7 6.3L21 55v9c0 2.43.82 2.77 2.54 1.05l3.75-3.76zM92 53V34a13 13 0 0 0-19.07-11.5L72 23l-.93-.5A13 13 0 0 0 52 34v19a14 14 0 0 0 8.37 12.82L64 64v-.3l.28.16A15 15 0 0 1 57 51a4 4 0 0 1 0-8v-5c6.1 0 11.52-2.87 15-7.34A18.97 18.97 0 0 0 87 38v5a4 4 0 0 1 0 8c0 5.35-2.8 10.04-7 12.7v.3l3.63 1.82A14 14 0 0 0 92 53zm-7-4v-9.1a20.94 20.94 0 0 1-13-6.2 20.94 20.94 0 0 1-13 6.2V51a13 13 0 0 0 26 0v-2zm4-2a2 2 0 0 0-2-2v4a2 2 0 0 0 2-2zm-34 0c0 1.1.9 2 2 2v-4a2 2 0 0 0-2 2zm10.34 17.45l.66.3V68a6 6 0 0 0 12 0v-3.25a14.95 14.95 0 0 1-12.66-.3zM80 66.24V68a8 8 0 1 1-16 0v-1.76l-4.92 2.46a3 3 0 0 0 1.21 1.77l.7.48-.36.77a3 3 0 0 0 2.46 4.27l.85.07.07.84a3 3 0 0 0 4.27 2.47l.77-.36.48.7a3 3 0 0 0 4.94 0l.48-.7.77.36a3 3 0 0 0 4.27-2.46l.07-.85.84-.07a3 3 0 0 0 2.47-4.27l-.36-.77.7-.48a3 3 0 0 0 1.2-1.77L80 66.24zm-20.28 5.05a4.01 4.01 0 0 1-1.55-2.14l-7.91 3.96C47.98 74.25 46 77.45 46 80V92h6v-7h1v7h38v-7h1v7h6V80a8.64 8.64 0 0 0-4.26-6.9l-7.9-3.95a4 4 0 0 1-1.56 2.14 4 4 0 0 1-3.3 5.7 4 4 0 0 1-5.7 3.29 4 4 0 0 1-6.57 0 4 4 0 0 1-5.7-3.3 4 4 0 0 1-3.29-5.7zM67.1 56H76.9a4.96 4.96 0 0 1-4.9 4 5 5 0 0 1-4.9-4zm4.9 3a4 4 0 0 0 3.47-2h-6.94A4 4 0 0 0 72 59zm6-11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0-6a5 5 0 0 1 4.47 2.76l-.9.45A4 4 0 0 0 78 43v-1zm-12 0v1a4 4 0 0 0-3.58 2.21l-.9-.45A5 5 0 0 1 66 42zm1 5a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm2.78 5.33l.56-.83a2.99 2.99 0 0 0 3.32 0l.56.83a3.98 3.98 0 0 1-4.44 0zM79 23a11 11 0 0 1 9.84 6.08l-.9.45A10 10 0 0 0 79 24v-1zm-23.84 6.08A11 11 0 0 1 65 23v1a10 10 0 0 0-8.95 5.53l-.9-.45zM18 9h15v1H18V9zm4.08 32a6.05 6.05 0 0 1-.08-1h12a6 6 0 0 1-11.92 1zM28 45a5 5 0 0 0 4-2h-8a5 5 0 0 0 4 2zm-4.9-4c.07.35.18.68.32 1h9.16c.14-.32.25-.65.32-1h-9.8zM35 31a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1-5a5 5 0 0 1 4.47 2.76l-.9.45a4 4 0 0 0-4.84-2l-.31-.95A5 5 0 0 1 34 26zm-8.22 10.33l.56-.83a2.99 2.99 0 0 0 3.32 0l.56.83a3.98 3.98 0 0 1-4.44 0zM23 31a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm.58-4.74l-.31.94a4 4 0 0 0-4.85 2.01l-.9-.45a5 5 0 0 1 6.06-2.5zM29 87a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm0-8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm0-8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                </svg>


                <p class="title has-text-centered">
                    Connect with friends and other readers
                </p>
                <p class="subtitle has-text-centered">
                    Connect your social accounts to see what your friends are reading. Find other readers with common
                    reading interests.
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

    <home-books-section :books="{{ $featuredBooks }}" :user="user" :likes="userLikedBooks"
                        :saves="userSavedBooks" title="Our Weekly Featured Books"></home-books-section>


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

    <section id="favorite-shelves" class="section is-primary is-bold" v-cloak>
        <div class="container">
            <div class="notification" style="background-color: hsla(171, 100%, 36%, 1); color: white;">
                <div class="title is-4">
                    <strong>Explore Our Favorite Bookshelves</strong>
                </div>
            </div>
            <div class="columns is-multiline">
                @foreach ($shelves as $shelf)
                    <div class="column is-3">
                        <a href="{{ route('shelf_path', ['username' => $shelf['user']['username'], 'shelf_slig' =>$shelf['slug']]) }}">
                            <div class="box shelf-item hvr-float"
                                 style="background-image: url({{ $shelf['cover'] or '' }})"></div>
                        </a>
                        <h2 class="title">{{ $shelf['name'] }}</h2>
                        <p class="subtitle">{{ count($shelf['books']) }} books</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


@endsection
