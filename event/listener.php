<?php
/**
*
* @package phpBB Extension - Sticky Bar
* @copyright (c) 2017 HiFiKabin
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace hifikabin\stickybar\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header'	=> 'add_page_header_link',
		);
	}

	protected $user;

	protected $template;

	protected $config;

	protected $helper;

	public function __construct(\phpbb\user $user, \phpbb\template\template $template, \phpbb\config\config $config, $root_path)
	{
		$this->user = $user;
		$this->template = $template;
		$this->config = $config;
		$this->helper = new \hifikabin\stickybar\helper($template, $root_path);
	}

	public function add_page_header_link($event)
	{
		$this->template->assign_vars(array(
			'IS_PHPBB_31'		=> phpbb_version_compare($this->config['version'], '3.1.0@dev', '>=') && phpbb_version_compare($this->config['version'], '3.2.0@dev', '<'),
			'STICKYBAR_COLOUR'	=> (!empty($this->config['stickybar_colour'])) ? $this->config['stickybar_colour'] : '',
			'STICKYBAR_SEARCH'	=> $this->config['stickybar_search'] ? true : false,
			'STICKYBAR_SELECT'	=> $this->config['stickybar_select'] ? true : false,
			'STICKYBAR_LOGO'	=> $this->helper->find_image_filename($this->config['stickybar_logo']) ?: '',
			'STICKYBAR_CORNER'	=> (!empty($this->config['stickybar_corner'])) ? $this->config['stickybar_corner'] : '0',
		));
	}
}
