<?php 
session_start();
 include("connect.php");
$Pet2Id = $_POST['selectPetd'];


if($Pet2Id == 'newPet')
{ // start if new pet
  ?>
<div class="row row0-5">
                      <div class="col-md-3">
               <div class="form-group">
                  <label for="">Pet Name <label style="color:red; font-size: 1.2rem;">*</label></label>
                   <input type="hidden" class="form-control"  name="petid2[]" value="0">
                 
                  <input type="text" class="form-control"  name="nchild_name2[]" required>
                  <input type="hidden" class="form-control"  name="pet" value="pet2">
                  <input type="hidden" class="form-control"  name="neworSame" value="0">

              </div>
            </div>
             <div class="col-md-2">
                <div class="form-group">
                 <label for="gender">Gender <label style="color: #435D7D;"></label> <label style="color:red; font-size: 1.2rem;">*</label></label>
                  <select name="nchild_kasarian2[]"  class="form-control" required="required">
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                 </select>
              </div>
            </div>
             <div class="col-md-2">
                <div class="form-group">
                <label for="dob">Date of Birth<label style="color: #435D7D;"></label><label style="color:red; font-size: 1.2rem;">*</label></label>
                <input type="date" class="form-control" name="nchild_birthday2[] " required>
              </div>
            </div>
             <div class="col-md-2">
                <div class="form-group">
                 <label for="gender">Pet Type <label style="color: #435D7D;"></label> <label style="color:red; font-size: 1.2rem;">*</label></label>
                  <select name="petType2[]"  class="form-control" required="required">
                    <option value="cat">Cat</option>
                    <option value="dog">Dog</option>
                     <option value="fosh">Fish</option>
                 </select>
              </div>
            </div>
              <div class="col-md-3">
                <div class="form-group">
                <label for="dob">Breed(optional)<label style="color: #435D7D;"></label><label style="color:red; font-size: 1.2rem;"></label></label>
                <input type="text" class="form-control" name="breed2[] ">
              </div>
            </div>
            <?php
 $queryCategory = "SELECT * FROM services_tbl join category_tbl on services_tbl.category_idfk = category_tbl.category_id WHERE services_isactive = '1'";
$resQueryCategory = mysqli_query($con, $queryCategory);

$categories = array(); // Array to store unique category names

while ($rowCategory = mysqli_fetch_assoc($resQueryCategory)) {
    $categoryName = $rowCategory['category_name'];
    $serviceName = $rowCategory['services_name'];
    $price = $rowCategory['services_price'];
     $category_id = $rowCategory['category_id'];
     $servId = $rowCategory['services_id'];

    if (!isset($categories[$categoryName])) {
        // Add the category to the array if it's not already present
        $categories[$categoryName] = array();
    }

    // Add the service to the corresponding category in the array
    $categories[$categoryName][] = array(
        'name' => $serviceName,
        'price' => $price,
        'servId' => $servId,
        'category_id' => $category_id
    );
}
?>
<div class="row mt-2">
  <div class="col">
    <?php
    $index = 0;
    foreach ($categories as $categoryName => $services) {
      if ($index % 2 == 0) {
         ?>
        <h5 style="color:#210062 ; font-size:1.5 rem; background-color:;"><?php echo $categoryName ?></h5>
        <?php
    
        foreach ($services as $service) {

          ?>
          <div class="mt-1 mb-3 shadow p-3 bg-info rounded" style="background-color:whitesmoke; border: 1px solid skyblue; font-size:1.2rem;">
             <input type="checkbox" name="cat2[]" value="<?php echo $service['servId'] ?>" style="transform: scale(1.2);margin-left: 2px;">
<input type="hidden" name="servicesName2[]" value="<?php echo $service['name'] ?>">
<label style="width:50%; color: #044350;"><?php echo $service['name'] ?></label>
<!-- <label>₱<?php echo $service['price'] ?></label><br> -->
          </div>
          <?php

        }
      }
      $index++;
    }
    ?>
  </div>
  <div class="col">
    <?php
    $index = 0;
    foreach ($categories as $categoryName => $services) {
      if ($index % 2 != 0) {
        ?>
        <h5 style="color:#210062 ; font-size:1.5 rem; background-color:;"><?php echo $categoryName ?></h5>
        <?php
    
        foreach ($services as $service) {

          ?>
          <div class="mt-1 mb-3 shadow p-3 bg-info rounded" style="background-color:whitesmoke; border: 1px solid skyblue; font-size:1.2rem;">
            <input type="checkbox" name="cat2[]" value="<?php echo $service['servId'] ?>" style="transform: scale(1.2);">
<input type="hidden" name="servicesName2[]" value="<?php echo $service['name'] ?>">
<label style="width:50%; color: #044350;"><?php echo $service['name'] ?></label>
<!-- <label>₱<?php echo $service['price'] ?></label><br> -->
          </div>
          <?php

        }
      }
      $index++;
    }
    ?>
  </div>
</div>
             <div class="col-md-6 mt-2">
                <div class="form-group">
               <button type="button" class="remove-btn-mybtnn1 btn btn-danger">Remove</button>
            </div>
            </div>
      </div>
      <?php

} // end if new pet
else
{ // start else oldpet

?>

<div class="row row0-5">
  <?php 
   $queryPet = "select * from pets where id = '$Pet2Id'";
        $resqueryPet= mysqli_query($con, $queryPet);
        while($rowqueryPet = mysqli_fetch_assoc($resqueryPet))
        {
        

  ?>
                      <div class="col-md-3">
               <div class="form-group">
                  <label for="">Pet Name <label style="color:red; font-size: 1.2rem;">*</label></label>
                   <input type="hidden" class="form-control"  name="petid2[]" value = "<?php echo $rowqueryPet['id'] ?>">
                 
                  <input type="text" class="form-control"  name="nchild_name2[]"  value="<?php echo $rowqueryPet['pet_name'] ?>" readonly>
                  <input type="hidden" class="form-control"  name="pet" value="pet2">
                  <input type="hidden" class="form-control"  name="neworSame" value="0">

              </div>
            </div>
             <div class="col-md-2">
                <div class="form-group"> 
                 <label for="gender">Gender <label style="color: #435D7D;"></label> <label style="color:red; font-size: 1.2rem;">*</label></label>
                 <input type="text" class="form-control"  name="nchild_kasarian2[]" value="<?php echo $rowqueryPet['pet_gender'] ?>" readonly>
                  
              </div>       
            </div> 
             <div class="col-md-2">
                <div class="form-group">
                <label for="dob">Date of Birth<label style="color: #435D7D;"></label><label style="color:red; font-size: 1.2rem;">*</label></label>
                <input type="date" class="form-control" name="nchild_birthday2[]" value="<?php echo $rowqueryPet['pet_dob'] ?>" readonly>
              </div>       
            </div>
             <div class="col-md-2">
                <div class="form-group"> 
                 <label for="gender">Pet Type <label style="color: #435D7D;"></label> <label style="color:red; font-size: 1.2rem;">*</label></label>
                 <input type="text" class="form-control"  name="petType2[]" value="<?php echo $rowqueryPet['pet_type'] ?>" readonly>
                 
              </div>       
            </div> 
              <div class="col-md-3">
                <div class="form-group">
                <label for="dob">Breed<label style="color: #435D7D;"></label><label style="color:red; font-size: 1.2rem;"></label></label>
                <input type="text" class="form-control" name="breed2[]" value="<?php echo $rowqueryPet['pet_breed'] ?>" readonly>
              </div>       
            </div>


            <?php
      }
 $queryCategory = "SELECT * FROM services_tbl join category_tbl on services_tbl.category_idfk = category_tbl.category_id WHERE services_isactive = '1'";
$resQueryCategory = mysqli_query($con, $queryCategory);

$categories = array(); // Array to store unique category names

while ($rowCategory = mysqli_fetch_assoc($resQueryCategory)) {
    $categoryName = $rowCategory['category_name'];
    $serviceName = $rowCategory['services_name'];
    $price = $rowCategory['services_price'];
     $category_id = $rowCategory['category_id'];
     $servId = $rowCategory['services_id'];

    if (!isset($categories[$categoryName])) {
        // Add the category to the array if it's not already present
        $categories[$categoryName] = array();
    }

    // Add the service to the corresponding category in the array
    $categories[$categoryName][] = array(
        'name' => $serviceName,
        'price' => $price,
        'servId' => $servId,
        'category_id' => $category_id
    );
}
?>
<div class="row mt-2">
  <div class="col">
    <?php
    $index = 0;
    foreach ($categories as $categoryName => $services) {
      if ($index % 2 == 0) {
         ?>
        <h5 style="color:#210062 ; font-size:1.5 rem; background-color:;"><?php echo $categoryName ?></h5>
        <?php
    
        foreach ($services as $service) {

          ?>
          <div class="mt-1 mb-3 shadow p-3 bg-info rounded" style="background-color:whitesmoke; border: 1px solid skyblue; font-size:1.2rem;">
             <input type="checkbox" name="cat2[]" value="<?php echo $service['servId'] ?>" style="transform: scale(1.2);margin-left: 2px;">
<input type="hidden" name="servicesName2[]" value="<?php echo $service['name'] ?>">
<label style="width:50%; color: #044350;"><?php echo $service['name'] ?></label>
<!-- <label>₱<?php echo $service['price'] ?></label><br> -->
          </div>
          <?php

        }
      }
      $index++;
    }
    ?>
  </div>
  <div class="col">
    <?php
    $index = 0;
    foreach ($categories as $categoryName => $services) {
      if ($index % 2 != 0) {
        ?>
        <h5 style="color:#210062 ; font-size:1.5 rem; background-color:;"><?php echo $categoryName ?></h5>
        <?php
    
        foreach ($services as $service) {

          ?>
          <div class="mt-1 mb-3 shadow p-3 bg-info rounded" style="background-color:whitesmoke; border: 1px solid skyblue; font-size:1.2rem;">
            <input type="checkbox" name="cat2[]" value="<?php echo $service['servId'] ?>" style="transform: scale(1.2);">
<input type="hidden" name="servicesName2[]" value="<?php echo $service['name'] ?>">
<label style="width:50%; color: #044350;"><?php echo $service['name'] ?></label>
<!-- <label>₱<?php echo $service['price'] ?></label><br> -->
          </div>
          <?php

        }
      }
      $index++;
    }
    ?>
  </div>
</div>
             <div class="col-md-6 mt-2">
                <div class="form-group">
               <button type="button" class="remove-btn-mybtnn1 btn btn-danger">Remove</button>
            </div>
            </div>
      </div>
      <?php


} // end eld oldpet
