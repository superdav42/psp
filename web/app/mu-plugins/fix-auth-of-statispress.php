<?php
/**
 * Plugin Name:  Fix Auth of StatisPress
 * Version:      1.0.0
 * Author:       David
 * License:      GPL License
 */

/**
 * Deregister SatisPress authentication servers.
 * 2020-11-13 This is needed because we are using basic auth to secure
 * this staging server which prevents the basic auth from working with
 * satuspress's keys. Once we go live we should remove this and start using keys.
 */
add_filter( 'satispress_authentication_servers', '__return_empty_array' );
