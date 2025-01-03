<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body class="bg-[#f9dbbd]">
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  -->
    
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  -->


    

    <section class="relative h-max min-h-screen overflow-hidden pb-10">
        <video
            class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 object-cover"
            autoplay loop muted playsinline>
            <source src="images/bg_1.mp4" type="video/mp4" />
        </video>
        <div class="relative z-10 flex flex-row gap-4 h-max text-center text-white bg-black bg-opacity-30">
            <div class="w-1/5 h-full">
            <?php require_once "menu_user.php"; ?>
            </div>
            <!-- tableau ==================================================================================================================================================== -->

            <div class="w-4/5 h-full pr-4">
                <div class="font-[sans-serif] overflow-x-auto h-full w-full flex flex-col gap-32 pt-20">
                    <h1 class="text-3xl font-bold md:text-5xl text-start">Mes Favoris</h1>

                    <table class="min-w-full h-max bg-black bg-opacity-80">
                        <thead class="whitespace-nowrap bg-black">
                            <tr>
                                <th class="p-4 text-sm font-semibold text-white text-center">
                                    Title
                                </th>
                                <th class="p-4 text-sm font-semibold text-white text-center">
                                    Genre
                                </th>
                                <th class="p-4 text-sm font-semibold text-white text-center">
                                    Favoris
                                </th>
                                <th class="p-4 text-sm font-semibold text-white text-center">
                                    Rating
                                </th>
                                <th class="p-4 text-sm font-semibold text-white text-center">
                                    plus
                                </th>
                            </tr>
                        </thead>

                        <tbody class="whitespace-nowrap">
                            <tr class="">
                                <td class="p-4 text-sm text-white text-center">
                                    Louis Vuitton
                                </td>
                                
                                <td class="p-4 text-sm text-white text-center">
                                    Bravo
                                </td>
                                <td class="p-4 text-sm text-white text-center">
                                    &#10084;
                                </td>
                                <td class="p-4 text-center">
                                    <svg class="w-[18px] h-4 inline mr-1" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                            fill="#facc15" />
                                    </svg>
                                    <svg class="w-[18px] h-4 inline mr-1" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                            fill="#facc15" />
                                    </svg>
                                    <svg class="w-[18px] h-4 inline mr-1" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                            fill="#facc15" />
                                    </svg>
                                    <svg class="w-[18px] h-4 inline mr-1" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                            fill="#facc15" />
                                    </svg>
                                    <svg class="w-[18px] h-4 inline" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                            fill="#facc15" />
                                    </svg>
                                </td>
                                <td class="p-4 text-center flex justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 cursor-pointer fill-gray-500 rotate-90" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="2" data-original="#000000" />
                                        <circle cx="4" cy="12" r="2" data-original="#000000" />
                                        <circle cx="20" cy="12" r="2" data-original="#000000" />
                                    </svg>
                                </td>
                            </tr>

                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>








    <!-- footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer -->
     <!-- <?php include "footer.php" ; ?> -->
    <!-- footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer -->
</body>

<script src="js/header.js"></script>

</html>