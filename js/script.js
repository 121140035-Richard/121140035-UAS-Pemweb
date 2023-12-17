function changeCardDetail(data, target) {
    target.textContent = data.value;
}

document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById("nama").value != null) {
        const nama = document.getElementById("nama").value;
        const nim = document.getElementById("nim").value;
        const prodi = document.getElementById("prodi").value;
        const jenis_kelamin = document.getElementById("jenis_kelamin").value;

        document.getElementById("nama_card").textContent = nama;
        document.getElementById("nim_card").textContent = nim;
        document.getElementById("prodi_card").textContent = prodi;
        document.getElementById("gender_card").textContent = jenis_kelamin;
    }
}, false);