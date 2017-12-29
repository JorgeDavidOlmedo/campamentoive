
<script type="text/javascript">

$(function(){

window.addItem=function(){

	alert('id: ');

            <?php foreach ($taxes as $key => $tax):?>

            	alert('id: '+$tax);
          
            <?php endforeach;?>
    }
}

</script>