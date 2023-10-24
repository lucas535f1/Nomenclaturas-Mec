<?php

class UnidadView extends Unidad{

    public function fetchAll(){
        return $this->getAll();
    }

    public function fetchAreas(){
        return $this->getAreas();
    }

    public function fetchUE($id){
        return $this->getUE($id);
    }

    public function UeExists($id){
        return $this->existsUE($id);
    }
    
    
}