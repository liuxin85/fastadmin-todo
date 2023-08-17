define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'ceshi/index' + location.search,
                    add_url: 'ceshi/add',
                    edit_url: 'ceshi/edit',
                    del_url: 'ceshi/del',
                    multi_url: 'ceshi/multi',
                    import_url: 'ceshi/import',
                    table: 'ceshi',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'ceshiint', title: __('Ceshiint')},
                        {field: 'ceshinum', title: __('Ceshinum'), searchList: {"0":__('Ceshinum 0'),"1":__('Ceshinum 1'),"2":__('Ceshinum 2')}, formatter: Table.api.formatter.normal},
                        {field: 'ceshifloat', title: __('Ceshifloat'), operate:'BETWEEN'},
                        {field: 'ceshidate', title: __('Ceshidate'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'ceshitimestamp', title: __('Ceshitimestamp')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});
