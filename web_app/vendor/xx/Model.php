<?php


namespace xx;



abstract class Model
{

    public $id;
    public static function findById($id, $name_column='id'){

        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE ' . $name_column . '=:id';
        $data = Db::getInstance()->query($sql, [':id' => $id], static::class);

        return $data ? $data[0] : null;
    }

    public static function findAll($columns, $tail,  $arr=[])
    {
        $sql = 'SELECT ' . $columns . ' FROM ' . static::TABLE . $tail;
        return Db::getInstance()->query(
            $sql, static::class, $arr);
    }


    public function insert()
    {
        $fields = get_object_vars($this);
        $cols = [];
        $data = [];
        foreach ($fields as $name => $value){
            if('id' == $name) {
                continue;
            }
            $cols[] = $name;
            $data[':' . $name] = $value;
        }
        $sql = 'INSERT INTO ' . static::TABLE . ' (' . implode(',', $cols) . ') 
        VALUES (' . implode(',', array_keys($data)) . ')';
        return Db::getInstance()->execute($sql, $data);
    }

    public function update()
    {
        $fields = get_object_vars($this);
        $id = '';
        $valId = 0;
        $sql = 'UPDATE ' . static::TABLE . ' SET ';
        $i = 1;
        foreach ($fields as $name => $value){
            if('id' == $name) {
                $id = $name;
                $valId = $value;
                if(!$valId){
                    $id = 'user_id';
                    $valId = $fields['user_id'];
                }
                continue;
            }
            $sql = $sql.$name. '=\''. $value.'\'';
            $i++;
            if( $i != count($fields)){
                $sql = $sql.',';
            }
        }
        $sql = $sql.' WHERE '. $id . '='.$valId;
        return Db::getInstance()->execute($sql);
    }

    public function save()
    {
        $fields = get_object_vars($this);
        if(is_null($fields['id'])){
            $this->insert();
        }else{
            $this->update();
        }
    }

    public function delete()
    {
        $fields = get_object_vars($this);
        $cols = [];
        $data = [];
        foreach ($fields as $name => $value){

            $cols[] = $name;
            $data[':' . $name] = $value;

        }
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE '.$cols[0].'=:'.$cols[0];

        Db::getInstance()->execute($sql, [':'.$cols[0] => $data[':id']]);
    }
}