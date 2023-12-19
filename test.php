<?php
include "libs/load.php";
echo $_POST['brand'];
$arr_CarBrand = Xlsx::GetField("libs/py/Xlxs.py","brand");

//GetField is used to get Perticulat Distinct field
$arr_CarModel = Xlsx::GetField("libs/py/Xlxs.py","model");
$arr_Year = Xlsx::GetField("libs/py/Xlxs.py","year");

if(isset($_POST['brand']) and !empty($_POST['brand'])){
  $brand = $_POST['brand'];
  $model = $_POST['model'];
  $year = $_POST['year'];
  $price = $_POST['price'];
}

?>
<form method="post" action="test.php">
<div class="dropdown"><br>
    <select class="select1" name="brand" id="SelectBrand">
      <option selected>CAR BRAND</option>

        <!--
          1st php is to set values for opetion
          2nd php is to check the element is selected or not and add seleced tag 
          3rd php is to add element in option
        -->
      <?for($i=0;$i<count($arr_CarBrand);$i++){?>
      
        <option value="<?echo $arr_CarBrand[$i]?>" <?(isset($_POST['brand'])and !empty($_POST['brand'] and $_POST['brand']==$arr_CarBrand[$i]))?print("Selected"):print("");?>> <?echo $arr_CarBrand[$i]?> </option>
      <?}?>

  </select><hr><hr>
</div>
<div class="dropdown" id="dropdownCarModel"><br>
    <select class="select1" name="model" id="SelectModel">
      <option selected  >CAR MODEL</option><hr>
      
      <?for($i=0;$i<count($arr_CarModel);$i++){?>
        <option id="OptionModel" value="<?echo $arr_CarModel[$i]?>" <?(isset($_POST['model'])and !empty($_POST['model'] and $_POST['model']==$arr_CarModel[$i]))?print("Selected"):print("");?>> <?echo $arr_CarModel[$i]?> </option>
      <?}?>
      

  </select><hr><hr>
  </div>

  <div class="dropdown">
    <select class="select1" name="year" id=>
      <option selected>YEAR</option>

      <?for($i=0;$i<count($arr_Year);$i++){?>
        <option value="<?echo $arr_Year[$i]?>" <?(isset($_POST['year'])and !empty($_POST['year'] and $_POST['year']==$arr_Year[$i]))?print("Selected"):print("");?>> <?echo $arr_Year[$i]?> </option>
      <?}?>

  </select><hr><hr>
  </div>
<div class="ranges">
  <input name = "price" type = "range" min = "500000" max = "100000000" step = "5000" onInput = "changeValue(this.value)" onchange = "changeValue(this.value)">
     <div id = "output"> </div>
     <script>
        let output = document.getElementById('output');
        function changeValue(newVal) {
           output.innerHTML = newVal;
        }
     </script>
<input type="submit" value="Search"/>
</form>
<?
if(isset($_POST['brand']) and !empty($_POST['brand'])){?>
  <hr><hr>
  
  <p> The Car Brand That You Chose is: <?echo $brand?> </p>

  <p> The CAR MODEL That You Chose is: <?echo $model?> </p>

  <p> The YEAR That You Chose is: <?echo $year?> </p>

  <p> PRICE: <?echo $price?></p>
<?}?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
$("#SelectBrand").change(function() {

  $.ajax({ type :"post", url: "/Website/we-prj1/ajax.php",
    data:{
      //Send Car Brand to the ajax
      brand:$(this).val()
    }, 
    success: function(responce){
      //this to remove all options in Car Model and add Related Models respect to Car Brand
      var Length = document.getElementById("SelectModel").length;
 
      for(i = 0; i <Length; i++) {
         $("#OptionModel").remove();
      }
      var select = document.getElementById("SelectModel");
      var option = document.createElement("option");
      
      alert(responce)
      data = JSON.parse(responce)
      index=0
      for(var i in data){
        option.text = data[i];
        select.add(option, select[index]);
        console.log(i,data[i])
        index++
      }
      
  }});
});
</script>

