<?php /** * @var \shoppingCart\Models\Category $category[] */  ?>


<h2>Categories : </h2>
<?php foreach ($this->categories as $category): ?>

    <div>
        <a href="<?= $this->url('categories', 'change' , ['id' => $category->getId()]);?>"
           style="<?=$category->getId() == $_SESSION['category_id'] ? 'color:blue' : '' ?>">
        <h3><?= $category->getName() ?></h3>
        </a>
    </div>
<?php endforeach; ?>

