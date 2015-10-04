<?php /** * @var \shoppingCart\Models\user $user[] */
if($_SESSION['userid'] == 1 ) {$isAdmin = true;}

?>

<?php if(!isset($_SESSION['userid']) && $isAdmin == false) : ?>

<?php else: $isAdmin == true ?>
<?php endif ?>


<?php if($isAdmin ==true): ?>
<h1>Welcome <?= ucfirst($this->userName); ?></h1>
<a href="<?= $this->url('users','logout')?>">Logout</a>
<a href="<?= $this->url('users','delete')?>">Delete</a>
<a href="<?= $this->url('users','create')?>">Create</a>
<a href="<?= $this->url('users','edit')?>">Edit</a>
<?php endif ?>