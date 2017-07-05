<?php if ( !empty($_SESSION['id_user']) ):?>

    <div class="panel-heading">
        <a class="btn btn-danger col-md-offset-10"  href='/?logout=1'>Logout</a>
        <br>
        <a class="btn btn-success col-md-offset-1"  href='/?page=country'>Country</a>
        <a class="btn btn-primary"                  href='/?page=city'>City</a>
        <a class="btn btn-warning"                  href='/?page=language'>Language</a>
    </div>

    <form method="post" action="/?page=talk&action=edit_save_talk">
    <table class="table table-bordered table-striped table-hover" style="width: 500px; height: 25px; margin-left: 50px;">
        <thead>
        <tr>
            <th style="width: 20px;">#</th>
            <th>Country</th>
            <th>City</th>
            <th>Languages to talk</th>

        </tr>
        </thead>
        <tbody>
        <br>
        <br>

                <?php if ($data):?>
                    <?php $i = 1;?>
                    <input type="hidden" name="id_talk" value="<?= $data['id_talk']?>">
                        <tr class="active">
                            <td>
                                <b><?=$i++?></b>
                            </td>

                            <td>
                                <select onchange="get_city(this.value);" class="form-control" name="id_country">
                                    <?php
                                    foreach ($data['all_country'] as $key => $value): ?>
                                        <option value ="<?= $value['id_country']?>"<?php if ( $value['selected'] == "selected"):?> selected <?php endif ?>>
                                            <?=$value['country']?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                             </td>

                            <td>
                                <select class="form-control" name="id_city" id="id_city">
                                    <?php
                                    foreach ($data['all_city'] as $key => $value): ?>
                                        <option value ="<?= $value['id_city']?>"<?php if ( $value['selected'] == "selected"):?> selected <?php endif ?>>
                                            <?=$value['city']?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </td>

                            <td>
                                <select class="form-control" name="id_language">
                                    <?php
                                    foreach ($data['all_language'] as $key => $value): ?>
                                        <option value ="<?= $value['id_language']?>"<?php if ( $value['selected'] == "selected"):?> selected <?php endif ?>>
                                            <?=$value['language']?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </td>


                        </tr>
                <?php endif ?>

        </tbody>
    </table>
        <button type="submit" name="submit" value="submit" class="btn btn-success col-md-offset-3">Save</button>
        <a class="btn btn-primary"  href='/?page=talk'>Back</a>

    </form>



<?php else :?>
    <div class="panel-heading">
        <a class="btn btn-success col-md-offset-1"  href='/?page=reg'>Registration</a>
    </div>

    <div class="panel-heading">
        <a class="btn btn-primary col-md-offset-1"  href='/?page=login'>Login in</a>
    </div>

    <div class="panel-heading">
        <a class="btn btn-warning col-md-offset-1"  href='/'>Back</a>
    </div>
<?php endif ?>

<script>
    function get_city(id_country)
    {
        $.getJSON( "index.php",{page:'talk',  action : 'ajax_return_city', id_country : id_country},
            function( data )
            {
                var s = "";
                $.each( data, function( key, val )
                {
                    s +='<option value="' + val.id_city + '">' + val.city + '</option>';
                });
                $("#id_city").html(s);
            }
        );

    }
</script>