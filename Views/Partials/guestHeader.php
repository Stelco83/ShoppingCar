<?php

use shoppingCart\models\category;

    $categories = \shoppingCart\repositories\CategoryRepository::create()->getAll();

?>
<h2>Welcome Guest!</h2>
<h3>Categories:</h3>
<?php foreach ($categories as $category) :?>
    <div>
        <a style="color: chocolate" href="<?= $this->url('categories', 'change' , ['id' => $category->getId()]);?>">
            <h3><?= $category->getName() ?></h3>
        </a>
    </div>
<?php endforeach?>
