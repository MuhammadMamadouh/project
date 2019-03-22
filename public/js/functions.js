

    function checkAll() {
        $('input[class="item_checkbox"]:checkbox').each(function () {
            if ($('input[class="check_all"]:checkbox:checked').length == 0) {
                $(this).prop('checked', !1)
            } else {
                $(this).prop('checked', !0)
            }
        })
    }

    function delete_all() {
        $(document).on('click', '.delAll', function () {
            $('#form_data').submit()
        });
        $(document).on('click', '.delBtn', function () {
            $(document).on('click', '.del_all', function () {
                $('#form_data').submit()
            });
            var itemChecked = $('input[class="item_checkbox"]:checkbox').filter(":checked").length;
            if (itemChecked > 0) {
                $('.record_count').text(itemChecked);
                $('.not_empty_record').removeClass('hidden');
                $('.empty_record').addClass('hidden')
            } else {
                $('.record_count').text('');
                $('.not_empty_record').addClass('hidden');
                $('.empty_record').removeClass('hidden')
            }
            $('#mutlipleDelete').modal('show')
        });
        $('.carousel').carousel()
    }
