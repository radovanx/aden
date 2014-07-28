<?php

define('WP_USE_THEMES', false);
require('../wp-load.php');


SourceImport::run();


mail('ales@web-4-all.cz', 'immomedia.com parse_xml.php', 'running');