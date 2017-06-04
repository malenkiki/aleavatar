<?php
/*
Copyright (c) 2013 Michel Petit <petit.michel@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Malenki\Aleavatar;
(@include_once __DIR__ . '/../vendor/autoload.php') || @include_once __DIR__ . '/../../../autoload.php';
$size = Aleavatar::SIZE;

if (isset($_GET['size'])) {
    $size = (integer) $_GET['size'];
}

if (isset($_GET['map'])) {
    $map = Aleavatar::mapSvg(true);
} else {

    $seed = '';

    if (isset($_GET['key'])) {
        $seed = trim($_GET['key']);
        $a = new Aleavatar($seed);
        $a->generate($size);

        if (isset($_GET['png'])) {
            header('Content-Type: image/png');
            echo $a->png();
            exit();
        } else {
            $key = $a->svgForHtml5();
        }
    } elseif (isset($_GET['alpha'])) {
        $arr = array_merge(range('A', 'Z'), range('a', 'z'));
    } elseif (isset($_GET['num'])) {
        $arr = range(0, 15);
    } else {
        $arr = array_map(function ($v) {return uniqid();}, range(0,19));
    }

    if (isset($arr)) {
        foreach ($arr as $k => $l) {
            $a = new Aleavatar($l);
            $a->generate($size);

            $data = new \stdClass();
            $data->seed = $l;

            $data->url = sprintf(
                'index.php?%s',
                http_build_query(array('key' => $l, 'size' => $size))
            );

            if (isset($_GET['png'])) {
                $data->img = sprintf(
                    '<img src="index.php?key=%s&amp;png&amp;size=%d" />',
                    $l,
                    $size
                );
            } else {
                $data->img = $a->svgForHtml5();
            }

            $arr[$k] = $data;
        }
    }
}
?><!doctype html>
<html>
<style>
div.seed {line-height:30px;height:30px;color:gray;font-family:sans-serif;font-size:10px;text-align:center;}
div.seed a {color:inherit;}
div.thumbnail-box {float:left; margin:20px;width:<?= $size ?>px;height:<?= $size + 30 ?>px;}
div.thumbnail {box-shadow:0 0 10px silver;}
div.key, div.thumbnail {width:<?= $size ?>px;height:<?= $size ?>px;}
div.key {margin:30px auto; box-shadow:0 0 10px silver;}
</style>
<body>
<div>
Size <a href="index.php?size=64">64</a> -  <a href="index.php?size=128">128</a> - <a href="index.php?size=256">256</a> - <a href="index.php?size=512">512</a>
A-Za-z <a href="index.php?alpha&amp;size=<?= $size ?>">svg</a> - <a href="index.php?alpha&amp;png&amp;size=<?= $size ?>">png</a>
0-15 <a href="index.php?num&amp;size=<?= $size ?>">svg</a> - <a href="index.php?num&amp;png&amp;size=<?= $size ?>">png</a>
Random <a href="index.php?size=<?= $size ?>">svg</a> - <a href="index.php?png&amp;size=<?= $size ?>">png</a>
<form method="get" action="index.php">
<input type="hidden" name="size" value="<?= $size ?>" />
<input type="text" name="key" value="<?= $seed ?>" />
<input type="checkbox" name="png" id="id-png" /> <label for="id-png">png</label>
<input type="submit" value="Try with my own string!" />
</form>
</div>
<?php if(isset($arr)): ?>
<?php foreach($arr as $a): ?>
<div class="thumbnail-box">
<div class="seed"><a href="<?= $a->url ?>"><?= $a->seed ?></a></div>
<div class="thumbnail"><?= $a->img ?></div>
</div>
<?php endforeach; ?>
<?php endif; ?>
<?php if(isset($map)): ?>
<div class="map"><?= $map ?></div>
<?php endif; ?>
<?php if(isset($key)): ?>
<div class="key"><?= $key ?></div>
<?php endif; ?>
</body>
</html>
