<div class="box box-solid box-inverse box-dark">
    <div class="box-body">
        @include(config('theme.admin.view').'layouts.modal-errors')
        <div class="row">
            <div class="col-12 text-right">
                <a href="#" class="btn btn-primary"
                   onclick="event.preventDefault();
                           md_supplier_contact_store(this, php_inject={{json_encode([ 'models' => ['supplier' => $supplier]])}});">
                    <i class="fa fa-save"></i></a>
            </div>
            <div class="col-12">
                @include(config('theme.member.view').'layouts.errors')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Barcode</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" placeholder="自動生成"  value="自動生成" disabled>
                    </div>


                    <label class="col-sm-2 col-form-label">啟用</label>
                    <div class="col-sm-4">
                        <input type="checkbox" class="bt-switch" name="is_active" id="is_active" value="1" {{old('is_active')==1? "checked":""}}
                        data-label-width="100%"
                               data-label-text="啟用" data-size="min"
                               data-on-text="On"    data-on-color="primary"
                               data-off-text="Off"  data-off-color="danger"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">聯絡人</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="sc_name" id="sc_name"  placeholder="聯絡人"  value="{{old('sc_name')}}">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">

    $(function () {
        //Switch
        active_switch(switch_class='bt-switch', options=[]);
    });


    function md_supplier_contact_store(_this,  php_inject){
        var formData = new FormData();
        formData.append('s_id', php_inject.models.supplier.s_id);
        formData.append('sc_name', $('#sc_name').val());
        $.ajaxSetup(active_ajax_header());
        $.ajax({
            type: 'post',
            url: '{{route('member.supplier-contact.store')}}',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                //關閉modal
                _modal = $('#modal-lg');
                _modal.children().find('.close').click();
                _modal.children().find('.modal-body').html('');


                //新增列
                cursor_move = tr_movable_html();
                sc_name = data.request.sc_name;
                sort_order  =   '<input text="type" name="supplier_contacts[ids][]" hidden value="'+data.models.supplierContact.sc_id+'">'+
                                '<input text="type" name="supplier_contacts[sc_name][]" hidden value="'+data.models.supplierContact.sc_name+'">';
                html='<tr><td>'+cursor_move+'</td><td></td><td>'+sc_name+sort_order+'</td><td>CRUD</td></tr>';
                $('#tbl-supplier-contact tbody').append(html);

                //排序
                // active_table_sortable(table_id="tbl-supplier-contact", eq_order_index=1, options={})
                active_table_tr_reorder_nth(table_id="tbl-supplier-contact", eq_order_index=1, options={});
            },

            error: function(data) {
                //轉換物件
                var request = $.parseJSON(data.responseText);
                error_bag = $(_this).parents().closest('div.box-body').children().find('#modal_errors_div');
                error_bag.html('');
                $.each(request.errors, function(key, value) {
                    error_bag.append('<li>' + value + '</li>');
                });
                error_bag.show();
            }
        });
    }
</script>
