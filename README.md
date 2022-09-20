# FieldtypeGooglePlacesID
## Easily associate a Google Places ID with a page based on the title field

This modules makes it easy to store the associated Google Places ID with a business listing on your website. The Google Places ID can then be used along side the Google Places API to retrieve hours of operation, contact information, reviews and images (subject to Google Places API pricing and terms).

## How to install
1. Place the module files in /site/modules/ folder
2. In your admin, click Modules > Check for new modules
3. Click "install" for **FieldtypeGooglePlacesID**, this will also install the companion **InputfieldGooglePlacesID** module that will handle the admin UI.
4. Now to go Setup > Fields and create a new Google Places ID field.
5. When editing the field, click the "details" tab, and set the 'Location Search Bias' and 'Location Search Bias'.
	- These fields are passed to the Google Place Search API to ensure the results returned are relevant to your website.
6. Finally, add your Google Places API key to your site config using "$config->googlePlacesApiKey"
### Field configuration options
