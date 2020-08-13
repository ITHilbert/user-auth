<?php

namespace ITHilbert\UserAuth\Traits;

trait Format
{

    function formatDisplayToIntern($display){
        $intern = strtolower( str_replace(' ','', $display));
        $intern = str_replace('ä','ae', $intern);
        $intern = str_replace('ö','oe', $intern);
        $intern = str_replace('ü','ue', $intern);
        $intern = str_replace('ß','ss', $intern);
        $intern = str_replace(';','', $intern);
        $intern = str_replace(':','', $intern);
        $intern = str_replace('"','', $intern);
        $intern = str_replace("'",'', $intern);
        $intern = str_replace('<','', $intern);
        $intern = str_replace('>','', $intern);

        return $intern;
    }

}
