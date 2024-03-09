<!DOCTYPE html>
<html lang="en">
<?php include '../../../head.php'; ?>
<body>

<?php 
session_start();
require '../../../config.php'; 
?>

<div class="wrapper">
<?php include '../../auditor-nav.php'; ?>
    <div class="main_content">
    <?php include '../../../navbar.php'; ?>

        <div class="info">

            <div class="page-title">
                <div class="row" style="display: flex;">
                    <div class="col-6">
                        <h2>Dashboard</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 mb-0">
                    <div class="card border-start border-5 border-primary shadow h-100 py-2 mb-0">
                        <div class="card-body mb-0">
                            <div class="row no-gutters align-items-center mt-2 mb-4">
                                <div class="col mr-2 mb-0">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Stocks Available</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        10
                                    </div>
                                </div>
                                <div class="col-auto mb-0">
                                    <i class="fa fa-book fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 mb-0">
                    <div class="card border-start border-5 border-primary shadow h-100 py-2 mb-0">
                        <div class="card-body mb-0">
                            <div class="row no-gutters align-items-center mt-2 mb-4">
                                <div class="col mr-2 mb-0">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Stockroom Stocks</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        10
                                    </div>
                                </div>
                                <div class="col-auto mb-0">
                                    <i class="fa fa-book fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 mb-0">
                    <div class="card border-start border-5 border-primary shadow h-100 py-2 mb-0">
                        <div class="card-body mb-0">
                            <div class="row no-gutters align-items-center mt-2 mb-4">
                                <div class="col mr-2 mb-0">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Janitorial Stocks</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        10
                                    </div>
                                </div>
                                <div class="col-auto mb-0">
                                    <i class="fa fa-book fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 mb-0">
                    <div class="card border-start border-5 border-primary shadow h-100 py-2 mb-0">
                        <div class="card-body mb-0">
                            <div class="row no-gutters align-items-center mt-2 mb-4">
                                <div class="col mr-2 mb-0">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Stocks issued</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        10
                                    </div>
                                </div>
                                <div class="col-auto mb-0">
                                    <i class="fa fa-book fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 mb-0">
                    <div class="card border-start border-5 border-primary shadow h-100 py-2 mb-0">
                        <div class="card-body mb-0">
                            <div class="row no-gutters align-items-center mt-2 mb-4">
                                <div class="col mr-2 mb-0">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Janitorial</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        10
                                    </div>
                                </div>
                                <div class="col-auto mb-0">
                                    <i class="fa fa-book fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 mb-0">
                    <div class="card border-start border-5 border-primary shadow h-100 py-2 mb-0">
                        <div class="card-body mb-0">
                            <div class="row no-gutters align-items-center mt-2 mb-4">
                                <div class="col mr-2 mb-0">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Stockroom</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        10
                                    </div>
                                </div>
                                <div class="col-auto mb-0">
                                    <i class="fa fa-book fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include '../../../message.php';
?>

</body>
</html>