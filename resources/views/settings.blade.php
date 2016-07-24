@extends('layouts.app')

@section('content')
<app-settings :user="user" inline-template>
    <div class="app-screen container max-width-1000 m-t-lg">
        <div class="row">
            <!-- Tabs -->
            <div class="col-md-4">
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading">
                        Settings
                    </div>

                    <div class="panel-body">
                        <div class="app-settings-tabs">
                            <ul class="nav app-settings-stacked-tabs" role="tablist">
                                <!-- Profile Link -->
                                <li role="presentation">
                                    <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                                        <i class="fa fa-fw fa-btn fa-edit"></i>Profile
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Panels -->
            <div class="col-md-8">
                <div class="tab-content">
                    <!-- Profile -->
                    <div role="tabpanel" class="tab-pane active" id="profile">
                        @include('settings.profile')
                    </div>
                </div>
            </div>
        </div>
    </div>
</app-settings>
@endsection
