<?php

namespace App\Services\Database;

use Config\Database;

class DatabaseService
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function registrarMovimiento(string $autor, string $mensaje): bool
    {
        return $this->db->query('CALL registrarMovimiento(?,?)', [$autor, $mensaje]) !== false;
    }

    public function buscarUsuarioByUsername(string $username): ?object
    {
        //Se realiza la consulta para verificar que exista un usuario con dichas credenciales
        $query = $this->db->query('CALL buscarUsuarioByNombre(?)', [$username]);

        //Se obtiene el resultado unico ROW
        $result = $query->getRow();
        $query->freeResult();
        return $result;
    }

    public function obtenerAuditoria(): array
    {
        $query = $this->db->query('CALL obtenerAuditoria()');

        $result = $query->getResult();
        $query->freeResult();
        return $result;
    }
}
