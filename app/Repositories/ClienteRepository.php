<?php
namespace App\Repositories;

use App\Models\Cliente;
use App\Repositories\Interfaces\ClienteRepositoryInterface;

class ClienteRepository implements ClienteRepositoryInterface
{
    public function all(){
        return Cliente::all();
    }

    public function find(int $id){
        return Cliente::findOrFail($id);
    }

    public function create(array $data)
    {
        return Cliente::create($data);
    }

    public function update(int $id, array $data)
    {
        $cliente = Cliente::find($id);
        $cliente->update($result);
        return $cliente;
    }

    public function delete(int $id)
    {
        $cliente = $this->find();
        $cliente->delete();
    }
}