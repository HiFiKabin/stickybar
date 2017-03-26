<?php
/**
*
* @package Header Link
* @copyright (c) 2017 HiFiKabin
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace hifikabin\stickybar\acp;

class stickybar_module
{
	var $page_title;
	var $tpl_name;
	var $u_action;

	function main($id, $mode)
	{
		global $user, $template, $request, $config;

		$this->tpl_name = 'acp_stickybar_config';
		$this->page_title = $user->lang('STICKYBAR_CONFIG');
		$form_name = 'acp_stickybar_config';
		add_form_key($form_name);

		$submit = $request->variable('save', false);
		if ($submit)
		{
			if (!check_form_key('acp_stickybar_config'))
			{
				trigger_error('FORM_INVALID');
			}
			$config->set('stickybar_colour', $request->variable('stickybar_colour', ''));
			$config->set('stickybar_search', $request->variable('stickybar_search', 0));
			$config->set('stickybar_select', $request->variable('stickybar_select', 0));
			$config->set('stickybar_logo', $request->variable('stickybar_logo', '', true));
			$config->set('stickybar_corner', $request->variable('stickybar_corner', 0));

			trigger_error($user->lang('STICKYBAR_SAVED') . adm_back_link($this->u_action));

		}
		$stickybar_logo = $request->variable('stickybar_logo', (!empty($config['stickybar_logo'])) ? $config['stickybar_logo'] : '', true);

		$template->assign_vars(array(
			'STICKYBAR_COLOUR'			=> $request->variable('stickybar_colour', (!empty($config['stickybar_colour'])) ? $config['stickybar_colour'] : ''),
			'STICKYBAR_SEARCH'			=> $request->variable('stickybar_search', !empty($config['stickybar_search'])),
			'STICKYBAR_SELECT'			=> $request->variable('stickybar_select', !empty($config['stickybar_select'])),
			'STICKYBAR_LOGO'			=> $stickybar_logo,
			'STICKYBAR_LOGO_FILENAME'	=> $this->find_image_filename($stickybar_logo),
			'STICKYBAR_CORNER'			=> $request->variable('stickybar_corner', (!empty($config['stickybar_corner'])) ? $config['stickybar_corner'] : ''),
			'U_ACTION'					=> $this->u_action,
		));
	}

	protected function find_image_filename($name)
	{
		global $phpbb_root_path, $template, $user;

		// Search in the user style(s) theme folders first
		$style_names = ($user !== null) ? $template->get_user_style() : array();
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
