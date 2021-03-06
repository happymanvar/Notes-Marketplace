<?php
session_start();

$page = 'settings';

if (!isset($_SESSION['is_loggedin']) && !((isset($_SESSION['is_admin'])) || (isset($_SESSION['is_superadmin'])))) {
    header('location:../login.php');
} else {
    $first_name = $_SESSION['username'];
    $last_name = $_SESSION['lastname'];
    $email_id = $_SESSION['email'];
    $adminid = $_SESSION['user_id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Manage Country</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">


</head>

<body>

    <!-- Navigation Bar -->
    <?php
    include 'admin-header.php';

    include 'db_conntect.php';
    ?>
    <!-- Navigation Bar END -->

    <?php
    if (isset($_GET['id'])) {
        $countryid = $_GET['id'];

        $updatecountry = "UPDATE countries SET `IsActive` = b'0', `ModifiedDate` = current_timestamp(), `ModifiedBy` = '$adminid' WHERE ID = '$countryid'";
        $updatequery = mysqli_query($conn, $updatecountry);
        if (!($updatequery)) {
            die("QUERY FAILED" . mysqli_error($conn));
        } else {
            header('location:manage-country.php');
        }
    }
    ?>

    <!-- Manage Country Starts -->
    <section id="manage-country">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="horizontal-heading">
                            <h3>Manage Country</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12 text-left">
                        <div id="add-country">
                            <a class="btn add-country-btn" href="add-country.php" title="ADD COUNTRY" role="button">ADD COUNTRY</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="row text-right">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-9 col-12">
                                <div class="row">
                                    <div class="col-md-8 col-8 table-search-bar">
                                        <div class="form-group">
                                            <input type="search" class="form-control" id="search" placeholder="Search">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-4 table-header-search-btn">
                                        <div id="search-btn">
                                            <a class="btn table-search-btn" title="search" role="button">SEARCH</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="manage-country-table table-responsive">

                            <table class="table table-hover" id="country-data-table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="table-header">SR NO.</th>
                                        <th scope="col" class="table-header seller">COUNTRY NAME</th>
                                        <th scope="col" class="table-header">COUNTRY CODE</th>
                                        <th scope="col" class="table-header date">DATE ADDED</th>
                                        <th scope="col" class="table-header seller">ADDED BY</th>
                                        <th scope="col" class="table-header">ACTIVE</th>
                                        <th scope="col" class="table-header">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $countrydata = "SELECT * FROM countries ORDER BY CreatedDate DESC";
                                    $countrydataquery = mysqli_query($conn, $countrydata);
                                    $count = mysqli_num_rows($countrydataquery);
                                    for ($i = 1; $i <= $count; $i++) {
                                        $cdata = mysqli_fetch_assoc($countrydataquery);
                                    ?>
                                        <tr style="height: 50px;" class="text-center">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $cdata['Name']; ?></td>
                                            <td><?php echo $cdata['CountryCode']; ?></td>
                                            <td><?php $addeddate =  $cdata['CreatedDate'];
                                                $date = strtotime($addeddate);
                                                echo date('d-m-Y, H:i', $date); ?></td>
                                            <td><?php
                                                $createrid = $cdata['CreatedBy'];
                                                $creater = "SELECT * FROM users WHERE ID = $createrid";
                                                $createrquery = mysqli_query($conn, $creater);
                                                $createrdata = mysqli_fetch_assoc($createrquery);
                                                echo $createrdata['FirstName'] . " " . $createrdata['LastName'];
                                                ?></td>
                                            <td><?php
                                                if ($cdata['IsActive'] == 1) {
                                                    echo "Yes";
                                                } else {
                                                    echo "No";
                                                }
                                                ?></td>
                                            <td class="text-center">
                                                <a href="add-country.php?id=<?php echo $cdata['ID']; ?>"><img src="admin-images/images/edit.png" alt="edit"></a>
                                                <a class="delete-country" href="manage-country.php?id=<?php echo $cdata['ID']; ?>"><img src="admin-images/images/delete.png" alt="delete"></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Manage Country Ends -->

    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>
    <!-- Footer Ends -->
    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- DataTable JS -->
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#country-data-table').DataTable({
                'sDom': '"top"i',
                "iDisplayLength": 5,
                language: {
                    paginate: {
                        next: '<img src="admin-images/images/right-arrow.png">',
                        previous: '<img src="admin-images/images/left-arrow.png">'
                    }
                }
            });

            $('.table-search-btn').click(function() {
                var x = $('#search').val();
                table.search(x).draw();

            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('.delete-country').click(function() {
                if (confirm('Are you sure you want to make this country inactive?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>

</body>

</html>