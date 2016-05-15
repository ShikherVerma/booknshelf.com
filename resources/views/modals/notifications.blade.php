<!-- Notifications Modal -->
<app-notifications
    :notifications="notifications"
    :loading-notifications="loadingNotifications" inline-template>

    <div>
        <div class="modal docked docked-right" id="modal-notifications" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <div class="btn-group">
                            <button class="btn btn-default" :class="{'active': showingNotifications}" @click="showNotifications" style="width: 100%;">
                                Notifications
                            </button>
                        </div>
                    </div>

                    <div class="modal-body">
                        <!-- Informational Messages -->
                        <div v-if="loadingNotifications">
                            <i class="fa fa-btn fa-spinner fa-spin"></i>Loading Notifications
                        </div>

                        <div v-if=" ! loadingNotifications && activeNotifications.length == 0">
                            <div class="alert alert-warning m-b-none">
                                We don't have anything to show you right now! But when we do,
                                we'll be sure to let you know. Talk to you soon!
                            </div>
                        </div>

                        <!-- List Of Notifications -->
                        <div v-if="showingNotifications && hasNotifications">
                            <div class="notification" v-for="notification in notifications.notifications">

                                <!-- Notification Icon -->
                                <figure>
                                    <img v-if="notification.creator" :src="notification.creator.photo_url" class="app-profile-photo">

                                    <span v-else class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa @{{ notification.icon }} fa-stack-1x fa-inverse"></i>
                                    </span>
                                </figure>

                                <!-- Notification -->
                                <div class="notification-content">
                                    <div class="meta">
                                        <p class="title">
                                            <span v-if="notification.creator">
                                                @{{ notification.creator.name }}
                                            </span>

                                            <span v-else>
                                                app
                                            </span>
                                        </p>

                                        <div class="date">
                                            @{{ notification.created_at | relative }}
                                        </div>
                                    </div>

                                    <div class="notification-body">
                                        @{{{ notification.parsed_body }}}
                                    </div>

                                    <!-- Notification Action -->
                                    <a :href="notification.action_url" class="btn btn-primary" v-if="notification.action_text">
                                        @{{ notification.action_text }}
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</app-notifications>
