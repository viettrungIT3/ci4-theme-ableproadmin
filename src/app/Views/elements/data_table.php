<?php
/**
 * Data Table Element
 * 
 * Usage:
 * echo view('elements/data_table', [
 *     'id' => 'usersTable',
 *     'columns' => [
 *         ['title' => 'ID', 'data' => 'id', 'sortable' => true],
 *         ['title' => 'Name', 'data' => 'name', 'sortable' => true],
 *         ['title' => 'Email', 'data' => 'email', 'sortable' => true],
 *         ['title' => 'Actions', 'data' => 'actions', 'sortable' => false, 'searchable' => false]
 *     ],
 *     'data' => $users, // array of data
 *     'searchable' => true,
 *     'sortable' => true,
 *     'pagination' => true,
 *     'class' => 'table-striped',
 *     'responsive' => true
 * ]);
 */

$id = $id ?? 'dataTable';
$searchable = $searchable ?? true;
$sortable = $sortable ?? true;
$pagination = $pagination ?? true;
$class = $class ?? '';
$responsive = $responsive ?? true;
$columns = $columns ?? [];
$data = $data ?? [];

$tableClass = 'table';
$tableClass .= $class ? " {$class}" : '';
?>

<?php if ($searchable): ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" id="<?= esc($id) ?>Search" placeholder="Search...">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="ti ti-search"></i>
                </button>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($responsive): ?>
    <div class="table-responsive">
    <?php endif; ?>

    <table class="<?= $tableClass ?>" id="<?= esc($id) ?>">
        <thead>
            <tr>
                <?php foreach ($columns as $column): ?>
                    <th<?= $sortable && ($column['sortable'] ?? true) ? ' class="sortable"' : '' ?>>
                        <?= esc($column['title']) ?>
                        <?php if ($sortable && ($column['sortable'] ?? true)): ?>
                            <i class="ti ti-arrow-up-down ms-1"></i>
                        <?php endif; ?>
                        </th>
                    <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <?php foreach ($columns as $column): ?>
                            <td>
                                <?php if (isset($column['render']) && is_callable($column['render'])): ?>
                                    <?= $column['render']($row) ?>
                                <?php else: ?>
                                    <?= esc($row[$column['data']] ?? '') ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="<?= count($columns) ?>" class="text-center">No data available</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($responsive): ?>
    </div>
<?php endif; ?>

<?php if ($pagination): ?>
    <nav aria-label="Table pagination">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
<?php endif; ?>