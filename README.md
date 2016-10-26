# UltiSlide

* [Setting up Ultislid](#setting-up-ultislid)
    * [Setup your config file](#setup-your-config-file)
## Setting up Ultislid
Follow these instructions to setup your ultislide.

### Setup your config file

1. Create a new copy of the config.example.php file in cms/php/ and name it config.php

2.  Get you Google API at http://console.developers.google.com and put it in the global constant "API_KEY". REMEMBER TO KEEP YOUR TOKEN SECRET
The token will be used to authentize to google. The API will be used to get the length of the youtube vidoes in the slideshow

3.  At http://console.developers.google.com active the API named "YouTube Data API v3".

4.  Fill in your database location, name, username and password.

5.  Set the URL_TO_SLIDE with the absolute url to the base directory of slideshow

6.  Set the defined IMAGES value to the image folder you want to use.  Important that the IMAGES ends with a /
