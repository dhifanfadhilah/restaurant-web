<section class="section-menu" id="menu">
	
        <div class="column">
			<h1>Our Delightful Menu</h1>
			</div>
			<?php if($products):  ?>
			<?php foreach($products as $productsItem): ?>
			<div class="column">
			<h2><?= $productsItem['title']; ?></h2>
			<h3>Rp <?= $productsItem['price']; ?>/pax</h3>
<img src="<?= $productsItem['main_course']; ?>" title="<?= $productsItem['main_course_name']; ?>" style="width:100%">
<img src="<?= $productsItem['main_drink']; ?>" title="<?= $productsItem['main_drink_name']; ?>" style="width:100%">
<img src="<?= $productsItem['additional']; ?>" title="<?= $productsItem['additional_name']; ?>" style="width:100%">
</div>
        <?php endforeach; ?>
		<?php else: ?>
<p>Our Menu is on Upload Process</p>
		<?php endif; ?>
		
</section>