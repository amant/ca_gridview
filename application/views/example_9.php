<fieldset>
    <legend>Action Column - Example 9</legend>
<?php echo render_partial('/ca_gridview') ?>
</fieldset>

<script> 
    function fn_action(){
        alert('Action Done');
        return false;
    }
    
    function fn_edit(){
        alert('Edit Action Done');
        return false;
    }
    
    
    function fn_delete(){
        if(confirm('Are you Sure To Delete?')) {
            alert('Deletion Done'); 
        } else {
            alert('Not Deleted'); 
        }
        return false;
    }
</script>