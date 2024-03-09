
<div class="sidebar">
<img class="nav-logo" style="width: 200px; height:200px; justify-self:center;" src="../../../assets/images/pms-logo.png" alt="logo">
    <ul style="padding: 0px;">
        <li>
            <a class="sub-btn" href="..\..\dashboard\dboard\dashboard.php"><i class="fa fa-home"></i></span> Dashboard</a>
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
