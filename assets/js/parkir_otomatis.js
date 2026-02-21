function pilihAreaOtomatis() {
    const jenis = document.getElementById('jenis_kendaraan').value;
    const areaSelect = document.getElementById('id_area');
    if(!areaSelect) return;

    const options = areaSelect.options;
    
    // Reset ke pilihan pertama jika jenis kosong
    if (jenis === "") {
        areaSelect.selectedIndex = 0;
        return;
    }

    for (let i = 0; i < options.length; i++) {
        const namaArea = options[i].getAttribute('data-nama');
        
        if (!namaArea) {
            // Fallback: gunakan text option jika tidak ada data-nama
            const teksArea = options[i].text.toLowerCase();
            
            if (jenis === "Truk" && teksArea.includes("basement")) {
                areaSelect.selectedIndex = i;
                break;
            } else if (jenis === "Mobil" && (teksArea.includes("lantai 1") || teksArea.includes("lt 1"))) {
                areaSelect.selectedIndex = i;
                break;
            } else if (jenis === "Motor" && (teksArea.includes("lantai 2") || teksArea.includes("lt 2"))) {
                areaSelect.selectedIndex = i;
                break;
            }
        } else {
            // Gunakan data-nama jika ada
            if (jenis === "Truk" && namaArea.includes("basement")) {
                areaSelect.selectedIndex = i;
                break;
            } else if (jenis === "Mobil" && (namaArea.includes("lantai 1") || namaArea.includes("lt 1"))) {
                areaSelect.selectedIndex = i;
                break;
            } else if (jenis === "Motor" && (namaArea.includes("lantai 2") || namaArea.includes("lt 2"))) {
                areaSelect.selectedIndex = i;
                break;
            }
        }
    }
}
