<template id="profile-shelf-item" :shelf="shelf">
    <div class="panel shelf-card-item pos-r">
         <div class="shelf-caption w-full pos-a">
             @{{ test }}
         </div>
         <div v-if="onOwnProfile()" class="shelf-card-actions-bar w-full pos-a">
             <button class="btn btn-sm btn-default-outline" @click="editShelf(shelf)">
                 <i class="fa fa-pencil"></i>
             </button>
             <button class="btn btn-sm btn-danger-outline" @click="approveShelfDelete(shelf)">
                 <i class="fa fa-times"></i>
             </button>
         </div>
         <div>
             <img class="media-object shelf-card-item-cover" :src="shelf.cover">
         </div>
     </div>
</template>
