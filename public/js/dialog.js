function parseErrorMessage(error) {
    let errorMessage = 'Terjadi kesalahan sistem atau koneksi saat memproses data.';
    try {
        let resp = error.responseJSON || (error.responseText ? JSON.parse(error.responseText) : null);
        if (resp) {
            if (resp.errors && typeof resp.errors === 'object' && Object.keys(resp.errors).length > 0) {
                let firstKey = Object.keys(resp.errors)[0];
                let firstVal = resp.errors[firstKey];
                errorMessage = Array.isArray(firstVal) ? firstVal[0] : firstVal;
            } else if (resp.message) {
                errorMessage = resp.message;
            } else if (resp.msg) {
                errorMessage = resp.msg;
            }
        }
    } catch (e) {
        // Fallback berdasarkan HTTP status code jika responseText bukan JSON
    }

    if (error.status === 413) {
        errorMessage = 'Ukuran file atau payload terlalu besar (Max upload terlampaui).';
    } else if (error.status === 422 && errorMessage === 'Terjadi kesalahan sistem atau koneksi saat memproses data.') {
        errorMessage = 'Data yang dikirimkan belum lengkap atau tidak valid.';
    } else if (error.status === 404) {
        errorMessage = 'Alamat endpoint tidak ditemukan (404).';
    } else if (error.status === 500 && errorMessage === 'Terjadi kesalahan sistem atau koneksi saat memproses data.') {
        errorMessage = 'Terjadi kesalahan internal server (500).';
    }
    return errorMessage;
}

async function saveData(title, form, url, resposeSuccess, image = null) {

    var form_data = new FormData($('#' + form)[0]);

    swal({
        title: title,
        text: "Apa kamu yakin ?",
        icon: "info",
        buttons: true,
        primariMode: true,
    })
        .then(async (res) => {
            if (res) {
                if (image){
                    if ($('#'+image).val()) {
                        let image1 = await handleImageUpload($('#'+image));
                        form_data.append('profile', image1, image1.name);
                    }
                }
                $.ajax({
                    type: "POST",
                    data: form_data,
                    url: url ?? window.location.pathname,
                    async: true,
                    processData: false,
                    contentType: false,
                    headers: {
                        'Accept': "application/json"
                    },
                    success: function (data, textStatus, xhr) {
                        if (xhr.status === 200) {
                            swal("Berhasil", {
                                icon: "success",
                                buttons: false,
                                timer: 1000
                            }).then((dat) => {
                                if (resposeSuccess) {
                                    resposeSuccess(data)
                                } else {
                                    window.location.reload()
                                }
                            });
                        } else {
                            swal({
                                title: "Gagal Menyimpan",
                                text: data['msg'] || "Terjadi kesalahan saat menyimpan.",
                                icon: "error"
                            });
                        }
                    },
                    xhr: function() {
                        $('#progressbar').remove();
                        $('#'+form).append(' <div id="progressbar" class="progress mt-2">\n' +
                            '                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>\n' +
                            '                            </div>')
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;
                                $('#progressbar div').attr('style',"width:"+percentComplete+'%').html(parseInt(percentComplete)+'%')
                                if (percentComplete === 100){
                                    $('#progressbar div').addClass('bg-success')
                                }
                            }
                        }, false);
                        return xhr;
                    },
                    complete: function (xhr, textStatus) {
                        setTimeout(() => {
                            $('#progressbar').remove();
                        }, 500);
                    },
                    error: function (error, xhr, textStatus) {
                        $('#progressbar div').removeClass('bg-success').addClass('bg-danger');
                        let reason = parseErrorMessage(error);
                        swal({
                            title: "Gagal Menyimpan",
                            text: reason,
                            icon: "error"
                        });
                    }
                })
            }
        });
    return false;
}

function saveDataObjectFormData(title, form_data, url, resposeSuccess) {
    swal({
        title: title,
        text: "Apa kamu yakin ?",
        icon: "info",
        buttons: true,
        primariMode: true,
    })
        .then((res) => {
            if (res) {
                $.ajax({
                    type: "POST",
                    data: form_data,
                    url: url ?? window.location.pathname,
                    async: true,
                    headers: {
                        'Accept': "application/json"
                    },
                    success: function (data, textStatus, xhr) {
                        if (xhr.status === 200) {
                            swal("Data Updated ", {
                                icon: "success",
                                buttons: false,
                                timer: 1000
                            }).then((dat) => {
                                if (resposeSuccess) {
                                    resposeSuccess(data)
                                } else {
                                    window.location.reload()
                                }
                            });
                        } else {
                            swal({
                                title: "Gagal Menyimpan",
                                text: data['msg'] || "Terjadi kesalahan saat menyimpan.",
                                icon: "error"
                            });
                        }
                    },
                    error: function (error, xhr, textStatus) {
                        let reason = parseErrorMessage(error);
                        swal({
                            title: "Gagal Menyimpan",
                            text: reason,
                            icon: "error"
                        });
                    }
                })
            }
        });
    return false;
}

function saveDataAjaxWImage(title, form, form_data, url, resposeSuccess) {
    var dataForm = form_data['form_data'];
    if (form_data['image']){
        $.each(form_data['image'], async function (k,v) {
            if ($('#'+form+' #'+v).val()) {
                let icon = await handleImageUpload($('#'+v));
                dataForm.append(v, icon, icon.name);
            }
        })
    }
    swal({
        title: title,
        text: "Apa kamu yakin ?",
        icon: "info",
        buttons: true,
        primariMode: true,
    })
        .then((res) => {
            if (res) {
                $.ajax({
                    type: "POST",
                    data: dataForm,
                    url: url ?? window.location.pathname,
                    async: true,
                    processData: false,
                    contentType: false,
                    headers: {
                        'Accept': "application/json"
                    },
                    success: function (data, textStatus, xhr) {
                        if (xhr.status === 200) {
                            swal("Data created ", {
                                icon: "success",
                                buttons: false,
                                timer: 1000
                            }).then((dat) => {
                                if (resposeSuccess) {
                                    resposeSuccess(data)
                                } else {
                                    window.location.reload()
                                }
                            });
                        } else {
                            swal({
                                title: "Gagal Menyimpan",
                                text: data['msg'] || "Terjadi kesalahan saat menyimpan.",
                                icon: "error"
                            });
                        }
                    },
                    error: function (error, xhr, textStatus) {
                        $('#progressbar div').removeClass('bg-success').addClass('bg-danger');
                        let reason = parseErrorMessage(error);
                        swal({
                            title: "Gagal Menyimpan",
                            text: reason,
                            icon: "error"
                        });
                    }
                })
            }
        });
    return false;
}

function deleteData(text, data,url, resposeSuccess) {

    swal({
        title: 'Hapus Data',
        text: "Apa kamu yakin menghapus data " + text + " ?",
        icon: "info",
        buttons: true,
        dangerMode: true,
    })
        .then((res) => {
            if (res) {
                $.ajax({
                    type: "POST",
                    data: data,
                    url: url,
                    async: true,
                    // processData: false,
                    // contentType: false,
                    headers: {
                        'Accept': "application/json"
                    },
                    success: function (data, textStatus, xhr) {
                        console.log(data);

                        if (xhr.status === 200) {
                            swal("Data Deleted ", {
                                icon: "success",
                                buttons: false,
                                timer: 1000
                            }).then((dat) => {
                                if (resposeSuccess) {
                                    resposeSuccess(data)
                                } else {
                                    window.location.reload()
                                }
                            });
                        } else {
                            swal(data['msg'])
                        }
                        console.log(data);
                    },
                    complete: function (xhr, textStatus) {
                        console.log(xhr.status);
                        console.log(textStatus);
                    },
                    error: function (error, xhr, textStatus) {
                        // console.log("LOG ERROR", error.responseJSON.errors);
                        // console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
                        // console.log(xhr.status);
                        // console.log(textStatus);
                        // console.log(error.responseJSON);
                        // swal(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0] : error.responseJSON['message'] ? error.responseJSON['message'] : error.responseJSON['msg'] )
                        console.log();
                        console.log(xhr);
                        console.log(textStatus);
                        // swal(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0] : error.responseJSON['message'] ? error.responseJSON['message'] : error.responseJSON['msg'] )
                        swal(error.responseText ? JSON.parse(error.responseText).message : error.responseJSON['msg'] )
                    }
                })
            }
        });
    return false;
}

function getSelect(id, url, nameValue = 'name', localStorageKey = null, text = null) {
    var select = $('#' + id);
    select.empty();

    // Jika localStorageKey tidak diberikan, gunakan id sebagai default
    var storageKey = localStorageKey || id;

    // Ambil data terakhir yang dipilih dari LocalStorage
    var savedValue = localStorage.getItem(storageKey);

    if (text) {
        select.append('<option value="">' + text + '</option>');
    } else {
        select.append('<option value="" disabled selected>Pilih Data</option>');
    }

    // Cek apakah data sudah ada di LocalStorage
    var storedData = localStorage.getItem(url);
    if (storedData) {
        // Gunakan data dari LocalStorage
        populateSelect(select, JSON.parse(storedData), nameValue, savedValue);
    } else {
        // Fetch data jika belum tersimpan di LocalStorage
        $.get(url, function (data) {
            localStorage.setItem(url, JSON.stringify(data)); // Simpan ke LocalStorage
            populateSelect(select, data, nameValue, savedValue);
        });
    }

    // Simpan pilihan user ke LocalStorage saat berubah
    select.on("change", function () {
        localStorage.setItem(storageKey, this.value);
    });
}

// Fungsi untuk mengisi dropdown dari data
function populateSelect(select, data, nameValue, selectedValue) {
    $.each(data, function (key, value) {
        var isSelected = selectedValue && selectedValue == value['id'] ? 'selected' : '';
        select.append('<option value="' + value['id'] + '" ' + isSelected + '>' + value[nameValue] + '</option>');
    });

    // Set nilai yang sudah disimpan di LocalStorage jika ada
    if (selectedValue) {
        select.val(selectedValue);
    }
}




function currency(field) {
    $('#' + field).on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            formatCurrency($(this), "blur");
        }
    });
}

function setImgDropify(img,text ='Masukkan Image',   file = null, height = null, width = null) {
    img = $('#' + img).dropify({
        messages: {
            'default': text,
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });
    img = img.data('dropify');
    img.resetPreview();
    img.clearElement();

    if (file) {
        img.settings.defaultFile = file;
        img.destroy();
        img.init();
    }
    $('.dropify-wrapper').height(height).width(width);

}
