
/*
 |--------------------------------------------------------------------------
 | Laravel Spark Components
 |--------------------------------------------------------------------------
 |
 | Here we will load the Spark components which makes up the core client
 | application. This is also a convenient spot for you to load all of
 | your components that you write while building your applications.
 */


/**
 * Layout Components...
 */
require('./navbar');
require('./notifications');


/**
 * Settings Component...
 */
require('./settings');

/**
 * Profile Settings Components...
 */
require('./profile');
require('./settings/update-profile-photo');
require('./settings/update-profile-information');
require('./settings/update-social');

/**
 * User's Profile Components
 */
require('./profile/profile-header');
require('./profile/profile-all-shelves');
require('./profile/profile-shelf-item');


require('./home');

require('./search/book-search-bar');
require('./new-shelf-modal');

// Books
require('./book/books');
require('./book/book-item');
require('./book/book-item-save-modal');

// Login

// Shelf
require('./shelf/shelf.js');
require('./shelf/shelf-book-item.js');

require('./please-login-modal.js');
