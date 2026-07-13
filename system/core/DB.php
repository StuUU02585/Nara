<?php

class CI_DB
{
    private $mysqli;

    public static function connect()
    {
        $db = [];
        require APPPATH . 'config/database.php';
        $cfg = $db['default'];
        return new self($cfg);
    }

    public function __construct(array $cfg)
    {
        $this->mysqli = new mysqli($cfg['hostname'], $cfg['username'], $cfg['password'], $cfg['database']);
        if ($this->mysqli->connect_errno) {
            throw new RuntimeException('Database connection failed: ' . $this->mysqli->connect_error);
        }
        $this->mysqli->set_charset($cfg['char_set'] ?? 'utf8mb4');
    }

    public function query($sql, array $params = [])
    {
        if (!$params) {
            $result = $this->mysqli->query($sql);
            if ($result === false) {
                throw new RuntimeException($this->mysqli->error);
            }
            return new CI_DB_result($result);
        }

        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt) {
            throw new RuntimeException($this->mysqli->error);
        }

        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);
        if (!$stmt->execute()) {
            throw new RuntimeException($stmt->error);
        }
        $result = $stmt->get_result();
        return new CI_DB_result($result ?: true);
    }

    public function insert($table, array $data)
    {
        $columns = array_keys($data);
        $placeholders = implode(',', array_fill(0, count($columns), '?'));
        $sql = 'INSERT INTO `' . $table . '` (`' . implode('`,`', $columns) . '`) VALUES (' . $placeholders . ')';
        $this->query($sql, array_values($data));
        return $this->mysqli->insert_id;
    }

    public function update($table, array $data, array $where)
    {
        $set = implode(', ', array_map(function ($column) {
            return '`' . $column . '` = ?';
        }, array_keys($data)));
        $conditions = implode(' AND ', array_map(function ($column) {
            return '`' . $column . '` = ?';
        }, array_keys($where)));
        $this->query('UPDATE `' . $table . '` SET ' . $set . ' WHERE ' . $conditions, array_merge(array_values($data), array_values($where)));
    }

    public function delete($table, array $where)
    {
        $conditions = implode(' AND ', array_map(function ($column) {
            return '`' . $column . '` = ?';
        }, array_keys($where)));
        $this->query('DELETE FROM `' . $table . '` WHERE ' . $conditions, array_values($where));
    }
}

class CI_DB_result
{
    private $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function result_array()
    {
        if ($this->result === true) {
            return [];
        }
        return $this->result->fetch_all(MYSQLI_ASSOC);
    }

    public function row_array()
    {
        if ($this->result === true) {
            return null;
        }
        return $this->result->fetch_assoc();
    }
}
