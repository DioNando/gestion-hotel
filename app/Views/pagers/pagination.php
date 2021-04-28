<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation">
    <ul class="pagination mb-0">
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                    <!-- <span aria-hidden="true"><?= lang('Pager.first') ?></span> -->
                    <span aria-hidden="true"><i class="fas fa-angle-double-left"></i></span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
                    <!-- <span aria-hidden="true"><?= lang('Pager.previous') ?></span> -->
                    <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item" <?= $link['active'] ? 'class="active"' : '' ?>>
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
                    <!-- <span aria-hidden="true"><?= lang('Pager.next') ?></span> -->
                    <span aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                    <!-- <span aria-hidden="true"><?= lang('Pager.last') ?></span> -->
                    <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>