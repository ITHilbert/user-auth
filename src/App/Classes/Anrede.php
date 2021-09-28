<?php

namespace ITHilbert\UserAuth\App\Classes;


class Anrede
{
    /**
     * Gibt eine ComboBox zurück
     *
     * @param integer $id
     * @param string $name
     * @return void
     */
    public static function getComboBox($id = 1, $name="anrede"){
        $anreden = config('userauth.anrede');

        $ausgabe = '<select name="'.$name.'" class="form-control">';
        foreach($anreden as $anrede){
            if($anrede['id'] == $id){
                $ausgabe.= '<option selected value="'.$anrede['id'].'">'.$anrede['anrede'].'</option>';
            }else{
                $ausgabe.= '<option value="'.$anrede['id'].'">'.$anrede['anrede'].'</option>';
            }
        }
        $ausgabe .= '</select>';
        return $ausgabe;
    }

    /**
     * Liefert den Datensatz zurück
     *
     * @param [int] $id
     * @return void
     */
    public static function get(int $id){
        $daten = config('userauth.anrede');

        return $daten[$id -1];
    }

    /**
     * Gibt die Anrede zur ID zurück
     *
     * @param [type] $statusID
     * @return void
     */
    public static function getAnrede(int $id){
        $daten = config('userauth.anrede');

        return $daten[$id -1]['anrede'];
    }
}
