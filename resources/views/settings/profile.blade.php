<app-profile :user="user" inline-template>
    <div>
        <!-- Update Profile Photo -->
        @include('settings.profile.update-profile-photo')

        <!-- Update Profile Information -->
        @include('settings.profile.update-profile-information')
    </div>
</app-profile>
