<div class="panel panel-success col-md-offset-1 col-md-4">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Country</h3>
    </div>

    <form method="post" action="/?page=country&action=edit_save">

        <input type="hidden" name="id_country" value="<?= $data['id_country']?>">

        <div class="form-group">
            <label>Country</label>
            <input type="text" class="form-control" name="country" maxlength="32" value="<?= $data['country']?>">
        </div>
        <button type="submit" name="submit" value="submit" class="btn btn-default">Save</button>
        <a class="btn btn-primary"  href='/?page=country'>Back</a>
    </form>

</div>