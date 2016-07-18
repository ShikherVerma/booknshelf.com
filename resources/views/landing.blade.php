@extends('layouts.app')

@section('content')
<div class="container p-main">
    <div class="row">
      <div class="col-md-9">
          <ul class="list-group media-list media-list-stream">


            <li class="media list-group-item p-a">
                <a class="media-left" href="#">
                    <img class="media-object img-circle" src="assets/img/avatar-fat.jpg">
              </a>
              <div class="media-body">
                <div class="media-body-text">
                  <div class="media-heading">
                    <small class="pull-right text-muted">12 min</small>
                    <h5>Jacob Thornton</h5>
                  </div>
                  <p>
                    Donec id elit non mi porta gravida at eget metus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  </p>
                </div>
              </div>
            </li>
            <li class="media list-group-item p-a">
              <a class="media-left" href="#">
                <img
                  class="media-object img-circle"
                  src="assets/img/avatar-fat.jpg">
              </a>
              <div class="media-body">
                <div class="media-body-text">
                  <div class="media-heading">
                    <small class="pull-right text-muted">12 min</small>
                    <h5>Jacob Thornton</h5>
                  </div>
                  <p>
                    Donec id elit non mi porta gravida at eget metus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  </p>
                </div>
              </div>
            </li>

          </ul>
        </div>

        <div class="col-md-3">
          <div class="alert alert-warning alert-dismissible hidden-xs" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <a class="alert-link" href="profile/index.html">Visit your profile!</a> Check your self, you aren't looking too good.
          </div>



          <div class="panel panel-default m-b-md hidden-xs">
            <div class="panel-body">
            <h5 class="m-t-0">Likes <small>· <a href="#">View All</a></small></h5>
            <ul class="media-list media-list-stream">
              <li class="media m-b">
                <a class="media-left" href="#">
                  <img
                    class="media-object img-circle"
                    src="assets/img/avatar-fat.jpg">
                </a>
                <div class="media-body">
                  <strong>Jacob Thornton</strong> @fat
                  <div class="media-body-actions">
                    <button class="btn btn-primary-outline btn-sm">
                      <span class="icon icon-add-user"></span> Follow</button>
                  </div>
                </div>
              </li>
               <li class="media">
                <a class="media-left" href="#">
                  <img
                    class="media-object img-circle"
                    src="assets/img/avatar-mdo.png">
                </a>
                <div class="media-body">
                  <strong>Mark Otto</strong> @mdo
                  <div class="media-body-actions">
                    <button class="btn btn-primary-outline btn-sm">
                      <span class="icon icon-add-user"></span> Follow</button></button>
                  </div>
                </div>
              </li>
            </ul>
            </div>
            <div class="panel-footer">
              Dave really likes these nerds, no one knows why though.
            </div>
          </div>
        </div>

  </div>
</div>
@endsection
