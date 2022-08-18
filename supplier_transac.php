<?php
include'../includes/config.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
                $id = $_POST['supplierid'];
              $name = $_POST['companyname'];
              $loc = $_POST['location'];
              $phone = $_POST['phonenumber'];
        
              switch($_GET['action']){
                case 'add':     
                    $query = "INSERT INTO supplier
                              (SUPPLIER_ID, COMPANY_NAME, LOCATION_ID, PHONE_NUMBER)
                              VALUES ('".$id."','{$name}','{$loc}','".$phone."')";
                    mysqli_query($db,$query)or die ('Error in updating supplier in Database');
                break;
              }
            ?>
              <script type="text/javascript">window.location = "supplier.php";</script>
          </div>

<?php
include'../includes/footer.php';
?>