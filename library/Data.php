<?php
class Data {
    /**
     *Transformarea rezultatului lucrului funcției de selecție a randurilor din bd în masic cu PDO
     * @param $rs
     * @return array
     */
    static function createSmartyRsArrayPDO($stmt)
    {
        $result = array();
        try {
            $result[] = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    /**
     *Преобразование результата работы функции выборки в ассоциативный массив
     *
     * @param $rs
     * @return array
     */
    static function createSmartyRsArray($rs){

        if(! $rs) return false;

        $smartyRs = array();
        while ($row = mysqli_fetch_assoc($rs)){
            $smartyRs[] = $row;
        }
        return $smartyRs;
    }
    /**
     * Implementation of mysql_field_name in mysqli
     *
     * @param $result
     * @param $field_offset
     * @return null
     */
    static function mysqli_field_name($result, $field_offset)
    {
        $properties = mysqli_fetch_field_direct($result, $field_offset);
        return is_object($properties) ? $properties->name : null;
    }
}
