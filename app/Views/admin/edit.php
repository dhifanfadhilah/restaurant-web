<section class="section-reserve">
		<header>
			<h1> Admin Menu</h1>
		</header>
	</section>

	<section class="section-form" id="form">
        <div class="column">
            <h1>Edit data id : <?=esc($data['id'])?></h1>
            <form class="form-login">
                <div class="form-group">
                <label for="Name">Name:</label><br>
                <input type="text" id="Name" name="name" value="<?= esc($data['full_name'])?>" disabled><br>
                 </div> 
                 <div class="form-group">
                <label for="Pax">Total Pax:</label><br>
                <input type="number" id="total_pax" name="total_pax" value="<?= esc($data['total_pax'])?>" disabled><br>
                 </div> 
                 <div class="form-group">
                <label for="Name">status:</label><br>
                <select class="form-control" id="status" name="status">
                    <option value="<?= esc($data['status'])?>">Current Status <?= esc($data['status'])?></option>
                    <option value="Completed">Completed</option>
                    <option value="Paid">Paid</option>
                    <option value="Arrived">Arrived</option>
                    <option value="Waiting">Waiting</option>
                </select>
                 </div> 
                 <br><br>
                <div class="form-group">
                <input type="hidden" name="trxId" value="<?= esc($data['id'])?>">
                <button type="submit" class="btn btn-primary" name="submit">Edit Status</button></div>
                    </form>        
            </div>   
    </section>

    <script>
        const form = document.querySelector('form');
 
        // update product to database
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const id = form.trxId.value;
            const status = form.status.value;
 
            try {
                await fetch(`/Admin/update/${id}`, {
                    method: "PUT",
                    body: JSON.stringify({ status}),
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                }); 
                location.assign('/Admin/success');
            } catch (err) {
                console.log(err);
            }
        });
         
    </script>
