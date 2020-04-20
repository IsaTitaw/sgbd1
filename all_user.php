<h1>Liste des utilisateurs</h1>
<br>
<br>
<br>
<table id="user-list">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Mdp</th>
        <th>Créé le</th>
        <th>Updaté le</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach($user_list as $user){
        ?>

        <tr>
            <td>
                <input type="text" name="username" value="<?php echo $user->__get('username') ?>">
            </td>
            <td>
                <input type="text" name="password" value="<?php echo $user->__get('password') ?>">
            </td>
<!--            <td>-->
<!--                <input type="text" name="created_at" value="--><?php //echo $user->__get('created_at') ?><!--">-->
<!--            </td>-->
<!--            <td>-->
<!--                <input type="text" name="$updated_at" value="--><?php //echo $user->__get('$updated_at') ?><!--">-->
<!--            </td>-->
            <td>
                <button class="user-delete-btn" data-id="<?php echo $user->__get('pk') ?>" name="delete">DELETE</button>
            </td>
            <td>
                <button class="user-edit-btn" data-id="<?php echo $user->__get('pk') ?>" name="edit">EDIT</button>
            </td>
        </tr>
    <?php }
    ?>
    </tbody>
</table>
