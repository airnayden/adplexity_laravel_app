<?php

function doExec($cmd)
{
    print $cmd . PHP_EOL;
    exec($cmd, $output, $result_code);

    if ($result_code > 0) {
        printf("ERROR [%s]: %s\n", $result_code, json_encode($output, JSON_PRETTY_PRINT));
    }
}

/**
 * Generate core documentation
 */

$locations = [
    __DIR__ . '/app/Http/Controllers/Api/V1/',
];

$to = __DIR__ . '/public/docs/';

$cmd = 'apidoc';

foreach ($locations as $from) {
    $cmd .= ' -i ' . $from;
}

$cmd .= ' -o ' . $to;

if (!file_exists($to . 'index.html')) {
    // generate base doc files
    doExec($cmd);
}

$cmd .= ' -t ' . __DIR__ . '/apidoc-template/';

doExec($cmd);

print 'Docs Generated :)' . PHP_EOL;
