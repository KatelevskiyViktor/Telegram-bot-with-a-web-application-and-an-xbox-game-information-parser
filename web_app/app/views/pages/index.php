<?php
/**
 * This var from controllers
 * @var $data
 */
?>
<div class="last_release div_with_bg">
    <div class="bg_cards under"></div>
    <div class="block_content under">
        <div class="search">
                <div class="search_input">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input class="search_field" type="search" placeholder="Введите название игры...">
                </div>
                <div class="search_result">


                </div>
        </div>
        <div class="header">
            <span><i class="fa-solid fa-fire"></i> Новинки</span>
        </div>
        <div class="cards">
                <?php foreach($data['games_by_date_relise'] as $game):
                    $game->ea_play_coast *= $data['course'];
                    $game->game_pass_coast *= $data['course'];
                    $game->full_coast *= $data['course'];
                    ?>
                    <div class="body_card" data-game='<?= json_encode((array)$game, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)?>'>
                        <img src="<?= $game->img ?>" alt="<?= $game->title ?>">
                        <div class="price">
                            <?php if ($game->full_coast && $game->ea_play_coast):?>
                                <span><i class="fa-solid fa-ruble-sign"></i><?= $game->ea_play_coast ?></span>
                                <span class="discount_color">-<?= (($game->full_coast - $game->ea_play_coast)/$game->full_coast) * 100 ?>%</span>
                            <?php elseif ($game->full_coast && $game->game_pass_coast): ?>
                                <span><i class="fa-solid fa-ruble-sign"></i><?= $game->game_pass_coast ?></span>
                                <span class="discount_color">-<?= (($game->full_coast - $game->game_pass_coast)/$game->full_coast) * 100 ?>%</span>
                            <?php elseif (!$game->game_pass_coast && !$game->ea_play_coast && $game->full_coast): ?>
                                <span><i class="fa-solid fa-ruble-sign"></i><?= $game->full_coast ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>
    </div>


</div>

<div class="div_without_bg">
    <div class="under">
        <div class="header">
            <span><i class="fa-solid fa-gamepad"></i> Игры</span>
        </div>
        <div class="cards">
            <?php foreach($data['games_by_date_relise'] as $game): ?>
                <div class="body_card" data-game='<?= json_encode((array)$game, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)?>'>
                    <img src="<?= $game->img ?>" alt="<?= $game->title ?>">
                    <div class="price">
                        <?php if ($game->full_coast && $game->ea_play_coast):?>
                            <span><i class="fa-solid fa-ruble-sign"></i><?= $game->ea_play_coast ?></span>
                            <span class="discount_color">-<?= (($game->full_coast - $game->ea_play_coast)/$game->full_coast) * 100 ?>%</span>
                        <?php elseif ($game->full_coast && $game->game_pass_coast): ?>
                            <span><i class="fa-solid fa-ruble-sign"></i><?= $game->game_pass_coast ?></span>
                            <span class="discount_color">-<?= (($game->full_coast - $game->game_pass_coast)/$game->full_coast) * 100 ?>%</span>
                        <?php elseif (!$game->game_pass_coast && !$game->ea_play_coast && $game->full_coast): ?>
                            <span><i class="fa-solid fa-ruble-sign"></i><?= $game->full_coast ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="ea_play div_with_bg">
    <div class="bg_cards under"></div>
    <div class="block_content under">
        <div class="header">
            <span><i class="fa-solid fa-tag"></i> Скидка с EA play</span>
        </div>
        <div class="cards">
            <?php foreach($data['games_by_date_relise'] as $game): ?>
                <div class="body_card" data-game='<?= json_encode((array)$game, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)?>'>
                    <img src="<?= $game->img ?>" alt="<?= $game->title ?>">
                    <div class="price">
                        <?php if ($game->full_coast && $game->ea_play_coast):?>
                            <span><i class="fa-solid fa-ruble-sign"></i><?= $game->ea_play_coast ?></span>
                            <span class="discount_color">-<?= (($game->full_coast - $game->ea_play_coast)/$game->full_coast) * 100 ?>%</span>
                        <?php elseif ($game->full_coast && $game->game_pass_coast): ?>
                            <span><i class="fa-solid fa-ruble-sign"></i><?= $game->game_pass_coast ?></span>
                            <span class="discount_color">-<?= (($game->full_coast - $game->game_pass_coast)/$game->full_coast) * 100 ?>%</span>
                        <?php elseif (!$game->game_pass_coast && !$game->ea_play_coast && $game->full_coast): ?>
                            <span><i class="fa-solid fa-ruble-sign"></i><?= $game->full_coast ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<div class="div_without_bg">
    <div class="under">
        <div class="header">
            <span><i class="fa-solid fa-tags"></i> Скидки с Game Pass</span>
        </div>
        <div class="cards">
            <?php foreach($data['games_by_date_relise'] as $game): ?>
                <div class="body_card" data-game='<?= json_encode((array)$game, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)?>'>
                    <img src="<?= $game->img ?>" alt="<?= $game->title ?>">
                    <div class="price">
                        <?php if ($game->full_coast && $game->ea_play_coast):?>
                            <span><i class="fa-solid fa-ruble-sign"></i><?= $game->ea_play_coast ?></span>
                            <span class="discount_color">-<?= (($game->full_coast - $game->ea_play_coast)/$game->full_coast) * 100 ?>%</span>
                        <?php elseif ($game->full_coast && $game->game_pass_coast): ?>
                            <span><i class="fa-solid fa-ruble-sign"></i><?= $game->game_pass_coast ?></span>
                            <span class="discount_color">-<?= (($game->full_coast - $game->game_pass_coast)/$game->full_coast) * 100 ?>%</span>
                        <?php elseif (!$game->game_pass_coast && !$game->ea_play_coast && $game->full_coast): ?>
                            <span><i class="fa-solid fa-ruble-sign"></i><?= $game->full_coast ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="rating div_with_bg">
    <div class="bg_cards under"></div>
    <div class="block_content under">
        <div class="header">
            <span><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i> Лучшее по рейтингу</span>
        </div>
        <div class="cards">
            <?php foreach($data['games_by_date_relise'] as $game): ?>
                <div class="body_card" data-game='<?= json_encode((array)$game, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?>'>
                    <img src="<?= $game->img ?>" alt="<?= $game->title ?>">
                    <div class="price">
                        <?php if ($game->full_coast && $game->ea_play_coast):?>
                            <span><i class="fa-solid fa-ruble-sign"></i><?= $game->ea_play_coast ?></span>
                            <span class="discount_color">-<?= (($game->full_coast - $game->ea_play_coast)/$game->full_coast) * 100 ?>%</span>
                        <?php elseif ($game->full_coast && $game->game_pass_coast): ?>
                            <span><i class="fa-solid fa-ruble-sign"></i><?= $game->game_pass_coast ?></span>
                            <span class="discount_color">-<?= (($game->full_coast - $game->game_pass_coast)/$game->full_coast) * 100 ?>%</span>
                        <?php elseif (!$game->game_pass_coast && !$game->ea_play_coast && $game->full_coast): ?>
                            <span><i class="fa-solid fa-ruble-sign"></i><?= $game->full_coast ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
<div class="modal">


</div>


<div class="menu">

</div>
