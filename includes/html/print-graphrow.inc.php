<?php

$print_graph = ! (isset($return_data) && $return_data);
$graph_data = \KartsNMS\Util\Html::graphRow($graph_array, $print_graph);

unset($graph_array);
