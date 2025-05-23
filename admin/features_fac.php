<?php
    require('inc/essen.php');
    require('inc/db_config.php');
    adminLogin();

    if(isset($_GET['seen']))
    {
        $frm_data = filteration($_GET);
        if($frm_data['seen']== 'all'){
            $q = "UPDATE `user_queries` SET `seen`=?";
            $values = [1];
            if(update($q,$values,'i'))
            {
                alert('success','Query marked as seen');
            }
            else
            {
                alert('error','Something went wrong');
            }
        }else{
            $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no` = ?";
            $values = [1,$frm_data['seen']];
            if(update($q,$values,'ii'))
            {
                alert('success','Query marked as seen');
            }
            else
            {
                alert('error','Something went wrong');
            }
        }
       
    }
    if(isset($_GET['del']))
    {
        $frm_data = filteration($_GET);
        
        $values = [$frm_data['del']];
        if(delete($q,$values,'i'))
        {
            $q = "DELETE FROM `user_queries`";   
            if(mysqli_query($con,$q))
            {
                alert('success','All data deleted!');
            }
            else
            {
                alert('error','Something went wrong');
            }   
        }else{
            $q = "DELETE FROM `user_queries` WHERE `sr_no` = ?";
            $values = [$frm_data['del']];
            if(delete($q,$values,'i'))
            {
                alert('success','Query deleted');
            }
            else
            {
                alert('error','Something went wrong');
            }
        }
        
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Features & Facilities</title>
    <?php require('inc/link.php'); ?>
</head>
<body class="bg-light">
    <?php require('inc/header.php'); ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden ">
                <h3 class="mb-4">FEATURES & FACILITIES</h3>
            

                <!-- Carousel  section-->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-center justify-content-between">
                            <h5 class="card-title m-0">FEATURES</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#features-s">
                                <i class="bi bi-plus-square"></i>Add
                            </button>
                        </div>
                        

                        <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;" >
                            <table class="table tabel-hover broder">
                                <thead class="stiky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>

                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="features-data">
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                 <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-center justify-content-between">
                            <h5 class="card-title m-0">Facilities</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#facility-s">
                                <i class="bi bi-plus-square"></i>Add
                            </button>
                        </div>
                        

                        <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;" >
                            <table class="table tabel-hover broder">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="facilities-data">
                                
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features team modal -->
    <div class="modal fade" id="features_s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="features_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Add Feature</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label  class="form-label">Name</label>
                            <input type="text"  name="features_name" id="features_name_inp" class="form-control shadow-none" required >
                        </div>
                    
                        
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
     <!-- Facilities team modal -->
    <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="facility_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Add Facility</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label  class="form-label">Name</label>
                            <input type="text"  name="facility_name" class="form-control shadow-none" required >
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Icon</label>
                            <input type="file"  name="facility_icon"  accept="[svg]" class="form-control shadow-none" required >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea namefacility_dsc="form-control shadow-none" rows="1" ></textarea>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>





    <?php require('inc/scripts.php'); ?>

   <script src="scripts/features_fac.js"></script>
   
</body>
</html>