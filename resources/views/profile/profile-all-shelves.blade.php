<app-profile-all-shelves :shelves=shelves inline-template>
    <div class="container m-y-md" v-if="shelves.length > 0">
        <div class="media" v-for="shelf in shelves">
            <div class="media-left">
                <!-- Edit Button -->
                <td>
                    <button class="btn btn-primary" @click="editToken(token)">
                        <i class="fa fa-pencil"></i>
                    </button>
                </td>

                <!-- Delete Button -->
                <td>
                    <button class="btn btn-danger-outline" @click="approveTokenDelete(token)">
                        <i class="fa fa-times"></i>
                    </button>
                </td>
            </div>
            <div class="media-body">
                <h4 class="media-heading">@{{ shelf.name }}</h4>
                <p>@{{ shelf.description }}</p>
            </div>
        </div>
    </div>
</app-profile-all-shelves>
