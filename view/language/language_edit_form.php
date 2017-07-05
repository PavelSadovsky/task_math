<div class="panel panel-success col-md-offset-1 col-md-4">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Language</h3>
    </div>

    <form method="post" action="/?page=language&action=edit_save">

        <input type="hidden" name="id_language" value="<?= $data['id_language']?>">

        <div class="form-group">
            <label>Language</label>
            <input type="text" class="form-control" name="language" maxlength="32" value="<?= $data['language']?>">
        </div>
        <button type="submit" name="submit" value="submit" class="btn btn-default">Save</button>
        <a class="btn btn-primary"  href='/?page=language'>Back</a>
    </form>

</div>