@extends('layouts.app')

@section('content')
<section class="jumbotron text-xs-center">
  <div class="container">
    <div id="apptest"></div>
    <h3 class="jumbotron-heading">Welcome to Booknshelf 👋</h3>
    <p class="lead text-muted">Easily create and share bookshelves with everyone and everywhere on the web.</p>
    <p>
      <a href="#" class="btn btn-primary">Try it now for free 🚀</a>
    </p>
  </div>
</section>


<section class="jumbotron text-xs-left">
  <div class="container max-width-1000">
    <h3 class="jumbotron-heading text-xs-center">How this works?</h3>
      <div class="card text-xs-center">
        <div class="card-header">
          Step 1
        </div>
        <div class="card-block">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        </div>
      </div>
      <div class="card text-xs-center">
        <div class="card-header">
          Step 2
        </div>
        <div class="card-block">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        </div>
      </div>
      <div class="card text-xs-center">
        <div class="card-header">
          Step 3
        </div>
        <div class="card-block">
          <h4 class="card-title">Special title treatment</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        </div>
      </div>
  </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
              <h1>Jumbotron heading</h1>
              <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
              <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Go!</button>
                </span>
              </div><!-- /input-group -->
            </div>
        </div>
    </div>
</div>
<!-- Portfolio Grid Section -->
<section id="portfolio" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Portfolio</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
        </div>
        <div class="row">
            <topic-card></topic-card>
            <!-- esentially topic-card-modal can live inside topic-card component -->
            <topic-card-modal></topic-card-modal>
        </div>
    </div>
</section>
@endsection
