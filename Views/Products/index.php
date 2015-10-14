<?php /** * @var \shoppingCart\Models\UserProduct $product */  ?>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Buy</th>
        <th>Sell</th>
    </tr>
    <?php foreach($this->userProducts as $product): ?>
        <tr>
            <td><?= $product->getProduct()->getName()?></td>
            <td><?= $product->getProduct()->getPrice()?></td>

            <td>
                <a href="<?= $this->url('products', 'buy', ['id' => $product->getProduct()->getId()]);  ?>">
               Buy <?=$product->getProduct()->getPrice() + $product->getLevel()->getCashConsume() ?>
                </a>
            </td>
            <td>
                <a href="<?= $this->url('products', 'sell', ['id' => $product->getProduct()->getId()]);  ?>">
                    Sell <?=$product->getProduct()->getPrice()+ $product->getLevel()->getCashConsume() ?>
                </a>
            </td>
        </tr>
    <?php endforeach ?>

</table>