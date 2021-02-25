<ul class="pagination mt-3 mb-3">
    <?php foreach($pagesArray as $page){ ?>
        <li class="<?='page-item'.$page['isActive']?>">
            <a class="page-link" href="<?=$page['href']?>"><?=$page['number']?></a>
        </li>
    <?php } ?>
</ul>