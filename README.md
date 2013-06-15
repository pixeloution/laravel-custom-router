Laravel Custom Router
===========
Adds some new features/syntax to the standard laravel-4 router

## Install

Add the github URL to repositories, library to the require in your composer.json, and add the post-install
script to scripts within composer.json.

    
    "repositories": [
    {
        "type": "git",
        "url": "https://github.com/pixeloution/laravel-custom-router.git"
    }

    "require" : 
    {
       "pixeloution/lararoute" : "*"
    }

    // this is optional - can also use method described below
    "scripts" : {
       "post-install-cmd" : [
          "Pixeloution\\Lararoute\\LararouteInstaller::postPackageInstall" 
       ]
    }

As an option, instead of adding the command to scripts, modify app/config/app.php
and add the following line to the `providers` array:

    'Pixeloution\Lararoute\RoutingServiceProvider',


## Multiple routes resolving to a single action
If you have multiple routes pointing to a single action, you can use this router to 
write the routes in a more simple fashion.

    Route::get(['about/directions', 'people/managers'], 'pages@show');

    // this is the same as ...
    Route::get( 'about/directions', 'pages@show' );
    Route::get( 'about/directions', 'pages@show' );

## Alternate route parameters syntax
Allows the use of :parameter syntax in routes. 

    Route::get( '/page/:id' );

    // this is the same as ...
    Route::get( 'page/{id}' ')

