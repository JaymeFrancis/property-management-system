<div class="sidebar">
    
<img class="nav-logo" style="width: 200px; height:200px; justify-self:center;" src="../../../assets/images/pms-logo.png" alt="logo">
    <ul style="padding: 0px;">
        <li>
            <a class="sub-btn" href="..\..\dashboard\dboard\dashboard.php"><i class="fa fa-home"></i></span> Dashboard</a>
        </li>
        <li class="item">
            <a class="sub-btn" href="#"><span class="btn-label"><i class="fa fa-th-list"></i></span> Stock Management</a>
            <ul class="sub-menu" style="display: none; padding: 0px;">
                <li><a class="sub-item" href="..\..\stock-management\stockroom\stkrm-particulars.php">Stockroom Supplies</a></li>
                <li><a class="sub-item" href="..\..\stock-management\janitorial\jtrl-particulars.php">Janitorial Supplies</a></li>
            </ul>
        </li>
        <li class="item">
            <a class="sub-btn" href="#"><span class="btn-label"><i class="fa fa-pencil"></i></span> Record Issuance</a>
            <ul class="sub-menu" style="display: none; padding: 0px;">
                <li><a class="sub-item" href="..\..\record-issuance\stockroom\requests.php">Record Stockroom Issuance</a></li>
                <li><a class="sub-item" href="..\..\record-issuance\janitorial\requests.php">Record Janitorial Issuance</a></li>
            </ul>
        </li>
        <li class="item">
            <a class="sub-btn" href="#"><i class="fa fa-th"></i></span> Equipment and Fixture</a>
            <ul class="sub-menu" style="display: none; padding: 0px;">
                <li><a class="sub-item" href="..\..\equipment-fixtures\memorandum-receipt\memorandum.php">Memorandum Receipt</a></li>
                <li><a class="sub-item" href="..\..\equipment-fixtures\inventory-locations\inventory-locations.php">Inventory by Location</a></li>
                <li><a class="sub-item" href="..\..\equipment-fixtures\inventory\inventory.php">Equipment Inventory</a></li>
                <li><a class="sub-item" href="..\..\equipment-fixtures\assign-equipment\assign-item.php">Assign Equipment Location</a></li>
                <li><a class="sub-item" href="..\..\equipment-fixtures\surrender-form\surrender.php">Surrendered Equipment</a></li>
            </ul>
        </li>
        <li class="item">
            <a class="sub-btn" href="#"><i class="fa fa-shopping-cart"></i></span> Purchase Order</a>
            <ul class="sub-menu" style="display: none; padding: 0px;">
                <li><a class="sub-item" href="..\..\purchase-order\for-purchase-order\purchase-order.php">For Purchase Order Items</a></li>
                <li><a class="sub-item" href="..\..\purchase-order\stockroom\orders.php">Stockroom Purchase Order</a></li>
                <li><a class="sub-item" href="..\..\purchase-order\janitorial\orders.php">Janitorial Purchase Order</a></li>
            </ul>
        </li>
        <li class="item">
            <a class="sub-btn" href="#"><i class="fa fa-file"></i></span> Reports</a>
            <ul class="sub-menu" style="display: none; padding: 0px;">
                <li><a class="sub-item" href="..\..\reports\stockroom-issuance\stockroom-issuance-report.php">Stockroom Issuance Report</a></li>
                <li><a class="sub-item" href="..\..\reports\janitorial-issuance\janitorial-issuance-report.php">Janitorial Issuance Report</a></li>
                <li><a class="sub-item" href="..\..\reports\stockroom-position\stock-position.php">Stockroom Stock Position Report</a></li>
                <li><a class="sub-item" href="..\..\reports\janitorial-position\janitorial-position.php">Janitorial Stock Position Report</a></li>
                <li><a class="sub-item" href="..\..\reports\summary-report\summary.php">Summary Report</a></li>
            </ul>
        </li>
        <li class="item">
            <a class="sub-btn" href="#"><i class="fa fa-cog"></i></span> Utilities</a>
            <ul class="sub-menu" style="display: none; padding: 0px;">
                <li><a class="sub-item" href="..\..\utilities\backup\backup-db.php">Back-Up</a></li>
                <li><a class="sub-item" href="..\..\utilities\restore\restore-db.php">Restore</a></li>
                <li><a class="sub-item" href="..\..\utilities\help\user-help.php">Help</a></li>
                <li><a class="sub-item" href="..\..\utilities\user-management\user-management.php">User Management</a></li>
                <li><a class="sub-item" href="..\..\utilities\audit-logs\audit-logs.php">Audit Logs</a></li>
            </ul>
        </li>
        <li>
            <a class="sub-btn" href="../../../function.php?log=logout" id="logout" name="logout"><i class="fa fa-sign-in"></i></span> Log Out</a>
        </li>
    </ul>
    <div class="col user-profile">
        <p><i class="fa fa-user-circle"></i> Logged in as:</p>
        <p style="font-size: 15px;"><?php echo $_SESSION['name']; ?></p>
        <p style="font-size: 15px;"><?php echo $_SESSION['user_lvl']; ?></p>
    </div>
</div>



<!-- Sub-Menu Script -->
<script type="text/javascript">
   $(document).ready(function(){
     //jquery for toggle sub menus
     $('.sub-btn').click(function(){
       $(this).next('.sub-menu').slideToggle();
     });
   });
</script>
