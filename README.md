# aleavatar

Generator of random avatars aka identicons, like you can see on Stackoverflow for example!

## How it works?

This PHP library create a `md5` sum from the string you give.

Each two character is taken, so, we get a string of 32 ÷ 2 = 16 characters.

For this 16 hexadecimal characters, we take the first 8 of them to choose basic shapes to use in the picture, the 6 followings are used to create the foreground color, the last but one is used to place basic shapes and the last is used to choose the rotation way of each quarter part.

## What do I get?

You get by default a picture of 128px × 128px. This picture can be SVG or PNG. For PNG, you must have one of this PHP modules: [ImageMagick](http://www.php.net/manual/en/book.imagick.php) or [GD](http://www.php.net/manual/en/book.image.php).

I recommand you the first one. GD is a fallback very poor (no scaling and antialias if you have PHP version prior to 5.5).

You can display PNG images or store them. As you want.

SVG can be used into HTML5 document or as standalone SVG file.

## How to install it?

Using composer it is very simple.

Just put this into your `composer.json` file:

``` json
require: "malenki/aleavatar": "dev-master"
```

## Do you have some examples?

Yes. The first, very simple, generates a (pseudo)random SVG avatar and save it into `my_avatar.svg` file:

``` php
$a = new Malenki\Aleavatar\Aleavatar();
$a->generate()->svg('my_avatar.svg');
```

Now, this one generates one SVG avatar to display into HTML5 based on the string "My avatar is fun!":
``` php
$a = new Malenki\Aleavatar\Aleavatar("My avatar is fun!");
$strSVG = $a->generate()->svgForHtml5();
```

The same but to generate PNG to display on browser :
``` php
$a = new Malenki\Aleavatar\Aleavatar("My avatar is fun!");
header('Content-Type: image/png');
echo $a->generate()->png();
exit();
```

You can change size in pixel too:
``` php
$a = new Malenki\Aleavatar\Aleavatar();
$a->generate(200)->svg('my_avatar.svg');
```

__Note:__ If you have GD as fallback, and your PHP version is inferior to 5.5, then you have not scaling.

Enjoy!
