# Divi ACF Plugins for oEmbed and Gallery Field Types
Shortcodes for displaying various ACF fields inside Divi's Code Module

## How to use the oEmbed ACF type
In any Code module you can use `[dt-yt-acf-video acf_id='my-video']` where the **my-video** parameter is the ACF oEmbed filed's name

## How to use the Gallery ACF type
1. Create a Gallery ACF filed
2. Set the Return Format to be **Image Array**
3. In any Code module you can use `[dt-acf-gallery acf_id='my_gallery']` where the **my_gallery** parameter is the ACF Gallery filed's name

The Shortcode that displays the ACF Gallery Field, is using the build in Magnific Popup JS library (that Divi is also using).