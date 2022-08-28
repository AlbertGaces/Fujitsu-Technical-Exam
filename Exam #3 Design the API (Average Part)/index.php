<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Records</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="jquery.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    

</head>

<body>

    <!-- ==================== MAIN CONTENT ==================== -->

    <div class="content m-3">
        <div class="container">

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
                            <table class="table table-hover nowrap w-100">
                                <thead class="bg-primary text-light">
                                    <th>ID</th>
                                    <th>Fullname</th>
                                    <th>Position</th>
                                    <th>Section</th>
                                    <th>Status</th>
                                </thead>
                                <tbody class="table-body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== START - ADD EMPLOYEES MODAL ==================== -->

            <form action="" method="POST" id="addEmployeesForm">
                <div class="modal fade" id="modalAddEmployee" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Employee</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label for="inputEmployeeName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="inputEmployeeName" name="inputEmployeeName" required>
                                </div>
                                <div class="mb-2">
                                    <label for="inputEmployeePosition" class="form-label">Position</label>
                                    <input type="text" class="form-control" id="inputEmployeePosition" name="inputEmployeePosition" required>
                                </div>
                                <div class="mb-2">
                                    <label for="inputEmployeeSection" class="form-label">Section</label>
                                    <input type="text" class="form-control" id="inputEmployeeSection" name="inputEmployeeSection" required>
                                </div>
                                <div class="mb-2">
                                    <label for="inputEmployeeStatus" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="inputEmployeeStatus" name="inputEmployeeStatus" required>
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
</body>
<script src="script.js"></script>
</html>