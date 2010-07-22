<?php



/**



 * Plugin Name: Simple Tracking
 * Description: A simple Conversion-Tracking-Plugin for Wordpress, which you can easiely insert into a post or page. Every time a visitor visits this post or page the conversion is beeing made.
 * Version: 0.2
 * Author: Fabian Renner
 * Author URI: http://www.vionic.de
*/

/**

 * Changelog:
 * 07/22/2010: 0.2 * 	- Internationalisation German/English
 * 05/27/2010: 0.1

 * 	- Original first Version

 */

/*  Copyright 2010  Fabian Renner  (email : renner@vionic.de)

    This program is free software; you can redistribute it and/or modify

    it under the terms of the GNU General Public License as published by

    the Free Software Foundation; either version 2 of the License, or

    (at your option) any later version.

    This program is distributed in the hope that it will be useful,

    but WITHOUT ANY WARRANTY; without even the implied warranty of

    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License

    along with this program; if not, write to the Free Software

    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/
	function initLanguage(){		$currentLocale = get_locale();		if(!empty($currentLocale)) {			$moFile = dirname(__FILE__) . "/language/" . $currentLocale . ".mo";			if(@file_exists($moFile) && is_readable($moFile)) load_textdomain('simple-tracking', $moFile);		}	}    function simpleTracker_adminMenu()    {        add_meta_box('simpleTracking', 'Simple Tracking', 'simpleTracker_insertForm', 'post', 'normal');			add_meta_box('simpleTracking', 'Simple Tracking', 'simpleTracker_insertForm', 'page', 'normal');				add_menu_page('Simple Tracking', 'Simple Tracking','manage_options','simpleTracking', 'simpleTracker_configPage','div');    }	    function simpleTracker_configPage()    {        $title = 'Simple Tracking';		$message = __('Perfect updated!', 'simple-tracking');        if ($_GET['updated']) { ?>			            <div id="message" class="updated fade"><p><?php echo $message; ?></p></div><?php 		} ?>		            <div class="wrap">				<div id="icon-simpleTracking" class="icon32"><br /></div>                <h2><?php echo $title; ?></h2>                <form action="options.php" method="post">                    <?php wp_nonce_field('update-options'); ?>     					<p style="margin-left: 10px;"><?php _e('Here you can insert 3 different trackingcodes.', 'simple-tracking') ?></p>					<p style="margin-left: 10px;"><?php _e('Please insert a title for every conversiontrackingcode. Its only for your own.', 'simple-tracking') ?></p>  					<table class="form-table">						<tr valign="top">                            <th scope="row"><?php _e('Title trackingcode 1', 'simple-tracking') ?></th>                            <td>                                <input type="text" size="40" style="width:400px;" name="simpleTracking_betreff1" id="simpleTracking_betreff1" value="<?php echo get_option('simpleTracking_betreff1'); ?>" />                            </td>                        </tr>						<tr>                            <th scope="row"><?php _e('Code 1', 'simple-tracking') ?></th>                            <td>                                <textarea rows="10" cols="40" style="width:400px;" name="simpleTracking_code1" id="simpleTracking_code1" value=""><?php echo get_option('simpleTracking_code1'); ?></textarea>                            </td>					</table>										<p style="margin-left: 10px;"><?php _e('Please type the following shortcode in the editor of a page or post:  <strong>[[[simpleTracking_shortcut1]]]</strong>.</p><p style="margin-left: 10px;">Alternatively you can push the specific button in the plugin-window under the page- or posteditor on every post or page.', 'simple-tracking') ?></p>										<table style="margin-top: 40px;" class="form-table">						<tr>                            <th scope="row"><?php _e('Title trackingcode 2', 'simple-tracking') ?></th>                            <td>                                <input type="text" size="40" style="width:400px;" name="simpleTracking_betreff2" id="simpleTracking_betreff2" value="<?php echo get_option('simpleTracking_betreff2'); ?>" />                            </td>                        </tr>						<tr>                            <th scope="row"><?php _e('Code 2', 'simple-tracking') ?></th>                            <td>                                <textarea rows="10" cols="40" style="width:400px;" name="simpleTracking_code2" id="simpleTracking_code2" value=""><?php echo get_option('simpleTracking_code2'); ?></textarea>                            </td>                        </tr>					</table>					<p style="margin-left: 10px;"><?php _e('Please type the following shortcode in the editor of a page or post:  <strong>[[[simpleTracking_shortcut2]]]</strong>.</p><p style="margin-left: 10px;">Alternatively you can push the specific button in the plugin-window under the page- or posteditor on every post or page.', 'simple-tracking') ?></p>										<table style="margin-top: 40px;" class="form-table">						<tr>                            <th scope="row"><?php _e('Title trackingcode 3', 'simple-tracking') ?></th>                            <td>                                <input type="text" size="40" style="width:400px;" name="simpleTracking_betreff3" id="simpleTracking_betreff3" value="<?php echo get_option('simpleTracking_betreff3'); ?>" />                            </td>                        </tr>						<tr>                            <th scope="row"><?php _e('Code 3', 'simple-tracking') ?></th>                            <td>                                <textarea rows="10" cols="40" style="width:400px;" name="simpleTracking_code3" id="simpleTracking_code3" value=""><?php echo get_option('simpleTracking_code3'); ?></textarea>                            </td>                        </tr>                   </table>				   <p style="margin-left: 10px;"><?php _e('Please type the following shortcode in the editor of a page or post:  <strong>[[[simpleTracking_shortcut3]]]</strong>.</p><p style="margin-left: 10px;">Alternatively you can push the specific button in the plugin-window under the page- or posteditor on every post or page.', 'simple-tracking') ?></p>                    <p class="submit">                        <input type="submit" name="Submit" value="<?php _e('Save &raquo;', 'simple-tracking'); ?>" />                    </p>					<input type="hidden" name="action" value="update" />                    <input type="hidden" name="page_options" value="simpleTracking_betreff1,simpleTracking_code1,simpleTracking_betreff2,simpleTracking_code2,simpleTracking_betreff3,simpleTracking_code3" />                </form>				<?php    }		function simpleTracker_insertForm() {?>		<script type="text/javascript">			jQuery(document).ready(function(){								var ergebnisbox1 = '[[[simpleTracking_shortcut1]]]';				var ergebnisbox2 = '[[[simpleTracking_shortcut2]]]';				var ergebnisbox3 = '[[[simpleTracking_shortcut3]]]';				jQuery('#simpleTracking_submit1').click(function(){									var displaychecker = jQuery('#editorcontainer textarea').css('display');																			if(displaychecker == 'none'){						mce = jQuery('#content_ifr').contents().find('body');						mceHtml = mce.html();						mce.html(mceHtml + ergebnisbox1);											} else {						textareaVar = jQuery('#editorcontainer textarea');						textEditor = textareaVar.val();						textareaVar.val(textEditor + ergebnisbox1);										}				});								jQuery('#simpleTracking_submit2').click(function(){									var displaychecker = jQuery('#editorcontainer textarea').css('display');																			if(displaychecker == 'none'){						mce = jQuery('#content_ifr').contents().find('body');						mceHtml = mce.html();						mce.html(mceHtml + ergebnisbox2);											} else {						textareaVar = jQuery('#editorcontainer textarea');						textEditor = textareaVar.val();						textareaVar.val(textEditor + ergebnisbox2);										}				});								jQuery('#simpleTracking_submit3').click(function(){									var displaychecker = jQuery('#editorcontainer textarea').css('display');																			if(displaychecker == 'none'){						mce = jQuery('#content_ifr').contents().find('body');						mceHtml = mce.html();						mce.html(mceHtml + ergebnisbox3);											} else {						textareaVar = jQuery('#editorcontainer textarea');						textEditor = textareaVar.val();						textareaVar.val(textEditor + ergebnisbox3);										}				});			});					</script>		<p style="padding: 5px;"><strong><?php _e('Here you can simply insert your specific trackingcode shortcut per mouseclick.', 'simple-tracking');?> </p>		<p style="padding: 5px;"><?php _e('In the frontend the trackingcode is then running each time a visitor visites the post or page. The Shortcut is then replaced by the script.', 'simple-tracking');?></strong><br /><br />	</p>		<table class="form-table">			<tr valign="top">                <th scope="row"><label for="simpleTracking_betreff1"><?php echo get_option('simpleTracking_betreff1'); ?></label></th>                <td>					<input id="simpleTracking_submit1" type="button" value="<?php echo __('Insert ', 'simple-tracking') . get_option('simpleTracking_betreff1'); ?>" />                </td>            </tr>			<tr>                <th scope="row"><label for="simpleTracking_betreff2"><?php echo get_option('simpleTracking_betreff2'); ?></label></th>                <td>					<input id="simpleTracking_submit2" type="button" value="<?php echo __('Insert ', 'simple-tracking') . get_option('simpleTracking_betreff2'); ?>" />                </td>            </tr>			<tr>                <th scope="row"><label for="simpleTracking_betreff3"><?php echo get_option('simpleTracking_betreff3'); ?></label></th>                <td>					<input id="simpleTracking_submit3" type="button" value="<?php echo __('Insert ', 'simple-tracking') . get_option('simpleTracking_betreff3'); ?>" />                </td>            </tr>			        </table>        <p>&nbsp;</p>		<?php    }		add_action('admin_menu', 'simpleTracker_adminMenu');			function simpleTracker_options_install() {		add_option('simpleTracking_betreff1', __('Title 1', 'simple-tracking'));	add_option('simpleTracking_code1', '<script>alert("1");</script>');		add_option('simpleTracking_betreff2', __('Title 2', 'simple-tracking'));	add_option('simpleTracking_code2', '<script>alert("2");</script>');		add_option('simpleTracking_betreff3', __('Title 3', 'simple-tracking'));	add_option('simpleTracking_code3', '<script>alert("3");</script>');	}	function simpleTracker_options_uninstall(){		delete_option('simpleTracking_betreff1');		delete_option('simpleTracking_code1');				delete_option('simpleTracking_betreff2');		delete_option('simpleTracking_code2');				delete_option('simpleTracking_betreff3');		delete_option('simpleTracking_code3');	}register_activation_hook(__FILE__, 'simpleTracker_options_install' );if (function_exists('register_uninstall_hook')){	register_uninstall_hook(__FILE__, 'simpleTracker_options_uninstall'); } else  {	register_deactivation_hook(__FILE__, 'simpleTracker_options_uninstall'); }  function simpleTracker_filterTracking($content){	$content = str_replace('[[[simpleTracking_shortcut1]]]',get_option('simpleTracking_code1'), $content);	$content = str_replace('[[[simpleTracking_shortcut2]]]',get_option('simpleTracking_code2'), $content);	$content = str_replace('[[[simpleTracking_shortcut3]]]',get_option('simpleTracking_code3'), $content);			return $content;}  add_filter('the_content', 'simpleTracker_filterTracking');	 add_action('admin_head', 'simpleTracker_tracking_css');add_action('init','initLanguage');/** * Ausgabe der Admin CSS */function simpleTracker_tracking_css() {    echo '<link id="dpm_css" rel="stylesheet" href="'.get_settings('siteurl').'/wp-content/plugins/simple-tracking/adminTracking.css" type="text/css" media="screen" />';}?>