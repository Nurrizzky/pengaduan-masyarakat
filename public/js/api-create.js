// Akan berjalan ketika Web / data nya sudah siap
$(document).ready(function () {
    $.ajax({
        method: "GET",
        url: "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
        dataType: "json",
        success: function (response) {
            let newElement = '';
            response.forEach(data => {
                let option = `
                    <option value="" disable selected hidden>Pilih</option>
                    // Saat nama Kabupaten di pilih, nama tersebut / optionnya memiliki value 'id'
                    <option value="${data.id}-${data.name}" id="id-province">${data.name}</option>
                `;
                newElement += option;
            });
            $('#province').html(newElement);
        },
        error: function(error) {
            alert(error);
        }
    });
});

// saat province sudah terpilih maka kode dibawah ini akan berjalan 
$('#province').change(function () {
    // idprovince akan berinteraksi dengan select province untuk mengambil sebuah nilai di option
    let idprovince = $(this).val();
    let id = idprovince.slice(0, 2);
    if (id) {
        $.ajax({
            method: "GET",
            url: "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/"+id+".json",
            dataType: "json",
            success: function (response) {
                let newOption = '';
                response.forEach(data => {
                    let option = `
                    <option value="" disable selected hidden>Pilih</option>
                    <option value="${data.id}-${data.name}" id="id-regency">${data.name}</option> //ubah data.name menjadi id dari api nya
                    `;
                    newOption += option;
                });
                $('#regency').html(newOption);
            },
            error: function (error) { 
                alert(error);
            }
        });
    }
});
$('#regency').change(function () {
    // idProvinsi akan berinteraksi dengan select provinsi untuk mengambil sebuah nilai di option
    let idKotaKabupaten = $(this).val();
    let id = idKotaKabupaten.slice(0, 4);
    if (id) {
        $.ajax({
            method: "GET",
            url: "https://www.emsifa.com/api-wilayah-indonesia/api/districts/"+id+".json",
            dataType: "json",
            success: function (response) {
                let newOption = '';
                response.forEach(data => {
                    let option = `
                    <option value="" disable selected hidden>Pilih</option>
                    <option value="${data.id}-${data.name}" id="id-subdistrict">${data.name}</option> //ubah data.name menjadi id dari api nya
                    `;
                    newOption += option;
                });
                $('#subdistrict').html(newOption);
            },
            error: function (error) { 
                alert(error);
            }
        });
    }
});
$('#subdistrict').change(function () {
    // idProvinsi akan berinteraksi dengan select provinsi untuk mengambil sebuah nilai di option
    let idsubdistrict = $(this).val();
    let id = idsubdistrict.slice(0, 7);
    if (id) {
        $.ajax({
            method: "GET",
            url: "https://www.emsifa.com/api-wilayah-indonesia/api/villages/"+id+".json",
            dataType: "json",
            success: function (response) {
                let newOption = '';
                response.forEach(data => {
                    let option = `
                    <option value="" disable selected hidden>Pilih</option>
                    <option value="${data.id}-${data.name}" id="id-village">${data.name}</option> //ubah data.name menjadi id dari api nya
                    `;
                    newOption += option;
                });
                $('#village').html(newOption);
            },
            error: function (error) { 
                alert(error);
            }
        });
    }
});