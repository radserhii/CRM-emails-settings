<template>
    <table class="table table-striped table-md" :id="name + 'Table'" style="width: 100%;"></table>
</template>

<script>
    export default {
        name: "data-table",
        props: {
            name: {
                required: true
            },
            columns: {
                required: true,
                type: Array
            },
            url: {
                required: true
            }
        },
        data: () => ({
            table: null
        }),
        computed: {
            page() {

            }
        },
        methods: {
            colVisibilityInit(cols, table) {
                let loadedCols = JSON.parse(localStorage.getItem(this.name + '_cols'));
                if (!loadedCols) {
                    localStorage.setItem(this.name + '_cols', JSON.stringify(cols));
                    loadedCols = cols;
                }
                $('[data-column]').each((i, v) => {
                    let column = $(v);
                    column.prop('checked', _.find(loadedCols, ['name', column.data('columnName')]).visible);
                    column.on('change', () => {
                        let loadedCols = JSON.parse(localStorage.getItem(this.name + '_cols'));
                        let newValue = !!column.prop('checked');
                        if (!loadedCols) {
                            localStorage.setItem(this.name + '_cols', JSON.stringify(cols));
                        } else {
                            let colIndex = _.findIndex(loadedCols, ['name', column.data('columnName')]);
                            loadedCols[colIndex].visible = newValue;
                            localStorage.setItem(this.name + '_cols', JSON.stringify(loadedCols));
                        }
                        table.api().columns(column.data('columnName') + ':name').visible(newValue);
                    });
                });
                _.each(loadedCols, (col) => {
                    table.api().columns(col.name + ':name').visible(col.visible);
                });
                setTimeout(() => {
                    table.api().columns.adjust().draw();
                }, 100);
            }
        },
        mounted() {
            let vm = this;
            this.table = $('#' + this.name + 'Table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: this.url,
                    method: 'post',
                },
                initComplete: function () {
                    let tbl = this;
                    $('.dropdown-menu').click(function (e) {
                        e.stopPropagation();
                    });
                    $('[data-filter][type="text"]').each((i, v) => {
                        $(v).on('keyup', function () {
                            let filter = $(this);
                            let operator = filter.data('filterOperator');
                            tbl.api().columns(filter.data('filterColumn') + ':name').search(operator ? operator + filter.val() : filter.val(), false, true).draw();
                        });
                    });
                    $('[data-filter][type="checkbox"]').each((i, v) => {
                        $(v).on('click', function () {
                            let filter = $(this);
                            tbl.api().columns(filter.data('filterColumn') + ':name').search(+filter.prop('checked'), false, true).draw();
                        });
                    });
                    $('select[data-filter]').select2({
                        theme: 'bootstrap4',
                        width: '100%',
                        allowClear: true
                    }).each((i, v) => {
                        $(v).on('select2:select change', function () {
                            let filter = $(this);
                            let operator = filter.data('filterOperator');
                            tbl.api().columns(filter.data('filterColumn') + ':name').search(operator ? operator + filter.val() : filter.val(), false, true).draw();
                        });
                    });
                    $('[data-filter-type="dateRange"]').daterangepicker({
                        showDropdowns: true
                    }).each((i, v) => {
                        $(v).on('apply.daterangepicker', function () {
                            let filter = $(this);
                            tbl.api().columns(filter.data('filterColumn') + ':name').search('[><]' + filter.val(), false, true).draw();
                        });
                    });
                    vm.colVisibilityInit(vm.columns, tbl);
                },
                drawCallback: function () {
                    $('[data-toggle="tooltip"]').tooltip();
                },
                language: {
                    lengthMenu: "Per page _MENU_",
                    paginate: {
                        first: '<span class="fa fa-angle-double-left"></span>',
                        last: '<span class="fa fa-angle-double-right"></span>',
                        next: '<span class="fa fa-angle-right"></span>',
                        previous: '<span class="fa fa-angle-left"></span>'
                    }
                },
                pagingType: "full_numbers",
                scrollX: '100%',
                dom: "<'row'<'col-sm-12 col-md-6'l>><'row'<'col-sm-12'tr>><'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                columns: this.columns,
            });
        }
    }
</script>

<style scoped>

</style>