<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">



<head>
	<title>SHAPES!</title>


	<script type="text/javascript">		
		
		function countDown(myLimit)
		{
			var x = myLimit;
			
			if(x > 0)
			{
				x = x - 1;
				document.getElementById('txt3').value = x;
				var t=setTimeout("countDown(document.getElementById('txt3').value)", 1000);	
			}
			else
			{
				alert("Sorry, time is up!");
				window.location.reload();
			}
		}
		

		function updateForm()
		{
			if(document.getElementById('circle').checked == true)
			{
				document.getElementById('txt1').value = "Enter your Radius here...";	
				document.getElementById('txt2').style.visibility="hidden";
			}
			else if(document.getElementById('rectangle').checked == true)
			{ 
				document.getElementById('txt1').value = "Enter your Length here...";
				document.getElementById('txt2').value = "Enter your Width here...";
				document.getElementById('txt2').style.visibility="visible";
			}
		}

	</script>	
</head>



<body onload="countDown(21)">
<?php include "shapes.php"; ?>
<form name="xx" action="funwithshapes.php" method="get">


	<!--Take a look at shapes.php for the class definitions!!-->



	<div id="main">	
		
		<h1>Fun with Shapes</h1>
		<h2>An object oriented PHP example w/ Javascript</h2>
		<?php echo "Writen by Brian Londregan"; ?>
		<br/>
		<br/>
		<br/>

			<p style="color:red;font-size:small;">
			You only have 20 seconds to create a shape before you must start over!
			<input type="text" id="txt3" size="1">
			</p>


		<table style="border-style:solid; padding:8px;">
			<tr>
				<td>1. Name:</td>	
				<td><input type="text" name="shapeName" id="shapeName" value="" maxlength="45" size="37"/></td>
			</tr>
			<tr>
				<td>2. Shape Type: </td>
				<td>
					<input type="radio" name="shapeType" id="circle" value="circle" onchange="updateForm()"/> Circle<br/>
					<input type="radio" name="shapeType" id="rectangle" value="rectangle" onchange="updateForm()"/> Rectangle
				</td>
			</tr>      
			<tr>
				<td>3. Dimensions: </td>
				<td>
					<input type="text" name="txt1" id="txt1" style="visibility:visible;" value="" maxlength="45" size="37"><br/> 
					<input type="text" name="txt2" id="txt2" style="visibility:hidden;" value="" maxlength="45" size="37">
				</td>
			</tr>
			<tr>
				<td colspan="2" style="padding-left:40px;">
					<input type="submit" value="Get your Shape's Information!" />
				</td>
			</tr>
		</table>	
		<br/>
		<br/>
		<br/>

	</div>



	
	<input type="hidden" name="hidden" id="hidden" value="1"/>




	<div id="infoArea" style="color:darkblue;font-weight:bold;">

		<?php
			if( isset($_GET['hidden']) )
			{		
				if(isset($_GET['shapeType']) && isset($_GET['shapeName']) && $_GET['shapeName'] != "" )
				{
					if ($_GET['shapeType'] == 'circle')
					{
						$theShape = new Circle($_GET['txt1']);
					}
					else if($_GET['shapeType'] == 'rectangle')
					{
						$theShape = new Rectangle($_GET['txt1'], $_GET['txt2']);
					}			
					
					$theShape->name = $_GET['shapeName'];			
			
					echo $theShape->Identify();
					?><br/><?php
					echo "Area: " . $theShape->Area();
					?><br/><?php
					echo "Perimeter: " . $theShape->Perimeter(); 			
				}
				else
				{
					echo "You didn't enter all the information... try again!";
				}
			}
		?>

	</div>




</form>
</body>
</html>