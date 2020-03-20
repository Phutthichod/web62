@extends('template.layout')

@section('title','pinto')

@section('content')
<?php
    function showDetail($head,$body,$option = null){
        echo "
                <strong>$head</strong>
                <span>$body</span>
        ";
        if($option == null)
            echo "<div></div>";
        echo $option;
    }
?>
<link rel="stylesheet" href="{{asset('css/show_profile/style.css')}}">
<link rel="stylesheet" href="{{asset('lib/croppie/croppie.css')}}">

<div class="main">
    <div></div>
    <div class="container">
        <span><a href="/">หน้าแรก</a>>โปรไฟล์</span>
        <div class="card">
            <div class="card-header">
                <div class="show-img-profile">
                    <strong>รูปโปรไฟล์</strong>
                    <span>แก้ไขรูป</span>
                    <div class="upload-img">
                        <input id='pic-logo' type='file' class='item-img file center-block'  accept=".jpg,.png" name='icon_insert' />
                        <img id="profile-show" src="{{asset(session()->get('icon'))}}" alt="">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="show-profile-detail">
                    {{showDetail("ชื่อเต็ม",session()->get('member')['thainame'])}}
                    {{showDetail("คณะ",session()->get('member')['faculty'])}}
                    {{showDetail("สาขา",session()->get('member')['department'])}}
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-header "><strong class="d-flex justify-content-start ml-3">ติดต่อ</strong> </div>
            <div class="card-body">
                <div class="show-profile-detail show-mail">
                    @if(session()->get('mail2') == null)
                        {{showDetail("อีเมล์",session()->get('member')['mail1'],"<button class='btn btn-success add-mail'>เพิ่มเมล์</button>") }}
                    @else
                        {{showDetail("อีเมล์",session()->get('member')['mail1'],null)}}
                        <?php $mail2 =  session()->get("mail2")?>
                        <?php showDetail("อีเมล์",'<input type="email" name="mail-update" class="form-control" disabled value='.$mail2.' />',"<div class='manage-mail'><button class='btn btn-warning edit-mail'>แก้ไข</button><button class='btn btn-danger delete-mail'>ลบ</button></div>");?>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card card-show-crop" style="float:right;">
        <div class="card-header">
            <strong>รูปโปรไฟล์</strong>
        </div>
        <div class="card-body">
             <center><div id="upload-demo" ></div></center>
        </div>
        <div class="card-footer">
            <button class="btn btn-success crop-submit">ยืนยัน</button>
            <button class="btn btn-danger crop-cancel">ยกเลิก</button>
        </div>
    </div>

</div>




<script src="{{asset('lib/croppie/croppie.js')}}"></script>
<script>
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    $('.card-show-crop').hide()
    let img

    $(document).on('change','#pic-logo', function () {
        // $('#change-profile').modal('show')
        $('.card-show-crop').toggle()
        let input = this
        console.log('cahnge');
        if (input.files && input.files[0]) {
            var reader = new FileReader()
            reader.onload = function (e) {
                console.log("set");
                img = e.target.result;
                // $('#change-profile').modal('show')
                // $('#img-show-crop').attr('src',IMG)
                crop(img);
            }
            reader.readAsDataURL(input.files[0])


        }
    });
    function crop(img){
            $uploadCrop = $('#upload-demo').croppie({
                viewport: {
                width: 150,
                height: 150,
                type:'circle'
            },
                enforceBoundary: false,
                enableExif: true

            });
            $uploadCrop.croppie('bind', {
            url: img
        }).then(function(){
            console.log('jQuery bind complete');
            // $('.card-show-crop').toggle()
        });
    }
    $('.crop-submit').click(function(){
        $('#upload-demo').croppie('result',
            {type:'canvas',size:'viewport'})

            .then(function(r) {

        $.ajax({
               type:'POST',
               url:'/profile/updateIcon',
               data: {
                   icon:r
               },
               success:function(data) {
                  console.log(data)
                    $('.img-profile').attr('src',`{{asset("`+data+`")}}`)
                    $('#profile-show').attr('src', `{{asset("`+data+`")}}`);
                //   location.reload();
               },
            error: function(data) {
                console.log(data);
            }
            });

            });
        $('#upload-demo').croppie('destroy')
        $('.card-show-crop').hide()
    })
    $('.crop-cancel').click(function(){
        $('#upload-demo').croppie('destroy')
        $('.card-show-crop').hide()
    })
    $(".add-mail").click(function(){
        console.log('click');
        $('.show-mail').append("<div></div>")
        $('.show-mail').append(`<?php showDetail("อีเมล์",'<input type="email" name="mail-update" class="form-control" />',"<div class='manage-mail'><button class='btn btn-warning edit-mail'>แก้ไข</button><button class='btn btn-success update-mail'>บันทึก</button></div>");?>`);
        $('.edit-mail').hide();
        $(this).remove();
    })
    $(document).on('change','input[name="mail-update"]',function(){
        console.log("change")
        updateMail($('input[name="mail-update"]').val())
    })
    $(document).on('blur','input[name="mail-update"]',function(){
        $('input[name="mail-update"]').attr('disabled','disabled')
    })
    $(document).on('click','.edit-mail',function(){
        $('input[name="mail-update"]').removeAttr('disabled')
        $('input[name="mail-update"]').focus()
    })
    $(document).on('click','.update-mail',function(){
        $('.edit-mail').show();
        $('input[name="mail-update"]').attr('disabled','disabled')
        updateMail($('input[name="mail-update"]').val())
        $(this).html("ลบ")
        $(this).attr('class','btn btn-danger delete-mail')
    })
    function updateMail(mail){
        $.ajax({
               type:'POST',
               url:'/profile/updateEmail',
               data: {
                mail:mail
               },
               success:function(data) {
                  console.log(data)
                //   location.reload();
               },
            error: function(data) {
                console.log(data);
            }
            });
    }

</script>
@endsection
