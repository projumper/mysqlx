<?php

/**
 * Created by PhpStorm.
 * User: code
 * Date: 05.10.2016
 * Time: 15:29
 */
class MysqlX extends PDO
{

    //private $dbh;

    public function __construct($dsn= 'mysql:host=localhost;port=3306;dbname=division;charset=utf8', $username='root', $passwd='', $options=array())
    {
        try
        {
            parent::__construct($dsn, $username, $passwd);

        }catch (Message $e){
            $e->getMessage();
        }

        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    /*public function connect()
    {
        try {
            $this->dbh = new PDO('mysql:dbname=products;host=127.0.0.1', 'app', 'jJ69NLoxoJdcfSV8qojylnWxpmkMAdQi');
            var_dump($this->dbh);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }*/

    private function queryX($statement)
    {
        //todo trycatch
        $this->query($statement);

    }

    public function selectX($from, $where, $fetchMode=false)
    {
        //mach $statement
        echo $statement = 'SELECT * FROM '.$from.' WHERE '.$where;

        $prepared = $this->prepare($statement);

        $prepared->debugDumpParams();

        $prepared->execute();


        if($fetchMode)
        {
            return $prepared->fetchall(PDO::FETCH_ASSOC);
        }else {
            return $prepared->fetch();
        }


    }

    public function insert($tbl, $clmn, $values)
    {
        echo $statement = 'INSERT INTO '.$tbl.' ('.$clmn.')  VALUES (?,?,?,?,?,?);';

        try{
            $prepared = $this->prepare($statement);

            $prepared->debugDumpParams();

            $prepared->execute($values);

        }catch (Message $e){

            $e->getMessage();
        }


    }

    public function update($tbl, $data, $where)
    {
        echo $statement = 'UPDATE '.$tbl.' SET '.$data.' WHERE '.$where;

        try{
            $prepared = $this->prepare($statement);

            $prepared->execute();

        }catch (PDOException $Exception){

            var_dump($Exception);
        }

    }

    public function delete()
    {

    }

}
