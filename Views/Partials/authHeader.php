<?php /** * @var \shoppingCart\Models\user $user[] */
/**
 * @var \shoppingCart\Models\Category $category[]
 */
if($_SESSION['userid'] > 1 ) {$isUser = true;}


?>

<?php if(!isset($_SESSION['userid']) && $isUser == false) : ?>

<?php else: $isUser == true ?>
<?php endif ?>


<?php if($isUser == true): ?>
    <h1>Welcome <?= ucfirst($this->userName); ?></h1>

    <a href="<?= $this->url('users','logout')?>">Logout</a>
<?php endif ?>


</br></br>
<a href="<?=$this->url('products')?>">Products:</a>

