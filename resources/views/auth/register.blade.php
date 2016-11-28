@extends('layouts.app')

@section('content')
	<div class="page-header header-filter" style="background-image: url('/img/backgrounds/gfgm2hcq92s-aaron-burden.jpg');
  background-size: cover; background-position: top center;">
     <div class="container login-container">
         <div class="row">
             <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                 <div class="card card-signup">
                     <form role="form" method="POST" action="{{ url('/register') }}">
                         {!! csrf_field() !!}
                         <div class="header header-info text-center">
                             <h4 class="card-title">Join to be a part of Booknshelf</h4>
                         </div>
                         <div class="content">
                             <div class="input-group">
                                 <a class="btn btn-facebook" href="{{ url('/auth/facebook') }}">
                                     <i class="fa fa-facebook"></i> Continue with Facebook
                                 </a>
                             </div>
                             <div class="input-group">
                                 <a class="btn btn-twitter" href="{{ url('/auth/twitter') }}">
                                     <i class="fa fa-twitter"></i> Continue with Twitter
                                 </a>
                             </div>

                             <div class="form-group label-floating {{ $errors->has('name') ? ' has-error' : '' }}">
                                 <div class="col-md-6">
                                     @if (!$errors->has('name'))
                                         <label class="control-label">Name</label>
                                     @endif
                                     <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                     @if ($errors->has('name'))
                                         <label class="control-label">{{ $errors->first('name') }}</label>
                                         <span class="material-icons form-control-feedback">clear</span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group label-floating {{ $errors->has('username') ? ' has-error' : '' }}">
                                 <div class="col-md-6">
                                     @if (!$errors->has('username'))
                                         <label class="control-label">Username</label>
                                     @endif
                                     <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                                     @if ($errors->has('username'))
                                         <label class="control-label">{{ $errors->first('username') }}</label>
                                         <span class="material-icons form-control-feedback">clear</span>
                                     @endif
                                 </div>
                             </div>

                             <div class="form-group label-floating {{ $errors->has('password') ? ' has-error' : '' }}">
                                 <div class="col-md-6">
                                     @if (!$errors->has('password'))
                                         <label class="control-label">Password</label>
                                     @endif
                                     <input type="password" class="form-control" name="password" value="{{ old('username') }}">
                                     @if ($errors->has('password'))
                                         <label class="control-label">{{ $errors->first('password') }}</label>
                                         <span class="material-icons form-control-feedback">clear</span>
                                     @endif
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="col-md-6 col-md-offset-4">
                                     <button type="submit" name="register" class="btn btn-info btn-round">
                                         Join
                                     </button>
                                 </div>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection
