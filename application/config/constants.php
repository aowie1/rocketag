<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/*
|--------------------------------------------------------------------------
| Labels
|--------------------------------------------------------------------------
|
| These are used to easily change the branding of the entire site by modifying individual semantic labels
|
*/

define('TAG_LABEL_SINGULAR', 'tag');
define('TAG_LABEL_PLURAL', 'tags');

define('THING_LABEL_SINGULAR', 'thing');
define('THING_LABEL_PLURAL', 'things');

define('JOIN_ACTION_LABEL_FUTURE', 'add');
define('JOIN_ACTION_LABEL_PRESENT', 'adding');
define('JOIN_ACTION_LABEL_PAST', 'added');

define('VOTE_ACTION_LABEL_FUTURE', 'vote');
define('VOTE_ACTION_LABEL_PRESENT', 'voting');
define('VOTE_ACTION_LABEL_PAST', 'voted');

define('CREATE_ACTION_LABEL_PRESENT', 'create');
define('CREATE_ACTION_LABEL_PRESENT', 'creating');
define('CREATE_ACTION_LABEL_PAST', 'created');

define('FAILURE_RESPONSE_FOLLOWUP', 'Please try again later');
//define('FAILURE_RESPONSE_FOLLOWUP', 'Please contact the <a href="mailto:aowie1@gmail.com">system admin</a>.');

/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
|
| Canned responses built for various API scenarios
|
*/
define('API_INVALID_REQUEST', 'Invalid request to API. (RTFM)');
define('API_NO_RESULTS', 'Query returned no results.');

define('THING_VIEW_URL_PATH', '/view/');

/* End of file constants.php */
/* Location: ./application/config/constants.php */