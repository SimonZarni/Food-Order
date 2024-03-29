<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include_once __DIR__ . "/../../controller/TownshipController.php";
$id=$_GET['id'];
$township_controller=new TownshipController();
if(isset($_GET['id'])){
    $township=$township_controller->getTownship($id);
}

if(isset($_POST['update'])){
    $error=false;
    if(!empty($_POST['township'])){
        $township=$_POST['township'];
    }else{
        $error=true;
        $township_error="Please enter your Township";
        echo $township_error;
    }
    
    $error=false;
    if(!empty($_POST['fee'])){
        $fee=$_POST['fee'];
    }else{
        $error=true;
        $fee_error="Please enter your Fee";
        echo $fee_error;
    }

    if(!$error){
        $status=$township_controller->updatetownship($id, $township, $fee);
        if($status){
            $message="update_status";
            header('location:township_list.php?update_status='.$message);
        }
    }else{
        echo $error;
    }
}
include_once __DIR__ . "/../../layouts/sidebar.php";
?>
<div class="container"> <!-- Added mt-4 for top margin -->
    <div class="row justify-content-center">
        <div class="col-md-6 my-5">
            <div class="card my-5">
                <div class="card-header">
                    <h4 class="card-title">Edit Township for ID-<?php echo $id?></h4>
                </div>
                <div class="card-body">
                    <form action="" method="Post">
                        <div class="form-group">
                            <label for="township">Township :</label>
                            <input type="text" class="form-control my-3" id="township" placeholder="Enter Township" name="township" value="<?php echo $township[0]['name'];?>">
                            <span class="text-danger my-2"><?php if(isset($township_error)) echo $township_error;?></span><br>
                        </div>
                        <div class="form-group">
                            <label for="fee">Fee :</label>
                            <input type="text" class="form-control my-3" id="fee" placeholder="Enter Fee" name="fee" value="<?php echo $township[0]['fee'];?>">
                            <span class="text-danger my-2"><?php if(isset($fee_error)) echo $fee_error;?></span><br>
                        </div>
                        <div class="text-center"> <!-- Center align button -->
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . "/../../layouts/footer.php";
?>