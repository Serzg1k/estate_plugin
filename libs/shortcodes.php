<?php

add_shortcode('real_estate', 'real_estate_func');

function real_estate_func($attr){
    $floors = range(1, 20);
    $rooms = range(1, 10);
    ?>
    <form id="filter_form">
        <div class="form-row">
            <div class="col">
                <input type="text" class="form-control" id="build_name" placeholder="Build name">
            </div>
            <div class="col">
                <input type="text" class="form-control" id="coordinates" placeholder="Coordinates">
            </div>
            <div class="col">
                <label for="floors">Floors</label>
                <select id="floors" class="form-control">
                    <option value="" selected>Choose...</option>
                    <?php foreach ($floors as $floor) { ?>
                        <option value="<?= $floor; ?>"><?= $floor; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label for="type">Type</label>
                <select id="type" class="form-control">
                    <option value="" selected>Choose...</option>
                    <option value="panel">panel</option>
                    <option value="brick">brick</option>
                    <option value="foam_block">foam block</option>
                </select>
            </div>
            <div class="col">
                <label for="rooms">Room</label>
                <select id="rooms" class="form-control">
                    <option value="" selected>Choose...</option>
                    <?php foreach ($rooms as $room) { ?>
                        <option value="<?= $room; ?>"><?= $room; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col">
                <label for="balcony">Balcony</label>
                <select id="balcony" class="form-control">
                    <option value="" selected>Choose...</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div class="col">
                <label for="wc">WC</label>
                <select id="wc" class="form-control">
                    <option value="" selected>Choose...</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <div id="insert_result"></div>
<?php } ?>