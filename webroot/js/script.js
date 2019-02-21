$(document).ready(function () {
    $('.selection').select2();
    $('.selectionMonths').select2();
    $('.selectionYears').select2();


    $('[id^=sendNotifcationMail]').click(function(event) {
        var id = event.target.value;
        var target = event.target.id;

        $.ajax({
            type: 'POST',
            url: "/cakeUren/user_monthbookings/attentionMail/",
            data: {id: id},
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#' + target).hide();
                }
            },
            error: function () {
                alert('Fout met versturen')
            }
        });
    });

    //Form opmaak
    $(".name").focus(function () {
        $(".name-help").slideDown(500);
    }).blur(function () {
        $(".name-help").slideUp(500);
    });

    $(".email").focus(function () {
        $(".email-help").slideDown(500);
    }).blur(function () {
        $(".email-help").slideUp(500);
    });

    $(".password").focus(function () {
        $(".password-help").slideDown(500);
    }).blur(function () {
        $(".password-help").slideUp(500);
    });
});



//Form opmaak. schuifbalkjes
// // Input Lock
// $("textarea").blur(function() {
//     $("#hire textarea").each(function() {
//         $this = $(this);
//         if (this.value !== "") {
//             $this.addClass("focused");
//             $("textarea + label + span").css({ opacity: 1 });
//         } else {
//             $this.removeClass("focused");
//             $("textarea + label + span").css({ opacity: 0 });
//         }
//     });
// });
//
// $("#hire .field:first-child input").blur(function() {
//     $("#hire .field:first-child input").each(function() {
//         $this = $(this);
//         if (this.value !== "") {
//             $this.addClass("focused");
//             $(".field:first-child input + label + span").css({ opacity: 1 });
//         } else {
//             $this.removeClass("focused");
//             $(".field:first-child input + label + span").css({ opacity: 0 });
//         }
//     });
// });
//
// $("#hire .field:nth-child(2) input").blur(function() {
//     $("#hire .field:nth-child(2) input").each(function() {
//         $this = $(this);
//         if (this.value !== "") {
//             $this.addClass("focused");
//             $(".field:nth-child(2) input + label + span").css({ opacity: 1 });
//         } else {
//             $this.removeClass("focused");
//             $(".field:nth-child(2) input + label + span").css({ opacity: 0 });
//         }
//     });
// });
