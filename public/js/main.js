$(function( $ ){
    //change function of every switch with class "js-switch"
    $('.js-switch').change(function () {
        //change status
        //if true turn false, if false turn true
        let status = $(this).prop('checked') === true ? 1 : 0;
        //get character id
        let characterId = $(this).data('id');

        //set up ajax with CSRF
        $.ajaxSetup({
            //send token in header
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //call on ajax
        $.ajax({
            // make type post
            type: "POST",
            //make datatype json
            dataType: "json",
            //send post to url
            url: "/update-status",
            //output data of status on character
            data: {'status': status, 'character_id': characterId},
            success: function (data) {
            }
        });
    });
});
