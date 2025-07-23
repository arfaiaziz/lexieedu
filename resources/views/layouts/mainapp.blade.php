<html>
    <head>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

        <!-- jQuery (wajib sebelum DataTables) -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


        <!-- DataTables core -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <!-- DataTables Buttons -->
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

        <!-- Export dependencies -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

        <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>


        <title>Admin Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background: white !important;
            }
            aside{
                background: #25375F;
                color: #fff;
            }
            .active{
                background: white !important;
                color: black !important;
            }
            .button-add{
                background: #30CAEE !important;
            }

            .striped-table tbody tr:nth-child(odd) {
                background-color: #F3FAFF; /* Baris ganjil - putih */
            }

            .striped-table tbody tr:nth-child(even) {
                background-color: #FFFFFF; /* Baris genap - biru muda */
            }

            table.dataTable>thead>tr>th, table.dataTable>thead>tr>td{
                border: 0 !important;
            }

            .dataTables_paginate{
                font-size: 12px !important
            }

            .dataTables_info{
                font-size: 12px !important
            }

            .dataTables_length{
                font-size: 12px !important
            }

            .dataTables_filter label{
                font-size: 12px !important
            }
        </style>
    </head>
    <body>
        <div class="flex min-h-screen bg-white">
            @include('layouts.admin.sidebar')
            <div class="flex-1 flex flex-col">
                @include('layouts.admin.header')
                @yield('content')
            </div>
        </div>

        @stack('scripts')
    </body>

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            const texts = document.querySelectorAll('.sidebar-text');
            const labels = document.querySelectorAll('.sidebar-label');
            const titleText = document.getElementById('sidebarTextTitle');
            const titleLogo = document.getElementById('sidebarLogo');

            if (sidebar.classList.contains('w-64')) {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-20');

                texts.forEach(el => el.classList.add('hidden'));
                labels.forEach(el => el.classList.add('hidden'));

                titleText.classList.add('hidden');
                titleLogo.classList.remove('hidden');

                this.classList.remove('fa-arrow-left');
                this.classList.add('fa-arrow-right');
            } else {
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');

                texts.forEach(el => el.classList.remove('hidden'));
                labels.forEach(el => el.classList.remove('hidden'));

                titleText.classList.remove('hidden');
                titleLogo.classList.add('hidden');

                this.classList.remove('fa-arrow-right');
                this.classList.add('fa-arrow-left');
            }
        });
    </script>



</html>
