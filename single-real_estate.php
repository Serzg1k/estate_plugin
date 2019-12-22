<?php
get_header();
$fields = get_fields();
?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) {
				the_post(); ?>

            <div class="content">
                <div class="title"><?= get_the_title() ?></div>
                <table>
                    <thead>
                    <tr>
                        <th>Build name</th>
                        <th>Сoordinates</th>
                        <th>Floors</th>
                        <th>Type of building</th>
                        <th>Image</th>
                        <th>Flats</th>
                    </tr>
                    </thead>
                    <tbody>
                        <th><?= $fields['real_estate_name']?$fields['real_estate_name']:'' ?></th>
                        <th><?= $fields['real_estate_coordinates']?$fields['real_estate_coordinates']:'' ?></th>
                        <th><?= $fields['real_estate_floors']?$fields['real_estate_floors']:'' ?></th>
                        <th><?= $fields['real_type_of_building']?$fields['real_type_of_building']:'' ?></th>
                        <th><img src="<?= $fields['real_estate_img']?$fields['real_estate_img']:'' ?>" alt=""></th>
                        <th colspan="5">
                            <?php
                            if(is_array($fields['real_estate_roms'])){
                                foreach ($fields['real_estate_roms'] as $val){ ?>
                                        <div>name - <?= $val['name'] ?></div>
                                        <div>count rooms - <?= $val['count_rooms'] ?></div>
                                        <div>balcony - <?= $val['balcony'] ?></div>
                                        <div>wc - <?= $val['wc'] ?></div>
                                        <div><img src="<?= $val['image'] ?>" alt=""></div>
                               <?php }
                            }
                            ?>
                        </th>
                    </tbody>
                </table>
            </div>

			<?php };
			?>
		</main>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer();