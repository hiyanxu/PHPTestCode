<?php
$num = "1499789081479680' AND 3466=3466 AND 'a'='b'";
var_dump(filter_var($num, FILTER_SANITIZE_NUMBER_INT));
