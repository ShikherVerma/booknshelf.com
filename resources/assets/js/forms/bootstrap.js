/**
 * Load the AppForm helper class.
 */
require('./form');

/**
 * Define the AppFormError collection class.
 */
require('./errors');

/**
 * Add additional HTTP / form helpers to the App object.
 */
$.extend(App, require('./http'));
