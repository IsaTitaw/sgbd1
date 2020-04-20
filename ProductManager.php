<?php
//dao = data acces object
//dal = data access layer
include 'ItemManager.php';
include 'VerifyManager.php';

class ProductManager extends ItemManager {
    
    function __construct() {
        parent::__construct('products');
    }

    //---------crée un nouveau produit dans la BDD--------------------------------------------------------------------------
    function save($data) {
        $pk = -1;

        if (!VerifyManager::sanitizeData($data)) {
            return false;
        }

        $product = $this->create([
            'pk' => $pk,
            'name' => $data['name'],
            'price' => $data['price'],
            'vat' => $data['vat'],
            'quantity' => $data['quantity']
        ]);

        if ($product) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (name, price, vat, price_vat, price_total, quantity) VALUES (?, ?, ?, ?, ?, ?)"
                );
                $statement->execute([
                    $product->__get('name'),
                    $product->__get('price'),
                    $product->__get('vat'),
                    $product->__get('price_vat'),
                    $product->__get('price_total'),
                    $product->__get('quantity'),
                ]);
                return true;
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
        return false;
    }

    //---------update un nouveau produit dans la BDD--------------------------------------------------------------------------
    function update($data) {
        if (!VerifyManager::sanitizeData($data)) {
            return false;
        }

        $product = $this->create([
            'pk' => $data['pk'],
            'name' => $data['name'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'vat' => $data['vat'],
        ]);

        if ($product) {
            try {
                $statement = $this->connection->prepare(
                    "UPDATE {$this->table} SET name = ?, price = ?, quantity = ?, vat = ?, price_vat = ?, price_total = ? WHERE pk = ?"
                );
                $statement->execute([
                    $product->__get('name'),
                    $product->__get('price'),
                    $product->__get('quantity'),
                    $product->__get('vat'),
                    $product->__get('price_vat'),
                    $product->__get('price_total'),
                    $product->__get('pk'),
                ]);
                return true;
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
        return false;
    }

    //---------fonction qui crée un nouvel objet Product, retourne un array $data-----
    function create($data) {
        return new Product(
            $data['pk'],
            $data['name'],
            $data['price'],
            $data['vat'],
            $data['quantity']
        );
    }

}
