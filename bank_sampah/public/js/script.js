$(document).ready(function(){
    $(".chosen-select").chosen();
    $(".chosen-container").width('618.1px');
    $(".chosen-container").css('display', 'inline-block');

    let myfunction = function(e){
        let sole = this.value;
        let total = this.parentElement.nextElementSibling.firstElementChild;
        let inputs = $('.angka');
        let benar = [];
        $.ajax({
            url: 'http://localhost:8080/tranksaksi/getHargaBarang',
            data: {nama : $(this).data('nama')},
            method: 'post',
            success: function(data){
                total.value = data*sole;
                for(let i=0;i<inputs.length;i++){
                    // alert($(inputs[i]).val());
                    if($(inputs[i]).val()!==''){
                        benar.push(true);
                    }else{
                        benar.push(false);
                    }
                    if(benar.every(v=>v==true)){
                        $("#submit").prop("disabled",false);
                        $('.salah').removeClass('d-block');
                    }else{
                        $("#submit").prop("disabled",true);
                        $('.salah').addClass('d-block');
                    }
                }
            }
        });
    }

    let myfunctions = function(e){
        let sole = this.value;
        let total = this.parentElement.nextElementSibling.firstElementChild;
        let stok = $(this).parent().prev().html();
        let benar = [];
        let jumlah = [];
        stok = parseInt(stok);
        let nama = $(this).parent().prev().prev().prev().prev().html();
        let inputs = $('.angka');
        $.ajax({
            url: 'http://localhost:8080/tranksaksi/getHargaBarangKeluar',
            data: {nama : $(this).data('nama')},
            method: 'post',
            success: function(data){
                total.value = data*sole;
                for(let i=0;i<inputs.length;i++){
                    if(($(inputs[i]).val()!=='')&&(sole>stok)){
                        $("#submit").prop("disabled",true);
                        $('#submit').parent().append(`<div id="validationServer04Feedback" class="invalid-feedback d-block stok">Jumlah ${nama} tidak boleh melebihi stok</div>`);
                        benar.push(true);
                        jumlah.push(false);
                    }else if(($(inputs[i]).val()!=='')&&(sole<=stok)){
                        $('.stok').remove();
                        jumlah.push(true);
                        benar.push(true);
                    }else if(($(inputs[i]).val()=='')&&(sole>stok)){
                        $("#submit").prop("disabled",true);
                        $('#submit').parent().append(`<div id="validationServer04Feedback" class="invalid-feedback d-block stok">Jumlah ${nama} tidak boleh melebihi stok</div>`);
                        benar.push(false);
                        jumlah.push(false);
                    }else if(($(inputs[i]).val()=='')&&(sole<=stok)){
                        $("#submit").prop("disabled",true);
                        $('.stok').remove();
                        benar.push(false);
                        jumlah.push(true);
                    }
                    if((benar.every(v=>v==true))&&(jumlah.every(v=>v==true))){
                        $('.salah').removeClass('d-block');
                        $("#submit").prop("disabled",false);
                        $('.stok').remove();
                        console.log(1);
                    }else if((benar.every(v=>v==true))&&(jumlah.every(v=>v==true))){
                        $('.salah').removeClass('d-block');
                        $('.salah').addClass('d-block');
                        console.log(2);
                    }else if((!benar.every(v=>v==true))&&(jumlah.every(v=>v==true))){
                        $("#submit").prop("disabled",true);
                        // $('.salah').addClass('d-block');
                        console.log(3);
                    }else{
                        $("#submit").prop("disabled",true);
                        $('.salah').addClass('d-block');
                        console.log(4);
                    }
                }
            }
        });
    }

    $('.jumlah').change(myfunction).keyup(myfunction);
    $('.jumlah-keluar').change(myfunctions).keyup(myfunction);
    $("#submit").prop("disabled",true);
    $('#submit').parent().append(`<div id="validationServer04Feedback" class="invalid-feedback d-block salah">Isi jumlah terlebih dahulu</div>`);
})