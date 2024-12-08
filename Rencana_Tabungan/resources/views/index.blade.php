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
                        <li><a href="{{ route('dashboard') }}" class="link_name">Dashboard</a></li>
                    </ul>
                </li>
                <li>
                    <div class="icon-link">
                        <a href="#">
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
                <h2>Dashboard</h2>
                <nav class="breadcrumb">
                    <a href="#">Home</a>
                    <span> / </span>
                    <span>Dashboard</span>
                </nav>
            </div>

            <div class="dashboard">
                <div class="dashboard-item">
                    <i class="bx bx-user"></i>
                    <div class="dashboard-info">
                        <h3>{{ $total_tabungan }}</h3>
                        <p>Total Tabungan</p>
                    </div>
                </div>
                <div class="dashboard-item">
                    <i class="bx bx-money"></i>
                    <div class="dashboard-info">
                        <h3>Rp {{ number_format($total_menabung, 0, ',', '.') }}</h3>
                        <p>Total Menabung</p>
                    </div>
                </div>
                <div class="dashboard-item">
                    <i class="bx bx-task"></i>
                    <div class="dashboard-info">
                        <h3>{{ $total_tercapai }}</h3>
                        <p>Total Tercapai</p>
                    </div>
                </div>

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
                    <div class="row">
                        @forelse($tabungan as $item)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="card mb-4 shadow-sm position-relative">
                                    <a href="{{ route('tabungan.detail', $item->id_tabungan) }}">
                                        <img src="{{ asset($item->foto) }}" class="card-img-top" alt="Foto Tabungan" style="height: 200px; object-fit: cover;">
                                    </a>
                                    <div class="card-body">
                                        <span class="badge {{ $item->status == 'Tercapai' ? 'bg-success' : 'bg-warning' }}">{{ $item->status }}</span>
                                        <strong>
                                            <p class="card-title" style="color: #ff8c6b; font-size: 20px;">{{ $item->judul_tabungan }}</p>
                                        </strong>
                                        <p class="card-text small">
                                            <strong><i class="bx bx-calendar"></i> :</strong> 
                                            {{ \Carbon\Carbon::parse($item->target_tanggal)->format('d M Y') }}
                                            <br>
                                            <strong><i class="bx bx-wallet"></i> :</strong>
                                            <span style="color: red;">Rp {{ number_format($item->nominal, 0, ',', '.') }} / 
                                                <span style="color: blue;">Rp {{ number_format($item->target_nominal, 0, ',', '.') }}</span>
                                            </span>
                                        </p>
                                    </div>
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                    <!-- Tombol Detail dan Hapus -->
                                    <div class="d-flex position-absolute bottom-0 end-0 m-3">
                                        <a href="#" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_tabungan }}" style="height: 35px; width: 40px; background: #ff8c6b; border-color: #ff8c6b;">
                                            <i class="bx bx-detail"></i>
                                        </a>
                                        <form action="{{ route('tabungan.delete', $item->id_tabungan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tabungan ini beserta riwayat menabungnya?')">
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
                                <div class="alert alert-warning text-center">Belum ada tabungan yang ditambahkan.</div>
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