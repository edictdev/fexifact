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

define('INTERNAL', TRUE);
define('MENUITEM', 'flexifact');

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/init.php');
require_once('pieforms/pieform.php');
require_once('pieforms/pieform/elements/calendar.php');
require_once(get_config('docroot') . 'artefact/lib.php');
safe_require('artefact', 'flexifact');

if (!PluginArtefactFlexifact::is_active()) {
    throw new AccessDeniedException(get_string('plugindisableduser', 'mahara', get_string('flexifact', 'artefact.flexifact')));
}

define('TITLE', get_string('edit', 'artefact.flexifact'));

$id = param_integer('id', 0);

if ($id != 0) {
    $artefact = new ArtefactTypeFlexifact($id);
    $canedit = ArtefactTypeFlexifact::can_edit($USER, $artefact); //todo Testing this is always true function not real
    if (!$canedit) {
        throw new AccessDeniedException(get_string('accessdenied', 'error'));
    }
    $form = ArtefactTypeFlexifact::get_form($artefact);
} else {
    $form = ArtefactTypeFlexifact::get_form();
}

$smarty = smarty();
$smarty->assign('form', $form);
$smarty->assign('PAGEHEADING', hsc(get_string("create", "artefact.flexifact")));
$smarty->display('artefact:flexifact:edit.tpl');