<?php
include 'functions.php';
$pdo = $pdo_connect_mysql();
$msg='';

if(isset($_GET['id'])){
    $stmt = $pdo->prepare('SELECT * FROM Contacts WHERE id=?');
    $stmt->execute([$_GET['id']]);
    $contact =$stmt->fecth(PDO::FETCH_ASSOC);
    if(!contact){
        exit('Contact  doesnt exist with that ID!');
    }
    if(isset($_GET['confirm'])){
        if($_GET['cofirm']=='yes'){
            $stmt=$pdo->prepare('DELETE FROM Contacts WHEREid=?');
            $stmt->execute([$_GET['id']]);
            $msg='You deleted the contact';
        }else{
            header('Location: read.php');
            exit;
        }
    }
}else{
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
    <h2>Delete contact #<?-$contact['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Are you sure you want to delete contact#<$contact['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$contact['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$contact['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
    </div>
    <?=template_footer()?>