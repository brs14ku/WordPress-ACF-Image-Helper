WordPress-ACF-Image-Helper
==========================

A simple image helper class and factory for Advanced Custom Fields Plugin and WordPress

<h2>Best used with the following plugins</h2>
https://github.com/elliotcondon/acf
http://www.advancedcustomfields.com/add-ons/options-page/

<h1>Using this Class</h1>

Include the file in your theme by adding it the following line to functions.php or wherever you would like if you have a more advanced structure. Be sure to adjust this to fit the path you place the file in.
```
include_once(get_template_directory().'/inc/classes/WPACFImageHelper.php');
```
The factory contains three methods for obtaining your image object:
<ul>
<li>createFromPost - This is when you're calling your object in the loop where post->ID is accessible</li>
<li>createFromOptions - This is for retrieving an image object from an item set on an <a href="http://www.advancedcustomfields.com/add-ons/options-page/">ACF Options</a> Field</li>
<li>createFromID - This is to use our helper class to save you a little time when you may already have the ID of an image.</li>
</ul>
In your templates and markup

```
    //Instantiate an Image helper object
    $heroImage = WPACFImageHelperFactory::createFromPost('hero_image', 'cat_hero_xlarge');

    //Get Image Source for your own use
    $heroImage->src;

    //Get Image alt for your own use
    $heroImage->alt;

    //Get Image ID for your own use
    $heroImage->id;
```

<h2>The real simplicity and awesomeness lies here:<h2>
```
echo $heroImage->buildImgTag('brent-did-good-things thumb more-classes');
```
The above line will dump an full html image tag with the image src, alt and the classes you pass it for use. Just echo it out and you're good to go.