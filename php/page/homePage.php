<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
</head>
<body class="container">
<form method="post" action="../auth/logout.php" autocomplete="off">
    <input type="submit" class="btn btn-danger" value="Logout"></input>
</form>
<div class="row">
    <div class="col">
        <div class="table-wrapper card">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require "../database/connection.php";
                $all_user = mysqli_query($conn,
                    "select * from users"
                ) or die(mysqli_error($conn));


                while ($user_row = mysqli_fetch_assoc($all_user)) {
                    echo "<tr>";
                    echo "<td>" . $user_row['id'] . "</td>";
                    echo "<td>" . $user_row['name'] . "</td>";
                    echo "<td>" . $user_row['email'] . "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <canvas id="bar"></canvas>

    </div>
</div>


</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
<script>
	let data1 = []
	data1.push(10)
	data1.push(2)
	let context = document.getElementById('bar').getContext('2d')

    <?php
    $all_user = mysqli_query($conn,
        "select * from users order by age"
    ) or die(mysqli_error($conn));

    $age = [];
    while ($user_row = mysqli_fetch_assoc($all_user)) {
        $user_age = $user_row['age'];
        if (array_key_exists($user_age, $age)) {
            $age[$user_age]++;
        } else {
            $age[$user_age] = 1;
        }
    }
    ?>

	let salesChartData = {
		labels: [
            <?php
            foreach ($age as $key => $value)
                echo "$key,";
            ?>
		],
		datasets: [
			{
				label: 'Digital Goods',
				backgroundColor: 'rgba(60,141,188,0.9)',
				borderColor: 'rgba(60,141,188,0.8)',
				pointRadius: false,
				pointColor: '#3b8bba',
				pointStrokeColor: 'rgba(60,141,188,1)',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(60,141,188,1)',
				data: [
                    <?php
                    foreach ($age as $key => $value)
                        echo "$value,";
                    ?>
				]
			},
		]
	}

	let salesChartOptions = {
		maintainAspectRatio: false,
		responsive: true,
		legend: {
			display: false
		},
	}
	let salesChart = new Chart(context, { // lgtm[js/unused-local-variable]
		type: 'line',
		data: salesChartData,
		options: salesChartOptions
	})
</script>
</html>
