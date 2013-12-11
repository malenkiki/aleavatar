#!/usr/bin/env php
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

namespace Malenki\Fictif;

(@include_once __DIR__ . '/vendor/autoload.php') || @include_once __DIR__ . '/../../autoload.php';

if(phpversion() >= '5.5.0')
{
    cli_set_process_title('aleavar');
}

$opt = \Malenki\Argile\Options::getInstance();

$opt->addUsage("--output FILE");
$opt->addUsage("--seed STRING --output FILE");
$opt->addUsage("--seed STRING --png --output FILE");

$opt->description('Create identicon ala "StackOverflow" for given string.');
$opt->version('Aleavar CLI version 1.0');

$opt->flexible();


$opt->newValue('seed')
    ->required()
    ->short('s')
    ->long('seed')
    ->help('Give string to generate unique identicon with it.', 'STRING')
    ;

$opt->newValue('output')
    ->required()
    ->short('o')
    ->long('output')
    ->help('File name to save identicon', 'FILE')
    ;
$opt->newSwitch('png')
    ->required()
    ->long('png')
    ->help('Output file as a PNG image instead using SVG.')
    ;

$opt->parse();

if($opt->has('output'))
{
    $strFile = $opt->get('output');
    
    if(is_writable(dirname($strFile)))
    {
        if(file_exists($strFile))
        {
            fwrite(STDERR, 'Cannot write output file, file already exists!');
            fwrite(STDERR, "\n");
            exit(1);
        }
    }
    else
    {
        fwrite(STDERR, 'Cannot write output file!');
        fwrite(STDERR, "\n");
        exit(1);
    }

    if($opt->has('seed'))
    {
        $a = new \Malenki\Aleavatar\Aleavatar($opt->get('seed'));
    }
    else
    {
        $a = new \Malenki\Aleavatar\Aleavatar();
    }

    $a->generate();

    if($opt->has('png'))
    {
        $a->png($strFile);
    }
    else
    {
        $a->svg($strFile);
    }
}
