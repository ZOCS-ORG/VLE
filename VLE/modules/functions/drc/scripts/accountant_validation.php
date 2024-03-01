<?php

?>

<script>
    var accGender = '';
    function accountant_validation(){
    var accId = document.getElementById('id').value;
    var accName = document.getElementById('name').value;
    var accPassword = document.getElementById('password').value;
    var accPhone = document.getElementById('phone').value;
    var accEmail = document.getElementById('email').value;
    var accDOB = document.getElementById('dob').value;
    var accHireDate = document.getElementById('hiredate').value;
    var accSalary = document.getElementById('salary').value;
    if(!accId){
        alert('Id Must be fild out.')
        return false;
    }elseif(!accName){
        alert('Name must be fild out.')
        return false;
    }elseif(!accPassword){
        alert('Password must be fild out.')
        return false;
    }elseif(!accPhone){
        alert('Phone must be fild out.')
        return false;
    }elseif(!accEmail){
        alert('Email must be fild out.')
        return false;
    }elseif(!accGender){
        alert('Gender must be fild out.')
        return false;
    }elseif(!accDOB){
        alert('Date Of Birth must be fild out.')
        return false;
    }elseif(!accSalary){
        alert('Salary must be fild out.')
        return false;
    }else return true;
}
</script>