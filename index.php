<?php 
include 'Product.php';
include 'ProductManager.php';

$product_manager = new ProductManager();
$display = 'list';

if (isset($_POST) && isset($_POST['type']))
{
    if ($_POST['type'] == 'create')
    {
        $ret = $product_manager->save($_POST);
        if (!$ret) {
            echo "Les données encodées ne sont pas correctes, veuillez recommencer sans choisir un prix ou une quantitté négative";
        }
    }
    if ($_POST['type'] == 'edit')

    {
        if ($product_manager->update($_POST)) {
            echo "true";
        } else {
            echo "Les données encodées ne sont pas correctes, veuillez recommencer sans choisir un prix ou une quantitté négative";
        }
        exit;
    }
    else if ($_POST['type'] == 'delete') // appelée dans script.js ($('.delete-btn').on('click'...))
    {
        if ($product_manager->delete($_POST['pk'])) {
            echo "true";
        } else {
            echo "false";
        }
        exit;
    }
}

if(isset($_GET) && isset($_GET['pk'])) {
    $product = $product_manager->fetch($_GET['pk']);
    $display = 'one';
} else {
    $product_list = $product_manager->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    
    <script src="script.js"></script>
</head>
<body>
    <button type="button" id="btn">CLICK ME</button>
    
       <form action="index.php" method="get" id="search-form">
        <label for="pk-search">Rechercher</label>
        <input type="number" name="pk" id="pk-search" min="0">
        <input type="submit" value="Rechercher">
    </form>
    
    <form action="index.php" method="post">
        <input type="hidden" name="type" value="create">
        <input type="text" name="name" required>
        <input type="number" name="price" step="0.01" min="0">
        <input type="number" name="quantity" min="0">
        <input type="number" name="vat" min="0" max="100" step="1">

        <input type="submit">
    </form>
    <br>

    <button class="user-btn" name="user">MANAGE USERS</button>
    
    <form action="index.php" method="post">
        
    </form>
    <section id="ajax-rsp">
        
    </section>
    
    <?php if($display == 'one') include 'unique_view.php'; ?>
    <?php if($display == 'list') include 'table_view.php'; ?>
</body>
</html>

