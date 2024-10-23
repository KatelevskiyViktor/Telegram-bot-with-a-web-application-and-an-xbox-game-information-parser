function get_game_info_and_set_into_modal_window() {
    $('.body_card').on('click', function () {
        let game = jQuery.parseJSON($(this).attr('data-game'))
        $('.modal').html('<img src="' + game.img + '" alt="' + game.title + '"><br><br><div class="price_modal">'
            + (game.full_coast ? '<br>Цена: ' + game.full_coast : "")
            + (game.ea_play_coast ? '<br>Скидка с EA play: ' + game.ea_play_coast : "")
            + (game.game_pass_coast ? '<br>Скидка с Game Pass: ' + game.game_pass_coast : "")
            + '</div><br><br><pre>' + game.description + '</pre>'
        ).modal();
    })
}

function search_request_into_db() {
    $('.search_field').on('input', function (e) {
        if ($(this).val() === '') {
            $('.search_result').html('');
            $('.search_result').css('display', 'none');
        } else {
            $('.search_result').css('display', 'inline-block');
            $.ajax({
                type: 'POST',
                url: '/search',
                data: {'request': $(this).val()},
                success: function (data) {
                    let games = jQuery.parseJSON(data);
                    let price = ''
                    $('.search_result').html('');
                    $.each(games, function () {
                        if (this.full_coast && this.ea_play_coast){
                            price = '<span class="price_into_search">₽ ' + this.ea_play_coast + '</span> <span class="discount_color price_into_search"> -' + Math.round((((this.full_coast - this.ea_play_coast) / this.full_coast) * 100)) + '%</span> ';
                        } else if (this.full_coast && this.game_pass_coast) {
                            price = '<span class="price_into_search">₽ ' + this.game_pass_coast + '</span> <span class="discount_color price_into_search"> -' + Math.round((((this.full_coast - this.game_pass_coast) / this.full_coast) * 100)) + '%</span> ';
                        } else if (!this.game_pass_coast && !this.ea_play_coast && this.full_coast) {
                            price = '<span class="price_into_search">₽ ' + this.full_coast + '</span>'
                        }

                        $('.search_result').append(
                            '<div class="sr_box"><p class="resp_search_text"><div class="search_img"><img class="resp_search_img" src="'
                            + this.img + '" alt="' + this.title + '"></div><span class="title_into_search">'
                            + this.title + '</span><br>' + this.description.slice(0, 100) + '...' + '</p>' +
                            price +'</div>'
                        )
                    });
                }
            });
        }
    })
}

