<?php

interface ClienteDao {
    public function lista();
    public function getById($id);
    public function insert($cliente);
    public function update($cliente);
    public function delete($cliente);

}
?>
