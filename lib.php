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
class PluginArtefactFlexifact extends PluginArtefact
{

    /**
     * @return array
     */
    public static function get_artefact_types()
    {
        return array('flexifact');
    }

    /**
     * @return array
     */
    public static function get_block_types()
    {
        return array(); //array('flexifact');
    }

    /**
     * @return string
     */
    public static function get_plugin_name()
    {
        return 'flexifact';
    }

    /**
     * @return mixed
     */
    public static function is_active()
    {
        return get_field('artefact_installed', 'active', 'name', 'flexifact');
    }

    /**
     * @return array
     */
    public static function menu_items()
    {
        return array();
    }

    /**
     * @return array
     */
    public static function get_artefact_type_content_types()
    {
        return array(
            'flexifact' => array('text'),
        );
    }
}

/**
 * Class ArtefactTypeFlexifact
 */
class ArtefactTypeFlexifact extends ArtefactType
{

    public function render_self($options)
    {
        return get_string('flexifactdesc', 'artefact.flexifact');
    }

    public static function get_icon($options = null)
    {
    }

    public static function is_singular()
    {
        return false;
    }

    public static function get_links($id)
    {
    }

    public static function can_edit($usr, $artefact)
    {
        return true;
    }

    public static function get_form($artefact = array())
    {
        require_once(get_config('libroot') . 'pieforms/pieform.php');

        //$elements = call_static_method(generate_artefact_class_name('flexifact'), 'get_form_elements', $artefact);
        $titledefault = '';

        $elements['title'] = array(
            'type' => 'text',
            'defaultvalue' => $titledefault,
            'title' => get_string('title', 'artefact.flexifact'),
            'size' => 30,
            'rules' => array(
                'required' => TRUE,
            ),
        );

        $elements['submit'] = array(
            'type' => 'submitcancel',
            'value' => array(get_string('save', 'artefact.flexifact'), get_string('cancel')),
            'goto' => '/artefact/flexifact/index.php',
        );

        $artefactform = array(
            'name' => empty($artefact) ? 'create' : 'edit',
            'plugintype' => 'artefact',
            'pluginname' => 'flexifact',
            'validatecallback' => array(generate_artefact_class_name('flexifact'), 'validate'),
            'successcallback' => array(generate_artefact_class_name('flexifact'), 'submit'),
            'elements' => $elements,
        );
        return pieform($artefactform);
    }

    /**
     * @param Pieform $form
     * @param $values
     */
    public static function validate(Pieform $form, $values)
    {
        global $USER;
        if (!empty($values['id'])) {
            $id = (int)$values['id'];
            $artefact = new ArtefactTypeFlexifact($id);
            $canedit = ArtefactTypeFlexifact::can_edit($USER, $artefact); //todo fake always true.
            if (!$canedit) {
                $form->set_error('submit', get_string('canteditdontownflexifact', 'artefact.flexifact'));
            }
        }
    }

    /**
     * @param Pieform $form
     * @param $values
     */
    public static function submit(Pieform $form, $values)
    {
        global $USER, $SESSION;
        if (isset($values['flexifact'])) {
            $id = (int)$values['flexifact'];
            $artefact = new ArtefactTypeFlexifact($id);
        } else {
            $artefact = new ArtefactTypeFlexifact();
            $artefact->set('owner', $USER->get('id'));
        }

        $artefact->set('title', $values['title']);

        $artefact->commit();

        $SESSION->add_ok_msg(get_string('savedsuccessfully', 'artefact.flexifact'));
        $data = $form->get_elements('data');
        foreach ($data as $elements) {
            foreach ($elements as $key => $element) {
                if ($key == 'goto') {
                    redirect($element);
                }
            }
        }
    }

    /**
     * This method extends ArtefactType::commit() by adding additional data
     * into the artefact_plans_task table.
     *
     */
    public function commit()
    {
        if (empty($this->dirty)) {
            return;
        }

        // Return whether or not the commit worked
        $success = FALSE;

        db_begin();

        parent::commit();

        db_commit();

        $this->dirty = $success ? FALSE : TRUE;

        return $success;
    }
}