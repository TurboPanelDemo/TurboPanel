TURBO_PHP=/usr/local/turbo/php/bin/php

$TURBO_PHP -r "copy('https://github.com/acmephp/acmephp/releases/download/1.0.1/acmephp.phar', 'acmephp.phar');"
$TURBO_PHP -r "copy('https://github.com/acmephp/acmephp/releases/download/1.0.1/acmephp.phar.pubkey', 'acmephp.phar.pubkey');"
$TURBO_PHP acmephp.phar --version
