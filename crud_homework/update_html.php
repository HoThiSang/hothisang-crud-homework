<?php require_once('partial/header.php');
require_once "database/database.php";
$student = selectOneStudent($_GET['id']);

?>

<div class="container p-4">
    <form action="update_model.php" method="post">
        <input type="hidden" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>">
        <div class="form-group">
            <input type="text" class="form-control" value="<?php echo $student['name'] ?>" name="name">
        </div>
        <div class="form-group">
            <input type="number" class="form-control" value="<?php echo $student['age'] ?>" name="age">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" value="<?php echo $student['email'] ?>" name="email">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" value="<?php echo $student['profile'] ?>" name="image_url">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" onclick="Edit(event, <?= $id ?>)">Update</button>
        </div>
    </form>
</div>
<?php require_once('partial/footer.php'); ?>