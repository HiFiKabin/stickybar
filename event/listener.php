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

	protected $is_phpbb31;

	protected $stickybar_logo;

	public function __construct(\phpbb\user $user, \phpbb\template\template $template, \phpbb\config\config $config, $root_path)
	{
		$this->user = $user;
		$this->template = $template;
		$this->config = $config;
		$this->is_phpbb31 = phpbb_version_compare($config['version'], '3.1.0@dev', '>=') && phpbb_version_compare($config['version'], '3.2.0@dev', '<');
		$this->stickybar_logo = (!empty($config['stickybar_logo'])) ? $this->find_image_filename($root_path, $config['stickybar_logo']) : false;
	}

	public function add_page_header_link($event)
	{
		$this->template->assign_vars(array(
			'IS_PHPBB_31'		=> $this->is_phpbb31,
			'STICKYBAR_COLOUR'	=> (!empty($this->config['stickybar_colour'])) ? $this->config['stickybar_colour'] : '',
			'STICKYBAR_SEARCH'	=> $this->config['stickybar_search'] ? true : false,
			'STICKYBAR_SELECT'	=> $this->config['stickybar_select'] ? true : false,
			'STICKYBAR_LOGO'	=> $this->stickybar_logo ?: '',
			'STICKYBAR_CORNER'	=> (!empty($this->config['stickybar_corner'])) ? $this->config['stickybar_corner'] : 0,
		));
	}

	protected function find_image_filename($phpbb_root_path, $name)
	{
		// Search in the user style(s) theme folders first
		$style_names = ($this->user !== null) ? $this->template->get_user_style() : array();
		foreach ($style_names as $style)
		{
			if (file_exists($phpbb_root_path . 'styles/' . $style . '/theme/images/' . $name))
			{
				return $phpbb_root_path . 'styles/' . $style . '/theme/images/' . $name;
			}
			if (file_exists($phpbb_root_path . 'styles/' . $style . '/theme/' . $name))
			{
				return $phpbb_root_path . 'styles/' . $style . '/theme/' . $name;
			}
		}
		if (file_exists($phpbb_root_path . 'images/' . $name))
		{
			return $phpbb_root_path . 'images/' . $name;
		}
		return false;
	}
}
