<div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>

    <a href="/">Home</a>
    @can('admin')
        <a href="/admin">Admin</a>
    @endcan
    @auth
        <a href="/riwayatTransaksi">Riwayat Transaksi</a>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" onclick="return confirm('Logout..?')" class="btn bg-transparent border-0">Logout</button>
        </form>
    @else
        <a href="/register">Register</a>
        <a href="/cekTransaksi">Cek Transaksi</a>
        <a href="/login">Login</a>
        <form action="/cekSaldo" method="POST">
            @csrf
            <button type="submit" class="btn bg-transparent border-0">Cek Saldo</button>
        </form>
        <form action="/daftarHarga" method="POST">
            @csrf
            <button type="submit" class="btn bg-transparent border-0">Daftar Harga</button>
        </form>
    @endauth
</div>
