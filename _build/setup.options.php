<?php
/**
 * Build the setup options form.
 */
$exists = $chunks = false;
$output = null;
/** @var array $options */
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
        //$exists = $modx->getObject('transport.modTransportPackage', array('package_name' => 'pdoTools'));
        break;

    case xPDOTransport::ACTION_UPGRADE:
        //$exists = $modx->getObject('transport.modTransportPackage', array('package_name' => 'pdoTools'));
        if (!empty($options['attributes']['chunks'])) {
            $chunks = '<ul id="formCheckboxes" style="height:200px;overflow:auto;">';
            foreach ($options['attributes']['chunks'] as $k => $v) {
                $chunks .= '
				<li>
					<label>
						<input type="checkbox" name="update_chunks[]" value="' . $k . '"> ' . $k . '
					</label>
				</li>';
            }
            $chunks .= '</ul>';
        }

        break;

    case xPDOTransport::ACTION_UNINSTALL:
        break;
}

$output = '';

if ($chunks) {
    switch ($modx->getOption('manager_language')) {
        case 'ru':
            $output .= 'Выберите чанки, которые нужно <b>перезаписать</b>:<br/>
				<small>
					<a href="#" onclick="Ext.get(\'formCheckboxes\').select(\'input\').each(function(v) {v.dom.checked = true;});">отметить все</a> |
					<a href="#" onclick="Ext.get(\'formCheckboxes\').select(\'input\').each(function(v) {v.dom.checked = false;});">cнять отметки</a>
				</small>
			';
            break;
        default:
            $output .= 'Select chunks, which need to <b>overwrite</b>:<br/>
				<small>
					<a href="#" onclick="Ext.get(\'formCheckboxes\').select(\'input\').each(function(v) {v.dom.checked = true;});">select all</a> |
					<a href="#" onclick="Ext.get(\'formCheckboxes\').select(\'input\').each(function(v) {v.dom.checked = false;});">deselect all</a>
				</small>
			';
    }

    $output .= $chunks;
}

return $output;