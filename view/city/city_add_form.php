<br>
<br>
<div class="panel panel-success col-md-offset-1 col-md-4">
    <div class="panel-heading">
        <h3 class="panel-title">Add new City</h3>
    </div>

    <form method="post" action="/?page=city&action=add_city">

        <div class="form-group">
            <label>Enter City</label>
            <input type="text" class="form-control" name="city" maxlength="32" value="">
        </div>

        <select class="form-control" name="id_country">
            <?php
            foreach ($data['all_country'] as $key => $value): ?>
                <option value ="<?= $value['id_country']?>">
                    <?=$value['country']?>
                </option>
            <?php endforeach ?>
        </select>

        <br>

        <button type="submit" name="submit" value="submit" class="btn btn-success">Save</button>
        <a class="btn btn-primary"  href='/?page=city'>Back</a>
    </form>

</div>