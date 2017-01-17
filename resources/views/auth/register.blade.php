@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns">
              <div class="column is-half is-offset-one-quarter">
                  <label class="label">Sign to easily create ...</label>
                  <p class="control">
                           <a class="button is-primary" href="{{ url('/auth/facebook') }}">
                             <span class="icon">
                               <i class="fa fa-facebook"></i>
                             </span>
                             <span>Continue with Facebook</span>
                           </a>
                  </p>
                  <p class="control">
                           <a class="button is-info" href="{{ url('/auth/twitter') }}">
                             <span class="icon">
                               <i class="fa fa-twitter"></i>
                             </span>
                             <span>Continue with Twitter</span>
                           </a>
                  </p>
                    <label class="label">Name</label>
                      <p class="control">
                        <input class="input" type="text" placeholder="Text input">
                      </p>
                      <label class="label">Username</label>
                      <p class="control has-icon has-icon-right">
                        <input class="input is-success" type="text" placeholder="Text input" value="bulma">
                        <span class="icon is-small">
                          <i class="fa fa-check"></i>
                        </span>
                        <span class="help is-success">This username is available</span>
                      </p>
                      <label class="label">Email</label>
                      <p class="control has-icon has-icon-right">
                        <input class="input is-danger" type="text" placeholder="Email input" value="hello@">
                        <span class="icon is-small">
                          <i class="fa fa-warning"></i>
                        </span>
                        <span class="help is-danger">This email is invalid</span>
                      </p>
                      <div class="control is-grouped">
                        <p class="control">
                          <button class="button is-primary">Submit</button>
                        </p>
                        <p class="control">
                          <button class="button is-link">Cancel</button>
                        </p>
                      </div>

              </div>
            </div>



        </div>
    </section>
@endsection
