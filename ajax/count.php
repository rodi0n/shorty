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
 * @file ajax/count.php
 * @brief Ajax method to retrieve a list of important sums, counts of the existing set of shortys
 * @return json: success/error state indicator
 * @return json: Associative array of counts
 * @author Christian Reiner
 */

// swallow any accidential output generated by php notices and stuff to preserve a clean JSON reply structure
OC_Shorty_Tools::ob_control ( TRUE );

//no apps or filesystem
$RUNTIME_NOSETUPFS = TRUE;

// Sanity checks
OCP\JSON::callCheck ( );
OCP\JSON::checkLoggedIn ( );
OCP\JSON::checkAppEnabled ( 'shorty' );

try
{
  $countResult = OC_Shorty_Tools::countShorties ( );
  
  // swallow any accidential output generated by php notices and stuff to preserve a clean JSON reply structure
  OC_Shorty_Tools::ob_control ( FALSE );
  OCP\Util::writeLog( 'shorty', sprintf("Counting shortys resulted in %s entries and %s clicks.",$countResult['sum_shortys'],$countResult['sum_clicks']), OC_Log::DEBUG );
  OCP\JSON::success ( array ( 'data'    => $countResult,
                              'message' => OC_Shorty_L10n::t('Counted entries and clicks') ) );
} catch ( Exception $e ) { OC_Shorty_Exception::JSONerror($e); }
?>
