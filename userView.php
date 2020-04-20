<?php
include('User.php');
include ('UserManager.php');

$user_manager = new UserManager();
$display='list';

if (isset($_POST) && isset($_POST['type']))
{
    if ($_POST['type'] == 'create')
    {
        $ret = $user_manager->save($_POST);
        if (!$ret) {
            echo "Les données encodées ne sont pas correctes";
        }
    }
    if ($_POST['type'] == 'edit')
    {
        if ($user_manager->update($_POST)) {
            echo "true";
        } else {
            echo "Les données encodées ne sont pas correctes";
        }
        exit;
    }
    else if ($_POST['type'] == 'delete') // appelée dans script.js ($('.delete-btn').on('click'...))
    {
        if ($user_manager->delete($_POST['pk'])) {
            echo "true";
        } else {
            echo "false";
        }
        exit;
    }
}

if(isset($_GET) && isset($_GET['pk'])) {
    $user = $user_manager->fetch($_GET['pk']);
    $display = 'one';
} else {
    $user_list = $user_manager->fetchAll();
}

?>

<h1>Bienvenue chez les users</h1>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DocumentUser</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="script.js"></script>
</head>
<body>

<form action="userView.php" method="get" id="user-search-form">
    <label for="pk-search">Rechercher User</label>
    <input type="number" name="pk" id="pk-search" min="0">
    <input type="submit" value="Rechercher">
</form>
<br>
<br>



<form action="userView.php" method="post">
    <label for="name">Encodez un nouvel utilisateur: </label>
    <input type="hidden" name="type" value="create">
    <input type="text" name="username" required>
    <input type="password" name="password" minlength="8">
    <input type="submit">
</form>
<br>


<form action="userView.php" method="post">
</form>

<section id="ajaxUser">
</section>

<?php if($display == 'one') include 'unique_user.php'; ?>
<?php if($display == 'list') include 'all_user.php'; ?>

</body>
</html>