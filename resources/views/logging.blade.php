<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open House 2025</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="wonderland-background">
        <div class="main-container">
            <div class="institution-credits-bar">
                <div class="credits-logo"><img src="{{ asset('image/smk1cimahi.png') }}"></div>
                <div class="credits-logo"><img src="{{ asset('image/rpl.png') }}"></div>
                <div class="credits-logo"><img src="{{ asset('image/ayenastudio.png') }}"></div>
                <div class="credits-logo"><img src="{{ asset('image/dijait.png') }}"></div>
            </div>

            <header class="wonderland-header">
                <h1 class="title">OPEN HOUSE</h1>
                <p class="philosophy">"Follow the White Rabbit – Let's Explore the Wonderland of Software Development!"</p>
            </header>

            <div class="content-wrapper">
                <div class="form-container">
                    <div class="tab-container">
                        <button class="tab-btn active" data-type="individual">Individu</button>
                        <button class="tab-btn" data-type="group">Rombongan</button>
                    </div>

                    <form id="guestBookForm" action="{{ url('login') }}" method="post" >
                        @csrf
                        <input type="hidden" name="type" id="formType" value="individual">

                        <div class="form-group">
                            <input type="text" id="instansi" name="instansi" placeholder="Alamat / Instansi / Nama Rombongan" required>
                            <span class="error-message">Please enter your address or institution</span>
                            @error('instansi')
                                <span class="error-message" style="display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="individualSection" class="form-section active">
                            <div class="form-group">
                                <input type="text" id="individualName" name="nama[]" placeholder="Nama">
                                @error('nama')
                                    <span class="error-message" style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div id="groupSection" class="form-section">
                            <div class="names-container">
                                <div class="form-group">
                                    <input type="text" class="group-name" name="nama[]" placeholder="Nama">
                                    <span class="error-message">Please enter a name</span>
                                </div>
                            </div>
                            <button type="button" id="addNameBtn" class="add-name-btn">
                                <span>Tambah</span>
                            </button>
                        </div>

                        <button type="submit" class="submit-btn">Enter Wonderland</button>
                    </form>
                </div>

                <div class="stats-sidebar">
                    <div class="stats-card">
                        <h3>Statistik Pengunjung</h3>
                        <div class="stat-item"><div class="stat-label">Tamu Hari Kamis</div><div class="stat-value" id="thursdayCount">{{ $Kamis }}</div></div>
                        <div class="stat-item"><div class="stat-label">Tamu Hari Jumat</div><div class="stat-value" id="fridayCount">{{ $Jumat }}</div></div>
                        <div class="stat-item"><div class="stat-label">Tamu Hari Sabtu</div><div class="stat-value" id="saturdayCount">{{ $Sabtu }}</div></div>
                        <div class="stat-divider"></div>
                        <div class="stat-item total"><div class="stat-label">Tamu Total</div><div class="stat-value" id="totalCount">{{ $Total }}</div></div>
                    </div>
                </div>
            </div>

        @if(session('success'))
        <div id="successModal" class="modal">
            <div class="modal-content">
                <h2>Welcome to Wonderland!</h2>
                <p>Data berhasil disimpan.</p>
                <button id="closeModal" class="close-modal-btn">Continue the Adventure</button>
            </div>
        </div>
        </div>
        @endif
    </div>


    <script src="{{ asset('script.js') }}"></script>
</body>
</html>
