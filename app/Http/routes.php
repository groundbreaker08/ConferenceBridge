<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


use App\Event;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\Entrust;

//Auth::loginUsingId(1);

/*
 * For non members and members
 */
Route::get('/technical_support', function () {
    $data = ['page_title'    =>  'Technical Support'];
    return view('technical_support',$data);
});
Route::get('/',function(){
    $data = ['page_title' => 'Sonic'];
    if(Auth::user()) return view('home',$data);
    else return view('main',$data);
});

/*
 * Members only
 */

Route::auth();
Route::group(['middleware'=>['auth']],function(){
    Route::get('contactUs', function () {
        return view('contacts', ['page_title' => 'Contact Us',]);
    });
    Route::resource('contacts','ContactController');
    Route::get('contactDataTableRequest','ContactController@DataTableList');

    Route::get('avatar/{id}/{avatar}','AvatarController@index');
    Route::put('avatar','AvatarController@update');

    Route::resource('settings','SettingController');
    Route::put('settings/profile/{id}','SettingController@update_profile');
    Route::put('settings/password/{user}','SettingController@update_password');

    Route::resource('profile','ProfileController');
    
    Route::resource('confirm','EventConfirmController');
    Route::get('events/create/rooms','EventController@showVenue');
    
    Route::group(
        [
            'prefix'    =>  'events',
        ],
        function(){
            Route::get      ('/created'     ,'EventController@loadCreatedEvents');
            Route::get      ('/invited'     ,'EventController@loadInvitedEvents');
            Route::get      ('/company'     ,'EventController@loadCompanyEvents');

            Route::get      (''             ,'EventController@index');  #   index page
            Route::get      ('/create'      ,'EventController@create'); #   create page for new data
            Route::post     (''             ,'EventController@store');  #   store request for new data
            Route::get      ('/{event}'     ,'EventController@show');   #   view page specific data
            Route::get      ('/{event}/edit','EventController@edit');   #   edit page specific data
            Route::put      ('/{event}'     ,'EventController@update'); #   update request for specific data
            Route::delete   ('/{event}'     ,'EventController@destroy');  #   delete request for specific data

        }
    );
    
    # Events
    #Route::resource('events', 'EventController');

    # Permissions
    Route::resource('permissions','PermissionController');

    # Roles
    Route::group(
        [
            'prefix'=>'roles',
            'middleware'=>['role:master']
        ],
        function(){
            Route::get('/','RoleController@index');
            Route::get('/{role}','RoleController@show');
            Route::delete('/{role}','RoleController@delete');
            Route::put('/{role}','RoleController@update');
            Route::get('/{role}/edit','RoleController@edit');
        }
    );
    # UserRoles
    Route::group(
        [
            'prefix'    =>'roles',
            'middleware'=>['role:master|administrator|manager']
        ],function(){
        Route::get('/{user}/load','RoleController@loadUserRoles');
        Route::put('/{user}/update','RoleController@addUserRoles');
        Route::delete('/{user}/remove','RoleController@removeUserRoles');
    });

    # Users
    Route::group(
        [   
            'prefix'=>'users', 
            'middleware'=>['role:master|administrator|manager']
        ],
        function(){
            Route::get('/load/api','UserController@loadCompanyUsers');
            Route::get('/{user}','UserController@show');
            Route::get('/','UserController@index');
            Route::post('/',
                [
                    'middleware'=>['role:master'],
                    'uses'=> 'UserController@store'
                ]
            );
            Route::delete('/{user}',
                [
                    'middleware'=>'role:master',
                    'uses'=>'UserController@destroy'
                ]
            );
        }
    );
    
    # Conference Types and Venues
    Route::group(
        [
            'prefix'=>'conference',
            'middleware'=>['role:master|administrator|manager']
        ],
        function(){
            Route::get      ('type/{type}','ConferenceController@showType');#Bridge or Room
            Route::post     ('venue','ConferenceController@storeVenue');
            Route::get      ('venue/{type}','ConferenceController@loadVenue');

            Route::get      ('venue/{venue}','ConferenceController@showVenue');
            Route::delete   ('venue/{venue}','ConferenceController@deleteVenue');
            Route::get      ('venue/{venue}/edit','ConferenceController@editVenue');
            Route::put      ('venue/{venue}','ConferenceController@updateVenue');
        }
    );


    Route::get('calendar', 'EventController@calendar');
    Route::get('calendarAPI', 'EventController@calendarAPI');
});
 
#Disclaimer
Route::get('disclaimer', function () {
    return view('disclaimer',['page_title'=>'Disclaimer']);
});
#Privacy
Route::get('privacy', function () {
    return view('privacy',['page_title'=>'Privacy Policy Statement']);
});

# verification token resend form
Route::get('verify/resend', [
    'uses' => 'Auth\VerifyController@showResendForm',
    'as' => 'verification.resend',
]);

# verification token resend action
Route::post('verify/resend', [
    'uses' => 'Auth\VerifyController@sendVerificationLinkEmail',
    'as' => 'verification.resend.post',
]);

# verification message / user verification
Route::get('verify/{token?}', [
    'uses' => 'Auth\VerifyController@verify',
    'as' => 'verification.verify',
]);