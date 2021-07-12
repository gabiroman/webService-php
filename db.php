<?php
class Db extends PDO
{
    private $user = 'root';
    private $pass = '';

    public function __construct()
    {
        try {
            parent::__construct(
                'mysql:host=localhost;dbname=ws-php',
                $this->user,
                $this->pass,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            exit;
        }
    }

    public function index($query)
    {
        $sql = $this->prepare($query);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit;
    }

    public function show($query, $id)
    {
        $sql = $this->prepare($query);
        $sql->execute($id);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 hay datos");
        echo json_encode($sql->fetchAll());
        exit;
    }

    public function store($query, $data)
    {
        $sql = $this->prepare($query);
        $sql->execute($data);
        $idPost = $this->lastInsertId();
        if ($idPost) {
            header("HTTP/1.1 200 Ok");
            echo json_encode($idPost);
            exit;
        }
    }

    public function update($query, $data)
    {
        $sql = $this->prepare($query);
        $sql->execute($data);
        header("HTTP/1.1 200 Ok");
        exit;
    }

    public function destroy($query, $id)
    {
        $sql = $this->prepare($query);
        $sql->execute($id);
        header("HTTP/1.1 200 Ok");
        exit;
    }
}
