<h1>Ada {{ $daftarTugas->count() }} tugas</h1>
<ol>
    <form action="/vee" method="POST" >
        <input type="text" name="deskripsi" placeholder="masukkan tugas">
        <button type="submit">Tambah</button>
    </form>

    @foreach ($daftarTugas as $tugas)
    <li>{{ $tugas->deskripsi }}</li>
    <form action="/vee/{{ $tugas->id }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="deskripsi" value="{{ $tugas->deskripsi }}">
        <button type="submit">Edit</button>
    </form>

    <p>
        <form action="/vee/{{ $tugas->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus</button>
        </form>
    </p>
    @endforeach
</ol>