<?php
    session_start();
    $_SESSION['active_page'] = "admin/student_files";
    include "../common/header.php";
    include_once '../../model/Config.php';
    include_once '../../model/StudentModel.php';
    $studModel = new StudentModel($DB_con);
    $studentList = $studModel->searchStudent();
?>

<div class="main">
    <div class="header clearfix" style="border-bottom: 1px solid rgba(0,0,0,.1); margin-bottom: 8px;">
        <div style="float:left">
            <h4 class="text-success">Search Student</h4>
        </div>
        <div style="float:right">
            <form action="add_edit_student.php" method="POST">
                <input value="add" name="action" hidden>
                <button class="btn btn-success btn-sm">Add New Record</button>
            </form>
        </div>
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-sm" id="searchStudent"
            placeholder="Enter Student's Last Name or First Name">
    </div>
    <table class="table table-sm table-striped table-hover">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="studentList">
            <?php 
            foreach ($studentList as $student):  ?>
            <tr>
                <td><?php echo $student['studID']; ?></td>
                <td><?php echo $student['last_name']; ?></td>
                <td><?php echo $student['first_name']; ?></td>
                <td><?php echo $student['middle_name']; ?></td>
                <td class="text-center" style="width: 80px;">
                    <form action="../admin/add_edit_student.php" method="POST">
                        <input value="edit" name="action" hidden>
                        <input value=<?= $student['studID'] ?> name="studId" hidden>

                        <button type="submit" style="border:none; background:none"><i class="fa fa-pencil-square-o text-warning"
                                style="padding:4px;"></i></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<!--Script Here-->
<script>
$(document).ready(function() {
    $(document).on("keyup", "#searchStudent", function() {
        var searchValue = $(this).val();
        $.post("../../model/StudentService.php", {
                search: searchValue,
                action: "searchStudent"
            },
            function(data) {
                $("#studentList").html(data);
            }
        );
    });
});
</script>
<?php include "../common/footer.php"; ?>