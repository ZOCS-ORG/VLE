<?php
  /** 
   * @TODO read gender from user input not predefined 'female'  ✅✔
  */
?>


<script>
var stuGender = 'Female';
function student_validation(){
   var stuId = document.getElementById('stuId').value;
   var stuName = document.getElementById('stuName').value;
   var stuPassword = document.getElementById('stuPassword').value;
   var stuPhone = document.getElementById('stuPhone').value;
   var stuEmail = document.getElementById('stuEmail').value;
   var stuGender = document.getElementById("input[name = 'gender']:checked").value;
   var stuDOB = document.getElementById('stuDOB').value;
   var stuAddmissionDate = document.getElementById('stuAddmissionDate').value;
   var stuParentId = document.getElementById('stuParentId').value;
   var stucourseid = document.getElementById('stucourseid').value;
   if(!stuId){
       alert('Learner Id Must be fild out.')
       return false;
   }
   else if(!stuName){
       alert('Learner Name must be fild out.')
       return false;
   }
   else if(!stuPassword){
       alert('Learner Password must be fild out.')
       return false;
   }
   else if(!stuPhone){
       alert('Learner Phone must be fild out.')
       return false;
   }
   else if(!stuEmail){
       alert('Learner Email must be fild out.')
       return false;
   }
   else if(!stuGender){
       alert('Learner Gender must be fild out.')
       return false;
   }
   else if(!stuDOB){
       alert('Learner Date Of Birth must be fild out.')
       return false;
   }
   else if(!stuParentId){
       alert('Learner Parent Id must be fild out.')
       return false;
   }
   else if(!stucourseid){
       alert('Learner Class Id must be fild out.')
       return false;
   }
   else return true;
}

</script>