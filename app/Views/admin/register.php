<section class="section-reserve">
		<header>
			<h1> Admin Menu</h1>
		</header>
	</section>

	<section class="section-form" id="form">
        <div class="column">
            <h1>Signup</h1>
            <?php if(isset($msg)):?>
    <div class="alert <?= $msg[0] ?>-alert">
                <h3><?= $msg[1] ?></h3>
              </div>     
              <?php endif; ?>
            <form action="<?=site_url('Admin/signup') ?>" method="POST" class="form-login">
                <div class="form-group">
                <label for="username">username:</label><br>
                <input type="text" id="username" name="username" ><br>
                 </div> 
                 <div class="form-group">
                 <label for="password">password:</label><br>
                <input type="password" id="password" name="password" ><br><br>
                </div><br><br>
                <div class="form-group"><button type="submit" class="btn btn-primary">Register Now</button></div>
                    </form>        
            </div>   
    </section>
