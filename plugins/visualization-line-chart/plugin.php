<?php

class DatawrapperPlugin_VisualizationLineChart extends DatawrapperPlugin_Visualization {

    public function getMeta(){
        $meta = array(
            "title" => __("Line Chart", $this->getName()),
            "id" => "line-chart",
            "extends" => "raphael-chart",
            "dimensions" => 2,
            "order" => 40,
            "axes" => array(
                "x" => array(
                    "accepts" => array("text", "date"),
                ),
                "y1" => array(
                    "accepts" => array("number"),
                    "multiple" => true
                ),
                "y2" => array(
                    "accepts" => array("number"),
                    "multiple" => true,
                    "optional" => true
                )
            ),
            "options" => $this->getOptions(),
            "locale" => array(
                "tooManyLinesToLabel" => __("Your chart contains <b>more lines than we can label</b>, so automatic labeling is turned off. To fix this <ul><li>filter some columns in the data table in the previous step, or</li><li>use direct labeling and the highlight feature to label the lines that are important to your story.</li></ul>", $this->getName())
            )
        );
        return $meta;
    }

    public function getOptions(){
        $id = $this->getName();
        $options = array(
            "sep-labeling" => array(
                "type" => "separator",
                "label" => __("Customize labeling", $id),
                "depends-on" => array(
                    "chart.min_columns[y1]" => 2,
                )
            ),
            "direct-labeling" => array(
                "type" => "checkbox",
                "label" => __("Direct labeling", $id),
                "default" => false,
                "depends-on" => array(
                    "chart.min_columns[y1]" => 2,
                    "chart.max_columns[y2]" => 0  // direct labeling not possible with second axis
                )
            ),
            "legend-position" => array(
                "type" => "radio-left",
                "label" => __("Legend position", $id),
                "default" => "right",
                "depends-on" => array(
                    "direct-labeling" => false,
                    "chart.min_columns[y1]" => 2
                ),
                "options" => array(
                    array(
                        "value" => "right",
                        "label" => __("right", $id)
                    ),
                    array(
                        "value" => "top",
                        "label" => __("top", $id),
                    ),
                    array(
                        "value" => "inside",
                        "label" => __("inside left", $id),
                    ),
                    array(
                        "value" => "inside-right",
                        "label" => __("inside right", $id),
                    )
                )
            ),

            "sep-lines" => array(
                "type" => "separator",
                "label" => __("Customize lines", $id)
            ),
            "force-banking" => array(
                "type" => "checkbox",
                "hidden" => true,
                "label" => __("Bank the lines to 45 degrees", $id)
            ),
            "show-grid" => array(
                "type" => "checkbox",
                "hidden" => true,
                "label" => __("Show grid", $id),
                "default" => false
            ),
            "connect-missing-values" => array(
                "type" => "checkbox",
                "label" => __("Connect lines between missing values", $id),
            ),
            "fill-between" => array(
                "type" => "checkbox",
                "label" => __("Fill between lines", $id),
                "default" => false,
                "depends-on" => array(
                    "chart.min_columns[y1]" => 2,
                    "chart.max_columns[y1]" => 2,
                    "chart.max_columns[y2]" => 0  // direct labeling not possible with second axis
                )
            ),
            "fill-below" => array(
                "type" => "checkbox",
                "label" => __("Fill below line", $id),
                "defaut" => false,
                "depends-on" => array(
                    "chart.max_columns[y1]" => 1,
                    "chart.max_columns[y2]" => 0
                )
            ),
            "line-mode" => array(
                "type" => "radio-left",
                "label" => __("Line mode", $id),
                "options" => array(
                    array("label" => __("Straight", $id), "value" => "straight"),
                    array("label" => __("Curved", $id), "value" => "curved"),
                    array("label" => __("Stepped", $id), "value" => "stepped")
                ),
                "default" => "straight"
            ),
            "sep-y-axis" => array(
                "type" => "separator",
                "label" => __("Customize y-Axis", $id)
            ),
            "baseline-zero" => array(
                "type" => "checkbox",
                "label" => __("Extend to zero", $id),
            ),
            "extend-range" => array(
                "type" => "checkbox",
                "label" => __("Extend to nice ticks", $id)
            ),
            "invert-y-axis" => array(
                "type" => "checkbox",
                "label" => __("Invert direction", $id),
                "default" => false
            )
        );
        return $options;
    }

}
