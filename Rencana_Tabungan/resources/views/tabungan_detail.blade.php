<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/style.css')}}" />
        <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }

            .card {
                transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            }

            .card:hover {
                transform: scale(1.02);
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            }

        </style>
    </head>
    <body>
        <div class="sidebar">
            <div class="logo-details">
                <div class="logo">
                    <img src="{{ asset('img/logo.png') }}" alt="profile" style="height: 35px; width: 35px;"/>
                </div>
                <span class="logo_name">PocketPlan</span>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="bx bx-grid-alt"></i>
                        <span class="link_name">Dashboard</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a href="#" class="link_name">Dashboard</a></li>
                    </ul>
                </li>
                <li>
                    <div class="icon-link">
                        <a href="{{ route('dashboard') }}">
                            <i class="bx bx-collection"></i>
                            <span class="link_name">Activity</span>
                        </a>
                        <i class="bx bxs-chevron-down arrow"></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Activity</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalTabungan">Tabungan</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalMenabung">Menabung</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('logout') }}">
                        <i class="bx bx-log-out"></i>
                        <span class="link_name">Logout</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a href="{{ route('logout') }}" class="link_name">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <section class="home-section">
            <!-- Topbar -->
            <div class="home-content">
                <i class="bx bx-menu"></i>
                <div class="profile">
                    <img src="{{ asset('img/profile.jpg') }}" alt="Profile">
                </div>
            </div>
        
            <!-- Page Title with Breadcrumb -->
            <div class="page-header">
                <h2>Detail</h2>
                <nav class="breadcrumb">
                    <a href="{{ route('dashboard') }}">Home</a>
                    <span> / </span>
                    <span>Detail Tabungan</span>
                </nav>
            </div>
        
            <div class="dashboard">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success" style="text-align: center; font-size: 13px; color: #155724;">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" style="text-align: center; font-size: 13px; color: #721c24;">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="container mt-4">
                    
                    <strong><p style="font-size: 21px;">Detail Tabungan</p></strong>
                
                    <!-- Informasi Tabungan -->
                    <div class="card mb-4" style="border-color: #ff8c6b;">
                        <div class="card-body">
                            <span class="badge {{ $tabungan_detail->status == 'Tercapai' ? 'bg-success' : 'bg-warning' }}">{{ $tabungan_detail->status }}</span>
                            <p></p>
                            <strong><p class="card-title" style="color: #ff8c6b; font-size: 20px;">{{ $tabungan_detail->judul_tabungan }}</p></strong>
                            <p class="card-text">
                                <strong><i class="bx bx-calendar"></i> :</strong> {{ \Carbon\Carbon::parse($tabungan_detail->target_tanggal)->format('d M Y') }} <br>
                                <strong><i class="bx bx-wallet"></i> :</strong> 
                                    <span style="color: red;">Rp {{ number_format($tabungan_detail->nominal, 0, ',', '.') }} / 
                                        <span style="color: blue;">Rp {{ number_format($tabungan_detail->target_nominal, 0, ',', '.') }}</span>
                                    </span>
                            </p>
                        </div>
                    </div>
                
                    <!-- Data Menabung -->
                    <strong><p>Riwayat Menabung</p></strong>
                    <div class="row">
                        @forelse($menabung as $item)
                            <div class="col-md-3">
                                <div class="card mb-4 shadow-sm" style="border-color: #ff8c6b;">
                                    <div class="card-body">
                                        <strong><i class="bx bx-calendar"></i> :</strong> {{ \Carbon\Carbon::parse($item->tanggal_menabung)->format('d M Y') }} 
                                        <br>
                                        <strong><i class="bx bx-wallet"></i> :</strong> Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                    </div>
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                    <div class="d-flex position-absolute bottom-0 end-0 m-3">
                                        <form action="{{ route('menabung.delete', $item->id_menabung) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" style="height: 35px; width: 40px;">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>                                    
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-warning text-center">Belum ada riwayat menabung untuk tabungan ini.</div>
                            </div>
                        @endforelse
                    </div>
                </div>                  
            </div>
        </section>   
        
        <!-- Modal Tambah Tabungan -->
        <div class="modal fade" id="modalTabungan" tabindex="-1" aria-labelledby="modalTabunganLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTabunganLabel">Tambah Tabungan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('tabungan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Tabungan</label>
                                <input type="text" class="form-control" id="judul" name="judul_tabungan" required>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Tabungan</label>
                                <input type="file" class="form-control" id="foto" name="foto" required>
                            </div>
                            <div class="mb-3">
                                <label for="target_nominal" class="form-label">Target Nominal</label>
                                <input type="number" class="form-control" id="target_nominal" name="target_nominal" required>
                            </div>
                            <div class="mb-3">
                                <label for="target_tanggal" class="form-label">Target Tanggal Tercapai</label>
                                <input type="date" class="form-control" id="target_tanggal" name="target_tanggal" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" id="status" name="status" value="Belum Tercapai" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Tabungan -->
        @foreach ($tabungan as $t)
        <div class="modal fade" id="editModal{{ $t->id_tabungan }}" tabindex="-1" aria-labelledby="editModalLabel{{ $t->id_tabungan }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $t->id_tabungan }}">Detail Tabungan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('tabungan.update', $t->id_tabungan) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="judul_tabungan" class="form-label">Judul Tabungan</label>
                                <input type="text" class="form-control" id="judul_tabungan" name="judul_tabungan" value="{{ $t->judul_tabungan }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="target_tanggal" class="form-label">Target Tanggal</label>
                                <input type="date" class="form-control" id="target_tanggal" name="target_tanggal" value="{{ $t->target_tanggal }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="target_nominal" class="form-label">Target Nominal</label>
                                <input type="text" class="form-control" id="target_nominal" name="target_nominal" value="{{ $t->target_nominal }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="nominal" class="form-label">Nominal</label>
                                <input type="text" class="form-control" id="nominal" name="nominal" value="{{ $t->nominal }}" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" id="status" name="status" value="{{ $t->status }}" required readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Modal Tambah Menabung -->
        <div class="modal fade" id="modalMenabung" tabindex="-1" aria-labelledby="modalMenabungLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTabunganLabel">Ayo Menabung</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('menabung') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id_tabungan" class="form-label">Pilih Tabungan</label>
                                <select class="form-control" id="id_tabungan" name="id_tabungan" required>
                                    <option value="" selected disabled>Pilih Tabungan</option>
                                    @foreach ($tabungan_status as $t)
                                        <option value="{{ $t->id_tabungan }}">
                                            {{ $t->judul_tabungan }} (Sisa Target: {{ $t->target_nominal - $t->nominal }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nominal" class="form-label">Nominal</label>
                                <input type="number" class="form-control" id="nominal" name="nominal" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_menabung" class="form-label">Tanggal Menabung</label>
                                <input type="date" class="form-control" id="tanggal_menabung" name="tanggal_menabung" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            let arrow = document.querySelectorAll(".arrow");
            for (var i = 0;i < arrow.length; i++) {
                arrow[i].addEventListener("click", (e)=>{
                    let arrowParent = e.target.parentElement.parentElement;
                    arrowParent.classList.toggle("showMenu");
                });
            }

            let sidebar = document.querySelector(".sidebar");
            let sidebarBtn = document.querySelector(".bx-menu");
            console.log(sidebarBtn);
            sidebarBtn.addEventListener("click", ()=>{
                sidebar.classList.toggle("close");
            });
        </script>
    </body>   
</html>