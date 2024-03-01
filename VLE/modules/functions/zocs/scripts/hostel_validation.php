<?php


?>


<script>
    function hostel_validation(){
        var id = document.getElementById('id').value;
        var name = document.getElementById('name').value;
        var beds = document.getElementById('beds').value;
        var patreon = document.getElementById('patreon').value;
        if(!id){
            alert('Id Must be fild out.');
            return false;
        }elseif(!name){
            alert('Name must be fild out.');
            return false;
        }elseif(!beds){
            alert('Bed capacity must be fild out.');
            return false;
        }elseif(!patreon){
            alert('Patreon/Matreon name must be fild out.');
            return false;
        }
        else return true;
        alert('h');
    }

</script>