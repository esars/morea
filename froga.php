<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title>Charting</title>
	<link href="css/basic.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="EnhanceJS/enhance.js"></script>	
	<script type="text/javascript">
		// Run capabilities test
		enhance({
			loadScripts: [
				{src: 'js/excanvas.js', iecondition: 'all'},
				'js/jquery.min.js',
				'js/visualize.jQuery.js',
				'js/example-editable.js'
			],
			loadStyles: [
				'css/visualize.css',
				'css/visualize-light.css'
			]	
		});   
    </script>
    
</head>
<body>

<table class='tabla1'>
	<caption>2009 Employee Sales by Department</caption>
	<thead>
		<tr>
			<td></td>
			<th scope="col">food</th>
			<th scope="col">auto</th>
			<th scope="col">household</th>
			<th scope="col">furniture</th>
			<th scope="col">kitchen</th>
			<th scope="col">bath</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th scope="row">Mary</th>
			<td>190</td>
			<td>160</td>
			<td>40</td>
			<td>120</td>
			<td>30</td>
			<td>70</td>
		</tr>
		<tr>
			<th scope="row">Tom</th>
			<td>3</td>
			<td>40</td>
			<td>30</td>
			<td>45</td>
			<td>35</td>
			<td>49</td>
		</tr>
		<tr>
			<th scope="row">Brad</th>
			<td>10</td>
			<td>180</td>
			<td>10</td>
			<td>85</td>
			<td>25</td>
			<td>79</td>
		</tr>
		<tr>
			<th scope="row">Kate</th>
			<td>40</td>
			<td>80</td>
			<td>90</td>
			<td>25</td>
			<td>15</td>
			<td>119</td>
		</tr>		
	</tbody>
</table>	
<table class="tabla2">
	<caption>Produktu erosienak</caption>
	<thead>
		<tr>
							<td></td>
			<th>Sativa Jack Herer</th><th>Geranioa</th><th>Kiwia</th><th>Kalabazina</th><th>Orkidea</th><th>Kamelia</th>		</tr>
	</thead>
	<tbody>
	<tr><th>Erosketak</th><td>13</td><td>8</td><td>6</td><td>6</td><td>5</td><td>4</td></tr>	</tbody>
</table>
</body>
</html>