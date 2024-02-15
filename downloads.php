 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="./style.css">
   <title>ZOCS Landing Page</title>

 </head>

 <body>
   <?php include('./nav.php') ?>

   <br>
   <h3 class="text-center">Documents Available for Download</h3>
   <br>

   <div class="container" style="height:70vh">
     <table class="table  mb-4">
       <thead>
         <tr>
           <th scope="col">#</th>
           <th scope="col">Document Name</th>
           <th scope="col">Discription</th>
           <th scope="col">Date</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
       <tbody>
         <?php
          include_once('vle/modules/config/config.php');
          $query = $db->query("SELECT * FROM moe_uploads WHERE visibility = 'Public' ");
          $no = 0;
          while ($row = $query->fetch_assoc()) {
            $no = $no + 1;
            $name = $row['title'];
            $description = $row['description'];
            $url = $row['url'];

            $file = $row['file'];
            $dueDate = $row['date_added'];
            $assDate = $row['date'];
            $ass_id = $row['upload_id'];

            $file_path = "vle/lms/files/moe_uploads/" . $file;
          ?>
           <tr>
             <td><?php echo $no ?></td>
             <td><?php echo $name ?></td>
             <td><?php echo $description ?></td>
             <td><?php echo $dueDate ?></td>
             <td> <a href="<?php echo $file_path ?>"> File </a> </td>
           </tr>
         <?php } ?>
       </tbody>
     </table>
     </table>




   </div>
   <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
 </body>
 <footer>
   <p>&copy; 2024 ZOCS. All rights reserved.</p>
   <p>Address: P.O Box 50429 | Lusaka</p>
   <p>Contact: Phone: (+260) 211-253641 / 211-253656</p>
   <p>Powered by Chesco tech-ltd</p>
 </footer>

 </html>