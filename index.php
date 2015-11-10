<?php
/**
 * Mahara: Electronic portfolio, weblog, resume builder and social networking
 * Copyright (C) 2006-2015 Catalyst IT Ltd (http://www.catalyst.net.nz)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    mahara
 * @subpackage module-flexifact
 * @author     Kevin Rickis (rdx565)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 2015 EdICT Training Ltd, Scotland
 *
 */
define('INTERNAL', 1);
define('MENUITEM', 'flexifact');
define('SECTION_PLUGINTYPE', 'artefact');
define('SECTION_PLUGINNAME', 'flexifact');
define('SECTION_PAGE', 'index');

require(dirname(dirname(dirname(FILE))) . '/init.php');
define('TITLE', get_string('flexifact', 'artefact.flexifact'));

$indexstring = get_string('flexifacts', 'artefact.flexifact');

$smarty = smarty();
$smarty->assign('indexstring', $indexstring);
$smarty->display('artefact:flexifact:index.tpl');
