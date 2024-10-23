<?php


namespace xx;


class Db
{
    use TSingleton;
    protected $dbh;
    private function __construct()
    {
        $config = (include __DIR__ . '/../../config/config.php')['db'];
        $this->dbh = new \PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'],
            $config['user'],
            $config['password']);
    }

    public function query($sql, $class, $data = []){
        $sth = $this->dbh->prepare($sql);
        $sth->execute($data);
        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function execute($sql, $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($data);
    }


}