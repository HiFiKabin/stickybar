<?php
/**
*
* @package phpBB Extension - Sticky Bar
* @copyright (c) 2017 HiFiKabin
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace hifikabin\stickybar\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/

class listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
		'core.user_setup'		=> 'load_language_on_setup',
		'core.page_header'		=> 'add_page_header_link',	
		);
	}


	protected $user;

	protected $template;

	public function __construct(\phpbb\user $user, \phpbb\template\template $template, \phpbb\config\config $config)
		{
		$this->user = $user;
		$this->template = $template;
		$this->config = $config;
		$this->is_phpbb31	= phpbb_version_compare($config['version'], '3.1.0@dev', '>=') && phpbb_version_compare($config['version'], '3.2.0@dev', '<');
		}

	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'hifikabin/stickybar',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function add_page_header_link($event)
	{
		$this->template->assign_vars(array(
		'IS_PHPBB_31'				=> $this->is_phpbb31,
		'STICKYBAR_COLOUR'			=> (isset($this->config['stickybar_colour'])) ? $this->config['stickybar_colour'] : '',
		'STICKYBAR_TEXT_COLOUR'		=> (isset($this->config['stickybar_text_colour'])) ? $this->config['stickybar_text_colour'] : '',		
		'STICKYBAR_SEARCH'			=> $this->config['stickybar_search']  ? true : false,
		'STICKYBAR_SELECT'			=> $this->config['stickybar_select']  ? true : false,
		'STICKYBAR_LOGO'			=> (isset($this->config['stickybar_logo'])) ? $this->config['stickybar_logo'] : '',
		'STICKYBAR_LEFT'			=> (isset($this->config['stickybar_left'])) ? $this->config['stickybar_left'] : '',
		'STICKYBAR_TOP'				=> (isset($this->config['stickybar_top'])) ? $this->config['stickybar_top'] : '',
		'USER_STICKYBAR'			=>	!empty($this->user->data['stickybar']) ? true : false,
		));
	}
}