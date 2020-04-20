<br>
<br>
<br>
<table id="product-list">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>VAT</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach($product_list as $product){
         ?>

        <tr>
            <td>
                <input type="text" data-reset-val="<?php echo $product->__get('name') ?>" name="name" value="<?php echo $product->__get('name') ?>">
            </td>
            <td>
                <input type="number" data-reset-val="<?php echo $product->__get('price') ?>" name="price" value="<?php echo $product->__get('price') ?>">
            </td>
            <td>
                <input type="number" data-reset-val="<?php echo $product->__get('quantity') ?>" name="quantity" value="<?php echo $product->__get('quantity') ?>">
            </td>
            <td>
                <input type="number" data-reset-val="<?php echo $product->__get('vat') ?>" name="vat" min="0" max="100" step="1" value="<?php echo $product->__get('vat') ?>">
            </td>
            <td>
                <button class="delete-btn" data-id="<?php echo $product->__get('pk') ?>" name="delete">DELETE</button>
            </td>
            <td>
                <button class="edit-btn" data-id="<?php echo $product->__get('pk') ?>" name="edit">EDIT</button>
            </td>
            <td>
                <button class="reset-btn" name="reset">RESET</button>
            </td>
            <td>
                <button onclick="location.href='index.php?pk=<?= $product->__get('pk') ?>'">SHOW</button>
            </td>
        </tr>
    <?php }
    ?>
    </tbody>
</table>