<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$controllers = ['Articles', 'Conference', 'Contacts', 'Events',
                'File', 'Grants', 'Individuals', 'License',
                'Login', 'Logout', 'Main', 'Moderators', 'Doctors','Offer',
                'Payment', 'Profile', 'Register', 'Tasks', 
                'SocialHelp',  'University', 'VirtualClinic'];
$languages = ['english', 'greek', 'bulgarian'];

foreach ($controllers as $c) {
	foreach ($languages as $l) {
        	$route[$c.'/'.$l] = $c.'/index/'.$l;
	}
}


