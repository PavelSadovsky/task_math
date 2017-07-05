<table class="table table-bordered table-striped table-hover" style="width: 500px; height: 25px; margin-left: 50px;">
    <thead>
    <tr>
        <th style="width: 20px;">#</th>
        <th>Language</th>
        <th style="width: 20px;">Edit</th>
        <th style="width: 20px;">Delete</th>
    </tr>
    </thead>
    <tbody>
    <a class="btn btn-success "  style="margin-left: 50px" href='/?page=language&action=add'>Add new Language</a>
    <a class="btn btn-primary "  style="margin-left: 5px;" href='/?page=talk'>Back</a>
    <br>
    <br>
<?php if ($data['language']):?>
        <?php $i = 1; foreach ($data['language'] as $key => $value): ?>

            <tr class="active">
                <td><b><?=$i++?></b></td>
                <td><?= $value['language']?></td>
                <td>
                    <a href="/?page=language&action=edit&id_language=<?=$value['id_language']?>">
                        <span class="nowrap">
                            <img src="/static/img/dot.gif" title="Edit" alt="Edit" class="icon ic_b_edit">Edit
                        </span>
                    </a>
                </td>
                <td>
                    <a onclick="return query_del('<?=$value['language']?>');" href="/?page=language&action=delete&id_language=<?=$value['id_language']?>">
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
