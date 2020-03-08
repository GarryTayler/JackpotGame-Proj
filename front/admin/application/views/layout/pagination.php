<hr>
<div style="text-align: center">
    <ul class="pagination" style="display: inline-block">

    </ul>
</div>
<script>
    $(function() {
        $('.pagination').pagination({

            items: '<?= $totalCount ?>',
            itemsOnPage: 10,
            currentPage: 1,
            edges: 2,
            displayedPages: 5,
            cssStyle: 'light-theme',
            hrefTextPrefix: '#',
            hrefTextSuffix: '#',
            prevText: '<i class="fa fa-angle-left"></i>',
            nextText: '<i class="fa fa-angle-right"></i>',
            onPageClick: onPageClick,
            onInit: function() {
//                    $('.pagination li:first-child').before('<li><a class="page-link" href="/users?page=1"><i class="fa fa-fast-backward"></i></a></li>');
//                    $('.pagination li:last-child').after('<li><a class="page-link" href="/users?page=<?//= $pgInfo['total_pages'] ?>//"><i class="fa fa-fast-forward"></i></a></li>');
            }
        });
    });
</script>