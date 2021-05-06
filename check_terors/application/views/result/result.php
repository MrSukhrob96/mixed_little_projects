<div class="container-fluid" style='margin-top: 30px;'>

<?php if(!empty($vars)){ ?>
  <table class="table">
    <thead class="bg-secondary">
      <tr>
        <th scope="col" class="active">№</th>
        <th scope="col" class="active">Фио Excel</th>
        <th scope="col" class="active">Фио АТЦ</th>
      </tr>
    </thead>
    <tbody>
<?php	  
      $i = 1;
	  
	  foreach ($vars as $key => $var) 
	  {

		foreach ($var as $excel_fio => $sql_fio) 
		{
          echo "<tr>
                  <th scope='row' style='width: 5%'>{$i}</th>
                  <td style='width: 45%'>$excel_fio</td>
                  <td style='width: 50%'>$sql_fio</td>
                </tr>";
	
           $i++;		 
        }
      }
?>
    </tbody>
  </table>
<?php 	
	} else{ 
?>
      <h1> <center>Не найден!</center></h1>
<?php 
} 
?>
</div>

<style>
  #myBtn {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    font-size: 18px;
    border: none;
    outline: none;
    color: white;
    cursor: pointer;
    padding: 13px;
    border-radius: 50%;
  }
</style>
<button onclick="topFunction()" id="myBtn" class="bg-secondary">Top</button>
<script>
  var mybutton = document.getElementById("myBtn");

  window.onscroll = function() {
    scrollFunction()
  };

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }

  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>