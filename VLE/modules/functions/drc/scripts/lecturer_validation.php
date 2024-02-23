<?php

?>

<script>
    var teaGender = '';
    function lecturer_validation(){
    var teaId = document.getElementById('id').value;
    var teaName = document.getElementById('name').value;
    var teaPassword = document.getElementById('password').value;
    var teaPhone = document.getElementById('phone').value;
    var teaEmail = document.getElementById('email').value;
    var teaDOB = document.getElementById('dob').value;
    var teaHireDate = document.getElementById('hiredate').value;
    var teaSalary = document.getElementById('salary').value;
    if(!teaId){
        alert('Id Must be fild out.')
        return false;
    }elseif(!teaName){
        alert('Name must be fild out.')
        return false;
    }elseif(!teaPassword){
        alert('Password must be fild out.')
        return false;
    }elseif(!teaPhone){
        alert('Phone must be fild out.')
        return false;
    }elseif(!teaEmail){
        alert('Email must be fild out.')
        return false;
    }elseif(!teaGender){
        alert('Gender must be fild out.')
        return false;
    }elseif(!teaDOB){
        alert('Date Of Birth must be fild out.')
        return false;
    }elseif(!teaParentId){
        alert('Salary must be fild out.')
        return false;
    }else return true;
}
</script>