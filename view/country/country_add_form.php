<br>
<br>
<div class="panel panel-success col-md-offset-1 col-md-4">
    <div class="panel-heading">
        <h3 class="panel-title">Add new Country</h3>
    </div>

    <form method="post" action="/?page=country&action=add_country">

        <div class="form-group">
            <label>Enter country name</label>
            <input type="text" class="form-control" name="name_country" maxlength="32" value="">
        </div>

        <button type="submit" name="submit" value="submit" class="btn btn-success">Save</button>
        <a class="btn btn-primary"  href='/?page=country'>Back</a>
    </form>

</div>