<app-profile-index :user="user" inline-template>
    <div>
        <!-- Profile Header -->
        <div>
            @include('profile.profile-header')
        </div>

        <!-- Display User's Shelves -->
        <div>
            @include('profile.profile-all-shelves')
        </div>

        <!-- Display User's Liked Shelves -->
        <div>
            @include('profile.profile-liked-shelves')
        </div>

        <div class="profile-index-tabs">
            <ul class="nav spark-settings-stacked-tabs" role="tablist">
                <li role="presentation">
                    <a href="#subscription" aria-controls="subscription" role="tab" data-toggle="tab">
                        <i class="fa fa-fw fa-btn fa-shopping-bag"></i>Subscription
                    </a>
                </li>

                <!-- Payment Method Link -->
                <li role="presentation">
                    <a href="#payment-method" aria-controls="payment-method" role="tab" data-toggle="tab">
                        <i class="fa fa-fw fa-btn fa-credit-card"></i>Payment Method
                    </a>
                </li>

                <!-- Invoices Link -->
                <li role="presentation">
                    <a href="#invoices" aria-controls="invoices" role="tab" data-toggle="tab">
                        <i class="fa fa-fw fa-btn fa-history"></i>Invoices
                    </a>
                </li>
            </ul>
        </div>
    </div>

</app-profile-index>
