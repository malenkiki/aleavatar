<?php
namespace Malenki\Aleavatar;

if(!extension_loaded('gd'))
{
    throw new \RuntimeException('GD is not available! Aleavatar uses GD to work!');
}

(@include_once __DIR__ . '/vendor/autoload.php') || @include_once __DIR__ . '/../../autoload.php';

$str_out = '';


if(isset($_GET['map']))
{
    $str_out .= Aleavatar::mapSvg(true);
}
elseif(isset($_GET['key']))
{
    if(isset($_GET['png']))
    {
        header('Content-Type: image/png');
        $a = new Aleavatar($_GET['key']);
        $a->generate();
        echo $a->png();
        exit();
    }
    $a = new Aleavatar($_GET['key']);
    $a->generate();
    $str_out .= sprintf('<div>%s</div>', $a->svgForHtml5());
}
elseif(isset($_GET['alpha']))
{
    foreach(range('A', 'Z') as $r)
    {
        $a = new Aleavatar($r);
        $a->generate();
        $str_out .= sprintf('<div>%s</div>', $a->svgForHtml5());
        $a = new Aleavatar(strtolower($r));
        $a->generate();
        $str_out .= sprintf('<div>%s</div>', $a->svgForHtml5());
    }
}
else
{
    foreach(range(0, 100) as $r)
    {
        $a = new Aleavatar(uniqid());
        $a->generate();
        $str_out .= sprintf('<div>%s</div>', $a->svgForHtml5());
    }
}
?>
<!doctype html>
<html>
<head>
<style>
div {margin:20px;width:128px;height:128px;float:left;box-shadow:0px 0px 10px silver;}
</style>
</head>
<body>
<?= $str_out ?>
</body>
</html>


