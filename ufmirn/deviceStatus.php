<?php
	include_once "includes/head.php";
	include_once "includes/functions.php";
?>
	<?php  
		$con = openDB();
		mysql_select_db("srishti")or DIE("error database listing");
		$id =  $_GET['device'];
		$query = "SELECT name,sliderValue,status,onTime FROM devicelist WHERE id = '".$id."'";
		$result = mysql_query($query);
		if (!$result)
		{
			echo 'Could not run query: ' . mysql_error();
		    exit;
		}
		$row = mysql_fetch_row($result);
	?>

  <div data-role="header" data-position="fixed"> <a href="index.php" data-icon="home">Home</a>
    <h1>Jarvis</h1>
    <a href="deviceList.php" data-icon="info">List&nbsp;&nbsp;&nbsp;&nbsp;</a> 
   </div>
  <!-- /header -->
  
  <div data-role="content" > 
   <form action="updateAndAct.php" method="get"> 
   <input type="hidden" name="id" value="<?php echo $id; ?>"/>
	<ul data-role="listview">
    	<li data-role="list-divider">
        <table>
        <tr>
			<td style="width:100%"><h3><?php echo $row[0]; ?></h3></td>
            <td>
            <p align="right">
            	<select name="status" id="flip-a" data-role="slider" data-mini="true">
					<option value="0">Off</option>
					<option value="1" <?php if($row[2]==1)echo "selected"?>>On</option>
				</select>    
            </p>
            </td>
            </tr>
            </table>
        </li>
        <?php
		$query2 = "SELECT slider,command FROM devicelist WHERE id='".$id."'";
		$temp = mysql_query($query2);
		mysql_error();
		$temp = mysql_fetch_array($temp);
		if($temp['slider']==1){
		echo '
        <li>
        	<div data-role="fieldcontain">
	 		<input type="range" name="sliderValue" id="slider" value="'; 
			echo $row[1] ;
			echo '" min="0" max="100"  />
		</div>
        </li>';
		
		}
		
		
		else "";
		
		?>
     <!--   	<label>Time Elapsed: </label><?php //echo $row[3]; ?>-->
     	<?php print_r ($temp['command']); ?>
        <li>
        <button type="submit">Update</button>
        </li>
        
        </ul>
        
        </form>
  
  </div>
  <!-- /content -->
  <?php include_once "includes/foot.php";?>
