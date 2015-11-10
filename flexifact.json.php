<?php
/**
 *
 * @package    mahara
 * @subpackage artefact-flexifact
 * @author     EdICT Training Ltd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL version 3 or later
 * @copyright  For copyright information on Mahara, please see the README file distributed with this software.
 *
 */

define('INTERNAL', 1);
define('JSON', 1);

require(dirname(dirname(dirname(__FILE__))) . '/init.php');
safe_require('artefact', 'flexifact');

$limit = param_integer('limit', 10);
$offset = param_integer('offset', 0);

$flexifact = ArtefactTypeFlexifact::get_flexifact($offset, $limit);
ArtefactTypeTarget::build_flexifact_list_html($flexifact);

json_reply(FALSE, (object) array('message' => FALSE, 'data' => $flexifact));