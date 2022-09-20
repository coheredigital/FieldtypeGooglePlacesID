# FieldtypeGooglePlacesID
## Easily associate a Google Places ID with a page based on the title field

This modules makes it easy to store the associated Google Places ID with a business listing on your website. The Google Places ID can then be used along side the Google Places API to retrieve hours of operation, contact information, reviews and images (subject to Google Places API pricing and terms).

### Requires [skagarwal/google-places-api](https://github.com/SachinAgarwal1337/google-places-api)
Install it with composer.
```php
composer require skagarwal/google-places-api
```

## How to install and setup the Module
1. Place the module files in /site/modules/ folder
2. In your admin, click Modules > Check for new modules
3. Click "install" for **FieldtypeGooglePlacesID**, this will also install the companion **InputfieldGooglePlacesID** module that will handle the admin UI.
4. Add your Google Place API Key to the module configuration page.
	- Alternatively your Google Places API key can be added to your site config.php using the property "$config->googlePlacesApiKey"
	- [Instructions from Google on how to obtain an Places API key.](https://developers.google.com/maps/documentation/places/web-service/get-api-key)

5. Now to go Setup > Fields and create a new Google Places ID field.
6. When editing the field, click the "details" tab, and set the 'Location Search Bias' and 'Location Search Bias'.
	- These fields are passed to the Google Place Search API to ensure the results returned are relevant to your website.


### Field configuration options
