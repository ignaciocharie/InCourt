<div class="card card-outline card-primary shadow rounded-0">
    <div class="card-header">
        <h3 class="card-title"><b>Booking List</b></h3>
        <div class="card-tools">
            <a href="?page=bookings/choose_facility" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="20%">
                    <col width="15%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-dark text-light">
                        <th class="text-center">#</th>
                        <th class="text-center">Date Booked</th>
                        <th class="text-center">Ref. Code</th>
                        <th class="text-center">Facility</th>
                        <th class="text-center">Client</th>
                        <th class="text-center">Scheduled Date</th>
                        <th class="text-center">Start Time</th>
                        <th class="text-center">End Time</th>
                        <th class="text-center">Hours</th>
                        <th class="text-center">Fee</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $bookings = $conn->query("SELECT b.*,concat(c.fullname,'') as client, f.name as facility,cc.name as category, (f.price * b.hours) as fee FROM `booking_list` b inner join client_list c on b.client_id = c.id inner join facility_list f on b.facility_id = f.id inner join category_list cc on f.category_id = cc.id order by unix_timestamp(b.date_created) desc ");
                    while($row = $bookings->fetch_assoc()):
                    ?>
                        <tr>
                            <td class="text-center"><?= $i++ ?></td>
                            <td><?= date("M-d-y h:iA", strtotime($row['date_created'])) ?></td>
                            <td><?= $row['ref_code'] ?></td>
                            <td>
                                <p class="truncate-1 m-0"><?= $row['facility'] ?></p>
                                <small class="text-muted"><?= $row['category'] ?></small>
                            </td>
                            <td><?= $row['client'] ?></td>
                            <td><?= date("M-d-y", strtotime($row['date_to'])) ?></td>
                            <td><?= date("h:iA", strtotime($row['start_time'])) ?></td>
                            <td><?= date("h:iA", strtotime($row['end_time'])) ?></td>
                            <td><?= $row['hours'] ?></td>
                            <td><?php echo $row['fee'] ?></td>
                            <td class="text-center">
                                <?php 
                                    switch($row['status']){
                                        case 0:
                                            echo "<span class='badge badge-secondary bg-gradient-secondary px-3 rounded-pill'>Pending</span>";
                                            break;
                                        case 1:
                                            echo "<span class='badge badge-primary bg-gradient-primary px-3 rounded-pill'>Confirmed</span>";
                                            break;
                                        case 2:
                                            echo "<span class='badge badge-warning bg-gradient-success px-3 rounded-pill'>Done</span>";
                                            break;
                                        case 3:
                                            echo "<span class='badge badge-danger bg-gradient-danger px-3 rounded-pill'>Cancelled</span>";
                                            break;
                                    }
                                ?>
                            </td>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-flat btn-sm btn-default border view_data" href="javascript:void(0)" data-id="<?= $row['id'] ?>"><i class="fa fa-eye"></i> View</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(function(){

        $('.table th, .table td').addClass("align-middle px-2 py-1")
		$('.table').dataTable();
		$('.table').dataTable();
        $('.view_data').click(function(){
            uni_modal("Booking Details","bookings/view_booking.php?id="+$(this).attr('data-id'))
        })
    })
</script>