<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    | 
    | {route}/{template}/{filename}
    | 
    | Examples: "images", "img/cache"
    |
    */
   
    'route' => 'imagecache',

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submited 
    | by URI. 
    | 
    | Define as many directories as you like.
    |
    */
    
    'paths' => array(
        public_path('uploads/users'),
        public_path('uploads'),
        public_path('images')
    ),

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation callbacks.
    | The keys of this array will define which templates 
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    */
   
    'templates' => array(

        'small' => function($image) { 
            return $image->fit(120, 90);
        },
        'medium' => function($image) {
            return $image->fit(240, 180);
        },
        'large' => function($image) {
            return $image->fit(480, 360);
        },
        
        
        //My 
        'big' => function($image) {
            return $image->resize(null, 540, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			});
        },
        'user' => function($image) {
            return $image->fit(260, 390, function ($constraint) {
				$constraint->upsize();
			});
        },
        'icon' => function($image) {
            return $image->fit(180, 135);
        }

    ),

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
    */
   
    'lifetime' => 43200,

);
