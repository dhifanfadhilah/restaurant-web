<section class="section-reserve">
		<header>
			<h1> Admin Menu</h1>
		</header>
	</section>
    <?php if(isset($msg)):?>
    <div class="alert <?= $msg[0] ?>-alert">
                <h3><?= $msg[1] ?></h3>  </div>     
              <?php endif; ?>
	<section class="section-form" id="form">
        <div class="column">
            <h1>Kelola Pesanan</h1>
            <table class="table1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Pilihan Menu</th>
                    <th>Jumlah Pax</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>RSVP</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
                </thead>
            <tbody>
             
            </tbody>
            </table>	
   
            </div>   
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Call function showData on loaded content
            showData();
        });
 
        // show data from database
        const showData = async () => {
            try {
                const response = await fetch('/Admin/getTransactions', {
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });
                const data = await response.json();
                 
                const table = document.querySelector('table tbody');
                let rowData = "";
                data.forEach(({ id,full_name,product,total_pax,price,type,payment,status,reserve_date,order_date }) => {
                    rowData += `<tr>`;
                    rowData += `<td>${id}</td>`;
                    rowData += `<td>${full_name}</td>`;
                    rowData += `<td>${product}</td>`;
                    rowData += `<td>${total_pax}</td>`;
                    rowData += `<td>${price}</td>`;
                    rowData += `<td>${type}</td>`;
                    rowData += `<td>${payment}</td>`;
                    rowData += `<td>${status}</td>`;
                    rowData += `<td>${reserve_date}</td>`;
                    rowData += `<td>${order_date}</td>`;
                    rowData += `<td>`;
                    rowData += `<a href="/Admin/update/${id}" class="btn-edit">Edit</a>`;
                    rowData += `<a href="/Admin/delete/${id}" class="btn-delete" data-id="${id}">Delete</a>`;
                    rowData += `</td>`;
                    rowData += `</tr>`;
                });
                table.innerHTML = rowData;
            } catch (err) {
                console.log(err);
            }
        }
 
        // Delete product method
        document.querySelector('table tbody').addEventListener('click', async (event) => {
            const id = event.target.dataset.id;
            try {
                await fetch(`/Admin/delete/${id}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                }); 
                showData();
            } catch (err) {
                console.log(err);
            }
        });
 
    </script>