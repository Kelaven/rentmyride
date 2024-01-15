<?php


// ! regex

define('REGEX_CATEGORY', '^.{2,30}$');
define('REGEX_MODEL', '^.{1,30}$');
define('REGEX_REGISTRATION', '^(?:[A-Z]{2}[-\s]?\d{3}[-\s]?[A-Z]{2}|(?:\d{4}[-\s]?[A-Z]{2}[-\s]?\d{2}))$'); // anciennes et nouvelles plaques fr
define('REGEX_MILEAGE', '^[0-9]{1,7}$');
define('ARRAY_TYPES', ['image/png', 'image/jpeg']);
define('MAX_FILESIZE', 2*1024*1024); // taille d'image max


// ! config

define('DSN', 'mysql:dbname=rentmyride;host=localhost');
define('USER', 'rentmyride_admin');
define('PASSWORD', '2t9#csRh$%uQ^wWPaFTb');