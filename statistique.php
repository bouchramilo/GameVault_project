<?php
require 'classes/personne.Class.php';
require 'classes/admin.CLass.php';
session_start();
$admin = new Admin();

?>


<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistique</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


</head>

<body>
    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <section class="relative h-max min-h-screen overflow-hidden pb-10">
        <video
            class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 object-cover"
            autoplay loop muted playsinline>
            <source src="images/bg_1.mp4" type="video/mp4" />
        </video>
        <div class="relative z-10 flex flex-row gap-4 h-max text-center text-white bg-black bg-opacity-30">
            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            <?php include 'menu_admin.php'; ?>
            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            <div class="main absolute t-[60px] w-[calc(100%-250px)] ml-[250px] min-h-[100vh]">
                <div class="cards w-[100%] py-[35px] px-[40px] grid grid-cols-3 gap-[40px]">
                    <div class="card p-[20px] flex align-center space-around bg-[#fff] rounded-lg shadow-md relative">
                        <div class="card_content ">
                            <div class="number text-2xl font-bold text-red-700 pb-[10px]"><?= $admin->allgames(); ?></div>
                            <div class="card_name text-[#d5d5d5] font-[700] text-md">games</div>
                        </div>
                        <div class="icon_box text-lg text-red-600">
                            <i class="fas fa-gamepad bottom-10 right-2 absolute" style="color: rgb(169, 34, 34); font-size: 2rem;"></i>
                        </div>
                    </div>
                    <div class="card card p-[20px] flex align-center space-between bg-[#fff] rounded-lg shadow-md relative">
                        <div class="card_content">
                            <div class="number text-2xl font-bold text-red-700 pb-[10px]"><?= $admin->allusers(); ?></div>
                            <div class="card_name  text-[#d5d5d5] font-[700]">users</div>
                        </div>
                        <div class="icon_box">
                            <i class="fas fa-users bottom-10 right-2 absolute" style="color: rgb(169, 34, 34); font-size: 2rem;"></i>
                        </div>
                    </div>
                    <div class="card card p-[20px] flex align-center space-between bg-[#fff] rounded-lg shadow-md relative">
                        <div class="card_content">
                            <div class="number text-2xl font-bold text-red-700 pb-[10px]"><?= $admin->allfavoris(); ?></div>
                            <div class="card_name  text-[#d5d5d5] font-[700]">Favoris</div>
                        </div>
                        <div class="icon_box">
                            <i class="fas fa-heart bottom-10 right-2 absolute" style="color: rgb(169, 34, 34); font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
                <div class="charts grid  grid-cols-3  gap-[40px] w-[100%] p-[40px] pt-[0]">
                    <div class="chart bg-white p-[20px] rounded-[10px] shadow-lg">
                        <h2>les games ajoutees au bibliotheque</h2>
                        <div>
                            <canvas id="myCharttroi"></canvas>
                        </div>
                    </div>
                    <div class="chart bg-white p-[20px] rounded-[10px] shadow-lg">
                        <h2>status des games</h2>
                        <canvas id="myCharttwo"></canvas>
                    </div>
                    <div class="chart bg-white p-[20px] rounded-[10px] shadow-lg">
                        <h2>les games ajoutee au favoris</h2>
                        <canvas id="myChart"></canvas>


                    </div>


                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            <!-- chart.js ============================================================================================================================================================ -->
            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['favoris ', 'pas favoris'],
                        datasets: [{
                            label: '# of Votes',
                            data: [<?= $admin->allfavorisbygame(); ?>, <?= $admin->allgames() - $admin->allfavorisbygame(); ?>],
                            backgroundColor: [
                                'rgba(41,155,99,1)',
                                'rgba(54,162,235,1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true

                    }
                });

                const ftx = document.getElementById('myCharttroi');

                new Chart(ftx, {
                    type: 'doughnut',
                    data: {
                        labels: ['ajouter ', 'pas encors'],
                        datasets: [{
                            label: '# of Votes',
                            data: [<?= $admin->allbib(); ?>, <?= $admin->allgames() - $admin->allbib(); ?>],
                            backgroundColor: [
                                'rgba(41,155,99,1)',
                                'rgba(54,162,235,1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true

                    }
                });

                const dtx = document.getElementById('myCharttwo');

                new Chart(dtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['encore ', 'terminee', 'abondonne'],
                        datasets: [{
                            label: '# of Votes',
                            data: [<?= $admin->allencours(); ?>, <?= $admin->alltermine();  ?>, <?= $admin->allabandonne(); ?>],
                            backgroundColor: [
                                'rgba(41,155,99,1)',
                                'rgba(54,162,235,1)',
                                'rgba(94,162,150,1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true

                    }
                });
            </script>
        </div>
    </section>
</body>

</html>