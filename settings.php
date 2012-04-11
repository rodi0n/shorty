<?php
/**
* @package shorty an ownCloud url shortener plugin
* @category internet
* @author Christian Reiner
* @copyright 2011-2012 Christian Reiner <foss@christian-reiner.info>
* @license GNU Affero General Public license (AGPL)
* @link information 
* @link repository https://svn.christian-reiner.info/svn/app/oc/shorty
*
* This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
* License as published by the Free Software Foundation; either
* version 3 of the license, or any later version.
*
* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU AFFERO GENERAL PUBLIC LICENSE for more details.
*
* You should have received a copy of the GNU Affero General Public
* License along with this library.
* If not, see <http://www.gnu.org/licenses/>.
*
*/

/**
 * @file settings.php
 * This plugins system settings dialog
 * The dialog will be included in the general framework of the system settings page
 * @access public
 * @author Christian Reiner
 */

// Check if we are a user
OC_Util::checkAdminUser ( );
OC_Util::checkAppEnabled ( 'shorty' );

// OC_Util::addScript ( 'shorty', 'debug' );
OC_Util::addScript ( 'shorty', 'shorty' );
OC_Util::addScript ( 'shorty', 'settings' );
OC_Util::addStyle  ( 'shorty', 'shorty' );
OC_Util::addStyle  ( 'shorty', 'settings' );

OC_Util::addStyle  ( '3rdparty', 'chosen/chosen' );
OC_Util::addScript ( '3rdparty', 'chosen/chosen.jquery.min' );

// fetch template
$tmpl = new OC_Template ( 'shorty', 'tmpl_settings' );
// inflate template
$tmpl->assign ( 'backend-static-base', OC_Appconfig::getValue('shorty','backend-static-base','') );
// render template
return $tmpl->fetchPage ( );
?>
