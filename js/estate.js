jQuery(document).ready(function($){
    $('#filter_form').submit(function (e) {
        e.preventDefault();
        let build_name = $('#build_name').val(),
            coordinates = $('#coordinates').val(),
            floors = $('#floors').val(),
            type = $('#type').val(),
            rooms = $('#rooms').val(),
            balcony = $('#balcony').val(),
            wc = $('#wc').val(),
            data;
        data = {
            'build_name': build_name,
            'coordinates': coordinates,
            'floors': floors,
            'type': type,
            'rooms': rooms,
            'balcony': balcony,
            'wc': wc,
        };
        sendAjax(data, 'estate_filter', 'post');
    });

    $(document).on('click', '.estate-paginate a', function (e) {
        e.preventDefault();
        let data = $('.estate-paginate').data('query'),
            numbers = $(this).text();

        if(numbers.indexOf('>') === 0){
            data.paged = Number(data.paged) + 1;
        }
        else if(numbers.indexOf('<') === 0){
            data.paged = Number(data.paged) - 1;
        }else{
            data.paged = numbers;
        }

        sendAjax(data, 'estate_filter', 'post');
    });

   function sendAjax(data, action, method) {
        let sendData = data;
        sendData.action = action;
        sendData.nonce = estateObj.nonce;
        $.ajax({
            url: estateObj.ajaxurl,
            method: method,
            data: sendData,
            success: function(res){

                if(res.success){
                    $('#insert_result').html(res.data);
                }
            }
        })
    }
});




