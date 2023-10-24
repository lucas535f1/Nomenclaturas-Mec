<?php
class NameView extends Name
{

    public function fetchNumber($name)
    {
        $names = $this->generateNumber($name);
        $length = strlen($name) - 1;
        $x = 1;
        $number = 1;
        $hueco = 0;
        $return="perepe";
        foreach ($names as $str) {
            if ($hueco == 0) {
                $number = intval(substr($str['NombrePC'], $length)) * 1;
                if ($number != strval($x)) {
                    $return = substr($name, 0, -1). $this->formatNum($x);
                    $hueco=1;
                }
                $x++;
            }
        }
        if ($hueco == 0) {
            $return = substr($name, 0, -1) . $this->formatNum($x);
        }
        return $return;
    }

    private function formatNum($numero)
    {
        if ($numero < 10) {
            $strNum = "00" . $numero;
        } else if ($numero < 100) {
            $strNum = "0" . $numero;
        } else {
            $strNum = strval($numero);
        }
        return $strNum;
    }
}
