   <section class="section-reserve">
		<header>
			<h1>Please Fill Out This Dine In Form</h1>
		</header>
	</section>
	<section class="section-form-menu" id="menu">
        <div class="column">
            <h1>Our Delightful Menu</h1>
            <?php if(isset($msg)):?>
    <div class="alert <?= $msg[0] ?>-alert">
                <h3><?= $msg[1] ?></h3>
              </div>     
              <?php endif; ?>
            <form action="/Dine/create"  method="POST">
                <div class="form-group">
                <label for="fname">Full name:</label><br>
                <input type="text" id="fname" name="fname" ><br>
                 </div> 
                <div class="form-group">
                    <label for="lname">Email:</label><br>
                   <input type="email" id="email" name="email" ><br><br>
                   </div>
                <div class="form-group">
                <label for="lname">How many will be dining:</label><br>
                <input type="number" id="guests" name="guests" value="1"><br><br>
                </div>
                <div class="form-group">
                <label for="lname">Pick Our Signature Set Menu:</label><br>
                <select class="form-control" id="sets" name="sets">
                    <option value="0">Pick Your Desire Set</option>
                    <?php foreach($products as $productsItem): ?>
                    <option value="<?= $productsItem['title']; ?>"><?= $productsItem['title']; ?> Rp<?= $productsItem['price']; ?>/pax</option>
                    <?php endforeach; ?>
                </select></div>
				<div class="form-group">
                    <label for="lname">Payment Method:</label><br>
                    <select class="form-control" id="payment" name="payment">
                        <option value="0">Pick Your Payment</option>
                        <option value="Cashier">At the cashier</option>
                    </select></div><br><br>
                <div class="form-group"><button type="submit" class="btn btn-primary">Book Now</button></div>
                    </form>        
            </div>
            <?php if($products):  ?>
			<?php foreach($products as $productsItem): ?>
			<div class="column">
			<h2><?= $productsItem['title']; ?></h2>
            <h2>Rp <?= $productsItem['price']; ?>/pax</h2>
<img src="<?= $productsItem['main_course']; ?>" title="<?= $productsItem['main_course_name']; ?>" style="width:100%">
<img src="<?= $productsItem['main_drink']; ?>" title="<?= $productsItem['main_drink_name']; ?>" style="width:100%">
<img src="<?= $productsItem['additional']; ?>" title="<?= $productsItem['additional_name']; ?>" style="width:100%">
</div>
        <?php endforeach; ?>
		<?php else: ?>
<p>Our Menu is on Upload Process</p>
		<?php endif; ?>
    </section>