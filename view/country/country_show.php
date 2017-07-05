<table class="table table-bordered table-striped table-hover" style="width: 500px; height: 25px; margin-left: 50px;">
    <thead>
    <tr>
        <th style="width: 20px;">#</th>
        <th>Country</th>
        <th style="width: 20px;">Edit</th>
        <th style="width: 20px;">Delete</th>
    </tr>
    </thead>
    <tbody>
    <a class="btn btn-success "  style="margin-left: 50px" href='/?page=country&action=add'>Add new Country</a>
    <a class="btn btn-primary "  style="margin-left: 5px;" href='/?page=talk'>Back</a>
    <br>
    <br>
<?php if ($data['country']):?>
        <?php $i = 1; foreach ($data['country'] as $key => $value): ?>

            <tr class="active">
                <td><b><?=$i++?></b></td>
                <td><?= $value['country']?></td>
                <td>
                    <a href="/?page=country&action=edit&id_country=<?=$value['id_country']?>">
                        <span class="nowrap">
                            <img src="/static/img/dot.gif" title="Edit" alt="Edit" class="icon ic_b_edit">Edit
                        </span>
                    </a>
                </td>
                <td>
                    <a onclick="return query_del('<?=$value['country']?>');" href="/?page=country&action=delete&id_country=<?=$value['id_country']?>">
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
