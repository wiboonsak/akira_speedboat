
<div class="table-responsive">
    <table class="table table-hover tablesorter">
        <thead>
            <tr>
                <th class="header">Transfer keygroup</th>
                <th class="header">Check in</th>                           
                <th class="header">Customer name</th>                      
                <th class="header">Customer telephone</th>
                <th class="header">Date booking</th>
                <th class="header">Total price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($employeeInfo) && !empty($employeeInfo)) {
                foreach ($employeeInfo as $key => $element) {
                    ?>
                    <tr>
                        <td><?php echo $element['transfer_keygroup']; ?></td>   
                        <td><?php echo $element['date_depart']; ?></td> 
                        <td><?php echo $element['customer_name']; ?></td>                       
                        <td><?php echo $element['customer_telephone']; ?></td>
                        <td><?php echo $element['date_booking']; ?></td>
                        <td><?php echo $element['total_price']; ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5">There is no employee.</td>    
                </tr>
            <?php } ?>
 
        </tbody>
    </table>
    <a class="pull-right btn btn-primary btn-xs" href="<?php echo site_url()?>export/createxls"><i class="fa fa-file-excel-o"></i> Export Data</a>
</div> 