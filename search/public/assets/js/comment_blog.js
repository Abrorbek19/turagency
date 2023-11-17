$(document).ready(function(){
    let token = "6106791463:AAHaT_-O8NSBLb6EB0GGa_bl647fhrfySPY";
    let userId = 1168146742
    nameInput = $('#name');
    emailInput = $('#email');
    commentInput = $('#comment');
    dateInput = $('#date');
    blogInput = $('#blog_id');
    // phone.inputmask({"mask": "+998-()-999-99-99"});

    $('#comment_blog').submit(function (e){
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
            url: '/comment_message', // Saytga yuborishning URL yo'li
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            data: {
                //   _token: name,
                name: nameInput.val(),
                email: emailInput.val(),
                date: dateInput.val(),
                blog_id: blogInput.val(),
                comment:commentInput.val(),
            },
            success: function(data) {

                // Saytga yuborilgan xabarning muvaffaqiyatli qabul qilindi
                console.log('Your message has been sent to admin')
                // console.log(this.data)
                $('#comment_btn').slideDown();
                location.reload()
            },
            error: function() {
                console.log("Message adminga bormadi")
                // Saytga yuborilgan xabar qabul qilinmadi
            }
        });


    });
});
