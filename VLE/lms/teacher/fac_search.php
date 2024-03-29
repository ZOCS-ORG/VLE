<?php
	require_once('header.php');
?>

<body>

    <?php require '../includes/profile_navbar.php'; ?>

    <div class="row">

    <!-- search column starts here -->
      <div class="col s12 m2">        
          <div class="card horizontal">
            <div class="card-stacked">
              
              <div class="card-content brown-text">
              <span class="card-title">Search</span>    

              <form action="fac_search.php" method="GET" enctype="multipart/form-data">

              <div class="input-field col s12">
                <select name="srchYear">
                  <option value="" disabled selected>Choose Year</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div>            

              <div class="input-field col s12">
              <select name="srchSub">
              <option value="" disabled selected>Choose Subject</option>
                <?php  
                $sub_query = $db->query("SELECT * FROM subject WHERE tId='$tId'");
                while($row=$sub_query->fetch_assoc()){
                   $subName=$row['subName'];
                   $subId=$row['subId'];
                   $count=0;
                   ?>

                   <option value="<?php echo $subId ?>"><?php echo $subName ?></option> 

                 <?php } ?>
               </select>
              </div>              

              <div class="input-field col s12">
                <select name="srchBatch">
                  <option value="" disabled selected>Choose Batch</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                </select>
              </div>    

              <div class="input-field col s12">
                <input id="srchPNum" type="number" name="srchPNum" class="validate">
                <label for="srchPNum">Practical number</label>
              </div>          
            
              </div>
              <div class="card-action">
                <button class="btn green waves-effect waves-light" type="submit" name="search">Search
                  <i class="material-icons right">send</i>
                </button>
              </div>
              </form>
            </div>
          </div>
      </div>
    <!-- search column ends here --> 

    <!-- display column starts here -->

  <div class="col s12 m8">

      <?php 
      if(isset($_GET['search'])){

        if(!empty($_GET['srchYear'])){$srchYear=$_GET['srchYear'];}
        else{?>
          <div class="card-panel green ">
            <span class="white-text">
              Please select Year.
            </span>
          </div><br>
        <?php die(); }
        if(!empty($_GET['srchSub'])){$srchSub=$_GET['srchSub'];}
        else{?>
          <div class="card-panel green ">
            <span class="white-text">
              Please select Subject.
            </span>
          </div><br>
        <?php die(); }
        if(!empty($_GET['srchBatch'])){$srchBatch=$_GET['srchBatch'];}
        else{?>
          <div class="card-panel green ">
            <span class="white-text">
              Please select Batch
            </span>
          </div><br>
        <?php die(); } ?>

        <?php $srchPNum=$_GET['srchPNum'];
      ?>
          <div class="card-panel green ">
              <span class="white-text">Showing results for<br>
              year= <?php echo $_GET['srchYear']?><br>
              subject= <?php echo $_GET['srchSub']?><br>
              batch= <?php echo $_GET['srchBatch']?><br>
              practical number= <?php echo $_GET['srchPNum']?><br>
              </span>
          </div><br>
          <div class="row"> 
        <table class="responsive-table striped">
          <thead>
            <tr>
                <th data-field="reg_no">Reg No.</th>
                <th data-field="prac_no">Prac No.</th>
                <th data-field="practical">Practical</th>
                <th data-field="output">Output</th>
                <th data-field="marks">Marks</th>
                <th data-field="show">Show</th>                    
            </tr>
          </thead>
          <tbody>
      <?php

        $sub_query = $db->query("SELECT * FROM practical WHERE sYear='$srchYear' && subId='$srchSub' && sBatch='$srchBatch' && pracNum='$srchPNum'");
          while($row=$sub_query->fetch_assoc()){
              $pracId=$row['pracId'];
              $reg_no=$row['sReg_no'];
              $year=$row['sYear'];
              $batch=$row['sBatch'];
              $subId=$row['subId'];
              $pracNum=$row['pracNum'];
              $code=$row['code'];
              $codeOp=$row['codeOp'];
              $ckt=$row['ckt'];
              $cktOp=$row['cktOp'];
              $marks=$row['marks'];
        ?>

              <tr>
                <td><?php echo $reg_no?></td>
                <td><?php echo $pracNum?></td>
                <?php
                if(empty($code)){ ?>
                  <td><?php echo $ckt ?></td>
                  <td><?php echo $cktOp;?></td>
                <?php }
                else{?>
                  <td><?php echo $code ?></td>
                  <td><?php echo $codeOp;?></td>
                <?php }
                ?>
                <td><?php echo $marks;?></td>
                <td><a class="btn green waves-effect waves-light" type="submit" name="Search" href="show_more_prac.php?id=<?php echo $pracId ?>">Show more<i class="material-icons right">send</i></a></td>
              </tr>

              <?php }?>
              </tbody>
            </table>

      <?php } ?>
       </div>  
      </div>



    <!-- display column ends here -->
    
    <!-- </div>status column starts here -->
      <div class="col s12 m2">
        <form action="fac_srch_rn.php" method="get" enctype="multipart/form-data">
          <div class="card ">
            <div class="card-content black-text">
            <span class="card-title">Search by Reg No.</span>
              <div class="input-field">
                <input id="reg_no" type="text" name="sreg_no" class="validate">
                <label for="reg_no">Reg No.</label>
              </div>
            </div>
            <div class="card-action">
              <button class="btn green waves-effect waves-light" type="submit" name="reg_search">Search
                <i class="material-icons right">send</i>
              </button>
            </div>
          </div>
        </form>
      </div>
    <!-- status column starts here   -->
</div>
    <?php ; ?>
    <?php require '../includes/footer.php'; ?>
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

  <!-- <script src="../js/materialize.js"></script> -->
  <script src="../js/init.js"></script>
  <script src="../js/script.js"></script>
</body>
</html>

<?php  ?>