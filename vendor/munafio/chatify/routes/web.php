<?php
/**
 * -----------------------------------------------------------------
 * NOTE : There is two routes has a name (user & group),
 * any change in these two route's name may cause an issue
 * if not modified in all places that used in (e.g Chatify class,
 * Controllers, chatify javascript file...).
 * -----------------------------------------------------------------
 */


/*
* This is the main app route [Chatify Messenger]
*/
Route::get('/', 'MessagesController@index')->name(config('chatify.path'))->middleware('auth');
Route::get('/schedule/{id}', 'MessagesController@schedule')->middleware('auth');

Route::get('/sale/{id}', 'MessagesController@sale')->middleware('auth');
Route::get('/consumer/{id}', 'MessagesController@consumer')->middleware('auth');
Route::get('/zone-sale/{id}', 'MessagesController@ZoneSale')->middleware('auth');
Route::get('/build/{index}', 'MessagesController@build')->middleware('auth');
Route::get('/calender/{index}', 'MessagesController@calender')->middleware('auth');

Route::get('/guest-schedule/{token}', 'MessagesController@scheduleForGuest');
/** 
 *  Fetch info for specific id [user/group]
 */
Route::post('/idInfo', 'MessagesController@idFetchData')->middleware('auth');
Route::post('/idInfo-guest', 'MessagesController@idFetchData');

Route::post('/idInfo-sale', 'MessagesController@idFetchSale')->middleware('auth');
Route::post('/idInfo-consumer', 'MessagesController@idFetchConsumer')->middleware('auth');
Route::post('/idInfo-build', 'MessagesController@idFetchBuild')->middleware('auth');
Route::post('/idInfo-calender', 'MessagesController@idFetchCalender')->middleware('auth');
/**
 * Send message route
 */
Route::post('/sendMessage', 'MessagesController@send')->name('send.message')->middleware('auth');
Route::post('/sendMessage-guest', 'MessagesController@sendGuest');
Route::post('/sale-send', 'MessagesController@sendSale');
Route::post('/consumer-send', 'MessagesController@sendConsumer');
Route::post('/build-send', 'MessagesController@sendBuild');
Route::post('/calender-send', 'MessagesController@sendCalender');

/** 
 * Fetch messages 
 */
Route::post('/fetchMessages', 'MessagesController@fetch')->name('fetch.messages')->middleware('auth');
Route::post('/fetchMessages-guest', 'MessagesController@fetchGuest')->name('fetch.messages');
Route::post('/fetchMessages-sale', 'MessagesController@fetchSale')->middleware('auth');
Route::post('/fetchMessages-consumer', 'MessagesController@fetchConsumer')->middleware('auth');
Route::post('/fetchMessages-build', 'MessagesController@fetchBuild')->middleware('auth');
Route::post('/fetchMessages-calender', 'MessagesController@fetchCalender')->middleware('auth');

/**
 * Download attachments route to create a downloadable links
 */
Route::get('/download/{fileName}', 'MessagesController@download')->name(config('chatify.attachments.route'))->middleware('auth');

/**
 * Authintication for pusher private channels
 */
Route::post('/chat/auth', 'MessagesController@pusherAuth')->name('pusher.auth');

/**
 * Make messages as seen
 */
Route::post('/makeSeen', 'MessagesController@seen')->name('messages.seen')->middleware('auth');

/**
 * Get contacts
 */
Route::post('/getContacts', 'MessagesController@getContacts')->name('contacts.get')->middleware('auth');
Route::post('/getGroups', 'MessagesController@getGroups')->name('groups.get')->middleware('auth');
Route::post('/getThread', 'MessagesController@getThread')->name('thread.get')->middleware('auth');
Route::post('/getThread-guest', 'MessagesController@getThreadGuest')->name('thread.get');


/**
 * Update contact item data
 */
Route::post('/updateContacts', 'MessagesController@updateContactItem')->name('contacts.update')->middleware('auth');


/**
 * Star in favorite list
 */
Route::post('/star', 'MessagesController@favorite')->name('star')->middleware('auth');

/**
 * get favorites list
 */
Route::post('/favorites', 'MessagesController@getFavorites')->name('favorites')->middleware('auth');

/**
 * Search in messenger
 */
Route::post('/search', 'MessagesController@search')->name('search')->middleware('auth');

Route::post('/my-search', 'MessagesController@mysearch')->name('mysearch');
/**
 * Get shared photos
 */
Route::post('/shared', 'MessagesController@sharedPhotos')->name('shared')->middleware('auth');

Route::post('/shared-sale', 'MessagesController@sharedSale')->name('shared')->middleware('auth');


Route::post('/shared-build', 'MessagesController@sharedBuild')->name('shared')->middleware('auth');

Route::post('/shared-calender', 'MessagesController@sharedCalender')->name('shared')->middleware('auth');

Route::post('/guest-shared', 'MessagesController@sharedPhotos')->name('guest-shared');
/**
 * Delete Conversation
 */
Route::post('/deleteConversation', 'MessagesController@deleteConversation')->name('conversation.delete')->middleware('auth');

/**
 * Delete Conversation
 */
Route::post('/updateSettings', 'MessagesController@updateSettings')->name('avatar.update')->middleware('auth');

/**
 * Set active status
 */
Route::post('/setActiveStatus', 'MessagesController@setActiveStatus')->name('activeStatus.set')->middleware('auth');

Route::post('/deleteMess', 'MessagesController@deleteMess')->name('activeStatus.set')->middleware('auth');





/*
* [Group] view by id
*/
Route::get('/group/{id}', 'MessagesController@index')->name('group');

/*
* user view by id.
* Note : If you added routes after the [User] which is the below one,
* it will considered as user id.
*
* e.g. - The commented routes below :
*/
// Route::get('/route', function(){ return 'Munaf'; }); // works as a route
Route::get('/{id}', 'MessagesController@index')->name('user');
// Route::get('/route', function(){ return 'Munaf'; }); // works as a user id


Route::post('/tran', 'MessagesController@tran')->name('tran');
