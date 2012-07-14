<?php
/**
* @package shorty an ownCloud url shortener plugin
* @category internet
* @author Christian Reiner
* @copyright 2011-2012 Christian Reiner <foss@christian-reiner.info>
* @license GNU Affero General Public license (AGPL)
* @link information http://apps.owncloud.com/content/show.php/Shorty?content=150401 
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
 * @file ajax/meta.php
 * @brief Ajax method to query meta information about a given remote url
 * @param string target: Url of a remote web resource
 * @return json: success/error state indicator
 * @return array: Associative array of meta data aspects
 * @author Christian Reiner
 */

// swallow any accidential output generated by php notices and stuff to preserve a clean JSON reply structure
OC_Shorty_Tools::ob_control ( TRUE );

//no apps or filesystem
$RUNTIME_NOSETUPFS = true;

// Check if we are a user
OCP\JSON::checkLoggedIn ( );
OCP\JSON::checkAppEnabled ( 'shorty' );

try
{
  $target  = OC_Shorty_Type::req_argument ( 'target', OC_Shorty_Type::URL, TRUE );
  $meta    = OC_Shorty_Meta::fetchMetaData(htmlspecialchars_decode($target));

  // swallow any accidential output generated by php notices and stuff to preserve a clean JSON reply structure
  OC_Shorty_Tools::ob_control ( FALSE );
  OCP\Util::writeLog( 'shorty', sprintf("Target meta data retrieved for url '%s'.",$target), OC_Log::DEBUG );
  OCP\JSON::success ( array ( 'data'    => $meta,
                              'message' => OC_Shorty_L10n::t("Target url '%s' is valid", $meta['target']) ) );
} catch ( Exception $e ) { OC_Shorty_Exception::JSONerror($e); }
?>
