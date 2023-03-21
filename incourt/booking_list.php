<br/><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="content py-5 mt-5">
    <div class="container">
        <div class="card card-outline card-primary shadow rounded-0">
            <div class="card-header">
                <h4 class="card-title">My Booking List</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                <table class="table table-striped table-bordered align-items-center mb-0">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="25%">
                        <col width="15%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Date Booked</th>
                            <th class="text-center">Ref Code</th>
                            <th class="text-center">Facility</th>
                            <th class="text-center">Scheduled Date</th>
                            <th class="text-center">Start Time</th>
                            <th class="text-center">End time</th>
                            <th class="text-center">Hours</th>
                            <th class="text-center">Fee</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT b.*,f.name as facility, c.name as category, (f.price * b.hours) as fee FROM `booking_list` b inner join facility_list f on b.facility_id = f.id inner join category_list c on f.category_id = c.id where b.client_id = '{$_settings->userdata('id')}' order by unix_timestamp(b.date_created) desc");
                            while($row = $qry->fetch_assoc()):
                                
                        ?>
                        <tr>
                            <td class="text-center"><?= $i++; ?></td>
                            <td><?= date("M-d-y h:iA", strtotime($row['date_created'])) ?></td>
                            <td><?= $row['ref_code'] ?></td>
                            <td>
                                <p class="m-0 truncate-1"><?= $row['facility'] ?></p>
                                <p class="m-0 truncate-1"><?= $row['category'] ?></p>
                            </td>
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
                                            echo "<span class='badge badge-primary bg-gradient-success px-3 rounded-pill'>Reserved</span>";
                                            break;
                                        case 3:
                                            echo "<span class='badge badge-danger bg-gradient-danger px-3 rounded-pill'>Cancelled</span>";
                                            break;
                                    }
                                ?>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-flat btn-light border btn-sm view_data" data-id="<?= $row['id'] ?>">View</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                </div>
            </div>  
        </div>
    </div>
</div>
<script>
    $(function(){
        $('table th, table td').addClass('px-2 py-1 align-middle')
        $('table').dataTable();

        $('.view_data').click(function(){
            uni_modal("Booking Details","view_booking.php?id="+$(this).attr('data-id'))
        })
    })
</script>