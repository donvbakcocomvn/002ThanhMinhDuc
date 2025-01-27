<?php

namespace PFBC\Element;

class Textarea extends \PFBC\Element {

    protected $_attributes = array("rows" => "5");

    public function render() {
        echo "<textarea", $this->getAttributes("value"), ">";
        if (!empty($this->_attributes["value"]))
            echo $this->filter($this->_attributes["value"]);
        echo "</textarea>";
    }

    public function renderHTML() {
        $label = $this->getLabel();
        $htmlTemplate = <<<HTML
                <div class="form-group">
                                    <label >$label</label>
HTML;

        echo $htmlTemplate;
        $this->render();
        echo "</div>";
    }

}
