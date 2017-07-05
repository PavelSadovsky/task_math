<?php if ( !empty($_SESSION['id_user']) ):?>

    <div class="panel-heading">
        <a class="btn btn-danger col-md-offset-10"  href='/?logout=1'>Logout</a>
        <br>
        <a class="btn btn-success col-md-offset-1"  href='/?page=country'>Go to countries</a>
        <a class="btn btn-primary"                  href='/?page=city'>Go to cities</a>
        <a class="btn btn-warning"                  href='/?page=language'>Go to languages</a>
    </div>
<br>
    <a class="btn btn-warning col-md-offset-1"  href='/?page=talk&action=add'>ADD NEW COMMUNICATION</a>

    <table class="table table-bordered table-striped table-hover" style="width: 500px; height: 25px; margin-left: 50px;">
        <thead>
        <tr>
            <th style="width: 20px;">#</th>
            <th>Country</th>
            <th>City</th>
            <th>Languages to talk</th>
            <th style="width: 20px;">Edit</th>
            <th style="width: 20px;">Delete</th>
        </tr>
        </thead>
        <tbody>
        <br>
        <br>

        <?php if ($data['talk']):?>
            <?php $i = 1; foreach ($data['talk'] as $key => $value): ?>

                <tr class="active">
                    <td><b><?=$value['id']?></b></td>
                    <td><?= $value['country']?></td>
                    <td><?= $value['city']?></td>
                    <td><?= $value['language']?></td>
                    <td>
                        <a href="/?page=talk&action=edit&id_talk=<?=$value['id']?>">
                        <span class="nowrap">
                            <img src="/static/img/dot.gif" title="Edit" alt="Edit" class="icon ic_b_edit">Edit
                        </span>
                        </a>
                    </td>
                    <td>
                        <a onclick="return query_del('<?=$value['id']?>');" href="/?page=talk&action=delete&id=<?=$value['id']?>">
                        <span class="nowrap">
                            <img src="/static/img/dot.gif" title="Delete" alt="Delete" class="icon ic_b_drop">Delete
                        </span>
                        </a>
                    </td>
                </tr>

            <? endforeach ?>
        <?php endif ?>



        </tbody>
    </table>


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
