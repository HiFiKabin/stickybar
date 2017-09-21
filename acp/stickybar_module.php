<?php
/**
*
* @package Header Link
* @copyright (c) 2015 HiFiKabin
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace hifikabin\stickybar\acp;

class stickybar_module
{
var $u_action;

   function main($id, $mode)
   {
        global $user, $template, $request;
        global $config;

        $this->tpl_name = 'acp_stickybar_config';
        $this->page_title = $user->lang('STICKYBAR_CONFIG');
        $form_name = 'acp_stickybar_config';
        add_form_key($form_name);

    $submit = $request->is_set_post('submit');
    if ($submit)
        {
        if (!check_form_key('acp_stickybar_config'))
        {
            trigger_error('FORM_INVALID');
        }
        $config->set('stickybar_colour', $request->variable('stickybar_colour', ''));
        $config->set('stickybar_text_colour', $request->variable('stickybar_text_colour', ''));	
        $config->set('stickybar_search', $request->variable('stickybar_search', 0));
        $config->set('stickybar_select', $request->variable('stickybar_select', 0));
        $config->set('stickybar_logo', $request->variable('stickybar_logo', '', true));
        $config->set('stickybar_left', $request->variable('stickybar_left', ''));
        $config->set('stickybar_top', $request->variable('stickybar_top', ''));		

        trigger_error($user->lang('STICKYBAR_SAVED') . adm_back_link($this->u_action));

        }
        $template->assign_vars(array(
        'STICKYBAR_COLOUR'			=> (isset($config['stickybar_colour'])) ? $config['stickybar_colour'] : '',
        'STICKYBAR_TEXT_COLOUR'		=> (isset($config['stickybar_text_colour'])) ? $config['stickybar_text_colour'] : '',
        'STICKYBAR_SEARCH'			=> (!empty($config['stickybar_search'])) ? true : false,
        'STICKYBAR_SELECT'			=> (!empty($config['stickybar_select'])) ? true : false,
        'STICKYBAR_LOGO'			=> (isset($config['stickybar_logo'])) ? $config['stickybar_logo'] : '',
        'STICKYBAR_LEFT'			=> (isset($config['stickybar_left'])) ? $config['stickybar_left'] : '',
        'STICKYBAR_TOP'				=> (isset($config['stickybar_top'])) ? $config['stickybar_top'] : '',
		
        'U_ACTION'					=> $this->u_action,
        ));
    }
}
