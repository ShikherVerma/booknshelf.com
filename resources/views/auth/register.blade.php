@extends('layouts.app')

@section('content')
    <div class="page-header header-filter" filter-color="purple" style="background-image: url('/img/bg7.jpg'); background-size: cover; background-position: top center;">
       	<div class="container">
   			<div class="row">
       			<div class="col-md-10 col-md-offset-1">

   					<div class="card card-signup">
                           <h2 class="card-title text-center">Register</h2>
                           <div class="row">
                               <div class="col-md-5 col-md-offset-1">
               					<div class="info info-horizontal">
               						<div class="icon icon-rose">
               							<i class="material-icons">timeline</i>
               						</div>
               						<div class="description">
               							<h4 class="info-title">Marketing</h4>
               							<p class="description">
               								We've created the marketing campaign of the website. It was a very interesting collaboration.
               							</p>
               						</div>
               		        	</div>

               					<div class="info info-horizontal">
               						<div class="icon icon-primary">
               							<i class="material-icons">code</i>
               						</div>
               						<div class="description">
               							<h4 class="info-title">Fully Coded in HTML5</h4>
               							<p class="description">
               								We've developed the website with HTML5 and CSS3. The client has access to the code using GitHub.
               							</p>
               						</div>
               					</div>

               					<div class="info info-horizontal">
               						<div class="icon icon-info">
               							<i class="material-icons">group</i>
               						</div>
               						<div class="description">
               							<h4 class="info-title">Built Audience</h4>
               							<p class="description">
               								There is also a Fully Customizable CMS Admin Dashboard for this product.
               							</p>
               						</div>
               					</div>
               				</div>
                               <div class="col-md-5">
                                   <div class="social text-center">
                                       <button class="btn btn-just-icon btn-round btn-twitter">
                                           <i class="fa fa-twitter"></i>
                                       </button>
                                       <button class="btn btn-just-icon btn-round btn-dribbble">
                                           <i class="fa fa-dribbble"></i>
                                       </button>
                                       <button class="btn btn-just-icon btn-round btn-facebook">
                                           <i class="fa fa-facebook"> </i>
                                       </button>
                                       <h4> or be classical </h4>
                                   </div>

   								<form class="form" method="" action="">
   									<div class="content">
   										<div class="input-group">
   											<span class="input-group-addon">
   												<i class="material-icons">face</i>
   											</span>
   											<input type="text" class="form-control" placeholder="First Name...">
   										</div>

   										<div class="input-group">
   											<span class="input-group-addon">
   												<i class="material-icons">email</i>
   											</span>
   											<input type="text" class="form-control" placeholder="Email...">
   										</div>

   										<div class="input-group">
   											<span class="input-group-addon">
   												<i class="material-icons">lock_outline</i>
   											</span>
   											<input type="password" placeholder="Password..." class="form-control" />
   										</div>

   										<!-- If you want to add a checkbox to this form, uncomment this code -->

   										<div class="checkbox">
   											<label>
   												<input type="checkbox" name="optionsCheckboxes" checked>
   												I agree to the <a href="#something">terms and conditions</a>.
   											</label>
   										</div>
   									</div>
   									<div class="footer text-center">
   										<a href="#pablo" class="btn btn-primary btn-round">Get Started</a>
   									</div>
   								</form>
                               </div>
                           </div>
                   	</div>

                   </div>
               </div>
   		</div>

   		<footer class="footer">
   	        <div class="container">
   	            <nav class="pull-left">
   					<ul>
   						<li>
   							<a href="http://www.creative-tim.com">
   								Creative Tim
   							</a>
   						</li>
   						<li>
   							<a href="http://presentation.creative-tim.com">
   							   About Us
   							</a>
   						</li>
   						<li>
   							<a href="http://blog.creative-tim.com">
   							   Blog
   							</a>
   						</li>
   						<li>
   							<a href="http://www.creative-tim.com/license">
   								Licenses
   							</a>
   						</li>
   					</ul>
   	            </nav>
   	            <div class="copyright pull-right">
   	                &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com" target="_blank">Creative Tim</a>
   	            </div>
   	        </div>
   	    </footer>

       </div>
{{--<div class="container m-t-lg">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-6 col-md-offset-3">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Sign up</div>--}}

                {{--<div class="panel-body">--}}
                    {{--<a class="btn btn-block btn-social btn-facebook" href="{{ url('/auth/facebook') }}">--}}
                      {{--<span class="fa fa-facebook"></span> Continue with Facebook--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<a class="btn btn-block btn-social btn-twitter" href="{{ url('/auth/twitter') }}">--}}
                      {{--<span class="fa fa-twitter"></span> Continue with Twitter--}}
                    {{--</a>--}}
                {{--</div>--}}

                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">--}}
                        {{--{!! csrf_field() !!}--}}

                        {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                            {{--<label class="col-md-4 control-label">Name</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="text" class="form-control" name="name" value="{{ old('name') }}">--}}

                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">--}}
                            {{--<label class="col-md-4 control-label">Username</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="username" class="form-control" name="username" value="{{ old('username') }}">--}}

                                {{--@if ($errors->has('username'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('username') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}


                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="password" class="form-control" name="password">--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" name="register" class="btn btn-default">--}}
                                    {{--<i class="fa fa-btn"></i>Sign up--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
