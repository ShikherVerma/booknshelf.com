
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
require('./update-profile-photo');
require('./update-profile-information');

/**
 * User's Profile Components
 */
require('./profile/profile-index');
require('./profile/profile-header');
require('./profile/profile-all-shelves');
require('./profile/profile-liked-shelves');


require('./home');
require('./activity');

require('./search/book-search-bar');
require('./create-shelf');

// Books
require('./books');
require('./book-item');
