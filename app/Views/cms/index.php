<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4><strong>Analytics</strong> <?= service('uri')->getSegment(1) ?></h4>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <p>Supplier</p>
                        <div class="row">
                            <div class="col-2">
                                <i class="bi bi-card-list fs-35" style="color:#3b7ddd;"></i>
                            </div>
                            <div class="col-10">
                                <h2 class="fw-400 text-end"><?= count(model('SupplierModel')->findAll()) ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <p>Barang</p>
                        <div class="row">
                            <div class="col-2">
                                <i class="bi bi-box2 fs-35" style="color:#986839;"></i>
                            </div>
                            <div class="col-10">
                                <h2 class="fw-400 text-end"><?= count(model('BarangModel')->findAll()) ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <p>Stok</p>
                        <div class="row">
                            <div class="col-2">
                                <i class="bi bi bi-view-stacked fs-35" style="color:#fcb92c;"></i>
                            </div>
                            <div class="col-10">
                                <?php foreach (model('StokModel')->sumStok()->getResultArray() as $sum) : ?>
                                    <h2 class="fw-400 text-end"><?= $sum['stok'] ?></h2>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Recent Movement</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <canvas id="chartjs-dashboard-line"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
                    var gradient = ctx.createLinearGradient(0, 0, 0, 225);
                    gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
                    gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
                    // Line chart
                    new Chart(document.getElementById("chartjs-dashboard-line"), {
                        type: "line",
                        data: {
                            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                            datasets: [{
                                label: "Sales ($)",
                                fill: true,
                                backgroundColor: gradient,
                                borderColor: window.theme.primary,
                                data: [
                                    2115,
                                    1562,
                                    1584,
                                    1892,
                                    1587,
                                    1923,
                                    2566,
                                    2448,
                                    2805,
                                    3438,
                                    2917,
                                    3327
                                ]
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            },
                            tooltips: {
                                intersect: false
                            },
                            hover: {
                                intersect: true
                            },
                            plugins: {
                                filler: {
                                    propagate: false
                                }
                            },
                            scales: {
                                xAxes: [{
                                    reverse: true,
                                    gridLines: {
                                        color: "rgba(0,0,0,0.0)"
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        stepSize: 1000
                                    },
                                    display: true,
                                    borderDash: [3, 3],
                                    gridLines: {
                                        color: "rgba(0,0,0,0.0)"
                                    }
                                }]
                            }
                        }
                    });
                });
            </script>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Pie Chart</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="chart chart-xs">
                                    <canvas id="chartjs-pie"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <table>
                                    <?php foreach ($pieChart_stok as $key => $row) : ?>
                                        <tr>
                                            <td><span class="me-1"><?= $key + 1 ?>.</span></td>
                                            <td><span class="me-2"><?= $row['nama_barang'] ?></span></td>
                                            <td><span class="me-1"><?= $row['stok'] ?></span></td>
                                            <td><span class="me-1"><?= $row['satuan'] ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Pie chart
                    new Chart(document.getElementById("chartjs-pie"), {
                        type: "pie",
                        data: {
                            labels: [<?php foreach ($pieChart_stok as $row) : echo '"' . $row['nama_barang'] . '",';
                                        endforeach; ?>],
                            datasets: [{
                                data: [<?php foreach ($pieChart_stok as $row) : echo '"' . $row['stok'] . '",';
                                        endforeach; ?>],
                                backgroundColor: [
                                    window.theme.primary,
                                    "#2b9b2b",
                                    window.theme.warning,
                                    window.theme.danger,
                                    window.theme.secondary,
                                    "#dee2e6"
                                ],
                                borderColor: "transparent"
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            }
                        }
                    });
                });
            </script>


        </div>
    </div>
</section>