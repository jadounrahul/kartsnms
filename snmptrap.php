#!/usr/bin/env php
<?php

/**
 * KartsNMS
 *
 *   This file is part of KartsNMS.
 *
 * @copyright  (C) 2006 - 2012 Adam Armstrong
 * @copyright  (C) 2018 KartsNMS
 * Adapted from old snmptrap.php handler
 */

use KartsNMS\Util\Debug;

$init_modules = [];
require __DIR__ . '/includes/init.php';

$options = getopt('d::');

if (Debug::set(isset($options['d']))) {
    echo "DEBUG!\n";
}

$text = stream_get_contents(STDIN);

// create handle and send it this trap
\KartsNMS\Snmptrap\Dispatcher::handle(new \KartsNMS\Snmptrap\Trap($text));
