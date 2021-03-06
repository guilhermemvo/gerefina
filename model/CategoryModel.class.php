<?php

class CategoryModel extends BaseModel {

    const CREATE_QUERY = 'INSERT INTO category (name,description) VALUES (:name,:description)';
    const SELECT_QUERY = 'select * from category';

    public function __construct() {
        parent::__construct();
    }

    public function create(CategoryObject $categoryObject) {

        $params = array(
            'name' => $categoryObject->getName(),
            'description' => $categoryObject->getDescription()
        );

        try {
            return $this->call(self::CREATE_QUERY, $params, null);
        } catch (Exception $exc) {
            echo '<pre>Exception!</pre>';
            echo $exc->getMessage();
        }
    }

    public function select() {
        try {
            return $this->call(self::SELECT_QUERY, null, true);
        } catch (Exception $exc) {
            echo '<pre>Exception!</pre>';
            echo $exc->getMessage();
        }
    }

}
