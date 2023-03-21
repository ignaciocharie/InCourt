<h1 class="">Welcome Admin<?php echo $_settings->info('lastname') ?></h1>
<hr>
<style>
  #cover_img_dash{
    width:100%;
    max-height:50vh;
    object-fit:cover;
    object-position:bottom center;
  }
</style>
<div class="main-cards">

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">TOTAL CATEGORIES</p>
              <span class="material-icons-outlined text-blue">inventory_2</span>
            </div>
            <span class="text-primary font-weight-bold"><?php 
                    $inv = $conn->query("SELECT count(id) as total FROM category_list where delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($inv);
                  ?>
                  <?php ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">FACILITIES</p>
              <span class="material-icons-outlined text-orange">add_business</span>
            </div>
            <span class="text-primary font-weight-bold"><?php 
                    $inv = $conn->query("SELECT count(id) as total FROM facility_list where delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($inv);
                  ?>
                  <?php ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">REGISTERED CLIENTS</p>
              <span class="material-icons-outlined text-green">how_to_reg</span>
            </div>
            <span class="text-primary font-weight-bold"><?php 
                    $mechanics = $conn->query("SELECT count(id) as total FROM `client_list` where delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($mechanics);
                  ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">PENDING BOOKINGS</p>
              <span class="material-icons-outlined text-red">notification_important</span>
            </div>
            <span class="text-primary font-weight-bold"><?php 
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where status = 0 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?></span>
          </div>

        </div>
<div class="row">
        <hr>
    <div class="text-center">
      
    </div>
</div>
