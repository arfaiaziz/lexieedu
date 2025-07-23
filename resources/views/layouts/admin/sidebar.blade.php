<aside id="sidebar" class="w-64  shadow-lg transition-all duration-300">
    <div class="h-full flex flex-col justify-between items-center">
        <div class="w-full">
            <div class="px-4 py-4 border-b sidebar-title bg-white">
                <a href="{{url('dashboard')}}">
                    <span id="sidebarTextTitle" class="text-lg font-bold text-gray-800">Queen's English College</span>
                </a>
                <img id="sidebarLogo" src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="w-10 h-10 hidden">
            </div>
            <nav class="p-4">
                <!-- <div class="text-sm text-white sidebar-label">Menu</div> -->
                <ul class="space-y-2">
                    <li>
                        <a href="{{url('dashboard')}}" class="flex items-center gap-2 py-2 text-white hover:bg-gray-200 hover:text-black p-2 no-underline rounded {{@$respon['dashboardmenu']}}">
                            <iconify-icon icon="mdi:home" width="24" height="24"></iconify-icon>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                    </li>
                     <li>
                        <a href="{{url('pengguna')}}" class="flex items-center gap-2 py-2 text-white hover:bg-gray-200 hover:text-black p-2 no-underline rounded {{@$respon['penggunamenu']}}">
                            <iconify-icon icon="material-symbols:account-box-sharp" width="24" height="24"></iconify-icon>
                            <span class="sidebar-text">Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('peserta')}}" class="flex items-center gap-2 py-2 text-white hover:bg-gray-200 hover:text-black p-2 no-underline rounded {{@$respon['pesertamenu']}}">
                            <iconify-icon icon="ix:user-group" width="24" height="24"></iconify-icon>
                            <span class="sidebar-text">Peserta</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('transaksi')}}" class="flex items-center gap-2 py-2 text-white hover:bg-gray-200 hover:text-black p-2 no-underline rounded {{@$respon['transaksimenu']}}">
                            <iconify-icon icon="fluent:arrow-swap-28-filled" width="24" height="24"></iconify-icon>
                            <span class="sidebar-text">Transaksi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('instansi')}}" class="flex items-center gap-2 py-2 text-white hover:bg-gray-200 hover:text-black p-2 no-underline rounded {{@$respon['instansimenu']}}">
                            <iconify-icon icon="ix:faceplate-container" width="24" height="24"></iconify-icon>
                            <span class="sidebar-text">Instansi</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="{{url('level')}}" class="flex items-center gap-2 py-2 text-white hover:bg-gray-200 hover:text-black p-2 no-underline rounded {{@$respon['levelmenu']}}">
                            <iconify-icon icon="ix:tree-two-level" width="24" height="24"></iconify-icon>
                            <span class="sidebar-text">Level</span>
                        </a>
                    </li> -->
                    <li>
                        <a href="{{url('soal')}}" class="flex items-center gap-2 py-2 text-white hover:bg-gray-200 hover:text-black p-2 no-underline rounded {{@$respon['soalmenu']}}">
                            <iconify-icon icon="prime:file-edit" width="24" height="24"></iconify-icon>
                            <span class="sidebar-text">Soal</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="py-4">
            <i id="toggleSidebar" class="fa-solid fa-arrow-left cursor-pointer"></i>
        </div>
    </div>
</aside>
