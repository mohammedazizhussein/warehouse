<?php
include('../includes/conn.php');
include('functions.php');
$id=$_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['emp_name']) && isset($_POST['dep_id'])) {
        if ($_POST['emp_name'] != "" && $_POST['dep_id'] != "") {

            /// scape the spicial char for security resones
            $emp_name = $_POST['emp_name'];
            $dep_id = $_POST['dep_id'];


            $sql = "UPDATE emp SET emp_name='$emp_name',dep_id='$dep_id' WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                $success = "تم تحديث الموظف بنجاح";
                header('location: view_emp.php');
                exit();
            } else {
                echo mysqli_error($conn);
            }



        } else {
            $error = "حقل اسم الموظف والقسم  لايمكن ان يكون فارغا";
        }

    }
}else{
 
    $sql="SELECT * FROM emp WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if ($res) {
    $row=mysqli_fetch_assoc($res);
    } else {
        echo mysqli_error($conn);
    }




}

?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحديث موظف</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="select22.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="stylem.css">
</head>

<body class=" gradient-custom">
    <?php include("../includes/menu.php") ?>
    <section>
        <div class="container py-5 h-200">

            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h2 class="fw-bold mb-2 text-uppercase">اضافة الموظفين</h2>
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <form action="" method="POST">
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="typeEmailX">اسم الموظف</label>
                                        <input type="text" id="typeEmailX" class="form-control form-control-lg"
                                            name="emp_name" value="<?php 

                                            echo $row['emp_name'] 
                                            
                                            ?>" />
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <div class="col-md-12 " style=" margin-top:20px;">
                                            <label for="selectData" class="mb-1">القسم</label>
                                            <select class="form-control" name="dep_id">
                                            <?php echo getItemsWithS('dep_table', 'dep_name', $row['dep_id']); ?>
                                            </select>
                                        </div>
                                    </div>




                            </div>

                            <!-- <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p> -->

                            <div class="mt-2">
                                <button class="btn btn-outline-warning btn-lg px-5" type="submit">تحديث
                                    موظف</button>
                            </div>
                            </form>
                            <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger mt-2' role='alert'>
                                    $error
                                  </div>";
                            }
                            if (!empty($success)) {
                                echo "<div class='alert alert-success mt-2' role='alert'>
                                    $success
                                  </div>";
                            }


                            ?>
                            <!-- <div>
                                    <p><a href="addusers.php"
                                            class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">اضافة
                                            مستخدمين</a>
                                        </p>
                                </div> -->



                            <!-- <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div> -->

                        </div>



                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="jquery.validate.min.js"></script>
    <script src="select2.min.js"></script>
    <script src="script.js"></script>

</body>

</html>