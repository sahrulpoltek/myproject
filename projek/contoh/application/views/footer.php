        <div class="col-sm-12">
				<p class="back-link">SDI &copy; 2021 <a href="http://tkj.poliupg.ac.id">TKJ</a></p>
		</div>
    </div>	<!--/.main-->
    
	
	<script src="<?= base_url() ?>assets/js/jquery-1.11.1.min.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>assets/js/chart.min.js"></script>
	<script src="<?= base_url() ?>assets/js/chart-data.js"></script>
	<script src="<?= base_url() ?>assets/js/easypiechart.js"></script>
	<script src="<?= base_url() ?>assets/js/easypiechart-data.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap-datepicker.js"></script>
	<script src="<?= base_url() ?>assets/js/custom.js"></script>
	<script src="<?= base_url() ?>assets/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>

	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>