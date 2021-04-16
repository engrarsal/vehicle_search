<div class="container hidden" id="output" >
  <div class="row">
  <h2>Listings</h2>
  <p>All vehilecs in <?php echo $zip ?> zip Areas</p>            
  <table  id="table" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Year</th>
        <th>Make</th>
        <th>Model</th>
        <th>Price</th>
        <th>Dealer Name</th>
        <th>State</th>
        <th>City</th>
        <th>Zip Code</th>
        <th>Distance</th>
      </tr>

    </thead>
    <tbody>

      
      <?php 
      foreach ($listings as $vehicles) { ?>
  
      <tr>
        <td><?php echo $vehicles['year']; ?></td>
        <td><?php echo $vehicles['make']; ?></td>
        <td><?php echo $vehicles['model']; ?></td>
        <td><?php echo $vehicles['price']; ?></td>
        <td><?php echo $vehicles['dealer_name']; ?></td>
        <td><?php echo $vehicles['state']; ?></td>
        <td><?php echo $vehicles['city']; ?></td>
        <td><?php echo $vehicles['zip']; ?></td>
        <td><?php echo $vehicles['distance']; ?></td>
      </tr>
     <?php }  ?>

    </tbody>
  </table>
</div>
</div>
