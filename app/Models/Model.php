<?php

namespace App\Models;

use App\Config\Database;
use App\Http\Exceptions\QueryException;
use PDO;

class Model extends Database
{

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var string
     */
    protected string $table;

    /**
     * @var string
     */
    protected string $primaryKey;

    /**
     * @var array|string[]
     */
    protected array $fillable;

    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->getPDO();
        $this->primaryKey = "id";
    }

    /**
     * @return array|false
     */
    public function all()
    {
        $query = "SELECT * FROM ".$this->table." WHERE deleted_at is null";

        $stmt = $this->pdo->query($query);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function find(int $id): ?array
    {
        $query = "SELECT * FROM ".$this->table." WHERE ".$this->primaryKey." = $id AND deleted_at is null";

        $stmt = $this->pdo->query($query);

        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return count($response) ? $response[0] : null;
    }


    /**
     * @param $data
     * @return array|false
     */
    public function search($data)
    {
        $query = "SELECT * FROM "
            .$this->table
            ." WHERE ";

        $count = 0;
        foreach ($this->fillable as $key)
        {
            $query .= $key . " LIKE '%$data%'";
            $count ++;
            if($count < count($this->fillable)) $query .= " OR ";
        }


        $stmt = $this->pdo->query($query);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param array $where
     * @return array|false
     */
    public function where(array $where)
    {
        $query = "SELECT * FROM ".$this->table." WHERE ";

        $count = 0;

        foreach ($where as $key => $value)
        {
            $query .= $key . " = " . $value;
            $count ++;
            if($count < count($where) - 1) $query .= " AND ";
        }

        $query .= " AND deleted_at is null";

        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param array $data
     * @throws QueryException
     */
    public function insert(array $data)
    {
        $query = "INSERT INTO ".$this->table."(";

        $values = ") VALUES(";

        $count = 0;

        foreach ($data as $key => $value)
        {
            $query .= "$key";
            $values .= ":$key";
            $count ++;
            if($count < count($data)) {
                $query .= ", ";
                $values .= ", ";
            }
        }

        $query .= $values . ")";

        $stmt = $this->pdo->prepare($query);

        foreach ($data as $key => $value)
        {
            unset($data[$key]);
            $data[":$key"] = $value;
        }

        if(!$stmt->execute($data)) {
            print_r($stmt->errorInfo());
            throw new QueryException();
        }

    }

    /**
     * @param array $data
     * @param int $id
     * @throws QueryException
     */
    public function update(array $data, int $id)
    {
        $query = "UPDATE ".$this->table." SET ";

        $count = 0;

        foreach ($data as $key => $value)
        {
            $query .= "$key = :$key";
            $count ++;
            if($count < count($data)) {
                $query .= ", ";
            }
        }

        $query .= " WHERE ".$this->primaryKey. " = :id";

        $stmt = $this->pdo->prepare($query);

        foreach ($data as $key => $value)
        {
            unset($data[$key]);
            $data[":$key"] = $value;
        }

        $data[':id'] = $id;

        if(!$stmt->execute($data)) {
            print_r($stmt->errorInfo());
            throw new QueryException();
        }
    }

    /**
     * @param int $id
     * @throws QueryException
     */
    public function delete(int $id)
    {
        $query = "UPDATE ".$this->table." SET deleted_at = :deleted_at WHERE ".$this->primaryKey." = :id";

        $stmt = $this->pdo->prepare($query);

        $data = [
            ':deleted_at' => date('Y-m-d H:i:s'),
            ':id' => $id
        ];

        if(!$stmt->execute($data)) {
            print_r($stmt->errorInfo());
            throw new QueryException();
        }
    }

}