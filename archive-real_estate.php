<?php
get_header();

$args = ['post_type' => 'real_estate'];
$query = new WP_Query($args);
?>
    <table>
        <thead>
            <tr>
                <th>Build name</th>
                <th>Сoordinates</th>
                <th>Floors</th>
                <th>Еype of building</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody id="insert-data">
                <?= get_estate($query) ?>
        </tbody>
    </table>
<?php
get_footer();