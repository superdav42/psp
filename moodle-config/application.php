<?php
/**
 * Your base production configuration goes in this file. Environment-specific
 * overrides go in their respective config-moodle/environments/{{WP_ENV}}.php file.
 *
 * A good default policy is to deviate from the production config as little as
 * possible. Try to define as much of your configuration in this file as you
 * can.
 */

use function Env\env;

/**
 * Directory containing all of the site's files
 *
 * @var string
 */
$root_dir = dirname(__DIR__);

/**
 * Document Root
 *
 * @var string
 */
$webroot_dir = $root_dir . '/web';

/**
 * Use Dotenv to set required environment variables and load .env file in root
 */
$dotenv = Dotenv\Dotenv::createImmutable($root_dir);
if (file_exists($root_dir . '/.env')) {
    $dotenv->load();
    $dotenv->required(['MOODLE_WWWROOT', 'MOODLE_DB_NAME', 'MOODLE_DB_USER', 'MOODLE_DB_PASSWORD']);
}


/**
 * Set up our global environment constant and load its config first
 * Default: production
 */
define('WP_ENV', env('WP_ENV') ?: 'production');

ini_set('display_errors', '0');

$CFG = new stdClass();

$CFG->dbtype    = env('MOODLE_DB_TYPE') ?: 'mysqli';
$CFG->dblibrary = env('MOODLE_DB_LIBRARY') ?: 'native';
$CFG->dbhost    = env('MOODLE_DB_HOST') ?: 'localhost';
$CFG->dbname    = env('MOODLE_DB_NAME');
$CFG->dbuser    = env( 'MOODLE_DB_USER');
$CFG->dbpass    = env('MOODLE_DB_PASSWORD');
$CFG->prefix    = env('MOODLE_DB_PREFIX') ?: 'mdl_';
$CFG->dboptions = array (
    'dbpersist' => 0,
    'dbport' => env('MOODLE_DB_PORT') ?: 3306,
    'dbsocket' => 'TCP',
    'dbcollation' => 'utf8mb4_unicode_ci',
);


$CFG->wwwroot   = env('MOODLE_WWWROOT');

$CFG->dataroot  = env('MOODLE_DATA_DIR') ?: $root_dir . '/moodledata';

$CFG->directorypermissions = 02777;

$CFG->admin = 'admin';

$env_config = __DIR__ . '/environments/' . WP_ENV . '.php';

if (file_exists($env_config)) {
    require_once $env_config;
}
