<?php 
    // ==================== SESSION INITIALIZATION ====================

    if(!isset($_SESSION)){
        session_start();
    }

    // ==================== DATABASE CONNECTION ====================

    include "database.php";
    
    // ==================== QUERIES ====================

    $sqlEmployeesTable = $database->query("SELECT employees_tbl.ID, employees_tbl.emp_firstname, employees_tbl.emp_lastname, employees_tbl.emp_age, employees_tbl.emp_gender, emp_pos_tbl.position, employees_tbl.emp_address, employees_tbl.emp_status FROM employees_tbl INNER JOIN emp_pos_tbl ON employees_tbl.emp_position = emp_pos_tbl.ID") or die ($database->error);

    if(isset($_POST['addEmployee'])){

        $empFirstname = $_POST['inputEmployeeFirstname'];
        $empLastname = $_POST['inputEmployeeLastname'];
        $empAge = $_POST['inputEmployeeAge'];
        $empGender = $_POST['selectEmployeeGender'];
        $empPosition = $_POST['selectEmployeePosition'];
        $empAddress = $_POST['inputEmployeeAddress'];

        $database->query("INSERT INTO `employees_tbl`(`ID`, `emp_firstname`, `emp_lastname`, `emp_age`, `emp_gender`, `emp_position`, `emp_address`, `emp_status`) VALUES (NULL,'$empFirstname','$empLastname','$empAge','$empGender','$empPosition','$empAddress','Employed')") or die ($database->error);
        $_SESSION['message']= "
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Added $empFirstname $empLastname in the employees record!',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 2000,
                });
            </script>
        ";
        header("Refresh:2; url=index.php");
    }

    if(isset($_POST['editEmployee'])){

        $empEditID = $_POST['inputHiddenEditEmployeeID'];
        $empEditFirstname = $_POST['inputEditEmployeeFirstname'];
        $empEditLastname = $_POST['inputEditEmployeeLastname'];
        $empEditAge = $_POST['inputEditEmployeeAge'];
        $empEditGender = $_POST['selectEditEmployeeGender'];
        $empEditPosition = $_POST['selectEditEmployeePosition'];
        $empEditAddress = $_POST['inputEditEmployeeAddress'];
        $empEditStatus = $_POST['selectEditEmployeeStatus'];

        $database->query("UPDATE `employees_tbl` SET `emp_firstname`='$empEditFirstname', `emp_lastname`='$empEditLastname', `emp_age`='$empEditAge', `emp_gender`='$empEditGender', `emp_position`='$empEditPosition', `emp_address`='$empEditAddress', `emp_status`='$empEditStatus' WHERE `ID`='$empEditID'") or die ($database->error);
        $_SESSION['message']= "
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '$empEditFirstname $empEditLastname details has been updated',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 2000,
                });
            </script>
        ";
        header("Refresh:2; url=index.php");
    }

    if(isset($_POST['deleteEmployee'])){

        $empDeleteID = $_POST['inputHiddenDeleteEmployeeID'];
        $empDeleteName = $_POST['inputHiddenDeleteEmployeeName'];

        $database->query("DELETE FROM `employees_tbl` WHERE `ID`='$empDeleteID'") or die ($database->error);
        $_SESSION['message']= "
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '$empDeleteName details has been deleted',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 2000,
                });
            </script>
        ";
        header("Refresh:2; url=index.php");
    }

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Records</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/af-2.3.7/b-2.1.1/cr-1.5.5/date-1.1.1/fc-4.0.1/fh-3.2.1/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.4/sr-1.0.1/datatables.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="js/jquery.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/af-2.3.7/b-2.1.1/cr-1.5.5/date-1.1.1/fc-4.0.1/fh-3.2.1/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.4/sr-1.0.1/datatables.min.js"></script>
    
</head>

<body>

    <style>
        .table.dataTable th {
            background-color: unset;
            border-bottom: #fff;
        }

        tr.even td {
            background-color: unset;
        }

        tr.odd td {
            background-color: unset;
        }
    </style>

    <!-- ==================== MAIN CONTENT ==================== -->

    <div class="content m-3">
        <div class="container">
            <?php
                if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
            ?>

            <!-- ==================== EMPLOYEES TITLE ROW ==================== -->

            <div class="row mb-2">
                <div class="col d-flex align-items-center">
                    <p class="fw-bold lead m-0 me-auto d-flex align-items-center">
                        <i class='bx bxs-group fs-1'></i>&emsp;Employee Records
                    </p>
                    <button class="btn btn btn-primary d-flex align-items-center" type="button" data-bs-toggle="modal" data-bs-target="#modalAddEmployee">
                        <i class='bx bx-plus fs-5'></i>&nbsp;Add New Employee
                    </button>
                </div>
            </div>
    

            <!-- ==================== EMPLOYEES TABLE ==================== -->

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <table class="datatable-desc-2 table table-hover responsive nowrap w-100">
                                <thead class="bg-primary text-light">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Position</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    <?php while($fetch = $sqlEmployeesTable->fetch_array()){ ?>
                                        <tr>
                                            <td class="align-middle">2022-100<?php echo $fetch['ID']?></td>
                                            <td class="align-middle"><?php echo $fetch['emp_firstname']." ".$fetch['emp_lastname']?></td>
                                            <td class="align-middle"><?php echo $fetch['emp_age']?></td>
                                            <td class="align-middle"><?php echo $fetch['emp_gender']?></td>
                                            <td class="align-middle"><?php echo $fetch['position']?></td>
                                            <td class="align-middle"><?php echo $fetch['emp_address']?></td>     
                                            <td class="align-middle"><?php echo $fetch['emp_status']?></td>      
                                            <td class="align-middle text-center">
                                                <button class="btn btn-sm btn-success p-1" data-bs-toggle="modal" data-bs-target="#modalEmployeeEdit<?php echo $fetch['ID']?>">
                                                    <i class='bx bx-edit fs-6 d-flex align-items-center' data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Employee"></i>
                                                </button>
                                                <?php
                                                    if ($fetch['emp_status'] == 'Resigned') {
                                                        ?>
                                                            <button class="btn btn-sm btn-danger p-1" data-bs-toggle="modal" data-bs-target="#modalEmployeeDelete<?php echo $fetch['ID']?>">
                                                                <i class='bx bx-trash fs-6 d-flex align-items-center' data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Employee"></i>
                                                            </button>
                                                        <?php
                                                    }   
                                                ?>
                                            </td>

                                            <!-- ==================== EDIT EMPLOYEE DETAILS ==================== -->

                                            <div class="modal fade" id="modalEmployeeEdit<?php echo $fetch['ID']?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="" method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Update <?php echo $fetch['emp_firstname']." ".$fetch['emp_lastname'] ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="inputHiddenEditEmployeeID" value="<?php echo $fetch['ID']?>"/>
                                                                <div class="mb-2">
                                                                    <label for="inputEditEmployeeName" class="form-label">Employee Name</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control w-50" id="inputEditEmployeeFirstname" name="inputEditEmployeeFirstname" placeholder="Firstname" value="<?php echo $fetch['emp_firstname']?>" required>
                                                                        <input type="text" class="form-control w-50" id="inputEditEmployeeLastname" name="inputEditEmployeeLastname" placeholder="Lastname" value="<?php echo $fetch['emp_lastname']?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <label for="inputEditEmployeeAge" class="form-label">Age</label>
                                                                            <input type="number" class="form-control" id="inputEditEmployeeAge" name="inputEditEmployeeAge" value="<?php echo $fetch['emp_age']?>" placeholder="Age" min="1" max="120" required>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label for="selectEditEmployeeGender" class="form-label">Gender</label>
                                                                            <select class="form-select" name="selectEditEmployeeGender">
                                                                                <option value="Male" <?php if ($fetch['emp_gender'] == 'Male') echo "selected";?>>Male</option>
                                                                                <option value="Female" <?php if ($fetch['emp_gender'] == 'Female') echo "selected";?>>Female</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="selectEditEmployeePosition" class="form-label">Position</label>
                                                                    <select class="form-select" id="selectEditEmployeePosition" name="selectEditEmployeePosition" required>
                                                                        <?php
                                                                            $query = "SELECT * FROM emp_pos_tbl";
                                                                            $result = $database->query($query);
                                                                            if($result->num_rows > 0){
                                                                                while ($row = $result->fetch_assoc()){
                                                                                    echo "<option value='{$row["ID"]}' ";
                                                                                    if ($fetch['position'] == $row["ID"]) {
                                                                                        echo "selected";
                                                                                    } 
                                                                                    echo ">{$row['position']}</option>";
                                                                                }
                                                                            }
                                                                            else {
                                                                                echo "<option value='' disabled>No available position</option>"; 
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="inputEditEmployeeAddress" class="form-label">Address</label>
                                                                    <input type="text" class="form-control" id="inputEditEmployeeAddress" name="inputEditEmployeeAddress" value="<?php echo $fetch['emp_address']?>" placeholder="Address" required>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="selectEditEmployeeStatus" class="form-label">Status</label>
                                                                    <select class="form-select" name="selectEditEmployeeStatus">
                                                                        <option value="Employed" <?php if ($fetch['emp_status'] == 'Employed') echo "selected";?>>Employed</option>
                                                                        <option value="Resigned" <?php if ($fetch['emp_status'] == 'Resigned') echo "selected";?>>Resigned</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-success" name="editEmployee" id="editEmployee">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- ==================== DELETE EMPLOYEE DETAILS ==================== -->

                                            <div class="modal fade" id="modalEmployeeDelete<?php echo $fetch['ID']?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="" method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete <?php echo $fetch['emp_firstname']." ".$fetch['emp_lastname'] ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="inputHiddenDeleteEmployeeID" value="<?php echo $fetch['ID']?>"/>
                                                                <input type="hidden" name="inputHiddenDeleteEmployeeName" value="<?php echo $fetch['emp_firstname']." ".$fetch['emp_lastname']?>"/>
                                                                <div class="mb-2">
                                                                    Are you sure you want to delete the records of <?php echo $fetch['emp_firstname']." ".$fetch['emp_lastname']?>?, This move cannot be reverted later.
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-success" name="deleteEmployee" id="deleteEmployee">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- ==================== START - ADD EMPLOYEES MODAL ==================== -->

            <form action="" method="POST">
                <div class="modal fade" id="modalAddEmployee" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Employee</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label for="inputEmployeeName" class="form-label">Employee Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control w-50" id="inputEmployeeFirstname" name="inputEmployeeFirstname" placeholder="Firstname" required>
                                        <input type="text" class="form-control w-50" id="inputEmployeeLastname" name="inputEmployeeLastname" placeholder="Lastname" required>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="inputEmployeeAge" class="form-label">Age</label>
                                            <input type="number" class="form-control" id="inputEmployeeAge" name="inputEmployeeAge" placeholder="Age" min="1" max="120" required>
                                        </div>
                                        <div class="col-6">
                                            <label for="selectEmployeeGender" class="form-label">Gender</label>
                                            <select class="form-select" name="selectEmployeeGender">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="selectEmployeePosition" class="form-label">Position</label>
                                    <select class="form-select" id="selectEmployeePosition" name="selectEmployeePosition" required>
                                        <option value="">Choose Employee Position</option>
                                        <?php
                                            $query = "SELECT * FROM emp_pos_tbl";
                                            $result = $database->query($query);
                                            if($result->num_rows > 0){
                                                while ($row = $result->fetch_assoc()){
                                                    echo "<option value='{$row["ID"]}'>{$row['position']}</option>";
                                                }
                                            }
                                            else {
                                                echo "<option value='' disabled>No available position</option>"; 
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="inputEmployeeAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="inputEmployeeAddress" name="inputEmployeeAddress" placeholder="Address" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="addEmployee" name="addEmployee" class="btn btn-primary w-100">Register Employee</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('.datatable-desc-2').DataTable({
            "scrollX": false,
            "ordering": true,
            columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
            "order": [[ 0, "asc" ]]
        });
    </script>

</body>
</html>