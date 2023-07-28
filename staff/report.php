<?php
$page_title = 'Report';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   //page_require_level(3);
?>
<?php include_once('layouts/header.php'); ?>


<!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Report</h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <!-- <li class="breadcrumb-item">Forms</li> -->
              <li class="breadcrumb-item active" aria-current="page">Report</li>
            </ol>
          </div>

        <div class="row">
        <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Report by Date</h6>
                </div>
                <div class="card-body">
                <form method="post" action="report_process.php">
                  <div class="form-group" id="simple-date4">
                    <label for="dateRangePicker">Select Date Range</label>
                    <div class="input-daterange input-group">
                      <input type="text" class="input-sm form-control" name="start-date" />
                      <div class="input-group-prepend">
                        <span class="input-group-text">to</span>
                      </div>
                      <input type="text" class="input-sm form-control" name="end-date" />
                    </div>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary">Generate Report</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <div>
</div>
          <!--Row-->


<?php include_once('layouts/footer.php'); ?>
