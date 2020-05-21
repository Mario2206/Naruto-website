<?php

use Helper\Checker;

var_dump(Checker::checkLength("salut", 5));
var_dump(Checker::checkLength("salut", 6));

var_dump(Checker::checkLengthOfArray(["salut", "cavas"], 5));