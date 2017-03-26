<?php
/**
*
* @package phpBB Extension - Sticky Bar
* @copyright (c) 2017 HiFiKabin
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_STICKYBAR'					=> 'Sticky Bar',
	'STICKYBAR_CONFIG'				=> 'Sticky Bar Settings',

	'STICKYBAR_SAVED'				=> 'Sticky Bar settings saved',

	'STICKYBAR_COLOUR'				=> 'Sticky Bar Background Colour',
	'STICKYBAR_SEARCH'				=> 'Sticky Bar Search',
	'STICKYBAR_SELECT'				=> 'Enable Sticky Bar Logo',
	'STICKYBAR_LOGO'				=> 'Sticky Bar Logo',
	'STICKYBAR_CORNER'				=> 'Sticky Bar Logo Corner',

	'STICKYBAR_COLOUR_EXPLAIN'		=> 'Select the Sticky Bar colour',
	'STICKYBAR_COLOUR_JS'			=> 'Click the box for web safe colour',
	'STICKYBAR_SEARCH_EXPLAIN'		=> 'Show Search on the Sticky Bar',
	'STICKYBAR_SELECT_EXPLAIN'		=> 'Show Sticky Bar Logo',
	'STICKYBAR_LOGO_EXPLAIN'		=> 'Place your Logo in your forums root/images folder and enter its name here (eg mini_logo.gif)',
	'STICKYBAR_LOGO_PREVIEW'		=> 'Sticky Bar Logo Preview',
	'STICKYBAR_CORNER_EXPLAIN'		=> 'What radius (if any) do you want to have on your Sticky Bar Logo',
	'STICKYBAR_PX'					=> 'px',

	'ACP_STICKYBAR_CONFIG'			=> 'Sticky Bar',
	'ACP_STICKYBAR_CONFIG_EXPLAIN'	=> 'This is configuration page for the Sticky Bar extension.',

	'ACP_STICKYBAR_CONFIG_SET'		=> 'Configuration',
	'STICKYBAR_CONFIG_SAVED'		=> 'Sticky Bar settings saved',
));

