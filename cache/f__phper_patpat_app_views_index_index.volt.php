<div class="page-header">
    <h1>Congratulations!</h1>
</div>

<p>You're now flying with Phalcon. Great things are about to happen!</p>

<p>This page is located at <code>views/index/index.volt</code></p>

<?php //echo $product->name ?>
<br>
<?php //echo $product->title ?>

<?php foreach ($product as $p) { ?>

name:<?= $p['name'] ?>

<?php } ?>