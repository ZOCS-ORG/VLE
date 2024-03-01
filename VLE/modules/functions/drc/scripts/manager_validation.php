<?php

?>

<script>
    var gender = '';
    function manager_validation(){
    var id = document.getElementById('id').value;
    var name = document.getElementById('name').value;
    var password = document.getElementById('password').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    var dob = document.getElementById('dob').value;
    var hireDate = document.getElementById('hiredate').value;
    if(!id){
        alert('Id Must be fild out.')
        return false;
    }elseif(!name){
        alert('Name must be fild out.')
        return false;
    }elseif(!password){
        alert('Password must be fild out.')
        return false;
    }elseif(!phone){
        alert('Phone must be fild out.')
        return false;
    }elseif(!email){
        alert('Email must be fild out.')
        return false;
    }elseif(!gender){
        alert('Gender must be fild out.')
        return false;
    }elseif(!dob){
        alert('Date Of Birth must be fild out.')
        return false;
    }else return true;
}
</script>