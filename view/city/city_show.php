<table class="table table-bordered table-striped table-hover" style="width: 500px; height: 25px; margin-left: 50px;">
    <thead>
    <tr>
        <th style="width: 20px;">#</th>
        <th>Country</th>
        <th>City</th>
        <th style="width: 20px;">Edit</th>
        <th style="width: 20px;">Delete</th>
    </tr>
    </thead>
    <tbody>
    <a class="btn btn-success "  style="margin-left: 50px" href='/?page=city&action=add'>Add new City</a>
    <a class="btn btn-primary "  style="margin-left: 5px;" href='/?page=talk'>Back</a>
    <br>
    <br>
    <?php //pr($data);?>
<?php if ($data['city']):?>
        <?php $i = 1; foreach ($data['city'] as $key => $value): ?>

            <tr class="active">
                <td><b><?=$i++?></b></td>
                <td><?= $value['country']?></td>
                <td><?= $value['city']?></td>
                <td>
                    <a href="/?page=city&action=edit&id_city=<?=$value['id_city']?>">
                        <span class="nowrap">
                            <img src="/static/img/dot.gif" title="Edit" alt="Edit" class="icon ic_b_edit">Edit
                        </span>
                    </a>
                </td>
                <td>
                    <a onclick="return query_del('<?=$value['city']?>');" href="/?page=city&action=delete&id_city=<?=$value['id_city']?>">
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
