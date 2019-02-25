<script>
	Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Adventures and Characters'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y}</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y} ',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    
    <?php 
    	$query="select count(a.id) as numOfAdventures, count(distinct c.id) as numOfCharacters
    			from adventure a
    			inner join player_adventure b on a.id=b.adventure
    			inner join pc c on c.id=b.pc";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		
		foreach ($result as $row):
    ?>
    
    series: [{
        name: 'Total',
        colorByPoint: true,
        data: [{
            name: 'Adventures',
            y: <?php echo $row->numOfAdventures; ?>
        }, {
            name: 'Characters',
            y: <?php echo $row->numOfCharacters; ?>,
            sliced: true,
            selected: true
        }
        <?php endforeach; ?>
        ]
    }]
});
</script>