<?php

class removeUEOContr extends removeUEO
{

    function deleteO($id)
    {
        if ($this->emptyO($id)) {
            $this->removeO($id);
        } else {
            $msg = "Para eliminar la oficina no pueden haber computadoras registradas en la misma";
            echo json_encode($msg);
            exit();
        }
    }

    function deleteUE($id)
    {
        if ($this->emptyUE($id)) {
            $this->removeUE($id);
        } else {
            $msg = "Para eliminar la unidad ejecutora no pueden haber oficinas registradas en la misma";
            echo json_encode($msg);
            exit();
        }
    }
}
