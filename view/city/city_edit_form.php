<div class="panel panel-success col-md-offset-1 col-md-4">
    <div class="panel-heading">
        <h3 class="panel-title">Edit City</h3>
    </div>

    <form method="post" action="/?page=city&action=edit_save">

        <input type="hidden" name="id_city" value="<?= $data['id_city']?>">

        <div class="form-group">
            <label>City</label>
            <input type="text" class="form-control" name="city" maxlength="32" value="<?= $data['city']?>">
        </div>

        <select class="form-control" name="id_country">
            <?php
                foreach ($data['all_country'] as $key => $value): ?>
                <option value ="<?= $value['id_country']?>"<?php if ( $value['selected'] == "selected"):?> selected <?php endif ?>>
                    <?=$value['country']?>
                </option>
            <?php endforeach ?>
        </select>
<br>

        <button type="submit" name="submit" value="submit" class="btn btn-default">Save</button>
        <a class="btn btn-primary"  href='/?page=city'>Back</a>
    </form>

</div>