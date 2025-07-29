function validate(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

$(function () {







    // Sayfa yenilendiğinde
    $(window).on('beforeunload', function () {
        // Kaydırma pozisyonunu sakla
        sessionStorage.setItem('scrollPosition', $(window).scrollTop());
    });
    var scrollPosition = sessionStorage.getItem('scrollPosition');

    // Eğer kaydırma pozisyonu varsa, sayfayı o pozisyona kaydır
    if (scrollPosition) {
        $(window).scrollTop(scrollPosition);
    }

    jQuery.fn.DataTable.ext.type.search.string = function (data) {
        var testd = !data ?
            '' :
            typeof data === 'string' ?
                data
                    .replace(/i/g, 'İ')
                    .replace(/ı/g, 'I') :
                data;
        return testd;
    };
    var table2696 = $("#example1limitler").DataTable({ "ordering": false, "searching": false, "lengthChange": false, "pageLength": 500 });
    var table22 = $("#example1islemealinanlar").DataTable({ "ordering": false, "pageLength": 500 });
    var table244 = $("#example1muhasebe").DataTable({ "ordering": false, "pageLength": 500 });
    var table245 = $("#example1dokuman").DataTable({ "ordering": false, "pageLength": 500 });


    var tablestk = $("#example1stok_tanim2").DataTable({
        "responsive": true,
        "pageLength": 20,
        "lengthChange": true,
        "autoWidth": false,
        "ordering": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('example1stok_tanim2_wrapper .col-md-6:eq(0)');

    var table = $("#example1tamamlananbasliklar").DataTable({
        "responsive": true,
        "pageLength": 15,
        "lengthChange": true,
        "autoWidth": false,
        "ordering": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1tamamlananbasliklar_wrapper .col-md-6:eq(0)');

    var table = $("#example1yonlendirilentablo").DataTable({
        "responsive": false,
        "pageLength": 2500,
        "lengthChange": true,
        "autoWidth": false,
        "ordering": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1yonlendirilentablo_wrapper .col-md-6:eq(0)');



    var table = $("#example1").DataTable({ "ordering": false, "pageLength": 20 });

    $('#example1_filter input').keyup(function () {

        table
            .search(
                jQuery.fn.DataTable.ext.type.search.string(this.value)
            )
            .draw();
    });

    $("#examplelabels").DataTable(
        {
            "responsive": true,
            "searching": true,
            "info": true,
            "ordering": false,
            "lengthChange": true,
            "pageLength": 16
        });
    $("#examplerows").DataTable(
        {
            "responsive": true,
            "searching": true,
            "info": true,
            "ordering": false,
            "lengthChange": true,
            "pageLength": 5
        });
    $("#examplecols").DataTable(
        {
            "responsive": true,
            "searching": true,
            "info": true,
            "ordering": false,
            "lengthChange": true,
            "pageLength": 5
        });

    var table = $("#examplekullanicilar").DataTable({ "ordering": false, "pageLength": 18 });
    var taablsae = $("#examplekullanicilar2").DataTable({ "ordering": false, "pageLength": 18 });
    $("#examplekapikullanici").DataTable(
        {
            "responsive": true,
            "searching": true,
            "info": false,
            "ordering": false,
            "lengthChange": false,
            "pageLength": 12
        });
    $("#examplekapikullanici2").DataTable(
        {
            "responsive": true,
            "searching": true,
            "info": false,
            "ordering": false,
            "lengthChange": false,
            "pageLength": 12
        });

    $("#example_table_ilce").DataTable({
        "responsive": true,
        "pageLength": 15,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


    $("#example_table_sehir").DataTable({
        "responsive": true,
        "pageLength": 15,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');



    $("#example11").DataTable({
        "responsive": true,
        "pageLength": 14,
        "lengthChange": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#examplelog").DataTable({
        "responsive": true,
        "pageLength": 14,
        "lengthChange": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#examplemusteriler').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "order": [
            [0, 'desc']
        ],
        "pageLength": 50,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
    $('#example1servisler').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "pageLength": 20,
        "info": true,
        "autoWidth": false,
        "responsive": false,
    });

    $('#example1bakim').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "pageLength": 10,
        "info": false,
        "autoWidth": false,
        "responsive": false,
    });
    $('#example1sigorta').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "pageLength": 10,
        "info": false,
        "autoWidth": false,
        "responsive": false,
    });
    $('#example1kasko').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "pageLength": 10,
        "info": false,
        "autoWidth": false,
        "responsive": false,
    });
    $('#example1muayene').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "pageLength": 10,
        "info": false,
        "autoWidth": false,
        "responsive": false,
    });
    $('#onaybekleyensiparisler').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "order": [
            [6, 'desc']
        ],
        "pageLength": 50,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    $('#examplereport').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    $('#exampleyonlendirmeler').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
    $('#rapor1').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
    $('#rapor2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
    $('#exampleeg').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "pageLength": 19,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": false,
    });


    $('#example152').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    $('#tableurunler').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true,
    });

    $('#tablehareketler').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true,
    });


    $('#examplecontacts').DataTable({
        "paging": true,
        "pageLength": 4,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

});


function confirm_action(confirm_title, confirm_content, confirm_success, url = "") {
    Swal.fire({
        title: confirm_title,
        text: confirm_content,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '#d33',
        confirmButtonText: confirm_success,
        cancelButtonText: "İptal"
    }).then((result) => {
        if (result.isConfirmed) {

            Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "İşlem gerçekleştiriliyor...",
                timer: 2500,
                timerProgressBar: true,
                showCancelButton: false,
                showConfirmButton: false
            });


            const endPoint = url;
            fetch(endPoint)
                .then(data => {


                    if (data.status == 500) {
                        Swal.fire({
                            title: "Başarısız!",
                            html: "İşlem Başarız. Sertifika için üretim onayı vermeden önce işleme almanız gereklidir.",
                            timer: 2500,
                            icon: "error",
                            timerProgressBar: true,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            title: "Başarılı!",
                            html: "İşlem başarıyla gerçekleştirilmiştir.",
                            timer: 2500,
                            icon: "success",
                            timerProgressBar: true,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        location.reload();

                    }


                })
                .then(res => {
                    console.log(res)
                });
        }
    })
}


























function confirm_incelenme_action(confirm_title, confirm_content, confirm_success, url = "") {
    Swal.fire({
        title: confirm_title,
        text: confirm_content,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '#d33',
        confirmButtonText: confirm_success,
        cancelButtonText: "İptal"
    }).then((result) => {
        if (result.isConfirmed) {

            Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "İşlem gerçekleştiriliyor...",
                timer: 2500,
                timerProgressBar: true,
                showCancelButton: false,
                showConfirmButton: false
            });


            const endPoint = url;
            fetch(endPoint)
                .then(data => {

                    Swal.fire({
                        title: "Başarılı!",
                        html: "Seçilen döküman için gözden geçirilme kaydı başarıyla oluşturulmuştur.",
                        timer: 2500,
                        icon: "success",
                        timerProgressBar: true,
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                    location.reload();




                })
                .then(res => {
                    console.log(res)
                });
        }
    })
}

function confirm_ticket_success_action(confirm_title, confirm_content, confirm_success, url = "") {
    Swal.fire({
        title: confirm_title,
        text: confirm_content,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        confirmButtonText: confirm_success,
        cancelButtonText: "İptal"
    }).then((result) => {
        if (result.isConfirmed) {



            Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "İşlem gerçekleştiriliyor...",
                timer: 2500,
                timerProgressBar: true,
                showCancelButton: false,
                showConfirmButton: false
            });


            const endPoint = url;
            fetch(endPoint)
                .then(data => {


                    Swal.fire({
                        title: "Başarılı!",
                        html: "Seçilen istek başarıyla onaylanmıştır.",
                        timer: 2500,
                        icon: "success",
                        timerProgressBar: true,
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                    location.reload();




                })
                .then(res => {
                    console.log(res)
                });
        }
    })
}

function confirm_ticket_danger_action(confirm_title, confirm_content, confirm_success, url = "") {
    Swal.fire({
        title: confirm_title,
        text: confirm_content,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: confirm_success,
        cancelButtonText: "İptal"
    }).then((result) => {
        if (result.isConfirmed) {

            Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "İşlem gerçekleştiriliyor...",
                timer: 2500,
                timerProgressBar: true,
                showCancelButton: false,
                showConfirmButton: false
            });


            const endPoint = url;
            fetch(endPoint)
                .then(data => {

                    Swal.fire({
                        title: "Başarılı!",
                        html: "Seçilen istek reddedilmiştir.",
                        timer: 2500,
                        icon: "success",
                        timerProgressBar: true,
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                    location.reload();




                })
                .then(res => {
                    console.log(res)
                });
        }
    })
}






function confirm_ticket_start_action(confirm_title, confirm_content, confirm_success, url = "") {
    Swal.fire({
        title: confirm_title,
        text: confirm_content,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        confirmButtonText: confirm_success,
        cancelButtonText: "İptal"
    }).then((result) => {
        if (result.isConfirmed) {

            Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "İşlem gerçekleştiriliyor...",
                timer: 2500,
                timerProgressBar: true,
                showCancelButton: false,
                showConfirmButton: false
            });


            const endPoint = url;
            fetch(endPoint)
                .then(data => {

                    Swal.fire({
                        title: "Başarılı!",
                        html: "Seçilen istek işleme alınmıştır.",
                        timer: 2500,
                        icon: "success",
                        timerProgressBar: true,
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                    location.reload();




                })
                .then(res => {
                    console.log(res)
                });
        }
    })
}









function confirm_talep_redirect(confirm_title, confirm_content, confirm_success, url = "") {

    Swal.fire({
        title: confirm_title,
        text: confirm_content,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        confirmButtonText: confirm_success,
        cancelButtonText: "İptal"
    }).then((result) => {
        if (result.isConfirmed) {




            const endPoint = url;
            fetch(endPoint)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Sunucu hatası: ${response.status} ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {

                    Swal.fire({
                        title: "Başarılı!",
                        html: "Seçilen istek işleme alınmıştır.",
                        timer: 2500,
                        icon: "success",
                        timerProgressBar: true,
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                    location.reload();




                })
                .then(res => {
                    console.log(res)
                })
                .catch(error => {
                    Swal.fire({
                        title: "Başarısız!",
                        html: `Bu talep 3 günlük görüşme sürecindedir.`,
                        icon: "error",
                        timerProgressBar: true,
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                });;
        }
    })
}














function fetchData(url, title, baseurl = "") {






    Swal.fire({
        title: "Lütfen Bekleyiniz!",
        html: "İstek bilgileri yükleniyor...",
        timer: 2500,
        timerProgressBar: true,
        showCancelButton: false,
        showConfirmButton: false
    });





    $.ajax({
        url: url,
        method: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);

            if (response.length > 0) {
                var tableHtml = '<table id="examsple1" class="table table-bordered table-striped text-sm" border="1"><tr><th width="70">ID</th><th style="text-align:left">Hareket Detayları</th><th style="text-align:left">Kullanıcı</th><th style="text-align:left">Departman</th><th style="text-align:left">Tarih</th> </tr>';

                $.each(response, function (index, record) {


                    tableHtml += '<tr><td>' + record.istek_hareket_id + '</td> <td style="text-align:left">' + record.istek_hareket_detay + '</td><td style="text-align:left">' + record.kullanici_ad_soyad + '</td><td style="text-align:left">' + record.departman_adi + '</td> <td style="text-align:left">' + record.istek_hareket_kayit_tarihi + '</td> </tr>';
                });

                tableHtml += '</table>';

                Swal.fire({
                    title: '<img width="70" src="' + baseurl + 'assets/dist/img/hareketler.png"></br></br>İstek Hareketleri\n<span style="font-size:16px;font-weight:lighter">' + title + '</span>',
                    confirmButtonColor: '#333',
                    html: tableHtml,
                    confirmButtonText: 'Kapat'
                });


            } else {
                Swal.fire({
                    title: 'Uyarı',
                    text: 'Hiç veri bulunamadı!',
                    icon: 'warning',
                    confirmButtonColor: '#333',
                    confirmButtonText: 'Tamam'

                });
            }
        },

        error: function (err) {
            console.error(err);
        }
    });
}




















function copy(value, element) {
    const textarea = document.createElement("textarea");
    textarea.value = value;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);

    const span_text = document.getElementById("span" + element);
    span_text.innerHTML = ("Panoya Kopyalandı");
    setTimeout(function () {
        span_text.innerHTML = ("Kopyala");
        button_text.classList.remove('btn-success');
        button_text.classList.add('btn-default');
        button_text.style.opacity = 0.7;
    }, 2000)
    const button_text = document.getElementById("button" + element);
    button_text.style.opacity = 1;
    button_text.classList.add('btn-success');
    button_text.classList.remove('btn-default');
}