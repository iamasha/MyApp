<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 2;

$stmt = $pdo->prepare('SELECT * FROM Contacts ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$record_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

$Contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_Contacts = $pdo->query('SELECT COUNT(*) FROM Contacts')->fetchColumn();
?>
<?=template_header('Read')?>

<div class="Content read">
    <h2>Read Contacts</h2>
    <a href="create.php" class="create-contact">Create Contact</a>
    <table>
    <tr>
        <td>#</td>
        <td>Name</td>
        <td>Email</td>
        <td>Phone</td>
        <td>Title</td>
        <td>Created</td>
    </tr>
    </thead>
    <tbody>
        <?php foreach($Contacts as $contact): ?>
        <tr>
            <td><?=$contact['id']?></td>
            <td><?=$contact['Name']?></td>
            <td><?=$contact['Email']?></td>
            <td><?=$contact['Phone']?></td>
            <td><?=$contact['Title']?></td>
            <td><?=$contact['Created']?></td>
            <td class ="actions">
                <a href="update.php?id=<?=$contact['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                <a href="delete.php?id=<?=$contact['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>

    </tbody>
    </table>
    <div class="pagination">
        <?php if($page>1): ?>
        <a href ="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page*$records_per_page<$num_Contacts): ?>
        <a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
        </div>
        </div>

        <?=template_footer()?>
    