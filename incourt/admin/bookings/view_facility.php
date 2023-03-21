<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT f.*, c.name as category from `facility_list` f inner join category_list c on f.category_id = c.id where f.id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}
?>
<style>
    .facility-img{
        width:100%;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<section class="py-5">
    <div class="container pt-4">
        <div class="card rounded-0 card-outline card-primary shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img src="<?= validate_image(isset($image_path) ? $image_path : "") ?>" alt="facility Image <?= isset($name) ? $name : "" ?>" class="img-thumbnail facility-img">
                    </div>
                </div>
                <fieldset>
                    <div class="row">
                        <div class="col-md-12">
                            <small class="mx-2 text-muted">Name</small>
                            <div class="pl-4"><?= isset($name) ? $name : '' ?></div>
                        </div>
                        <div class="col-md-12">
                            <small class="mx-2 text-muted">Description</small>
                            <div class="pl-4"><?= isset($description) ? $description : '' ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <small class="mx-2 text-muted">Price</small>
                            <div class="pl-4"><?= isset($price) ? number_format($price,2) : '' ?></div>
                        </div>
                    </div>
                </fieldset>
                <center>
                    <a href="?page=bookings/manage_booking&fid=<?= $id ?>&<?= $price ?>" class="btn btn-large btn-primary rounded-pill w-25">Book Now</a>
                </center>
            </div>
        </div>
    </div>
</section>

<script>

  
</script>