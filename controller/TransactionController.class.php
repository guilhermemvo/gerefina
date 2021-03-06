<?php

class TransactionController {

    const INSERT_TRANSACTION_SUCCESS = "Transação inserida com sucesso.";
    const INSERT_TRANSACTION_FAIL = "A Transação não foi cadastrada. Tente novamente mais tarde.";

    public function create() {

        if ($transactionObject->validateData($_POST)) {

            $transactionObject = new TransactionObject();
            $transactionObject->setName($_POST['name']);
            $transactionObject->setDescription($_POST['description']);
            $transactionObject->setType($_POST['type']);
            $transactionObject->setCategory($_POST['category']);
            $transactionObject->setAccount($_POST['account']);
            $transactionObject->setDate($_POST['date']);
            $transactionObject->setValue($_POST['value']);

            $transactionModel = new TransactionModel();

            try {
                if ($transactionModel->create($transactionObject)) {
                    echo INSERT_TRANSACTION_SUCCESS . '<br><br>';
                    $this->read();
                } else {
                    echo INSERT_TRANSACTION_FAIL . '<br><br>';
                }
            } catch (Exception $exc) {
                echo '<pre>Exception!</pre>';
                echo $exc->getMessage();
            }
        } else {

            View::output('newTransactionView');
        }
    }

    public function read() {

        $transactionModel = new TransactionModel();

        try {

            $objectList = $transactionModel->select();

            View::setParams(
                array(
                    'name' => 'Transaction',
                    'data' => $objectList
                )
            );

            View::output('listTransactionView');

        } catch (Exception $exc) {
            echo '<pre>Exception!</pre>';
            echo $exc->getMessage();
        }
    }

    public function update() {
        return 1;
    }

    public function delete() {
        return 1;
    }

}
