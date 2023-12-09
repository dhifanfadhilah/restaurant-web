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
                    <th>Nama</th>
                    <th>Pilihan Menu</th>
                    <th>Main Course</th>
                    <th>Jumlah Pax</th>
                    <th>Price</th>
                    <th>Status</th>
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
                const response = await fetch('/Admin/getJoinDinein', {
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });
                const data = await response.json();
                 
                const table = document.querySelector('table tbody');
                let rowData = "";
                data.forEach(({full_name,product,main_course,total_pax,price,status}) => {
                    rowData += `<tr>`;
                    rowData += `<td>${full_name}</td>`;
                    rowData += `<td>${product}</td>`;
                    rowData += `<td> <img src="${main_course}" title="${main_course}" style="width:100%"></td>`;
                    rowData += `<td>${total_pax}</td>`;
                    rowData += `<td>${price}</td>`;
                    rowData += `<td>${status}</td>`;
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