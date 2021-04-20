<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg='';

if(isset($_GET['Id'])){
    if(!empty($_POST)){
        $id = isset($_POST['Id']) ? $_POST['Id'] : NULL;
        $Name =isset($_POST['Name']) ? $_POST['Name'] : '';
        $Email =isset($_POST['Email']) ? $_POST['Email'] : '';
        $Phone =isset($_POST['Phone']) ? $_POST['Phone'] : '';
        $Title =isset($_POST['Title']) ? $_POST['Title'] : '';
        $Created =isset($_POST['Created']) ? $_POST['Created'] : date('Y-m-d H:i:s');
        $stmt =$pdo->prepare('UPDATE Contacts SET Id=?, Name=?, Email=?, Phone=?, Title=?, Created=? WHERE Id=?');
        $stmt->execute([$Id, $Name, $Email, $Phone, $Title, $Created, $_GET['Id']]);
        $msg = 'Updated Successfully!';
     }
     $stmt =$pdo->prepare('SELECT * FROM Contacts WHERE Id=?');
     $stmt->execute([$_GET['Id']]);
     $Contacts = $stmt->fetch(PDO::FETCH_ASSOC);
     if(!$contact){
         exit('Contact doesnt exist with that Id!');
     }
     else{
         exit('No Id specified!');
     }
}
?>
<?=template_header('Read')?>
<div class="content update">
    <h2>Update Contact #<?=$contact['Id']?></h2>
    <form action="update.php?id=<?=$contact['Id']?>" method="post">
        <label for="id">Id</label>
        <label for="Name">Name</label>
        <input type="text" name="Id" id="Id" placeholder="1" value="<?=$contact['Id']?>">
        <input type="text" name="Name" placeholder="sha" value="<?=$contact['Name']?>" id="name">
        <label for="Email">Email</label>
        <label for="Phone">Phone</label>
        <input type="email" name="Email" placeholder="sha@gmail.com" value="<?=$contact['Email']?>" id="email">
        <input type="text" name="Phone" Placeholder="+256757941028" value="<?=$contact['Phone']?>" id="phone">
        <label for="Title">Title</label>
        <label for="Created">Created</label>
        <input type="text" name="Title" placholder="Employee" value="<?=$contact['Title']?>" id="Title">
        <input type="datetime-local" name="Created" value="<?=date('Y-m-d\TH:i', strtotime($contact['Created']))?>" id="Created">
        <input type="Submit" value="Update">
    </form>
    <?php if($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
    </div>

    <?=template_footer()?>