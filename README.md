# aleavatar

Generator of random avatars aka identicons, like you can see on Stackoverflow for example!

## How it works?

This PHP library create a `md5` sum from the string you give.

Each two character is taken, so, we get a string of 32 ÷ 2 = 16 characters.

For this 16 hexadecimal characters, we take the first 8 of them to choose basic shapes to use in the picture, the 6 followings are used to create the foreground color, the last but one is used to place basic shapes and the last is used to choose the rotation way of each quarter part.

## What do I get?

You get by default a picture of 128px × 128px. This picture can be SVG or PNG. For PNG, you must have one of this PHP modules: [ImageMagick](http://www.php.net/manual/en/book.imagick.php) or [GD](http://www.php.net/manual/en/book.image.php).

I recommand you the first one. GD is a fallback.


You can display PNG images or store them. As you want.

SVG can be used into HTML5 document or as standalone SVG file.
