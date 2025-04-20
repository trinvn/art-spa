(function ($) {
    'use strict';

    $(document).ready(function ($) {
        // Khởi tạo nhưng ẩn nút mặc định của plugin
        $('.brxe-content-more__body').readmore({
            collapsedHeight: 58,
            moreLink: '',
            lessLink: ''
        });

        // Khi nhấn nút "Xem thêm"
        $('.brxe-content-more__button a').on('click', function (e) {
            e.preventDefault();
            let parent_item = $(this).closest('.brxe-content-more');
            parent_item.toggleClass('show').find('.brxe-content-more__body').readmore('toggle');
        });
    })
})(jQuery)