<?php

require_once '../libraries/data_acces_layer.php';
// require_once '../libraries/util_response.php';


class Cinema {


    public function __construct() {
        $this->DAL = new Data_Access_Layer();
    }

    public function search(){

        $result = null;
        try {
            $result = $this->DAL->query("SELECT 
            cinema.id_cinema, 
            cinema.name, 
            cinema.qualification, 
            cinema.type, 
            cinema.date,
            category.name as category
        FROM cinema
        inner join category on cinema.category = category.id_category where state = 'activo'", [], false);
        } catch (Exception $e) {
            $result = $e->getMessage;
        }
        $this->DAL->close();
        return $result;
    }



    public function find($field){

        $result = null;
        try {
            $result = $this->DAL->query("SELECT 
            cinema.id_cinema, 
            cinema.name, 
            cinema.qualification, 
            cinema.type, 
            cinema.date,
            category.name as category
        FROM cinema
        inner join category on cinema.category = category.id_category where (cinema.name = :name) or (category.name = :category) and state = 'activo'", [":name" => $field, 'category' => $field], false);
        } catch (Exception $e) {
            $result = $e->getMessage;
        }
        $this->DAL->close();
        return $result;
    }


    public function findRecents(){

        $result = null;
        try {
            $result = $this->DAL->query("SELECT 
            cinema.id_cinema, 
            cinema.name, 
            cinema.qualification, 
            cinema.type, 
            cinema.date,
            category.name as category
        FROM cinema
        inner join category on cinema.category = category.id_category  where state = 'activo' order by id_cinema desc limit 5;", [], false);
        } catch (Exception $e) {
            $result = $e->getMessage;
        }
        $this->DAL->close();
        return $result;
    }


    public function findBetters(){

        $result = null;
        try {
            $result = $this->DAL->query("SELECT 
            cinema.id_cinema, 
            cinema.name, 
            cinema.qualification, 
            cinema.type, 
            cinema.date,
            category.name as category
        FROM cinema
        inner join category on cinema.category = category.id_category where qualification >= 4 and  state = 'activo' order by qualification desc;", [], false);
        } catch (Exception $e) {
            $result = $e->getMessage;
        }
        $this->DAL->close();
        return $result;
    }


    public function add ($cinema) {

        $result = null;
        try {
            $result = $this->DAL->query("Insert Into cinema (name, state, type, category, date) values (:name, 'activo', :type, :category, NOW())", $cinema, false);
        } catch (Exception $e) {
            $result = $e->getMessage;
        }
        $this->DAL->close();
        return $result;
    }

    public function delete ($idCinema) {

        $result = null;
        try {
            $result = $this->DAL->query("Update cinema Set state = 'inactivo' Where id_cinema = " . $idCinema, [], true);
        } catch (Exception $e) {
            $result = $e->getMessage;
        }
        $this->DAL->close();
        return $result;
    }

    public function qualify ($idCinema, $value) {

        $result = null;
        try {
            $result = $this->DAL->query("Update cinema set qualification = :value where id_cinema = :idCinema", [":value" => $value, ":idCinema" => $idCinema], true);
        } catch (Exception $e) {
            $result = $e->getMessage;
        }
        $this->DAL->close();
        return $result;
    }
}

?>