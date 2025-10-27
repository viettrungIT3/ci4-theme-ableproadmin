<?php
/**
 * Data Table Widget Component.
 *
 * Displays data in a responsive table with sorting, filtering, and pagination
 *
 * @param string $title Table title
 * @param array $headers Table headers
 * @param array $data Table data
 * @param array $options Table options
 * @param string $class Additional CSS classes
 * @param string $tableId Unique table ID
 */

// Default values
$title = $title ?? 'Data Table';
$headers = $headers ?? [];
$data = $data ?? [];
$options = $options ?? [];
$class = $class ?? '';
$tableId = $tableId ?? 'table_' . uniqid();

// Default headers
if (empty($headers)) {
    $headers = [
        ['key' => 'id', 'label' => 'ID', 'sortable' => true],
        ['key' => 'name', 'label' => 'Name', 'sortable' => true],
        ['key' => 'email', 'label' => 'Email', 'sortable' => true],
        ['key' => 'status', 'label' => 'Status', 'sortable' => false],
        ['key' => 'actions', 'label' => 'Actions', 'sortable' => false],
    ];
}

// Default data
if (empty($data)) {
    $data = [
        ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'status' => 'Active'],
        ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'status' => 'Inactive'],
        ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com', 'status' => 'Active'],
        ['id' => 4, 'name' => 'Alice Brown', 'email' => 'alice@example.com', 'status' => 'Pending'],
        ['id' => 5, 'name' => 'Charlie Wilson', 'email' => 'charlie@example.com', 'status' => 'Active'],
    ];
}

// Default options
$defaultOptions = [
    'searchable' => true,
    'sortable' => true,
    'pagination' => true,
    'pageSize' => 10,
    'exportable' => true,
    'responsive' => true,
];

$tableOptions = array_merge($defaultOptions, $options);
?>

<div class="data-table-widget <?= esc($class) ?>">
    <div class="card h-100">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0"><?= esc($title) ?></h5>
                <div class="table-actions">
                    <?php if ($tableOptions['exportable']): ?>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-download"></i> Export
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#" onclick="exportTable('<?= esc($tableId) ?>', 'csv')">
                                        <i class="ti ti-file-csv me-2"></i>CSV
                                    </a></li>
                                <li><a class="dropdown-item" href="#"
                                        onclick="exportTable('<?= esc($tableId) ?>', 'excel')">
                                        <i class="ti ti-file-excel me-2"></i>Excel
                                    </a></li>
                                <li><a class="dropdown-item" href="#" onclick="exportTable('<?= esc($tableId) ?>', 'pdf')">
                                        <i class="ti ti-file-pdf me-2"></i>PDF
                                    </a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if ($tableOptions['searchable']): ?>
            <div class="card-body border-bottom">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="ti ti-search"></i>
                            </span>
                            <input type="text" class="form-control" id="<?= esc($tableId) ?>_search"
                                placeholder="Search...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            <select class="form-select" id="<?= esc($tableId) ?>_pageSize" style="width: auto;">
                                <option value="5">5 per page</option>
                                <option value="10" selected>10 per page</option>
                                <option value="25">25 per page</option>
                                <option value="50">50 per page</option>
                                <option value="100">100 per page</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="<?= esc($tableId) ?>">
                    <thead class="table-light">
                        <tr>
                            <?php foreach ($headers as $header): ?>
                                <th class="<?= $header['sortable'] ? 'sortable' : '' ?>"
                                    data-key="<?= esc($header['key']) ?>">
                                    <?= esc($header['label']) ?>
                                    <?php if ($header['sortable']): ?>
                                        <i class="ti ti-arrows-sort ms-1"></i>
                                    <?php endif; ?>
                                </th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <?php foreach ($headers as $header): ?>
                                    <td>
                                        <?php if ($header['key'] === 'actions'): ?>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary" onclick="editRow(<?= esc($row['id']) ?>)">
                                                    <i class="ti ti-edit"></i>
                                                </button>
                                                <button class="btn btn-outline-danger" onclick="deleteRow(<?= esc($row['id']) ?>)">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </div>
                                        <?php elseif ($header['key'] === 'status'): ?>
                                            <?php
                                            $statusClass = match ($row[$header['key']]) {
                                                'Active' => 'badge bg-success',
                                                'Inactive' => 'badge bg-danger',
                                                'Pending' => 'badge bg-warning',
                                                default => 'badge bg-secondary'
                                            };
                                            ?>
                                            <span class="<?= esc($statusClass) ?>">
                                                <?= esc($row[$header['key']]) ?>
                                            </span>
                                        <?php else: ?>
                                            <?= esc($row[$header['key']] ?? '') ?>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if ($tableOptions['pagination']): ?>
            <div class="card-footer">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="table-info">
                        <span id="<?= esc($tableId) ?>_info">Showing 1 to 10 of 50 entries</span>
                    </div>
                    <nav>
                        <ul class="pagination pagination-sm mb-0" id="<?= esc($tableId) ?>_pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .data-table-widget .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: all 0.3s ease;
    }

    .data-table-widget .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .data-table-widget .table th.sortable {
        cursor: pointer;
        user-select: none;
        position: relative;
    }

    .data-table-widget .table th.sortable:hover {
        background-color: #e9ecef;
    }

    .data-table-widget .table th.sortable i {
        opacity: 0.5;
        transition: opacity 0.2s ease;
    }

    .data-table-widget .table th.sortable:hover i {
        opacity: 1;
    }

    .data-table-widget .table th.sortable.sorted i {
        opacity: 1;
        color: #0d6efd;
    }

    .data-table-widget .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .data-table-widget .btn-group-sm .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }

    /* Dark theme support */
    [data-pc-theme="dark"] .data-table-widget .card {
        background-color: #1a1a1a;
        border: 1px solid #404040;
    }

    [data-pc-theme="dark"] .data-table-widget .card-header {
        background-color: #2d2d2d;
        border-bottom-color: #404040;
    }

    [data-pc-theme="dark"] .data-table-widget .card-title {
        color: #e9ecef;
    }

    [data-pc-theme="dark"] .data-table-widget .table-light {
        background-color: #2d2d2d;
    }

    [data-pc-theme="dark"] .data-table-widget .table-light th {
        color: #e9ecef;
        border-color: #404040;
    }

    [data-pc-theme="dark"] .data-table-widget .table td {
        color: #e9ecef;
        border-color: #404040;
    }

    [data-pc-theme="dark"] .data-table-widget .table tbody tr:hover {
        background-color: #2d2d2d;
    }

    [data-pc-theme="dark"] .data-table-widget .card-footer {
        background-color: #2d2d2d;
        border-top-color: #404040;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .data-table-widget .card-header {
            padding: 0.75rem 1rem;
        }

        .data-table-widget .card-body {
            padding: 0.75rem 1rem;
        }

        .data-table-widget .table-responsive {
            font-size: 0.875rem;
        }

        .data-table-widget .btn-group-sm .btn {
            padding: 0.125rem 0.25rem;
            font-size: 0.7rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const table = document.getElementById('<?= esc($tableId) ?>');
        if (!table) return;

        let currentPage = 1;
        let pageSize = <?= $tableOptions['pageSize'] ?>;
        let currentData = <?= json_encode($data) ?>;
        let filteredData = [...currentData];
        let sortColumn = null;
        let sortDirection = 'asc';

        // Initialize table
        initializeTable();

        function initializeTable() {
            // Search functionality
            const searchInput = document.getElementById('<?= esc($tableId) ?>_search');
            if (searchInput) {
                searchInput.addEventListener('input', handleSearch);
            }

            // Page size change
            const pageSizeSelect = document.getElementById('<?= esc($tableId) ?>_pageSize');
            if (pageSizeSelect) {
                pageSizeSelect.addEventListener('change', handlePageSizeChange);
            }

            // Sort functionality
            const sortableHeaders = table.querySelectorAll('th.sortable');
            sortableHeaders.forEach(header => {
                header.addEventListener('click', () => handleSort(header));
            });

            // Render table
            renderTable();
        }

        function handleSearch(e) {
            const searchTerm = e.target.value.toLowerCase();
            filteredData = currentData.filter(row => {
                return Object.values(row).some(value =>
                    String(value).toLowerCase().includes(searchTerm)
                );
            });
            currentPage = 1;
            renderTable();
        }

        function handlePageSizeChange(e) {
            pageSize = parseInt(e.target.value);
            currentPage = 1;
            renderTable();
        }

        function handleSort(header) {
            const key = header.getAttribute('data-key');

            if (sortColumn === key) {
                sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                sortColumn = key;
                sortDirection = 'asc';
            }

            // Update sort indicators
            table.querySelectorAll('th.sortable').forEach(th => {
                th.classList.remove('sorted');
                th.querySelector('i').className = 'ti ti-arrows-sort ms-1';
            });

            header.classList.add('sorted');
            const icon = header.querySelector('i');
            icon.className = sortDirection === 'asc' ? 'ti ti-arrow-up ms-1' : 'ti ti-arrow-down ms-1';

            // Sort data
            filteredData.sort((a, b) => {
                const aVal = a[key];
                const bVal = b[key];

                if (typeof aVal === 'number' && typeof bVal === 'number') {
                    return sortDirection === 'asc' ? aVal - bVal : bVal - aVal;
                }

                const aStr = String(aVal).toLowerCase();
                const bStr = String(bVal).toLowerCase();

                if (sortDirection === 'asc') {
                    return aStr.localeCompare(bStr);
                } else {
                    return bStr.localeCompare(aStr);
                }
            });

            currentPage = 1;
            renderTable();
        }

        function renderTable() {
            const startIndex = (currentPage - 1) * pageSize;
            const endIndex = startIndex + pageSize;
            const pageData = filteredData.slice(startIndex, endIndex);

            // Update table body
            const tbody = table.querySelector('tbody');
            tbody.innerHTML = '';

            pageData.forEach(row => {
                const tr = document.createElement('tr');
                <?php foreach ($headers as $header): ?>
                    const td<?= $header['key'] ?> = document.createElement('td');
                    <?php if ($header['key'] === 'actions'): ?>
                        td<?= $header['key'] ?>.innerHTML = `
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-primary" onclick="editRow(${row.id})">
                                <i class="ti ti-edit"></i>
                            </button>
                            <button class="btn btn-outline-danger" onclick="deleteRow(${row.id})">
                                <i class="ti ti-trash"></i>
                            </button>
                        </div>
                    `;
                    <?php elseif ($header['key'] === 'status'): ?>
                        const statusClass = row.<?= $header['key'] ?> === 'Active' ? 'badge bg-success' :
                            row.<?= $header['key'] ?> === 'Inactive' ? 'badge bg-danger' :
                                row.<?= $header['key'] ?> === 'Pending' ? 'badge bg-warning' : 'badge bg-secondary';
                        td<?= $header['key'] ?>.innerHTML = `<span class="${statusClass}">${row.<?= $header['key'] ?>}</span>`;
                    <?php else: ?>
                        td<?= $header['key'] ?>.textContent = row.<?= $header['key'] ?> || '';
                    <?php endif; ?>
                    tr.appendChild(td<?= $header['key'] ?>);
                <?php endforeach; ?>
                tbody.appendChild(tr);
            });

            // Update pagination
            updatePagination();

            // Update info
            updateInfo();
        }

        function updatePagination() {
            const totalPages = Math.ceil(filteredData.length / pageSize);
            const pagination = document.getElementById('<?= esc($tableId) ?>_pagination');
            if (!pagination) return;

            pagination.innerHTML = '';

            // Previous button
            const prevLi = document.createElement('li');
            prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
            prevLi.innerHTML = `<a class="page-link" href="#" tabindex="-1">Previous</a>`;
            prevLi.addEventListener('click', (e) => {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    renderTable();
                }
            });
            pagination.appendChild(prevLi);

            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                li.addEventListener('click', (e) => {
                    e.preventDefault();
                    currentPage = i;
                    renderTable();
                });
                pagination.appendChild(li);
            }

            // Next button
            const nextLi = document.createElement('li');
            nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
            nextLi.innerHTML = `<a class="page-link" href="#">Next</a>`;
            nextLi.addEventListener('click', (e) => {
                e.preventDefault();
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTable();
                }
            });
            pagination.appendChild(nextLi);
        }

        function updateInfo() {
            const info = document.getElementById('<?= esc($tableId) ?>_info');
            if (!info) return;

            const startIndex = (currentPage - 1) * pageSize + 1;
            const endIndex = Math.min(currentPage * pageSize, filteredData.length);
            const total = filteredData.length;

            info.textContent = `Showing ${startIndex} to ${endIndex} of ${total} entries`;
        }
    });

    // Export functions
    function exportTable(tableId, format) {
        const table = document.getElementById(tableId);
        if (!table) return;

        // Simple CSV export
        if (format === 'csv') {
            const rows = Array.from(table.querySelectorAll('tr'));
            const csvContent = rows.map(row =>
                Array.from(row.querySelectorAll('td, th'))
                    .map(cell => `"${cell.textContent.trim()}"`)
                    .join(',')
            ).join('\n');

            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = `table-${tableId}.csv`;
            link.click();
            URL.revokeObjectURL(url);
        }
    }

    // Action functions
    function editRow(id) {
        // Implement edit functionality
        alert('Edit functionality for row ' + id + ' - to be implemented');
    }

    function deleteRow(id) {
        if (confirm('Are you sure you want to delete this row?')) {
            // Implement delete functionality
            alert('Delete functionality for row ' + id + ' - to be implemented');
        }
    }
</script>