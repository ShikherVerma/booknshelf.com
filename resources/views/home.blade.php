@extends('layouts.app')

@section('content')
    <div class="container home-container m-t-lg">
        {{--<div class="jumbotron">--}}
          {{--<h1>Theme example</h1>--}}
          {{--<p>This is a template showcasing the optional theme stylesheet included in Bootstrap. Use it as a starting point to create something more unique by building on or modifying it.</p>--}}
        {{--</div>--}}
        <div class="inner-container">
            <div class="home-hero">
                <h2>Discover great books and bookshelves on different topics.</h2>
            </div>
            <div class="home-hero subscribe-hero-text">
                <h5>Get the most popular books and bookshelves in your inbox every week!</h5>
            </div>
            <div class="home-hero">
                <form class="form-inline" method="POST"
                      action="//booknshelf.us3.list-manage.com/subscribe/post?u=a18b6a0108993df0bc58f69ca&id=7e4f46c598"
                      target="_blank">
                    <div class="form-group">
                        <input type="email" name="EMAIL" class="form-control" placeholder="Enter your email address">
                        <button type="submit" class="btn btn-pretty">SUBSCRIBE</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="inner-container topics-container">
            <div class="shelf-card hvr-grow">
                <h3>Personal Development</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card suggest-topic-card">
                <h3>
                    <p class="text-center">Help me by suggesting a topic you would like to see in here.</p>
                    <a href="https://goo.gl/forms/CcCU1KSpmqFJeHzB3" type="button" target="_blank"
                       class="btn btn-bright">SUGGEST YOUR TOPIC</a>
                </h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card donation-card">
                <div class="donate-content">
                    <p class="text-center">Like Booknshelf? 😊😍</p>
                    <span class="text-muted">Make a small donation to help me to keep the site running!</span>
                    <p>
                        <a href="https://paypal.me/tiggreen" target="_blank"
                           type="button" class="btn btn-bright">MAKE A DONATION!</a>
                    </p>
                </div>


            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
            <div class="shelf-card hvr-grow">
                <h3>My card</h3>
            </div>
        </div>
    </div>
@endsection
