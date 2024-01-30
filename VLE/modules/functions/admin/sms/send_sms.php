<?php
    include_once('../layouts/head_to_wrapper.php');
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/topbar.php');

?>
<style>
    .f_input{
        background-color: #f6f6f6;
        border: none;
        color: #0d0d0d;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 5px;
        width: 85%;
        border: 2px solid #f6f6f6;
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -ms-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
        -webkit-border-radius: 5px 5px 5px 5px;
        border-radius: 5px 5px 5px 5px;
    }
    #_btn{
        background: #0067a9;
        color: #FFFFFF;
    }
    .f_select{
        background-color: #f6f6f6;
        border: none;
        color: #0d0d0d;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 5px;
        width: 85%;
        border: 2px solid #f6f6f6;
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -ms-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
        -webkit-border-radius: 5px 5px 5px 5px;
        border-radius: 5px 5px 5px 5px;
    }
    .f_textarea{
        background-color: #f6f6f6;
        border: none;
        color: #0d0d0d;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 5px;
        width: 85%;
        border: 2px solid #f6f6f6;
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -ms-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
        -webkit-border-radius: 5px 5px 5px 5px;
        border-radius: 5px 5px 5px 5px;
    }
    #formContent {
        -webkit-border-radius: 10px 10px 10px 10px;
        border-radius: 10px 10px 10px 10px;
        background: #f6f6f6;
        padding: 30px;
        width: 90%;
        max-width: 450px;
        position: relative;
        padding: 0px;
        -webkit-box-shadow: 0 15px 30px 0 rgba(0,0,0,0.3);
        box-shadow: 0 15px 30px 0 rgba(0,0,0,0.3);
        text-align: center;
        border-radius: 10px;
        border-style: outset dotted;
        max-height:100%;
    }
    #formContent_select_plugin {
        -webkit-border-radius: 10px 10px 10px 10px;
        border-radius: 10px 10px 10px 10px;
        background: #f6f6f6;
        padding: 30px;
        width: 90%;
        max-width: 450px;
        position: relative;
        padding: 0px;
        -webkit-box-shadow: 0 15px 30px 0 rgba(0,0,0,0.3);
        box-shadow: 0 15px 30px 0 rgba(0,0,0,0.3);
        text-align: center;
        border-radius: 10px;
        border-style: outset dotted;
    }
    #formContent_select_plugin li{
        text-align: left;
        color: red !important;
        font-size: 2px;
    }
    .select_style {
			width: 20px;
            color: red;
		}
</style>						

 <hr/>

<main>
    <div class="container-fluid col-md-10">

            <div id="tabs">
                <ul>
                    <li><a href="#custom">Send Single SMS</a></li>
                    <li><a href="#staff">Send to Staff</a></li>
                    <li><a href="#parents">Send to Parent</a></li>
                    <li><a href="#students">Send to Students</a></li>
                </ul>
                <div id="custom">

                    <div class="card-body">
                        <div class="table-responsive">
                           
                            <div id="formContent">
                                <br>
                                <form  method="post" action="#">
                                    <input type="hidden" name="school_dn" value="<?php echo $school_dn; ?>" />
                                    <input type="number" id="phone" class="f_input" name="phone" placeholder="Recipient Cell eg. 09******** " required />

                                    <textarea  id="text" class="f_textarea" name="msg" placeholder="Messege" required ></textarea>

                                    <input type="submit" class="fadeIn f_input " id="_btn" name="send_single_sms" value="Send">
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

                <div id="staff">
                    <div class="card-body">
                        <div id="formContent">
                            <br>
                            <form  method="post" action="#">      
                                <input type="hidden" name="school_dn" value="<?php echo $school_dn; ?>" />
                                <select name="phones[]" multiple="" id="s_drop" class="f_select">
                                    <option disabled> Accountants </option>
                                    <?php
                                        $res = mysqli_query($db, "SELECT name, phone FROM accountants ");
                                        while($row = mysqli_fetch_array($res)) { ?>
                                        <option value="<?php echo $row['phone'];?>"> <?php echo $row['name']." - ".$row['phone']; ?> </option>
                                    <?php   }     ?>

                                    <option disabled> System Administrators </option>
                                    <?php
                                        $res1 = mysqli_query($db, "SELECT name, phone FROM admin ");
                                        while($row1 = mysqli_fetch_array($res1)) { ?>
                                        <option value="<?php echo $row1['phone'];?>"> <?php echo $row1['name']." - ".$row1['phone']; ?> </option>
                                    <?php   }     ?>

                                    <option disabled> Managers </option>
                                    <?php
                                        $res2 = mysqli_query($db, "SELECT name, phone FROM managers ");
                                        while($row2 = mysqli_fetch_array($res2)) { ?>
                                        <option value="<?php echo $row2['phone'];?>"> <?php echo $row2['name']." - ".$row2['phone']; ?> </option>
                                    <?php   }     ?>

                                    <option disabled> Teachers </option>
                                    <?php
                                        $res3 = mysqli_query($db, "SELECT name, phone FROM teachers ");
                                        while($row3 = mysqli_fetch_array($res3)) { ?>
                                        <option value="<?php echo $row3['phone'];?>"> <?php echo $row3['name']." - ".$row3['phone']; ?> </option>
                                    <?php   }     ?>
                                </select>
                                <textarea  id="text" class="f_textarea" name="msg" placeholder="Messege" required ></textarea>
                                <input type="submit" class="fadeIn f_input" id="_btn" name="send_multiple_sms" value="Send">
                            </form>
                        </div>
                    </div>
                </div>

                <div id="parents">
                    <div class="card-body">
                        <div id="formContent_select_plugin">
                            <br>
                            <form  method="post" action="#">      
                                <input type="hidden" name="school_dn" value="<?php echo $school_dn; ?>" />
                                <select name="phones[]" multiple="" id="testSelect1" class="select_style">
                                    <?php
                                    $res = mysqli_query($db, "SELECT * FROM parents ");
                                    while($row = mysqli_fetch_array($res)) { ?>
                                    <option value="<?php echo $row['motherphone'];?>"> <?php echo "Mr ".$row['fathername']." and Mrs ".$row['mothername']; ?> </option>
                                    <?php   }     ?>
                                </select>
                                <textarea  id="text" class="f_textarea" name="msg" placeholder="Messege" required ></textarea>

                                <input type="submit" class="fadeIn f_input" id="_btn" name="send_multiple_sms" value="Send">
                            </form>
                        </div>
                    </div>
                </div>

                <div id="students">
                    <div class="card-body">
                        <div id="formContent_select_plugin">
                            <br>
                            <form  method="post" action="#">      
                                <input type="hidden" name="school_dn" value="<?php echo $school_dn; ?>" />
                                <select name="phones[]" multiple="" id="testSelect2" class="select_style">
                                    <?php
                                    $res = mysqli_query($db, "SELECT * FROM students ");
                                    while($row = mysqli_fetch_array($res)) { ?>
                                    <option value="<?php echo $row['phone'];?>"> <?php echo $row['name']." ".$row['phone']; ?> </option>
                                    <?php   }     ?>
                                </select>
                                <textarea  id="text" class="f_textarea" name="msg" placeholder="Messege" required ></textarea>

                                <input type="submit" class="fadeIn f_input" id="_btn" name="send_multiple_sms" value="Send">
                            </form>
                        </div>
                    </div>
                </div>

                
            </div>
    </div>
</main>


<!-- Multi-Select suport -->
<link rel="stylesheet" href="../layouts/vannilaSelect/vanillaSelectBox.css"/>
<script src="../layouts/vannilaSelect/vanillaSelectBox.js"></script>
<script>
  let mySelect = new vanillaSelectBox("#s_drop",{
      maxWidth: 500,
      maxHeight: 400,
      minWidth: -1,
      search: true,
      placeHolder: 'Recipient Staff ',
  });
</script>

<script>
	document.multiselect('#testSelect1');
	document.multiselect('#testSelect2');
    // .setCheckBoxClick("checkboxAll", function(target, args) {
		// 	console.log("Checkbox 'Select All' was clicked and got value ", args.checked);
		// })
		// .setCheckBoxClick("1", function(target, args) {
		// 	console.log("Checkbox for item with value '1' was clicked and got value ", args.checked);
		// });

</script>
<!-- End multi-select support  -->
        
</div>
<?php require_once('../layouts/footer_to_end.php'); ?>

