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
                    <option value="" disable selected hidden>Pilih Berdasarkan Provinsi</option>
                    // Saat nama Kabupaten di pilih, nama tersebut / optionnya memiliki value 'id'
                    <option value="${data.name}" id="id-province">${data.name}</option>
                `;
                newElement += option;
            });
            $('#search-provinsi').html(newElement);
        },
        error: function(error) {
            alert(error);
        }
    });
});