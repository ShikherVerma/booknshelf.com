@extends('layouts.app')

@section('content')

@if (!Auth::check())
    @include('landing.welcome-message')
@endif

<div class="container max-width-1000">
    <div class="row">
        <div class="col-md-9">
            <div id="fh5co-board" data-columns>
                <div class="item animate-box">
                    <div>
                        <a href="images/img_1.jpg" class="image-popup fh5co-board-img" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, eos?"><img src="images/img_1.jpg" alt="Free HTML5 Bootstrap template"></a>
                    </div>
                    <div class="fh5co-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, eos?</div>
                </div>
                <div class="item animate-box">
                    <div>
                        <a href="images/img_2.jpg" class="image-popup fh5co-board-img"><img src="images/img_2.jpg" alt="Free HTML5 Bootstrap template"></a>
                        <div class="fh5co-desc">Veniam voluptatum voluptas tempora debitis harum totam vitae hic quos.</div>
                    </div>
                </div>
                <div class="item animate-box">
                    <div>
                        <a href="images/img_3.jpg" class="image-popup fh5co-board-img"><img src="images/img_3.jpg" alt="Free HTML5 Bootstrap template"></a>
                        <div class="fh5co-desc">Optio commodi quod vitae, vel, officiis similique quaerat odit dicta.</div>
                    </div>
                </div>
                <div class="item animate-box">
                    <div>
                        <a href="images/img_4.jpg" class="image-popup fh5co-board-img"><img src="images/img_4.jpg" alt="Free HTML5 Bootstrap template"></a>
                        <div class="fh5co-desc">Dolore itaque deserunt sit, at exercitationem delectus, consequuntur quaerat sapiente.</div>
                    </div>
                </div>
                <div class="item animate-box">
                    <div>
                        <a href="images/img_5.jpg" class="image-popup fh5co-board-img"><img src="images/img_5.jpg" alt="Free HTML5 Bootstrap template"></a>
                        <div class="fh5co-desc">Tempora distinctio inventore, nisi excepturi pariatur tempore sit quasi animi.</div>
                    </div>
                </div>
                <div class="item animate-box">
                    <div>
                        <a href="images/img_6.jpg" class="image-popup fh5co-board-img"><img src="images/img_6.jpg" alt="Free HTML5 Bootstrap template"></a>
                        <div class="fh5co-desc">Sequi, eaque suscipit accusamus. Necessitatibus libero, unde a nesciunt repellendus!</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3">

            <div class="alert alert-warning alert-dismissible hidden-xs" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <a class="alert-link" href="profile/index.html">Visit your profile!</a> Check your self, you aren't looking too good.
            </div>

            <div class="panel panel-default m-b-md hidden-xs">
                <div class="panel-body">
                    <ul class="media-list media-list-stream">
                        <li class="media m-b">
                            <div class="media-body">
                                <div class="media-body-actions">
<!--                                     <button class="btn btn-primary-outline btn-sm">
                                        <span class="icon icon-add-user"></span> Business
                                    </button> -->
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
