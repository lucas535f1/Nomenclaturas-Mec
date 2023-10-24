<?php
class OficinaView extends Oficina{

    public function fetchAll(){
        return $this->getAll();
    }

    public function fetchOficina($id){
        return $this->getOficina($id);
    }

    public function fetchUE($ue){
        return $this->getUE($ue);
    }

    public function oficinaExists($id){
        return $this->existsOficina($id);
    }
    
    

}