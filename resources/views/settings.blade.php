@extends('layouts.app')

@section('content')
<spark-settings :user="user" :teams="teams" inline-template>
    <div class="spark-screen container">
        <div class="row">
            <!-- Tabs -->
            <div class="col-md-4">
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading">
                        Settings
                    </div>

                    <div class="panel-body">
                        <div class="spark-settings-tabs">
                            <ul class="nav spark-settings-stacked-tabs" role="tablist">
                                <!-- Profile Link -->
                                <li role="presentation">
                                    <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                                        <i class="fa fa-fw fa-btn fa-edit"></i>Profile
                                    </a>
                                </li>

                                <!-- Security Link -->
                                <li role="presentation">
                                    <a href="#security" aria-controls="security" role="tab" data-toggle="tab">
                                        <i class="fa fa-fw fa-btn fa-lock"></i>Security
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

                    <!-- Security -->
                    <div role="tabpanel" class="tab-pane" id="security">
                        @include('settings.security')
                    </div>

                </div>
            </div>
        </div>
    </div>
</spark-settings>
@endsection
