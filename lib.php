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

defined('INTERNAL') || die();

/**
 * Class PluginArtefactFlexifact
 */
class PluginArtefactFlexifact extends PluginArtefact {

    /**
     * @return array
     */
    public static function get_artefact_types() {
        return array('flexifact');
    }

    /**
     * @return array
     */
    public static function get_block_types() {
        return array(); //array('flexifacts');
    }

    /**
     * @return string
     */
    public static function get_plugin_name() {
        return 'flexifacts';
    }

    /**
     * @return mixed
     */
    public static function is_active() {
        return get_field('artefact_installed', 'active', 'name', 'flexifacts');
    }

    /**
     * @return array
     */
    public static function menu_items() {
        global $USER;
        log_info($USER);
        $menu = array();
        $staffinstitutions = $USER->get('staffinstitutions');
        if (empty($staffinstitutions)) {
            $menu = array(
                array(
                    'path' => 'content/flexifacts',
                    'url' => 'artefact/flexifacts/',
                    'title' => get_string('flexifacts', 'artefact.flexifacts'),
                    'weight' => 60
                )
            );
        }
        return $menu;
    }

    /**
     * @return array
     */
    public static function get_artefact_type_content_types() {
        return array(
            'flexifact' => array('text'),
        );
    }
}

/**
 * Class ArtefactTypeTarget
 */
class ArtefactTypeFlexifact extends ArtefactType {
    public function render_self($options) {
        return get_string('flexifactdesc', 'artefact.fexifact');
    }

    public static function get_icon($options=null) {}

    public static function is_singular() {
        return false;
    }

    public static function get_links($id) {}
}