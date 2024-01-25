<?php


// ! regex

define('REGEX_CATEGORY', '^.{2,30}$');
define('REGEX_MODEL', '^.{1,30}$');
define('REGEX_REGISTRATION', '^(?:[A-Z]{2}[-\s]?\d{3}[-\s]?[A-Z]{2}|(?:\d{4}[-\s]?[A-Z]{2}[-\s]?\d{2}))$'); // anciennes et nouvelles plaques fr
define('REGEX_MILEAGE', '^[0-9]{1,7}$');
define('ARRAY_TYPES', ['image/png', 'image/jpeg']);
define('MAX_FILESIZE', 2*1024*1024); // taille d'image max
define('REGEX_NO_NUMBER',"^[A-Za-z-éèêëàâäôöûüç' ]+$");
define('REGEX_DATE','^([0-9]{4})[\/\-]?([0-9]{2})[\/\-]?([0-9]{2})$');
define('REGEX_PHONE', '^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$');
define('REGEX_ZIPCODE', '^(?:[0-8]\d|9[0-8])\d{3}$');


// ! config

define('DSN', 'mysql:dbname=rentmyride;host=localhost');
define('USER', 'rentmyride_admin');
define('PASSWORD', '2t9#csRh$%uQ^wWPaFTb');


// ! nbe de véhicules à afficher par pages

define('NB_ELEMENTS_PER_PAGE', 8);