<?php
include 'functions.php';
$pdo=pdo_connect_mysql();
$msg='';
if(!empty($_POST)){
    $id=isset($_POST['Id']) && !empty($_POST['Id']) && $_POST['Id'] !='auto' ? $_POST['Id'] : NULL;
    $Name = isset($_POST['Name']) ? $_POST['Name'] : '';
    $Email = isset($_POST['Email']) ? $_POST['Email'] : '';
    $Phone = isset($_POST['Phone']) ? $_POST['Phone'] : '';
    $Title = isset($_POST['Title']) ? $_POST['Title'] : '';
    $Created = isset($_POST['Created']) ? $_POST['Created'] :date('Y-m-d H:i:s');

    //insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO Contacts VALUES(?, ?, ?, ?, ?, ?)');
    $stmt->execute([$Id, $Name, $Email, $Phone, $Title, $Created]);

    $msg = 'Created Successfully';
}
?>
<?=template_header('create')?>
<div class="content update">
    <h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="Name">Name</label>
        <input type="text" name="Id" placeholder="26" value="auto" id="Id">
        <input type="text" name="Name" placeholder="name" id="Name">
        <label for="Email">Email</label>
        <label for="Phone">Phone</label>
        <input type="text" name="Email" placeholder="example@gmail.com" id="Email">
        <input type="text" name="Phone" placeholder="+25670000000" id="Phone">
        <label for="Title">Title</label>
        <label for="Created">Created</label>
        <input type="text" name="Title" placeholder="Employee" id="Title">
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created">
        <input type="submit" value="create">
        </form>
        <?php if ($msg): ?>
        <p><?=$msg?></p>
        <?php endif; ?>
    </div>
    <?=template_footer()?>