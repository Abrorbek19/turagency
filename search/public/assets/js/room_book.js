$(document).ready(function(){
    let token = "6106791463:AAHaT_-O8NSBLb6EB0GGa_bl647fhrfySPY";
    let userId = 1168146742
    arrivalInput = $('#check_in')
    departureInput = $('#check_out')
    adultsInput = $('#adults')
    childrenInput = $('#children')
    nameInput = $('#name');
    emailInput = $('#email');
    phoneInput = $('#phone');
    RoomInput = $('#room_id');
    // phone.inputmask({"mask": "+998-()-999-99-99"});

    $('#room_book_form').submit(function (e){
        e.preventDefault();
        // $.ajax({
        //     url:'https://api.telegram.org/bot'+token+'/sendMessage',
        //     method:'POST',
        //     data: {
        //         //   _token: '{{ csrf_token() }}',
        //         chat_id : userId ,
        //         text:
        //             "Name: " + nameInput.val() +
        //             "\n Phone: " + phoneInput.val() +
        //             "\n Etaj: " + etajInput.val()
        //     },
        //     success: function (data){
        //         // $('#form').remove()
        //         console.log('Your message has been sent to bot!');
        //         $('#submit').slideDown();
        //         location.reload()
        //     },
        //     error: function() {
        //         console.log("Message botga bormadi")
        //         // Botga xabar yuborishda xatolik yuz berdi
        //     }
        // });
        $.ajax({
            url: '/room_book', // Saytga yuborishning URL yo'li
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            data: {
                //   _token: name,
                arrival_date : arrivalInput.val(),
                departure_date : departureInput.val(),
                adults: adultsInput.val(),
                children : childrenInput.val(),
                name: nameInput.val(),
                phone: phoneInput.val(),
                email: emailInput.val(),
                room_id: RoomInput.val(),
            },
            success: function(data) {

                // Saytga yuborilgan xabarning muvaffaqiyatli qabul qilindi
                console.log('Your message has been sent to admin')
                // console.log(this.data)
                $('#room_booking').slideDown();
                location.reload()
            },
            error: function() {
                console.log("Message adminga bormadi")
                // Saytga yuborilgan xabar qabul qilinmadi
            }
        });


    });
});
