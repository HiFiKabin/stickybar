<?php
/**
*
* @package phpBB Extension - Sticky Bar
* @copyright (c) 2017 javiexin
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace hifikabin\stickybar;

class helper
{
	protected $template;

	protected $root_path;

	public function __construct(\phpbb\template\template $template, $phpbb_root_path)
	{
		$this->template = $template;
		$this->root_path = $phpbb_root_path;
	}

	public function find_image_filename($name)
	{
		if (!$name)
		{
			return false;
		}

		// Search in the user style(s) theme folders first
		$style_names = $this->template->get_user_style();
		foreach ($style_names as $style)
		{
			if (file_exists($this->root_path . 'styles/' . $style . '/theme/images/' . $name))
			{
				return $this->root_path . 'styles/' . $style . '/theme/images/' . $name;
			}
			if (file_exists($this->root_path . 'styles/' . $style . '/theme/' . $name))
			{
				return $this->root_path . 'styles/' . $style . '/theme/' . $name;
			}
		}
		// Use the global images/ path as fallback in case no theme image applies
		if (file_exists($this->root_path . 'images/' . $name))
		{
			return $this->root_path . 'images/' . $name;
		}
		return false;
	}
}
